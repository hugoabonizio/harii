<?php
class HelationTest extends PHPUnit_Framework_TestCase {
	function testActLikeArray() {
		$r = new Helation(array(1, 3, 5));
		$this->assertEquals(1, $r[0]);
		$this->assertEquals(3, $r[1]);
		$this->assertEquals(5, $r[2]);
	}
	
	function testActLikeIterator() {
		$result = array();
		$r = new Helation(array(1, 3, 5));
		foreach ($r as $member) {
			$result[] = $member;
		}
		$this->assertEquals(1, $r[0]);
		$this->assertEquals(3, $r[1]);
		$this->assertEquals(5, $r[2]);
	}
}