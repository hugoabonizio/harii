<?php
class Helation implements ArrayAccess, Iterator {
	private $members = array();
	private $position = 0;

	function __construct($members) {
		$this->members = $members;
		$this->position = 0;
	}

	function offsetSet($offset, $value) {
		if (is_null($offset)) {
			$this->members[] = $value;
		} else {
			$this->members[$offset] = $value;
		}
	}

	function offsetExists($offset) {
		return isset($this->members[$offset]);
	}

	function offsetUnset($offset) {
		unset($this->members[$offset]);
	}

	function offsetGet($offset) {
		return isset($this->members[$offset]) ? $this->members[$offset] : null;
	}
	
	function rewind() {
		$this->position = 0;
	}

	function current() {
		return $this->members[$this->position];
	}

	function key() {
		return $this->position;
	}

	function next() {
		++$this->position;
	}

	function valid() {
		return isset($this->members[$this->position]);
	}
}