<?php
namespace Harii;
include_once 'relation.php';
include_once 'model.php';

class Harii {
	private static $_PDO;
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
	
	static function all() {
		// store the query globaly, this way you can analyse this
		// later and/or make tests
		$_CURRENT_QUERY = "SELECT * FROM " . self::make_name() . ";";
		$result = self::$_PDO->query($_CURRENT_QUERY)->fetchAll(\PDO::FETCH_ASSOC);
		$members = array();
		$class_name = self::make_name(); // get the class name and strtolower()
		
		foreach ($result as $row) {
			// create a object of the class
			$m = new $class_name();
			// and set the attributes
			foreach ($row as $attr=>$value) {
				$m->$attr = $value;
			}
			$members[] = $m;
		}
		
		$relation = new Relation($members);
		return $relation;
	}
	
	// find by id of the record
	static function find($id) {
		$_CURRENT_QUERY = "SELECT * FROM " . self::make_name() . " WHERE id = ?;";
		$stmt = self::$_PDO->prepare($_CURRENT_QUERY);
		$stmt->bindParam(1, $id);
		$stmt->execute();
		
		$class_name = self::make_name(); // get the class name and strtolower()
		
		foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row) {
			$m = new $class_name();
			// and set the attributes
			foreach ($row as $attr=>$value) {
				$m->$attr = $value;
			}
			return $m; // return in the first member of relation
		}
	}
	
	// usage example:
	// User::where("condition = ?", $value1);
	static function where() {
		// get parameters dinamically
		$args = func_get_args();
		$condition = $args[0];
		
		$_CURRENT_QUERY = "SELECT * FROM " . self::make_name() . " WHERE " . $condition . ";";
		$stmt = self::$_PDO->prepare($_CURRENT_QUERY);
		// bind parameters passed after condition (first parameter)
		for ($i = 1; $i < func_num_args(); $i++) {
			$stmt->bindValue($i, $args[$i]);
		}
		$stmt->execute();
		
		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$members = array();
		$class_name = self::make_name(); // get the class name and strtolower()
		
		foreach ($result as $row) {
			// create a object of the class
			$m = new $class_name();
			// and set the attributes
			foreach ($row as $attr=>$value) {
				$m->$attr = $value;
			}
			$members[] = $m;
		}
		
		$relation = new Relation($members);
		return $relation;
	}
	
	
}
