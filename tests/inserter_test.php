<?php
class User extends \Harii\Model {
	public $id, $name, $email, $password;
}

class InserterTest extends \PHPUnit_Framework_TestCase {
	function setUp() {
		\Harii\Harii::configure(new \PDO('sqlite:' . realpath(dirname(__FILE__)) . '/db/test.db'));
	}
	
	function testInsertQuery() {
		$inserter = new \Harii\Inserter(null, 'test_table');
		$inserter->values(array(
			'some_column' => 'value1',
			'numeric_column' => 1
		));
		
		$this->assertEquals("INSERT INTO test_table (some_column, numeric_column) VALUES (?, ?)", $inserter->query);
	}
	
	function testCreate() {
		$rand = rand(0, 9999999);
		$user = User::create(array(
			'name' => 'user name ' . $rand,
			'email' => 'email_' . $rand . '@email.com',
			'password' => 123456
		));
		
		$select = User::where(array('name' => 'user name ' . $rand));
		
		$this->assertEquals('user name ' . $rand, $user->name); // return a User object
		$this->assertEquals(false, $user->new_record);
		$this->assertEquals(true, is_numeric($user->id)); // return inserted id
		$this->assertEquals('email_' . $rand . '@email.com', $select->first()->email);
		
	}
}