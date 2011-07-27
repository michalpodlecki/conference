<?php
/*
* File: /app/controllers/components/attachment.php
* A file uploader and image crop/thumbnailer component for CakePHP
*
* @link         https://github.com/tute/Thumbnail-component-for-CakePHP
* @author       TuteC (Eugenio Costa)
* @version      0.9
* @license      MIT
*
*/

App::import('Core', 'Inflector');

class AttachmentComponent extends Object {

	/**
	 * Configuration options
	 * @var $config array
	 */
	var $config = array(
		'files_dir'   => '',
		'rm_tmp_file' => false,
		'allow_non_image_files' => true,
		'images_size' => array(
			/* You may define as many options as you like */
			/*'big'   => array(640, 480, 'resize'),
			'med'   => array(263, 263, 'resizeCrop'),
			'small' => array( 90,  90, 'resizeCrop')*/
		)
	);

	/**
	 * Initialization method. You may override configuration options from a controller
	 *
	 * @param $controller object
	 * @param $config array
	 */
	function initialize(&$controller, $config) {
		$this->controller = $controller;
		$model_prefix = Inflector::tableize($controller->modelClass); // lower case, studley caps -> underscores
		$prefix = Inflector::singularize($model_prefix); // make singular. 'GalleryImage' becomes 'gallery_image'
		$this->config = array_merge(
			array('default_col' => $prefix), /* default column prefix is lowercase, singular model name */
			$this->config, /* default general configuration */
			$config        /* overriden configurations */
		);
	}

	/**
	* Uploads file to file system, according to $config.
	* Example usage:
	*	 $this->Attachment->upload($this->data['Model']['Attachment']);
	*
	* @return mixed boolean true on success, or error string
	* @param $data array the file input array
	* @param $column_prefix string The prefix of the fields used to store the uploaded file data
	*
	*/
	function upload(&$data, $column_prefix = null) {
		if ($column_prefix == null) {
			$column_prefix = $this->config['default_col'];
		} else {
			$this->config['default_col'] = $column_prefix;
		}

		$file = $data[$this->config['default_col']];
		if ($file['error'] === UPLOAD_ERR_OK) {
			return $this->upload_FS($data);
		} else {
			return $this->log_proper_error($file['error']);
		}
	}

	/**
	 * Creates the relevant dir's and processes the file
	 *
	 * @return mixed boolean true on success, or error string
	 * @param $data array The array of data from the controlle
	 */
	function upload_FS(&$data) {
		$column_prefix = $this->config['default_col'];
		$error = 0;
		$tmpuploaddir  = WWW_ROOT.'attachments'.DS.'tmp'; // /tmp/ folder (should delete image after upload)
		$fileuploaddir = WWW_ROOT.'attachments'.DS.'files';

		// Make sure the required directories exist, and create them if necessary
		if (!is_dir($tmpuploaddir)) mkdir($tmpuploaddir, 0777, true);
		if (!is_dir($fileuploaddir)) mkdir($fileuploaddir, 0777, true);

		/* Generate a unique name for the file */
		$filetype = end(split('\.', $data[$column_prefix]['name']));
		$filename = String::uuid();
		settype($filename, 'string');
		$filename .= '.' . $filetype;

		/* Security check */
		if (!is_uploaded_file($data[$column_prefix]['tmp_name'])) {
			return $this->log_cakephp_error_and_return('Error uploading file (sure it was a POST request?).');
		}

		/* If it's image get image size and make thumbnail copies. */
		if ($this->is_image($filetype)) {
			$this->copy_or_log_error($data[$column_prefix]['tmp_name'], $tmpuploaddir, $filename);
			/* Create each thumbnail_size */
			foreach ($this->config['images_size'] as $dir => $opts) {
				$this->thumbnail($tmpuploaddir.DS.$filename, $dir, $opts[0], $opts[1], $opts[2]);
			}
			if ($this->config['rm_tmp_file'])
				unlink($tmpuploaddir.DS.$filename);
		} else {
			if (!$this->config['allow_non_image_files']) {
				return $this->log_cakephp_error_and_return('File type not allowed (only images files).');
			} else {
				$this->copy_or_log_error($data[$column_prefix]['tmp_name'], $fileuploaddir, $filename);
			}
		}

		/* File uploaded, return modified data array */
		$res[$column_prefix.'_file_path'] = $filename;
		$res[$column_prefix.'_file_name'] = $data[$column_prefix]['name'];
		$res[$column_prefix.'_file_size'] = $data[$column_prefix]['size'];
		$res[$column_prefix.'_content_type'] = $data[$column_prefix]['type'];
		unset($data[$column_prefix]); /* delete $_FILES indirection */
		$data = array_merge($data, $res); /* add default fields */

		return true;
	}


