<?php
class basic {
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
	//--------------------------------
	//ポストの中身をエンティティ化する
	//--------------------------------
	public static function post_security() {
		$post = array();
		foreach($_POST as $key => $value) {
			$post[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
		}
		return $post;
	}
	//--------------------------------
	//ゲットの中身をエンティティ化する
	//--------------------------------
	public static function get_security() {
		$get = array();
		foreach($_GET as $key => $value) {
			$get[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
		}
		return $get;
	}
	//------------------------
	//変数をエンティティ化する
	//------------------------
	static function variable_security_entity($variable) {
		if(is_array($variable)) {
			foreach($variable as $key => $value) {
				$variable[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
			}
		}
			else {
				$variable = htmlspecialchars($$variable, ENT_QUOTES, 'UTF-8');
			}
		return $variable;
	}
	//-------------------
	// ディレクトリ作成
	//-------------------
	 public static function dir_create($directory_path) {
		if( file_exists($directory_path) ) {
		
		}
			else {
				if(mkdir($directory_path, 0755)) {
					chmod($directory_path, 0755);
				}
			}
	}
	//----------------------------------
	//ディレクトリー内のファイルを全削除
	//----------------------------------
	public static function dir_file_all_del($dir) {
		// ディテクトリ内のオブジェクト取得
		if($cache_opendir_object = opendir($dir)) {
			// オブジェクト走査
			while (false !== ($file_name = readdir($cache_opendir_object))) {
				// .と..を外す
				if($file_name != '.'  && $file_name != '..') {
					// ファイル削除
					unlink($dir.$file_name);
				}
			}
			// ディレクトリーを閉じる
			closedir($cache_opendir_object);
		}
	}
	//-------------------
	// ディレクトリ削除
	//-------------------
	public static function rmdirAll($dir) {
	//	pre_var_dump($dir);
		// 指定されたディレクトリ内の一覧を取得
		$res = glob($dir.'/*');
		// 一覧をループ
		foreach ($res as $f) {
			// is_file() を使ってファイルかどうかを判定
			if (is_file($f)) {
				// ファイルならそのまま削除
				unlink($f);
			} else {
				// ディレクトリの場合（ファイルでない場合）は再度rmdirAll()を実行
				Library_Dir_Basis::rmdirAll($f);
			}
		} // foreach ($res as $f) {
		// 中身を削除した後、本体削除
		rmdir($dir);
	}
	//----
	//削除
	//----
	/**
	* 再帰的にディレクトリを削除する。
	* @param string $dir ディレクトリ名（フルパス）
	*/
	 public static function removeDir($dir) {
	    $cnt = 0;
	    $handle = opendir($dir);
	
	    if (!$handle) {
	        return ;
	    }
	    while (false !== ($item = readdir($handle))) {
	        if ($item === "." || $item === "..") {
	            continue;
	        }
	        $path = $dir . DIRECTORY_SEPARATOR . $item;
	        if (is_dir($path)) {
	            // 再帰的に削除
	            $cnt = $cnt + Library_Dir_Basis::removeDir($path);
	        }
	        else {
	            // ファイルを削除
	            unlink($path);
	        }
	    }
	    closedir($handle);
	
	    // ディレクトリを削除
	    if (!rmdir($dir)) {
	        return ;
	    }
	}

}
