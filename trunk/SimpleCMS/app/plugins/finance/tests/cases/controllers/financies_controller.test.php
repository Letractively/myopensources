<?php 
/* SVN FILE: $Id$ */
/* FinanciesController Test cases generated on: 2009-02-22 15:02:06 : 1235316186*/
App::import('Controller', 'Finance.Financies');

class TestFinancies extends FinanciesController {
	var $autoRender = false;
}

class FinanciesControllerTest extends CakeTestCase {
	var $Financies = null;

	function setUp() {
		$this->Financies = new TestFinancies();
		$this->Financies->constructClasses();
	}

	function testFinanciesControllerInstance() {
		$this->assertTrue(is_a($this->Financies, 'FinanciesController'));
	}

	function tearDown() {
		unset($this->Financies);
	}
}
?>