<?php
namespace Harii;
include_once 'sql_helper.php';

class Inserter extends SQLHelper {
	function __construct($pdo, $table_name, $class_name = null) {
		$this->pdo = $pdo;
		$this->table_name = $table_name;
		$this->query = "INSERT INTO " . $table_name . " ";
		
		if ($class_name)
			$this->class_name = $class_name;
		else
			$this->class_name = $table_name;
	}
	
	function values($values = array()) {
		$keys = array_keys($values);
		$values_params = array_fill(0, count($keys), '?');
		
		$columns = '(' . implode(', ', $keys) . ')';
		$columns_params = '(' . implode(', ', $values_params) . ')';
		
		$this->query .= $columns . " VALUES " . $columns_params;
	}
}