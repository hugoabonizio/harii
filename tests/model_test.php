<?php
// example class
class ModelTest extends \Harii\Model {
	public $attr1, $attr2;
}

class HariiTest extends \PHPUnit_Framework_TestCase {
	function testMassAssignment() {
		$m1 = new ModelTest(array(
			'attr1' => 1,
			'attr2' => 2
		));
		
		$this->assertEquals(1, $m1->attr1);
		$this->assertEquals(2, $m1->attr2);
	}
	
	function testUpdateAttributes() {
		$m2 = new ModelTest();
		$attrs = array('attr1' => 'a');
		$m2->update_attributes($attrs);
		
		$this->assertEquals('a', $m2->attr1);
		$this->assertEquals(null, $m2->attr2);
	}
}