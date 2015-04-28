<?php
include_once 'helation.php';

class Harii {
	private static $_PDO;
	
	static function configure($configs) {
		self::$_PDO = $configs;
	}
	
	static function all() {
		$relation = new Helation(array(1, 3, 5, 7, 13));
		return $relation;
	}
}
