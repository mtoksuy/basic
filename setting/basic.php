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
	//----------------
	//サイト情報取得
	//-----------------
	public static function site_data_get() {
		$site_data_array = array();
		$query = model_db::query("
			SELECT *
			FROM setting
		");
		$site_data_array = $query[0];
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
	//------------------------------
	//マークダウンをHTMLに変換
	//------------------------------
	public static function markdown_html_conversion($markdown, $user_id_data_array = null) {
//		pre_var_dump($markdown);
//		pre_var_dump($user_id_data_array);

		// 改行変換
		$markdown = preg_replace('/\r\n\r\n|\n\n/', '
<br>
', $markdown);
		// 最後に改行追加
		$markdown=$markdown.'
';
/*
		// チェックポイント変換
		$markdown = preg_replace('/\[checkpoint\r\n# (.*?)\r\n(.*?)\]/s', '
<div class="check_point"><div class="check_point_inner"><div class="check_point_inner_heading">\\1</div>\\2</div></div>
', $markdown);
*/
		// 大文字の英数字、，．を小文字に変換
		$markdown = mb_convert_kana($markdown, 'rn');
		$markdown = preg_replace('/，/s', ',', $markdown);
		$markdown = preg_replace('/．/s', '.', $markdown);

		// チェックポイント変換
		$markdown = preg_replace('/\[checkpoint:(.*?)title:"(.*?)"(.*?)\]/s', '
<div class="check_point"><div class="check_point_inner"><div class="check_point_inner_heading">\\2</div>\\3</div></div>
', $markdown);
//pre_var_dump($markdown);


		// h6変換
		$markdown = preg_replace('/##### (.*?)
/', '<h6>\\1</h6>
', $markdown);

		// h5変換
		$markdown = preg_replace('/#### (.*?)
/', '<h5>\\1</h5>
', $markdown);

		// h4変換
		$markdown = preg_replace('/### (.*?)
/', '<h4>\\1</h4>
', $markdown);

		// h3変換
		$markdown = preg_replace('/## (.*?)
/', '<h3>\\1</h3>
', $markdown);

		// h2変換
		$markdown = preg_replace('/# (.*?)
/', '<h2>\\1</h2>
', $markdown);

		// 1行セパレーター変換
		$markdown = preg_replace('/---/', '<div class="separator">-----୨୧-----୨୧-----୨୧-----‎</div>', $markdown);

		// 太文字変換先頭バージョン
		$markdown = preg_replace('/\r\n\*(.*?)\*/', '
 <strong>\\1</strong>', $markdown);
		// 太文字変換先頭バージョン
		$markdown = preg_replace('/\n\*(.*?)\*/', '
 <strong>\\1</strong>', $markdown);
		// 太文字変換
		$markdown = preg_replace('/\*(.*?)\*/', '<strong>\\1</strong>', $markdown);


		// マーカー変換先頭バージョン
		$markdown = preg_replace('/\r\n\__(.*?)\__/', '
 <mark class="marker">\\1</mark>', $markdown);
		// マーカー変換先頭バージョン
		$markdown = preg_replace('/\n\__(.*?)\__/', '
 <mark class="marker">\\1</mark>', $markdown);
		// マーカー変換
		$markdown = preg_replace('/\__(.*?)\__/', '<mark class="marker">\\1</mark>', $markdown);

		// aリンク変換
		$markdown = preg_replace('/\[(.*?)\]\(http(.*?)\)/', '<a href="http\\2" target="_blank">\\1</a>', $markdown);

		// リスト変換
		$markdown = preg_replace('/\* (.*?)
/', '<li>\\1</li>
', $markdown);


//pre_var_dump($markdown);
		// リスト変換
		$markdown = preg_replace('/<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>|<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>|<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>|<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>|<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>|<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>|<li>(.*?)<\/li>\n<li>(.*?)<\/li>\n<li>(.*?)<\/li>|<li>(.*?)<\/li>\n<li>(.*?)<\/li>|<li>(.*?)<\/li>/', '<ul>\\0</ul>', $markdown);

//pre_var_dump($markdown);

/*
<div class="check_point">
	<div class="check_point_inner">
	<div class="check_point_inner_heading">チェックポイント</div>
		<ul>
			<li>テキストテキストテキストテキストテキストテキストテキストテキストテキ</li>
			<li>テキスト</li>
			<li>テキスト</li>
			<li>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</li>
		</ul>
	</div>
</div>
*/
		// レスポンシブ画像変換
		$markdown = preg_replace('/\(((.*?)jpg)\):([0-9]{0,3})/', '<div class="responsive_image_\\3"><img src="\\1"></div>', $markdown);
//var_dump($markdown);




		// 画像変換
		$markdown = preg_replace('/\(((.*?)jpg)\)/', '<img src="\\1">', $markdown);
		$markdown = preg_replace('/\(((.*?)jpeg)\)/', '<img src="\\1">', $markdown);
		$markdown = preg_replace('/\(((.*?)JPG)\)/', '<img src="\\1">', $markdown);
		$markdown = preg_replace('/\(((.*?)JPEG)\)/', '<img src="\\1">', $markdown);
		$markdown = preg_replace('/\(((.*?)png)\)/', '<img src="\\1">', $markdown);
		$markdown = preg_replace('/\(((.*?)PNG)\)/', '<img src="\\1">', $markdown);
		$markdown = preg_replace('/\(((.*?)webp)\)/', '<img src="\\1">', $markdown);
		$markdown = preg_replace('/\(((.*?)WEBP)\)/', '<img src="\\1">', $markdown);

//		$markdown = preg_replace('/\[checkpoint\r\n# (.*?)\r\n(.*?)\]/s', '

	
		// アマゾン変換
//		$markdown = preg_replace('/\[amazon:(.*?)brand:(.*?)title:(.*?)price:(.*?)rating:(.*?)review:(.*?)image:(.*?)link:(.*?)\]/s', '<div class="amazon_link"><div class="amazon_link_inner"><div class="amazon_link_recommend">おすすめアイテム</div><div class="amazon_link_left"><p><img src="\\7"></p></div><div class="amazon_link_right"><h3 class="amazon_link_heading"><span>\\2</span>\\3</h3><div class="amazon_link_price">\\4</div><div class="amazon_link_rating"><img src="https://amatem.jp/assets/img/common/rating_1_\\5.png"><span>\\6個の評価</span></div><span class="amazon_link_button"><a href="\\8" target="_blank"><img src="https://amatem.jp/assets/img/common/amazon_logo_10.png">で詳細を見る</a></span></div></div></div>', $markdown);



		// アマゾン変換
		$markdown = preg_replace('/\[amazon:(.*?)brand:"(.*?)"(.*?)title:"(.*?)"(.*?)price:"(.*?)"(.*?)rating:"(.*?)"(.*?)review:"(.*?)"(.*?)image:"(.*?)"(.*?)link:"(.*?)"(.*?)]/s', '<div class="amazon_link"><div class="amazon_link_inner"><div class="amazon_link_recommend">おすすめアイテム</div><div class="amazon_link_left"><p><img src="\\12" alt="\\4"></p></div><div class="amazon_link_right"><h3 class="amazon_link_heading"><span>\\2</span>\\4</h3><div class="amazon_link_price">\\6</div><div class="amazon_link_rating"><img src="https://amatem.jp/assets/img/common/rating_1_\\8.png"><span>\\10個の評価</span></div><span class="amazon_link_button"><a href="\\14" target="_blank"><img src="https://amatem.jp/assets/img/common/amazon_logo_10.png">で詳細を見る</a></span></div></div></div>', $markdown);

		// アマゾン_v2変換
		$markdown = preg_replace('/\[amazon_v2:(.*?)ASIN:"(.*?)"(.*?)brand:"(.*?)"(.*?)title:"(.*?)"(.*?)price:"(.*?)"(.*?)rating:"(.*?)"(.*?)review:"(.*?)"(.*?)image:"(.*?)"(.*?)link:"(.*?)"(.*?)]/s', '<div class="amazon_link" asin-data="\\2"><div class="amazon_link_inner"><div class="amazon_link_recommend">おすすめアイテム</div><div class="amazon_link_left"><p><img src="\\14" alt="\\6"></p></div><div class="amazon_link_right"><h3 class="amazon_link_heading"><span>\\4</span><a href="'.HTTP.'products/\\2/" target="_blank">\\6</a></h3><div class="amazon_link_price">\\8</div><div class="amazon_link_rating"><img src="https://amatem.jp/assets/img/common/rating_1_\\10.png"><span>\\12個の評価</span></div><span class="amazon_link_button"><a href="\\16" target="_blank"><img src="https://amatem.jp/assets/img/common/amazon_logo_10.png">で詳細を見る</a></span><div class="amazon_products_link"><a href="'.HTTP.'products/\\2/" target="_blank"><img src="'.HTTP.'assets/img/common/amazon_products_link_1.png"></a></div></div></div></div>', $markdown);


		// 引用変換
		$markdown = preg_replace('/\[quote:(.*?)quote:"(.*?)"(.*?)link_text:"(.*?)"(.*?)link:"(.*?)"(.*?)]/s', '<div class="quote"><div class="quote_inner">
<blockquote cite="\\6">
\\2
</blockquote><div class="quote_link">引用元：<cite><a href="\\6" target="_blank">\\4</a></cite></div></div></div>', $markdown);

		// 囲み変換
		$markdown = preg_replace('/\[box:(.*?)text:"(.*?)"(.*?)]/s', '<div class="box"><div class="box_inner"><p>\\2</p></div></div>', $markdown);

		// カード形式リンク変換
		$markdown =basic::card_link_conversion($markdown);

		// 吹き出し変換
		$markdown = preg_replace('/\[blowing:(.*?)text:"(.*?)"(.*?)]/s', '<div class="blowing"><div class="blowing_inner"><div class="person"><figure class="person_icon"><img src="'.HTTP.'assets/img/user_icon/'.$user_id_data_array['icon'].'" alt="" width="92" height="92"></figure></div><div class="name">'.$user_id_data_array['name'].'</div><div class="balloon"><p>\\2</p></div>	</div></div>', $markdown);

/*
		pre_var_dump($user_id_data_array['icon']);
		pre_var_dump($_SESSION);

		pre_var_dump($markdown);
*/
// icon

//pre_var_dump($markdown);
file_put_contents(PATH.'setting/markdown_article_tmt.txt', $markdown);
/* ファイルポインタをオープン */
$file = fopen(PATH.'setting/markdown_article_tmt.txt', 'r');
/* ファイルを1行ずつ出力 */
if($file){
	while ($line = fgets($file)) {
		 preg_match('/^<|^\r\n/', $line, $line_array);
//		 pre_var_dump($line_array);
//		 pre_var_dump($line);
		 if(!$line_array[0]) {
		 	if(strlen($line) > 2) {
//pre_var_dump($line);
//pre_var_dump($line_array);
		 		$txt.='<p>'.$line.'</p>';
//				$txt.=$line;
			}
		}
			else {
				$txt.=$line;
			}
		$i++;
	}
}
//pre_var_dump($txt);
/* ファイルポインタをクローズ */
fclose($file);

// 改行を削除
$txt = str_replace(array("\r\n", "\r", "\n"), '', $txt);
//file_put_contents(PATH.'login/admin/markdown_post/markdown_post_tmt.txt', $txt);
		return $txt;
	}
	//------------
	//下書き保存
	//------------
	public static function markdown_post_draft_save($post) {
		if($post['draft_id']) {
//				pre_var_dump($post);
				model_db::query("
					UPDATE article_draft 
					SET 
						title = '".$post['title']."', 
						category = '".$post['category']."', 
						hashtag = '".$post['hashtag']."', 
						content = '".$post['content']."'
					WHERE primary_id = ".(int)$post['draft_id']."
				");
				$post['primary_id'] = $post['draft_id'];
				return $post;
		}
			else {
				model_db::query("
					INSERT INTO article_draft 
					(
						amatem_id, 
						title, 
						category, 
						hashtag, 
						content
					) 
					VALUES (
						'".$_SESSION['amatem_id']."',
						'".$post['title']."',
						'".$post['category']."',
						'".$post['hashtag']."',
						'".$post['content']."'
					)");
				$query = model_db::query("
					SELECT * 
						FROM article_draft
						WHERE amatem_id = '".$_SESSION['amatem_id']."' 
						AND del = 0
						ORDER BY primary_id DESC
						LIMIT 0,1");
					$query = $query[0];
				return $query;
			}
	}

	//---------
	//編集保存
	//---------
	public static function markdown_post_edit_save($post) {
		$now_date = date('Y-m-d H:i:s', time());
		model_db::query("
			UPDATE article
			SET 
				title = '".$post['title']."', 
				category = '".$post['category']."', 
				content = '".$post['content']."',
				update_time = '".$now_date."'
			WHERE primary_id = ".(int)$post['article_id']."
		");
		$post['primary_id'] = $post['article_id'];
		if(file_exists(PATH.'article/'.$post['article_id'].'/index.html')) {
			// 圧縮ファイル削除
			unlink(PATH.'article/'.$post['article_id'].'/index.html');
		}
		if(file_exists(PATH.'article/'.$post['article_id'].'/index.html.gz')) {
			// 圧縮ファイル削除
			unlink(PATH.'article/'.$post['article_id'].'/index.html.gz');
		}
		// 更新記事情報取得
		$res = model_db::query("
			SELECT *
			FROM article
			WHERE del = 0
			AND primary_id = ".(int)$post['article_id']."
			ORDER BY primary_id DESC
			LIMIT 0, 1");
		// 記事OGP画像生成(更新)
		model_media_post_basis::media_article_ogp_create($res);
		return $post;
	}
	//----------
	//新規投稿
	//---------
	public static function markdown_post_add($post) {
		$query = model_db::query("
			INSERT INTO article 
			(
				amatem_id, 
				title, 
				category, 
				content,
				content_type
			) 
			VALUES (
				'".$_SESSION['amatem_id']."',
				'".$post['title']."',
				'".$post['category']."',
				'".$post['content']."',
				'markdown'
			)");
	}
	//--------------
	//記事OGP生成 (古い  model_media_post_basis::media_article_ogp_createが正しい
	//--------------
	public static function media_article_ogp_create($res) {
//		pre_var_dump($res);
		pre_var_dump($res[0]['primary_id']);
		pre_var_dump($res[0]['title']);
		// 基準となるOGP画像
		$im = imagecreatefrompng(PATH.'assets/img/ogp/amatem_ogp_0.png');
		// Create some colors 後で使うかも
		$white = imagecolorallocate($im, 255, 255, 255);
		$grey = imagecolorallocate($im, 128, 128, 128);
		$black = imagecolorallocate($im, 0, 0, 0);
		// OGP画像に転写するタイトルテキスト
		$text = $res[0]['title'];
		// [と]を正しくpreg_replaceできるように変換
		$text = preg_replace('/\[/', '顯', $text);
		$text = preg_replace('/\]/', '舷', $text);
		// 16文字で改行
		$text_16 = mb_substr($text, 0, 16);
		$text_last = preg_replace('/'.$text_16.'/', '', $text);
		$text_16 = $text_16.'
';
		$text = $text_16.$text_last;
		
		$text_32 = mb_substr($text, 0, 32);
		$text_last = preg_replace('/'.$text_32.'/', '', $text);
		$text_32 = $text_32.'
';
		$text = $text_32.$text_last;
		
		$text_51 = mb_substr($text, 0, 51);
		$text_last = preg_replace('/'.$text_51.'/', '', $text);
		$text_51 = $text_51.'
';
		$text = $text_51.$text_last;
		// [と]を戻す
		$text = preg_replace('/顯/', '[', $text);
		$text = preg_replace('/舷/', ']', $text);
		// アップロードするディレクトリ
		$uploads_dir = PATH.'assets/img/article_ogp/';
		// 使用するフォント
/*
		$font = '/var/www/html/assets/font/Noto_Serif_KR/NotoSerifKR-ExtraLight.otf';
		$font = '/var/www/html/assets/font/Noto_Serif_KR/NotoSerifKR-SemiBold.otf';
		$font = '/var/www/html/assets/font/MODI_komorebi-gothic_2018_0501/komorebi-gothic-P.ttf';
*/
		$font = PATH.'assets/font/source-han-code-jp-2.011R/OTF/SourceHanCodeJP-Medium.otf';
		
		//image file name
		$name = $uploads_dir.$res[0]['primary_id'].'.png'; //this saves the image inside uploaded_files folder
		// テキスト転写
		imagettftext($im, 36, 0, 270, 290, $black, $font, $text); // 画像、フォントサイズ、なんか、横、縦
		// png作成
		imagepng($im,$name,1);
		// GD 削除
		imagedestroy($im);
	}
	//-----------------------
	//カード形式リンク変換
	//-----------------------
	public static function card_link_conversion($markdown) {
//		pre_var_dump($markdown);
		preg_match_all('/\[card_link:(.*?)url:"(.*?)"(.*?)\]/s', $markdown, $markdown_array);
//		pre_var_dump($markdown_array);
		foreach($markdown_array[2] as $kye => $value) {
			$html = file_get_contents($value);
			// ヘッダー取得
			$header = get_headers($value);
			foreach($header as $header_key => $header_value) {
				// gzチェック
				if(preg_match('/gzip/', $header_value)) {
					$gz_check = true;
				}
			}
			// gzならデコードする
			if($gz_check) {
				$html = gzdecode($html);
			}
			$gz_check = false;
			// タイトル取得
			preg_match('/<title>(.*?)<\/title>/', $html, $html_array);
			$title = $html_array[1];
			// サムネイル取得
			preg_match('/<meta property="og:image" content="(.*?)"/', $html, $html_array);
			$image = $html_array[1];
			// アイコン取得
			preg_match('/<link rel="shortcut icon"(.*?)href="(.*?)"(.*?)>/', $html, $html_array);
			$icon = $html_array[2];
			if(!$icon) {
				preg_match('/<link rel="icon"(.*?)href="(.*?)"(.*?)>/', $html, $html_array);
				$icon = $html_array[2];
			}
//			pre_var_dump($icon);
			if($icon) {
				// 相対的に表記されたアイコンを絶対的に戻す
				if(!preg_match('/http/', $icon, $icon_array)) {
					// 相対パスを絶対パスに変換
					$icon = model_login_markdown_post_basis::pathToUrl($icon, $value);
					// パスから画像データを取得
					$data = file_get_contents($icon);
					// base64に変換
					$imageData = base64_encode($data);
					// mime情報取得
					$getimagesize =  getimagesize($icon);
					$mime = $getimagesize['mime'];
					$mime = preg_replace('/vnd.microsoft.icon/', 'x-icon', $mime);
//					pre_var_dump($mime);
					// src作成
					$src = 'data:'.$mime.';base64,'.$imageData;
/*
<img src="data:image/vnd.microsoft.icon; base64,AAABAAE
<img src="data:image/vnd.microsoft.icon;AAAAAAA=" decoding="async" loading="lazy">

<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAD==">
*/
					// icon_html生成
					$icon_html = '<img src="'.$src.'" decoding="async" loading="lazy">';
				}
					// 絶対パスの場合
					else {
						// パスから画像データを取得
						$data = file_get_contents($icon);
						// base64に変換
						$imageData = base64_encode($data);
						// mime情報取得
						$getimagesize =  getimagesize($icon);
						$mime = $getimagesize['mime'];
						$mime = preg_replace('/vnd.microsoft.icon/', 'x-icon', $mime);
						// src作成
						$src = 'data:'.$mime.';base64,'.$imageData;
						// icon_html生成
						$icon_html = '<img src="'.$src.'" decoding="async" loading="lazy">';
					}
			}
				// ほんとうにない場合
				else {
					$icon_html = '';
				}
			// ドメイン取得
			$parse_url = parse_url($value);
			$domain = $parse_url['host'];

			$url = $value;
		 	$value = preg_replace('/\//', '\/', $value);
		 	$value = preg_replace('/\?/', '\?', $value);
/*
		 	pre_var_dump($title);
		 	pre_var_dump($icon);
		 	pre_var_dump($domain);
*/
		 	// カード形式リンク変換
		 	$markdown = preg_replace('/\[card_link:(.*?)url:"'.$value.'"(.*?)\]/s', '<div class="card_link"><a href="'.$url.'" target="_blank"><div class="card_link_left"><div class="card_link_title">'.$title.'</div><div class="card_link_domain_data">'.$icon_html.$domain.'</div></div><div class="card_link_right"><div class="card_link_img"><!-- <img src="'.HTTP.'assets/img/common/icon-chain02.png" decoding="async" loading="lazy"> --></div></div></a></div>', $markdown);
		 	$url = '';
		 	$title = '';
		 	$icon = '';
		 	$domain = '';
		 	$image = '';
		} // foreach($markdown_array[2] as $kye => $value) {
	return $markdown;
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

}
