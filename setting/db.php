<?php 
class model_db {
	//-------
	// DB接続
	//-------
	 public static function db_conect($db_config_array) {
		$db = new mysqli($db_config_array['default']['connection']['hostname'],$db_config_array['default']['connection']['username'],$db_config_array['default']['connection']['password'], $db_config_array['default']['connection']['database']);
		if ($db->connect_error) {
		    echo $db->connect_error;
		    exit();
		}
			else {
				$db->set_charset($db_config_array['default']['charset']);
			}
		return $db;
	}
	//-------
	// クエリ
	//-------
	 public static function query($query) {
		global $db_config_array;
		// DB接続
		$db = model_db::db_conect($db_config_array);

		if(preg_match('/INSERT INTO/', $query)) {
			$query_pattern = 'INSERT';
		}
			else if(preg_match('/SELECT/', $query)) {
				$query_pattern = 'SELECT';
			}
				else if(preg_match('/UPDATE/', $query)) {
					$query_pattern = 'UPDATE';
				}
		$select_array = array();
		if($result = $db->query($query)) {
			switch($query_pattern) {
				case 'SELECT':
					while($row = $result->fetch_assoc()) {
						$select_array[] = $row;
					}
					$result->close();
				break;
				case 'INSERT':
					$select_array = $result;
				break;
				case 'UPDATE':
					$select_array = $result;
				break;
			}
		}
			else {
		
			}
		return $select_array;
	}
}