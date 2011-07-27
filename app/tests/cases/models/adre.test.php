<?php
/* Adre Test cases generated on: 2011-02-26 01:44:40 : 1298681080*/
App::import('Model', 'Adre');

class AdreTestCase extends CakeTestCase {
	var $fixtures = array('app.adre');

	function startTest() {
		$this->Adre =& ClassRegistry::init('Adre');
	}

	function endTest() {
		unset($this->Adre);
		ClassRegistry::flush();
	}

}
?>