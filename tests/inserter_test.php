<?php
class InserterTest extends \PHPUnit_Framework_TestCase {
	function testInserQuery() {
		$inserter = new \Harii\Inserter(null, 'test_table');
		$inserter->values(array(
			'some_column' => 'value1',
			'numeric_column' => 1
		));
		
		$this->assertEquals("INSERT INTO test_table (some_column, numeric_column) VALUES (?, ?)", $inserter->query);
	}
}