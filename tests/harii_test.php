<?php
// example class
class User extends \Harii\Model {	
}

class Comment extends \Harii\Model {
}

class HariiTest extends \PHPUnit_Framework_TestCase {
	protected $users;
	
	function setUp() {
		\Harii\Harii::configure(new \PDO('sqlite:' . realpath(dirname(__FILE__)) . '/db/test.db'));
		$this->users = User::all();
	}
	
	function testReturnAll() {
		// 0
		$this->assertEquals("hugo", $this->users[0]->name);
		$this->assertEquals("hugo_abonizio@hotmail.com", $this->users[0]->email);
		$this->assertEquals("12345", $this->users[0]->password);
		$this->assertEquals(false, $this->users[0]->new_record);
		// 1
		$this->assertEquals("karl marx", $this->users[1]->name);
		$this->assertEquals("das@kapital.com", $this->users[1]->email);
		$this->assertEquals("54321", $this->users[1]->password);
	}
	
	function testSizeOfResult() {
		$this->assertEquals(2, count($this->users));
	}
	
	function testClassOfResults() {
		$this->assertEquals('User', get_class($this->users[0]));
	}
	
	function testFindOne() {
		$user = User::find(1);
		$this->assertEquals('hugo', $user->name);
		$this->assertEquals('User', get_class($user));
		
		$user2 = User::find(2);
		$this->assertEquals('karl marx', $user2->name);
		$this->assertEquals(false, $user2->new_record);
		
		$fake_user = User::find(66);
		$this->assertEquals(null, $fake_user);
	}
	
	function testWhere() {
		$user_comments = Comment::where("user_id = ? AND id > ?", 1, 0);

		$this->assertEquals('Harii\Relation', get_class($user_comments));
		$this->assertEquals(2, count($user_comments));
		$this->assertEquals('hugos comment', $user_comments[0]->comment);
		$this->assertEquals('second hugos comment', $user_comments[1]->comment);
	}
	
	function testNamedWhere() {
		$user_comments = Comment::where("user_id = :user AND id > :id", array(
			'user' => 1,
			'id' => 0
		));

		$this->assertEquals(2, count($user_comments));
		$this->assertEquals('hugos comment', $user_comments[0]->comment);
		$this->assertEquals('second hugos comment', $user_comments[1]->comment);
	}
}