<?php
class Arzen_Oauth_ServerTest extends PHPUnit_Framework_TestCase {
	
	protected $_model;
	
	public function setUp() {
		$this->_model = new Arzen_Oauth_Server();
	}
	
	public function testBase() {
		$requestToken = $this->_model->getRequestToken();
		echo $requestToken;
		$this->assertEquals("dd", $requestToken);
	}
	
}