<?php

	
	function db_select($query){
		$mysqli = new mysqli("localhost", "ts_worker", "pass123", "talestarter_dev");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		$rtn = $mysqli->query($query);
		if($rtn){
			return $rtn->fetch_assoc();
		}else{
			echo "SQL failed: (" . $mysqli->errno . ") " . $mysqli->error;
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
			echo "SQL failed: (" . $mysqli->errno . ") " . $mysqli->error;
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
			echo "SQL failed: (" . $mysqli->errno . ") " . $mysqli->error;
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
			echo "SQL failed: (" . $mysqli->errno . ") " . $mysqli->error;
			return false;
		}
		$mysqli->close();
	}

	
?>