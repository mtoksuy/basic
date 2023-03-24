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
				if(mkdir($directory_path, 0755, true)) {
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
				basic::rmdirAll($f);
			}
		} // foreach ($res as $f) {
		// 中身を削除した後、本体削除
		rmdir($dir);
	}
	//----------------------
	//ディレクトリ削除v.2
	//----------------------
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
	            $cnt = $cnt + basic::removeDir($path);
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
		// iconランダム選択
		$icon_array = array(
			0 => 'basic_default_icon_black_1.png', 
			1 => 'basic_default_icon_blue_1.png', 
			2 => 'basic_default_icon_green_1.png', 
			3 => 'basic_default_icon_pink_1.png', 
			4 => 'basic_default_icon_yellow_1.png', 
			5 => 'default_1.png', 
		);
		// ランダムなキーを取得
		$random_key = array_rand($icon_array);
		// ランダムに選択されたアイコンのファイル名を取得
		$random_icon_name = $icon_array[$random_key];
		// ユーザー登録
		model_db::query("
			INSERT INTO user (
				basic_id,
				password,
				icon
			)
			VALUES (
				'".$post['basic_id']."', 
				'".$password_hash."',
				'".$random_icon_name."'
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
		if($query) {
			$page_data_array = $query[0];
		}
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
	//--------------------------------------
	// ユーザーディレクトリセットアップ
	//--------------------------------------
	public static function user_dir_setup($post) {
		// サイト情報取得
		$site_data_array = basic::site_data_get();
		// ディレクトリ作成パス取得
		$directory_path = PATH.'app/theme/'.$site_data_array['theme'].'/controller/writer/'.$post['basic_id'].'';
		// ディレクトリ作成
		basic::dir_create($directory_path);
		// ファイル複製
		copy(PATH.'setting/master/writer.php', $directory_path.'/index.php');
	}
	//------------------------------
	// シングル版：静的化+圧縮化
	//------------------------------
	public static function single_html_gzip_create($http_path, $directory_path) {
		// サイト情報取得
		$site_data_array = basic::site_data_get();
		// 自動圧縮許可がある場合
		if((int)$site_data_array['compression'] === 1) {
			// 圧縮タイプ：gz
			if($site_data_array['compression_type'] === 'gz') {
				// 該当index.html削除
				if(file_exists($directory_path.'/index.html')) {
					unlink($directory_path.'/index.html');
				}
				// 該当index.html.gz削除
				if(file_exists($directory_path.'/index.html.gz')) {
					unlink($directory_path.'/index.html.gz');
				}
				// 素のhtml抽出
				$html = file_get_contents($http_path);
				// 文字化けさせないためにutf-8に変換
				$html = mb_convert_encoding($html,'utf-8','auto');
				//コメントアウトを削除
				$html = preg_replace('/<!--[\s\S]*?-->/s', '', $html);
				// CSSインライン化
				$html = basic::css_inline($http_path, $html);
				// JSインライン化 todo:未完成。ペンディング
		//		$html = basic::js_inline($http_path, $html);
				//HTML圧縮
				$html = basic::html_comp($html);
				// 圧縮したindexファイル生成
				file_put_contents($directory_path.'/index.html', $html);
				// 圧縮したindexファイルの内容を読み込む
				$code = file_get_contents($directory_path.'/index.html');
				// gzip圧縮処理して該当フォルダにファイルを作成
				$gzip = gzopen($directory_path.'/index.html.gz' ,'w9');
				gzwrite($gzip ,$code);
				gzclose($gzip);
			}
		}
	}
	//-------------------
	// CSSインライン化
	//-------------------
	public static function css_inline($http_path, $html) {
		$search = '/<link(.*?)>/';
		preg_match_all($search, $html, $html_array);
		foreach($html_array[0] as $key => $value) {
			if(preg_match('/stylesheet/', $value)) {
				preg_match('/href=("|\')(.*?)("|\')/', $value, $value_array);
			 	$convert_to_uri = basic::convert_to_uri($value_array[2], $http_path);
				$css = file_get_contents($convert_to_uri);
				$css = preg_replace('/
/', '', $css);
				$search = $html_array[0][$key];
				$replace = '<style>'.$css.'</style>';
				$search = preg_replace('/\?/', '\?', $search);
				$html = preg_replace('#'.$search.'#', $replace, $html);
			}
		} // foreach($html_array[0] as $key => $value) {
		return $html;
	}
	//-----------------
	// JSインライン化 todo:未完成。ペンディング
	//-----------------
	public static function js_inline($http_path, $html) {
		$search = '/<script(.*?)>/';
		preg_match_all($search, $html, $html_array);
		foreach($html_array[1] as $key => $value) {
			preg_match('/src="(.*?)"/', $value, $value_array);
			 $convert_to_uri = basic::convert_to_uri($value_array[1], $http_path);
		 	 if(preg_match('/google/', $convert_to_uri)) {

			}
				else {
					$js = file_get_contents($convert_to_uri);
					$replace = '<script>'.$js.'</script>';
					$search = preg_replace('/\?/', '\?', $html_array[0][$key]);
					// jquery-3.5.1.min.jsのインライン化がうまくいかない
					$html = preg_replace('#'.$search.'#', $replace, $html);
				}
		}
		return $html;
	}	
	//-----------
	//HTML圧縮
	//-----------
	 public static function html_comp($html) {
		// HTML圧縮
		$search = array(
			'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
			'/[^\S ]+\</s',  // strip whitespaces before tags, except space
			'/(\s)+/s'       // shorten multiple whitespace sequences
		);
		$replace = array(
			'>',
			'<',
			'\\1'
		);
		$html = preg_replace($search, $replace, $html);
		return $html;
	}
	//----------------------------
	// 相対パスから絶対パス取得
	//-----------------------------
  /**
   * http://web-tsukuru.com/187
   * スクレイピングなどで画像URLを取得する時に使うために
   * ベースURLを元に相対パスから絶対パスに変換する関数
   *
   * @param string $target_path 変換する相対パス
   * @param string $http_path ベースとなるパス
   * @return $uri string 絶対パスに変換済みのパス
   */
	public static function convert_to_uri($target_path, $http_path) {
	    $component = parse_url($http_path);
	
	    $directory = preg_replace('!/[^/]*$!', '/', $component["path"]);
	
	    switch (true) {
	
	      // [0] 絶対パスのケース（簡易版)
	      case preg_match("/^http/", $target_path):
	        $uri =  $target_path;
	        break;
	
	      // [1]「//exmaple.jp/aa.jpg」のようなケース
	      case preg_match("/^\/\/.+/", $target_path):
	        $uri =  $component["scheme"].":".$target_path;
	        break;
	
	      // [2]「/aaa/aa.jpg」のようなケース
	      case preg_match("/^\/[^\/].+/", $target_path):
	        $uri =  $component["scheme"]."://".$component["host"].$target_path;
	        break;
	
	      // [2']「/」のケース
	      case preg_match("/^\/$/", $target_path):
	        $uri =  $component["scheme"]."://".$component["host"].$target_path;
	        break;
	
	      // [3]「./aa.jpg」のようなケース
	      case preg_match("/^\.\/(.+)/", $target_path,$maches):
	        $uri =  $component["scheme"]."://".$component["host"].$directory.$maches[1];
	        break;
	
	      // [4]「aa.jpg」のようなケース（[3]と同じ）
	      case preg_match("/^([^\.\/]+)(.*)/", $target_path,$maches):
	        $uri =  $component["scheme"]."://".$component["host"].$directory.$maches[1].$maches[2];
	        break;
	
	      // [5]「../aa.jpg」のようなケース
	      case preg_match("/^\.\.\/.+/", $target_path):
	        //「../」をカウント
	        preg_match_all("!\.\./!", $target_path, $matches);
	        $nest =  count($matches[0]);
	
	        //ベースURLのディレクトリを分解してカウント
	        $dir = preg_replace('!/[^/]*$!', '/', $component["path"])."\n";
	        $dir_array = explode("/",$dir);
	        array_shift($dir_array);
	        array_pop($dir_array);
	        $dir_count = count($dir_array);
	
	        $count = $dir_count - $nest;
	
	        $pathto="";
	        $i = 0;
	        while ( $i < $count) {
	          $pathto .= "/".$dir_array[$i];
	          $i++;
	        }
	        $file = str_replace("../","",$target_path);
	        $uri =  $component["scheme"]."://".$component["host"].$pathto."/".$file;
	
	        break;
	
	        default:
	        $uri = $target_path;
	    }
	    return $uri;
	  }
	//-------------------------------------------
	// 静的化+圧縮化する際のリストarray取得
	//-------------------------------------------
	/*
	*  $method　：機能毎のpermalink名が挿入される。
　　　トップ=root、記事=article、新着記事=newarticle、ライター=writer、ページ=page、サイトマップ=sitemap
	*  $permalink：articleであればprimary_idが挿入される。pageであればpermalinkが挿入される
	*/
	public static function html_gzip_create_list_array_get($method = 'root',  $permalink = NULL) {
		// サイト情報取得
		$site_data_array = basic::site_data_get();
		if($method == 'root') {
			$html_gzip_create_list_array = array(
				0 => array(
							'http_path'         => HTTP,
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/root',
						),
			); // $html_gzip_create_list_array = array(
		}
		else if($method == 'article' || $method == 'newarticle') {
			$html_gzip_create_list_array = array(
				0 => array(
							'http_path'         => HTTP,
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/root',
						),
				1 => array(
							'http_path'         => HTTP.'article/'.$permalink.'/',
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/article/'.$permalink.'',
						),
				2 => array(
							'http_path'         => HTTP.'newarticle/',
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/newarticle',
						),
				3 => array(
							'http_path'         => HTTP.'writer/'.$_SESSION['basic_id'].'/',
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/writer/'.$_SESSION['basic_id'].'',
						),
				4 => array(
							'http_path'         => HTTP.'sitemap/',
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/sitemap',
						),
			); // $html_gzip_create_list_array = array(
		}
		else if($method == 'article_del') {
			$html_gzip_create_list_array = array(
				0 => array(
							'http_path'         => HTTP,
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/root',
						),
				1 => array(
							'http_path'         => HTTP.'newarticle/',
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/newarticle',
						),
				2 => array(
							'http_path'         => HTTP.'writer/'.$_SESSION['basic_id'].'/',
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/writer/'.$_SESSION['basic_id'].'',
						),
				3 => array(
							'http_path'         => HTTP.'sitemap/',
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/sitemap',
						),
			); // $html_gzip_create_list_array = array(
		}
		else if($method == 'page') {
			$html_gzip_create_list_array = array(
				0 => array(
							'http_path'         => HTTP.$permalink.'/',
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/'.$permalink.'',
						),
				1 => array(
							'http_path'         => HTTP.'sitemap/',
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/sitemap',
						),
			); // $html_gzip_create_list_array = array(
		}
		else if($method == 'page_del') {
			$html_gzip_create_list_array = array(
				0 => array(
							'http_path'         => HTTP.'sitemap/',
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/sitemap',
						),
			); // $html_gzip_create_list_array = array(
		}
		else if($method == 'writer') {

		}
		else if($method == 'sitemap') {

		}
		else if($method == 'profile') {
			$html_gzip_create_list_array = array(
				0 => array(
							'http_path'         => HTTP.'writer/'.$_SESSION['basic_id'].'/',
							'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/writer/'.$_SESSION['basic_id'].'',
						),
			); // $html_gzip_create_list_array = array(
		}
		return $html_gzip_create_list_array;
	}
	//---------------------------
	// multi版：静的化+圧縮化
	//---------------------------
	public static function multi_html_gzip_create($html_gzip_create_list_array) {
//		pre_var_dump($html_gzip_create_list_array);
		// サイト情報取得
		$site_data_array = basic::site_data_get();
		foreach($html_gzip_create_list_array as $key => $value) {
			// 自動圧縮許可がある場合
			if((int)$site_data_array['compression'] === 1) {
				// 圧縮タイプ：gz
				if($site_data_array['compression_type'] === 'gz') {
					// 該当index.html削除
					if(file_exists($value['directory_path'].'/index.html')) {
						unlink($value['directory_path'].'/index.html');
					}
					// 該当index.html.gz削除
					if(file_exists($value['directory_path'].'/index.html.gz')) {
						unlink($value['directory_path'].'/index.html.gz');
					}
					// 素のhtml抽出
					$html = file_get_contents($value['http_path']);
					// 文字化けさせないためにutf-8に変換
					$html = mb_convert_encoding($html,'utf-8','auto');
					//コメントアウトを削除
					$html = preg_replace('/<!--[\s\S]*?-->/s', '', $html);
					// CSSインライン化
					$html = basic::css_inline($value['http_path'], $html);
					// JSインライン化 todo:未完成。ペンディング
			//		$html = basic::js_inline($value['http_path'], $html);
					// 記事専用 code内改行、半角空白全角空白タブは圧縮しない 開始
					$pattern = '/<div class="code">(.*?)<\/div>/s';
					$html = preg_replace_callback($pattern, function($matches) {
						return str_replace('
', '記事専用改行圧縮前', $matches[0]);
					}, $html);
					$html = preg_replace_callback($pattern, function($matches) {
						return str_replace(' ', '記事専用半角空白圧縮前', $matches[0]);
					}, $html);
					$html = preg_replace_callback($pattern, function($matches) {
						return str_replace('　', '記事専用全角空白圧縮前', $matches[0]);
					}, $html);
					$html = preg_replace_callback($pattern, function($matches) {
						return str_replace('	', '記事専用タブ圧縮前', $matches[0]);
					}, $html);
					//HTML圧縮
					$html = basic::html_comp($html);
					// 記事専用 code内改行、半角空白全角空白タブは圧縮しない 終了
					$html = preg_replace("/記事専用改行圧縮前/", '
', $html);
					$html = preg_replace("/記事専用半角空白圧縮前/", ' ', $html);
 					$html = preg_replace("/記事専用全角空白圧縮前/", '　', $html);
					$html = preg_replace("/記事専用タブ圧縮前/", '	', $html);
					// 圧縮したindexファイル生成
					file_put_contents($value['directory_path'].'/index.html', $html);
					// 圧縮したindexファイルの内容を読み込む
					$code = file_get_contents($value['directory_path'].'/index.html');
					// gzip圧縮処理して該当フォルダにファイルを作成
					$gzip = gzopen($value['directory_path'].'/index.html.gz' ,'w9');
					gzwrite($gzip ,$code);
					gzclose($gzip);
				} // if($site_data_array['compression_type'] === 'gz') {
			} // if((int)$site_data_array['compression'] === 1) {
		} // foreach($html_gzip_create_list_array as $key => $value) {
	}

	//------------------------
	// ディレクトリをコピー
	//------------------------
	public static function copy_dir($dir, $new_dir) {
		$dir         = rtrim($dir, '/').'/';
		$new_dir = rtrim($new_dir, '/').'/';
		
		// コピー元ディレクトリが存在すればコピーを行う
		if (is_dir($dir)) {
			// コピー先ディレクトリが存在しなければ作成する
			if (!is_dir($new_dir)) {
				mkdir($new_dir, 0755);
				chmod($new_dir, 0755);
			}
			// ディレクトリを開く
			if($handle = opendir($dir)) {
				// ディレクトリ内のファイルを取得する
				while (false !== ($file = readdir($handle))) {
					if ($file === '.' || $file === '..') {
						continue;
					}
					// 下の階層にディレクトリが存在する場合は再帰処理を行う
					if(is_dir($dir.$file)) {
						basic::copy_dir($dir.$file, $new_dir.$file);
					} 
					else {
						copy($dir.$file, $new_dir.$file);
					}
				}
				closedir($handle);
			} // if($handle = opendir($dir)) {
		} // if (is_dir($dir)) {
	} // function copy_dir($dir, $new_dir) {
	//------------------------------
	// php内部ライブラリチェック
	//------------------------------
	 public static function extensions_check($str) {
		$get_loaded_extensions = get_loaded_extensions();
		foreach($get_loaded_extensions as $key => $value) {
			if($value ==$str) { return true; }
		}
		return false;
	}
	//------------------------------
	// テキスト差分(英語大前提)
	//------------------------------
	public static function text_diff($text1, $text2) {
	  $text1Array = explode(' ', $text1);
	  $text2Array = explode(' ', $text2);
	
	  $diffArray = array();
	  $commonArray = array_intersect($text1Array, $text2Array);
	  $i = 0;
	  foreach ($text1Array as $word) {
	    if (!in_array($word, $commonArray)) {
	      $diffArray[$i] = '<del>' . $word . '</del>';
	      $i++;
	    } else {
	      while ($text2Array[0] != $word) {
	        $diffArray[$i] = '<ins>' . $text2Array[0] . '</ins>';
	        $i++;
	        array_shift($text2Array);
	      }
	      $diffArray[$i] = $word;
	      $i++;
	      array_shift($text2Array);
	    }
	  }
	  while (count($text2Array) > 0) {
	    $diffArray[$i] = '<ins>' . array_shift($text2Array) . '</ins>';
	    $i++;
	  }
	  return implode(' ', $diffArray);
	}
	//-----------------------------------------------
	// 再起的にhtmlファイルとgzファイルのみ削除
	//-----------------------------------------------
	public static function recursive_delete_htm_gz($dir) {
		// ディレクトリが存在しない場合は処理を中断する
		if(!file_exists($dir)) {
			return;
		}
		// ディレクトリ内のファイル・フォルダを取得する
		$files = scandir($dir);
		// ファイル・フォルダを順に処理する
		foreach($files as $file) {
			// カレントディレクトリ、親ディレクトリ、.git、fileuploadは無視する
			if ($file == '.' || $file == '..' || $file == '.git' || $file == 'fileupload') {
				continue;
			}
			// ファイルパスを作成する
			$filepath = $dir.$file;
			// ファイルの種類によって処理を分岐する
			if (is_dir($filepath)) {
				$filepath = $filepath.'/';
				// ディレクトリの場合は再帰的に処理する
				basic::recursive_delete_htm_gz($filepath);
			} 
			else {
				// ファイルの場合は拡張子を取得する
				$ext = pathinfo($filepath, PATHINFO_EXTENSION);
				if ($ext == 'html' || $ext == 'gz') {
					// htmlファイルまたはgzファイルの場合は削除する
					unlink($filepath);
				}
			}
		} // foreach ($files as $file) {
	}
	//----------
	// cron起動
	//----------
	public static function start_cron($site_data_array, $increment = 200) {
		// 進めるcron取得
		$cron_res = model_db::query("
			SELECT *
			FROM cron
			WHERE complete = 0
			ORDER BY primary_id ASC
			LIMIT 0, 1
		");
		if(empty($cron_res[0]['type'])) { $cron_res[0]['type'] = ''; }
		// type:articleの場合
		if($cron_res[0]['type'] == 'article') {
			$count = (int)$cron_res[0]['count'];
			// 記事情報取得
			$new_article_res = model_db::query("
				SELECT primary_id
				FROM article
				WHERE del = 0
				ORDER BY primary_id DESC
				LIMIT 0, 1
			");
			// 最新記事id取得
			$latest_article_primary_id = (int)$new_article_res[0]['primary_id'];
			// 次のカウント
			$next_count = ($count+$increment);
			// 繰り返しでarticleを最新化していく
			while($count < $next_count) {
				$count++;
				$article_res = model_db::query("
					SELECT primary_id
					FROM article
					WHERE del = 0
					AND primary_id = ".$count."
					ORDER BY primary_id DESC
					LIMIT 0, 1
				");
				// 記事がdel:0の場合
				if($article_res) {
					// ディレクトリ作成パス取得
					$directory_path = PATH.'app/theme/'.$site_data_array['theme'].'/controller/article/'.$count.'';
					// ディレクトリがなかった場合
					if(!file_exists($directory_path)) {
						// ディレクトリ作成
						basic::dir_create($directory_path);
						// ファイル複製
						copy(PATH.'setting/master/article.php', $directory_path.'/index.php');
					}
					// htmlがなかった場合
					if(!file_exists($directory_path.'/index.html')) {
						// 擬似的array生成
						$html_gzip_create_list_array = array(
							0 => array(
										'http_path'         => HTTP.'article/'.$count.'/',
										'directory_path' => PATH.'app/theme/'.$site_data_array['theme'].'/controller/article/'.$count.'',
							), 
						); // $html_gzip_create_list_array = array(
						// multi版：静的化+圧縮化
						basic::multi_html_gzip_create($html_gzip_create_list_array);
					}
				} // if($article_res) {
				// 最新記事まで差し掛かったら completeを1にして繰り返しを抜ける
				if($count == $latest_article_primary_id) {
					 model_db::query("
						UPDATE cron 
						SET complete = 1
						WHERE primary_id = ".(int)$cron_res[0]['primary_id']."
					");
					break;
				}
			} // while($count < $next_count) {
			// cron更新
			 model_db::query("
				UPDATE cron 
				SET count = ".$count."
				WHERE primary_id = ".(int)$cron_res[0]['primary_id']."
			");
		} // if($cron_res[0]['type'] == 'article') {
	}
	//---------------------------------------------
	// 特定の文字列が2連続である場合1つにする
	//---------------------------------------------
	public static function replace_recursive($str, $target_str = '/') {
		$new_str = str_replace($target_str.$target_str, $target_str, $str);
		if ($new_str !== $str) {
			return basic::replace_recursive($new_str);
		} 
		else {
			return $new_str;
		}
	}

	//---------------------------------
	// 特定の配下のファイル一覧取得
	//---------------------------------
	public static function getPhpFilesInSelectDirectory($dir, $target_dir, $extension = 'php') {
		$files = glob($dir . '/*');
		$phpFiles = [];
		foreach ($files as $file) {
			if (is_dir($file)) {
				$phpFiles = array_merge($phpFiles, basic::getPhpFilesInSelectDirectory($file, $target_dir, $extension));
			}
			elseif (strpos($file, '/'.$target_dir.'/') !== false && pathinfo($file, PATHINFO_EXTENSION) == $extension) {
				$phpFiles[] = $file;
			}
		}
		return $phpFiles;
	}
	//-----------------------------
	// ローカルかつwidnows判定
	//-----------------------------
	public static function is_local_and_windows() {
		$is_local_and_windows = false;
		// ローカル環境
		if(preg_match('/localhost/',$_SERVER["HTTP_HOST"])) {
			if (isset($_SERVER['HTTP_USER_AGENT'])) {
				$ua = $_SERVER['HTTP_USER_AGENT'];
				if (strpos($ua, 'Windows') !== false) {
					$is_local_and_windows = true;
				}
			}
		} // if(preg_match('/localhost/',$_SERVER["HTTP_HOST"])) {
		return $is_local_and_windows;
	}


}



