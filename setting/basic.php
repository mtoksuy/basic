<?php 
class basic {
	//------------------------
	// ヴァーダンプの進化版
	//------------------------
	public static function pre_var_dump($data = '') {
		echo '<pre class="debug">';
		var_dump($data);
		echo '</pre>';
	}
	//-----------------------------
	// オブジェクトヴァーダンプ
	//-----------------------------
	function obj_var_dump($name, $val) {
	// if (!isset($val)) {return ('');}
	if (is_array($val)) {
		ksort($val);
		foreach ($val as $key => $contents) {
			$key = $name . "['" . $key . "']";
			$ret .= obj_var_dump($key, $contents);
		}
	}
		else if (is_object($val)) {
			$className = get_class($val);
			$vars = get_class_vars($className);
			$props = get_object_vars($val);
			$methods = get_class_methods($className);
			if (is_array($props) && count($props) > 0) {
				$key = 'OBJECT:' . $className . '->(property)';
				$ret .= obj_var_dump($key, $props);
			}
			if (is_array($methods) && count($methods) > 0) {
				$key = 'OBJECT:' . $className . '->(method)';
				$ret .= obj_var_dump($key, $methods);
			}
		}
			else {
				if (is_numeric($val)) {
					$ret = '$' . $name . ' = ' . $val . ";\n";
				}
					else {
						$val = htmlspecialchars($val);
						$val = preg_replace('/[\r\n]/', '\\n ', $val);
						$ret = '$' . $name . ' = \'' . $val . "';\n";
					}
			}
	echo '<pre>'.$ret.'</pre>';
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
	public static function variable_security($variable) {
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
	//----------------
	//サイト情報取得
	//-----------------
	public static function site_data_get() {
		$site_data_array = array();
		$query = model_db::query("
			SELECT *
			FROM setting
		");
		$query_a = model_db::query("
			SELECT COUNT(primary_id)
			FROM contact
			WHERE del = 0
			AND read_check = 0
		");
//		pre_var_dump($query);
//		pre_var_dump($query_a);
		$site_data_array = $query[0];
		$site_data_array['contact_unread_count'] = $query_a[0]['COUNT(primary_id)'];
//		pre_var_dump($site_data_array);
		return $site_data_array;
	}
	//----------------
	//ページ情報取得
	//-----------------
	public static function page_data_get($controller_query) {
		$page_data_array = array();
		$query = model_db::query("
			SELECT *
			FROM page
			WHERE dir_name = '".$controller_query."'
		");
		$page_data_array = $query[0];
		return $page_data_array;
	}
	//----------------------------
	//相対パスを絶対パスに変換
	// https://qiita.com/fallout/items/347c4b0c377e025198e6
	//----------------------------
	public static function pathToUrl($pPath, $pUrl) {
		$path = trim($pPath);    // 変換対象パス
		$url = trim($pUrl);      // 基準URL
		
		//-- 変換不要
		if ($path === '') { return $url; }
		
		if (stripos($path, 'http://') === 0 ||
		stripos($path, 'https://') === 0 ||
		stripos($path, 'mailto:') === 0 ||
		stripos($path, 'tel:') === 0) { return $path; }
		
		//-- #anchor
		if (strpos($path, '#') === 0) { return $url . $path; }
		
		//-- 基準URLを分解
		$urlAry = explode('/', $url);
		if (!isset($urlAry[2])) { return false; }
		
		//-- //path
		if (strpos($path, '//') === 0) { return $urlAry[0] . $path; }
		
		//-- 基準URLのHOME(scheme://host)
		$urlHome = $urlAry[0] . '//' . $urlAry[2];
		
		//-- 基準URLのパス
		if (!$pathBase = parse_url($url, PHP_URL_PATH)) { $pathBase = '/'; }
		
		//-- ?query
		if (strpos($path, '?') === 0) { return $urlHome . $pathBase . $path; }
		
		//-- /path
		if (strpos($path, '/') === 0) { return $urlHome . $path; }
		
		//-- ./path or ../path
		$pathBaseAry = array_filter(explode('/', $pathBase), 'strlen');
		if (strpos(end($pathBaseAry), '.') !== false) { array_pop($pathBaseAry); }
		
		foreach (explode('/', $path) as $pathElem) {
		if ($pathElem === '.') { continue; }
		if ($pathElem === '..') { array_pop($pathBaseAry); continue; }
		if ($pathElem !== '') { $pathBaseAry[] = $pathElem; }
		}
		
		return (substr($path, -1) === '/') ? $urlHome . '/' . implode('/', $pathBaseAry) . '/'
		: $urlHome . '/' . implode('/', $pathBaseAry);
	}
	//--------------------------
	//macかどうかをチェック
	//--------------------------
	public static function is_mac() {
		// UAを取得
		$ua = $_SERVER['HTTP_USER_AGENT'];
		// UAに Macintosh が含まれるか
		if (preg_match('/Macintosh/', $ua)) {
			return true;
		}
		else {
			return false;
		}
	}
	//------------------------------
	// バイト数のフォーマット変換
	//------------------------------
	public static function byte_format($size, $dec=-1, $separate=false){
	$units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
	$digits = ($size == 0) ? 0 : floor( log($size, 1024) );
	
	$over = false;
	$max_digit = count($units) -1 ;

	if($digits == 0){
		$num = $size;
	} else if(!isset($units[$digits])) {
		$num = $size / (pow(1024, $max_digit));
		$over = true;
	} else {
		$num = $size / (pow(1024, $digits));
	}
	
	if($dec > -1 && $digits > 0) $num = sprintf("%.{$dec}f", $num);
	if($separate && $digits > 0) $num = number_format($num, $dec);
	
	return ($over) ? $num . $units[$max_digit] : $num . $units[$digits];
}
	//-------------------
	// データベース調整
	//-------------------
	public static function setup_to_database_coordinate($post) {
		// articleのbasic_id変更
		model_db::query("
			UPDATE article 
			SET
				basic_id = '".$post['basic_id']."'
		");
		model_db::query("
			UPDATE page
			SET
				basic_id = '".$post['basic_id']."'
		");
	}
	//-----------------
	// ランダム数取得
	//-----------------
	public static function random_bytes_get($length) {
		$random_bytes = substr(bin2hex(random_bytes($length)), 0, $length);
		return $random_bytes;
	}
	//--------------------
	// ユーザー情報取得
	//--------------------
	public static function user_data_get($user_id) {
		$user_data_array = array();
		$query = model_db::query("
			SELECT *
			FROM user
			WHERE primary_id = ".(int)$user_id."
		");
		if(!$query) {
			$query = model_db::query("
				SELECT *
				FROM user
				WHERE basic_id = '".$user_id."'
			");
		}
		$user_data_array = $query[0];
		return $user_data_array;
	}
	//--------------------------
	// 現在のブランチ名を取得
	//--------------------------
	public static function git_branch_name_get() {
		$gitPath = PATH.".git/HEAD";
		return trim(implode('/', array_slice(explode('/', file_get_contents($gitPath)),2)), "\n");
	}




}
