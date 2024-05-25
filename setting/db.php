<?php
class model_db {
	//-------
	// DB接続
	//-------
	public static function db_conect($db_config_array) {
		$db = new mysqli($db_config_array['default']['connection']['hostname'], $db_config_array['default']['connection']['username'], $db_config_array['default']['connection']['password'], $db_config_array['default']['connection']['database']);
		if ($db->connect_error) {
			echo '<b>Warning</b>: mysqli::__construct(): ' . $db->connect_error;
			return null; // 接続失敗時はnullを返す
		}
		$db->set_charset($db_config_array['default']['charset']);
		return $db;
	}

	//-------
	// クエリ
	//-------
	public static function query($query) {
		global $db_config_array;
		$query_pattern = '';
		// DB接続
		$db = self::db_conect($db_config_array);
		if (!$db) {
			return []; // DB接続に失敗した場合は空の配列を返す
		}

		try {
			if (preg_match('/INSERT INTO/', $query)) {
				$query_pattern = 'INSERT';
			} else if (preg_match('/SELECT/', $query)) {
				$query_pattern = 'SELECT';
			} else if (preg_match('/UPDATE/', $query)) {
				$query_pattern = 'UPDATE';
			}

			$select_array = [];
			if ($result = $db->query($query)) {
				switch ($query_pattern) {
					case 'SELECT':
						while ($row = $result->fetch_assoc()) {
							$select_array[] = $row;
						}
						$result->close();
						break;
					case 'INSERT':
					case 'UPDATE':
						$select_array = $result;
						break;
				}
			}
			return $select_array;
		} catch (mysqli_sql_exception $e) {
			// 後ほど logに出力する方法で再実装する
			//			echo "SQL Error: " . $e->getMessage(); // エラーメッセージの出力
			return []; // エラー発生時は空の配列を返す
		}
	}
}
