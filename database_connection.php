<?php
	function sql_escape($text){
	$mysqli = new mysqli("localhost", "ts_worker", "pass123", "talestarter_dev");	
	$text = $mysqli->real_escape_string($text);
	return $text;
	}
	
	function db_select($query){
		$mysqli = new mysqli("localhost", "ts_worker", "pass123", "talestarter_dev");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$rtn = $mysqli->query($query);
		if($rtn){
			return $rtn->fetch_assoc();
		}else{
			return false;
		}
		$mysqli->close();
	}
	
	function db_select_multi($query){
		$mysqli = new mysqli("localhost", "ts_worker", "pass123", "talestarter_dev");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$result = $mysqli->query($query);
		$rtn = array();
		while($row = $result->fetch_assoc()) {
			$rtn[] = $row;
		}
		if($rtn){
			return $rtn;
		}else{
			return false;
		}
		$mysqli->close();
	}
	
	
	function db_insert($query){
		$mysqli = new mysqli("localhost", "ts_worker", "pass123", "talestarter_dev");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$rtn = $mysqli->query($query);
		if($rtn){
			return $mysqli->insert_id;
		}else{
			return false;
		}
		$mysqli->close();
	}
	
		function db_update($query){
		$mysqli = new mysqli("localhost", "ts_worker", "pass123", "talestarter_dev");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$rtn = $mysqli->query($query);
		if($rtn){
			return true;
		}else{
			return false;
		}
		$mysqli->close();
	}

	
?>