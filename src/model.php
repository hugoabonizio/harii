<?php
namespace Harii;

class Model extends Harii {
	public $primary_key = 'id';
	public $destroyed = false;
	public $new_record = true;
	
	function __construct($attrs = array()) {
		$this->update_attributes($attrs);
	}
	
	function update_attributes($attrs) {
		foreach ($attrs as $attr=>$value) {
			$this->$attr = $value;
		}
	}
	
	function save() {
		if ($this->new_record) {
			// INSERT
			$inserter = new Inserter(self::$_PDO, self::make_name());
			$this->id = $insert->values(get_class_vars(get_class($this)))->save();
			$this->new_record = false;
			return $this;
		} else {
			// UPDATE
		}
	}
}