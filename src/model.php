<?php
namespace Harii;

class Model extends Harii {
	function __construct() {
		if (func_num_args()) {
			update_attributes(func_get_args()[1]);
		}
	}
	
	function update_attributes($attrs) {
		foreach ($attrs as $attr=>$value) {
			$this->$attrs = $value;
		}
	}
}