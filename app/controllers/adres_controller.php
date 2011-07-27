<?php
class AdresController extends AppController {

	var $name = 'Adres';

	function index() {
		$this->Adre->recursive = 0;
		$this->set('adres', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid adre', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('adre', $this->Adre->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Adre->create();
			if ($this->Adre->save($this->data)) {
				$this->Session->setFlash(__('The adre has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The adre could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid adre', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Adre->save($this->data)) {
				$this->Session->setFlash(__('The adre has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The adre could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Adre->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for adre', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Adre->delete($id)) {
			$this->Session->setFlash(__('Adre deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Adre was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>