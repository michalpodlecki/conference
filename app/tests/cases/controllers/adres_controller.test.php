<?php
/* Adres Test cases generated on: 2011-02-27 20:52:51 : 1298836371*/
App::import('Controller', 'Adres');

class TestAdresController extends AdresController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AdresControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.adre');

	function startTest() {
		$this->Adres =& new TestAdresController();
		$this->Adres->constructClasses();
	}

	function endTest() {
		unset($this->Adres);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>