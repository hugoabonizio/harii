<?php
// example class
class User extends Harii {	
}

class HariiTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		Harii::configure(new PDO('sqlite:' . realpath(dirname(__FILE__)) . '/db/test.db'));
	}
	
	function testFirstOfAll() {
		$users = User::all();
		// 0
		$this->assertEquals("hugo", $users[0]->name);
		$this->assertEquals("hugo_abonizio@hotmail.com", $users[0]->email);
		$this->assertEquals("12345", $users[0]->password);
		// 1
		$this->assertEquals("karl marx", $users[1]->name);
		$this->assertEquals("das@kapital.com", $users[1]->email);
		$this->assertEquals("54321", $users[1]->password);
	}
	
	function testSizeOfResult() {
		$users = User::all();
		$this->assertEquals(2, count($users));
	}
}