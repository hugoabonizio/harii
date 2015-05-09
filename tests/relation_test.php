<?php
class RelationTest extends PHPUnit_Framework_TestCase {
	protected $relation;
	
	function setUp() {
		$this->relation =  new \Harii\Relation(array(1, 3, 5));
	}
	
	function testActLikeArray() {
		$this->assertEquals(1, $this->relation[0]);
		$this->assertEquals(3, $this->relation[1]);
		$this->assertEquals(5, $this->relation[2]);
	}
	
	function testActLikeIterator() {
		$result = array();
		foreach ($this->relation as $member) {
			$result[] = $member;
		}
		$this->assertEquals(1, $this->relation[0]);
		$this->assertEquals(3, $this->relation[1]);
		$this->assertEquals(5, $this->relation[2]);
	}
	
	function testCountableBehavior() {
		$this->assertEquals(3, count($this->relation));
	}
}