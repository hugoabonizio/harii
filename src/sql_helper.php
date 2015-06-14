<?php
namespace Harii;

class SQLHelper {
	function type($value) {
		if (is_bool($value))
			return \PDO::PARAM_BOOL;
		elseif (is_null($value))
			return \PDO::PARAM_NULL;
		elseif (is_int($value))
			return \PDO::PARAM_INT;
		elseif (is_string($value) || is_float($value)) // find better way
			return \PDO::PARAM_STR;
	}
}