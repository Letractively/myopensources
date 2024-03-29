<?php 
/* SVN FILE: $Id$ */
/* User Fixture generated on: 2009-01-17 17:01:37 : 1232185177*/

class UserFixture extends CakeTestFixture {
	var $name = 'User';
	var $table = 'users';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'username' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
			'password' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'username'  => 'Lorem ipsum dolor sit amet',
			'password'  => 'Lorem ipsum dolor sit amet'
			));
}
?>