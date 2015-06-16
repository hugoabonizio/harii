<?php
namespace Harii;

class Model extends Harii {
	public $primary_key = 'id';
	
	function __construct($attrs = array()) {
		$this->update_attributes($attrs);
	}
	
	function update_attributes($attrs) {
		foreach ($attrs as $attr=>$value) {
			$this->$attr = $value;
		}
	}
}