	/**
	 * Deletes file, or image and associated thumbnail
	 * e.g;
	 *	$this->Attachment->delete_files('file_name.jpg');
	 *
	 * @param $filename string The file to delete
	 */
	function delete_files($filename) {
		/* Non image files */
		if (is_file(WWW_ROOT.'attachments'.DS.'files'.DS.$filename)) {
			unlink(WWW_ROOT.'attachments'.DS.'files'.DS.$filename);
		}
		/* tmp files (if not pruned while uploading) */
		if (is_file(WWW_ROOT.'attachments'.DS.'tmp'.DS.$filename)) {
			unlink(WWW_ROOT.'attachments'.DS.'tmp'.DS.$filename);
		}
		/* Thumbnail copies */
		foreach ($this->config['images_size'] as $size => $opts) {
			$photo = WWW_ROOT.'attachments'.DS.$this->config['files_dir'].DS.$size.DS.$filename;
			if (is_file($photo)) unlink($photo);
		}
	}

	


	/* Many helper functions */

	function copy_or_log_error($tmp_name, $dst_folder, $dst_filename) {
		if (is_writeable($dst_folder)) {
			if (!copy($tmp_name, $dst_folder.DS.$dst_filename)) {
				unset($dst_filename);
				return $this->log_cakephp_error_and_return('Error uploading file.', 'publicaciones');
			}
		} else {
			// if dst_folder not writeable, let developer know
			debug('You must allow proper permissions for image processing. And the folder has to be writable.');
			debug("Run 'chmod 755 $dst_folder', and make sure the web server is it's owner.");
			return $this->log_cakephp_error_and_return('No write permissions on attachments folder.');
		}
	}

	function is_image($file_type) {
		$image_types = array('jpeg', 'jpg', 'gif', 'png');
		return in_array(strtolower($file_type), $image_types);
	}

	function log_proper_error($err_code) {
		switch ($err_code) {
			case UPLOAD_ERR_NO_FILE:
				return 0;
			case UPLOAD_ERR_INI_SIZE:
				$e = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$e = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
				break;
			case UPLOAD_ERR_PARTIAL:
				$e = 'The uploaded file was only partially uploaded.';
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$e = 'Missing a temporary folder.';
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$e = 'Failed to write file to disk.';
				break;
			case UPLOAD_ERR_EXTENSION:
				$e = 'File upload stopped by extension.';
				break;
			default:
				$e = 'Unknown upload error. Did you add array(\'type\' => \'file\') to your form?';
		}
		return $this->log_cakephp_error_and_return($e);
	}

	function log_cakephp_error_and_return($msg) {
		$_error["{$this->config['default_col']}_file_name"] = $msg;
		$this->controller->{$this->controller->modelClass}->validationErrors = array_merge($_error, $this->controller->{$this->controller->modelClass}->validationErrors);
		$this->log($msg, 'attachment-component');
		return false;
	}

	function image_type_to_extension($imagetype) {
		if (empty($imagetype)) return false;
		switch($imagetype) {
			case IMAGETYPE_TIFF_II : return 'tiff';
			case IMAGETYPE_TIFF_MM : return 'tiff';
			case IMAGETYPE_GIF  : return 'gif';
			case IMAGETYPE_JPEG : return 'jpg';
			case IMAGETYPE_PNG  : return 'png';
			case IMAGETYPE_SWF  : return 'swf';
			case IMAGETYPE_PSD  : return 'psd';
			case IMAGETYPE_BMP  : return 'bmp';
			case IMAGETYPE_JPC  : return 'jpc';
			case IMAGETYPE_JP2  : return 'jp2';
			case IMAGETYPE_JPX  : return 'jpf';
			case IMAGETYPE_JB2  : return 'jb2';
			case IMAGETYPE_SWC  : return 'swc';
			case IMAGETYPE_IFF  : return 'aiff';
			case IMAGETYPE_WBMP : return 'wbmp';
			case IMAGETYPE_XBM  : return 'xbm';
			default             : return false;
		}
	}
}
?>