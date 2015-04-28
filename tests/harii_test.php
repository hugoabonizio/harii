<?php
// example class
class User extends Harii {	
}

class HariiTest extends PHPUnit_Framework_TestCase {
	function testFirstOfAll() {
		Harii::configure(new PDO('sqlite:' . realpath(dirname(__FILE__)) . '/db/test.db'));
		$users = User::all();
		$this->assertEquals("hugo", $users[0]->name);
		$this->assertEquals("hugo_abonizio@hotmail.com", $users[0]->email);
		$this->assertEquals("12345", $users[0]->password);
	}
}