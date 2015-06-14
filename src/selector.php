<?php
namespace Harii;
include_once 'sql_helper.php';

class Selector extends SQLHelper {
	function __construct($pdo, $table_name, $class_name = null) {
		$this->pdo = $pdo;
		$this->table_name = $table_name;
		$this->query =  "SELECT * FROM " . $table_name;
		$this->where = " 1 = 1";
		
		if ($class_name)
			$this->class_name = $class_name;
		else
			$this->class_name = $table_name;
	}
	
	function select($conditions = null, $values = null) {
		if ($conditions) {// else continues to be 1 = 1
			$this->where = $conditions;
		}
		
		$this->query .= " WHERE " . $this->where;
		$this->stmt = $this->pdo->prepare($this->query);
		
		// bind parameters passed after condition (first parameter)
		foreach ((array) $values as $key => $value) {
			if (is_numeric($key))
				$this->stmt->bindValue($key + 1, $value, $this->type($value));
			else // string like ':name'
				$this->stmt->bindValue($key, $value, $this->type($value));
		}
		return $this;
	}
	
	function get() {
		$this->stmt->execute();
		$members = array();
		
		foreach ($this->stmt->fetchAll(\PDO::FETCH_ASSOC) as $row) {
			// create a object of the class
			$m = new $this->class_name();
			// and set the attributes
			foreach ($row as $attr=>$value) {
				$m->$attr = $value;
			}
			$members[] = $m;
		}
		return $members;
	}
}