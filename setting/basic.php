<?php 
class basic {
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
	//---------------------
	// configファイル生成
	//----------------------
	 public static function config_file_create($post) {
	 	$config_content = "<?php 
// ローカル開発
if(\$_SERVER['HTTP_HOST'] == 'localhost') {
		\$database_name = '".$post['database_name']."';
		\$host_name         = '".$post['database_host']."';
		\$user_name         = '".$post['database_user']."';
		\$password           = '".$post['database_password']."';
}
	// 本番
	else {
		\$database_name = '".$post['database_name']."';
		\$host_name         = '".$post['database_host']."';
		\$user_name         = '".$post['database_user']."';
		\$password           = '".$post['database_password']."';
	}
\$db_config_array = array(
	'default' => array(
		'type'             => 'mysql',                     //
		'profiling'       => 'true',                       // 
		'table_prefix' => '',                              // 
		'charset'        => 'utf8',                       // 
		'connection'   => array(                      // 
			'database'  => \$database_name, // 
			'hostname' => \$host_name,         // 
			'username' => \$user_name,         // 
			'password'  => \$password,           //
		),
	'charset' => 'utf8mb4',    // charaset をutf8mb4に指定して追加
	),
);";
	 	// ファイルに書き込む
	 	file_put_contents(PATH.'setting/db_config.php', $config_content);
	}
	//-----------------
	// DB接続チェック
	//-----------------
	 public static function db_conect_check($db_config_array) {
		$db = new mysqli($db_config_array['default']['connection']['hostname'],$db_config_array['default']['connection']['username'],$db_config_array['default']['connection']['password'], $db_config_array['default']['connection']['database']);
		if ($db->connect_error) {
			$connect_check = false;
		}
			else {
				$connect_check = true;
			}
		return $connect_check;
	}
	//-------------------
	// basic_idチェック
	//-------------------
	public static function basic_id_check($post) {
		// チェック変数
		$user_basic_id_check = true;
		// 半角英数字(-_含む)だけか調べる
		$pattern = '/^[a-zA-Z0-9_-]+$/';
		if(preg_match($pattern, $post["basic_id"], $basic_id_array)) {
			$signup_basic_id_res = model_db::query("
				SELECT *
				FROM user
				WHERE basic_id = '".$post["basic_id"]."'");
			foreach($signup_basic_id_res as $key => $value) {
				$user_basic_id_check = false;
			}
		}
			else {
				$user_basic_id_check = false;
			}
		return $user_basic_id_check;
	}
	//---------------------------------
	//メールアドレスをチェックする
	//---------------------------------
	public static function email_check($post) {
		// チェック変数
		$user_email_check = true;
		// 正しいメールアドレスかどうか調べる関数
		$user_email_check = library_validateemail_basis::validate_email($post["email"]);
		if($user_email_check) {
			$signup_email_res = model_db::query("
				SELECT *
				FROM user
				WHERE email = '".$post["email"]."'");
			foreach($signup_email_res as $key => $value) {
				$user_email_check = false;
			}
		}
			else {
				$user_email_check = false;
			}
		return $user_email_check;
	}
	//---------------------------
	//パスワードをチェックする
	//---------------------------
	public static function password_check($post) {
		// チェック変数
		$user_password_check = true;
		// 半角英数字だけか調べる
		$pattern = '/^[a-zA-Z0-9_-]+$/';
		if(preg_match($pattern, $post["password"], $password_array)) {
			$password_number = strlen($post["password"]);
			// 4文字未満ならアウト
			if($password_number < 4) {
					$user_password_check = false;
			}
		}
			// 半角英数字以外が入っている場合
			else {
				$user_password_check = false;
			}
		return $user_password_check;
	}
	//--------------------------------
	//セットアップからユーザー登録
	//--------------------------------
	public static function setup_to_user_signup($post) {
		// hash生成
		$password_hash = password_hash($post['password'], PASSWORD_DEFAULT);
			// ユーザー登録
			model_db::query("
				INSERT INTO user (
					basic_id,
					password
				)
				VALUES (
					'".$post['basic_id']."', 
					'".$password_hash."'
				)
			");
			// サイト名変更
			model_db::query("
				UPDATE setting 
				SET
					title = '".$post['site_name']."'
				WHERE setting_id = 1;");
	}
}
