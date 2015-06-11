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