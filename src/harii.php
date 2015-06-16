<?php
namespace Harii;
include_once 'relation.php';
include_once 'model.php';
include_once 'selector.php';
include_once 'inserter.php';

class Harii {
	public static $_PDO;
	public $_CURRENT_QUERY;
	
	static function configure($pdo, $configs = array('enviroment' => 'development')) {
		self::$_PDO = $pdo;
		if (isset($configs['enviroment']) && $configs['enviroment'] != 'production') {
			self::$_PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
	}
	
	static function make_name() {
		if (isset($this)) { // if object context
			$name = get_class($this);
		} else { // if calling statically
			$name = get_called_class();
		}
		$name = explode("\\", $name);
		return strtolower($name[count($name) - 1]);
	}
	
	
	
	// find by id of the record
	static function find($id) {
		$result = self::where("id = ?", $id);
		if (count($result))
			return $result[0];
		else
			return null;
	}
	
	static function all() {
		return self::where();
	}
	
	// usage example:
	// User::where("condition = ?", $value1);
	static function where() {
		$selector = new Selector(self::$_PDO, self::make_name());
		
		// get parameters dinamically
		$args = func_get_args();
		if (func_num_args()) {
			if (is_array($args[0])) {// pass just array as array('username' => 'hugo')
				$params = $args[0];
			} elseif (is_string($args[0])) { // "condition", values...
				if (func_num_args() == 2 and is_array($args[1])) {
					$params = array_slice($args, 1)[0];
				} else {
					$params = array_slice($args, 1);
				}
			}
			
			$result = $selector->select($args[0], $params)->get();
		} else {
			$result = $selector->select()->get();
		}
		
		$relation = new Relation($result);
		return $relation;
	}
	
	static function create($attrs) {
		$class_name = self::make_name();
		$inserter = new Inserter(self::$_PDO, $class_name);
		$attrs['id'] = $inserter->values($attrs)->save();
		return new $class_name($attrs);
	}
	
	
}
