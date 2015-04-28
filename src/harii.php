<?php
include_once 'helation.php';

class Harii {
	private static $_PDO;
	private $_CURRENT_QUERY;
	
	static function configure($configs) {
		self::$_PDO = $configs;
	}
	
	static function all() {
		// store the query globaly, this way you can analyse this
		// later and/or make tests
		$_CURRENT_QUERY = "SELECT * FROM " . self::make_name() . ";";
		$result = self::$_PDO->query($_CURRENT_QUERY)->fetchAll(PDO::FETCH_ASSOC);
		$members = array();
		$class_name = self::make_name(); // get the class name and strtolower()
		
		foreach ($result as $row) {
			// create a object of the class
			$m = new $class_name();
			// and set the attributs
			foreach ($row as $attr=>$value) {
				$m->$attr = $value;
			}
			$members[] = $m;
		}
		
		$relation = new Helation($members);
		return $relation;
	}
	
	static function make_name() {
		if (isset($this)) { // if object context
			return strtolower(get_class($this));
		} else { // if calling statically
			return get_called_class();
		}
	}
}
