<?php
class Harii {
	private static $_PDO;
	
	static function configure($configs) {
		self::$_PDO = $configs;
	}
}
	