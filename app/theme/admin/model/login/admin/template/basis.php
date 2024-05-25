<?php
class model_login_admin_template_basis {

	//------------------------------------------------------------------
	// 選択しているテーマのcommon配下のファイルリストarray取得
	//------------------------------------------------------------------
	public static function view_common_list_array_get($site_data_array) {
		//		pre_var_dump(PATH.'app/theme/'.$site_data_array['theme'].'/view/common/');
		$list_dir = (PATH . 'app/theme/' . $site_data_array['theme'] . '/view/common/');
		$list_dir_replace_word = (preg_replace('/\//', '\/', $list_dir));
		$glob = glob($list_dir . '*.php');
		foreach ($glob as $key => $value) {
			$view_common_list_array[] = preg_replace('/' . $list_dir_replace_word . '/', '', $value);
		}
		return $view_common_list_array;
	}
	//------------------------
	// ファイルの内容を取得
	//------------------------
	public static function file_content_get($file_path) {
		$file_content = file_get_contents($file_path);
		return $file_content;
	}
	//------------------------
	// ファイルの内容を保存
	//------------------------
	public static function file_content_save($post, $file_path) {
		if (file_exists($file_path)) {
			//			pre_var_dump($post);
			file_put_contents($file_path, $_POST['content']);
		}
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
		$markdown = $markdown . '
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
		$markdown = preg_replace('/\[amazon_v2:(.*?)ASIN:"(.*?)"(.*?)brand:"(.*?)"(.*?)title:"(.*?)"(.*?)price:"(.*?)"(.*?)rating:"(.*?)"(.*?)review:"(.*?)"(.*?)image:"(.*?)"(.*?)link:"(.*?)"(.*?)]/s', '<div class="amazon_link" asin-data="\\2"><div class="amazon_link_inner"><div class="amazon_link_recommend">おすすめアイテム</div><div class="amazon_link_left"><p><img src="\\14" alt="\\6"></p></div><div class="amazon_link_right"><h3 class="amazon_link_heading"><span>\\4</span><a href="' . HTTP . 'products/\\2/" target="_blank">\\6</a></h3><div class="amazon_link_price">\\8</div><div class="amazon_link_rating"><img src="https://amatem.jp/assets/img/common/rating_1_\\10.png"><span>\\12個の評価</span></div><span class="amazon_link_button"><a href="\\16" target="_blank"><img src="https://amatem.jp/assets/img/common/amazon_logo_10.png">で詳細を見る</a></span><div class="amazon_products_link"><a href="' . HTTP . 'products/\\2/" target="_blank"><img src="' . HTTP . 'assets/img/common/amazon_products_link_1.png"></a></div></div></div></div>', $markdown);


		// 引用変換
		$markdown = preg_replace('/\[quote:(.*?)quote:"(.*?)"(.*?)link_text:"(.*?)"(.*?)link:"(.*?)"(.*?)]/s', '<div class="quote"><div class="quote_inner">
<blockquote cite="\\6">
\\2
</blockquote><div class="quote_link">引用元：<cite><a href="\\6" target="_blank">\\4</a></cite></div></div></div>', $markdown);

		// 囲み変換
		$markdown = preg_replace('/\[box:(.*?)text:"(.*?)"(.*?)]/s', '<div class="box"><div class="box_inner"><p>\\2</p></div></div>', $markdown);

		// カード形式リンク変換
		$markdown = model_login_admin_page_basis::card_link_conversion($markdown);

		// 吹き出し変換
		$markdown = preg_replace('/\[blowing:(.*?)text:"(.*?)"(.*?)]/s', '<div class="blowing"><div class="blowing_inner"><div class="person"><figure class="person_icon"><img src="' . HTTP . 'assets/img/user_icon/' . $user_id_data_array['icon'] . '" alt="" width="92" height="92"></figure></div><div class="name">' . $user_id_data_array['name'] . '</div><div class="balloon"><p>\\2</p></div>	</div></div>', $markdown);

		/*
		pre_var_dump($user_id_data_array['icon']);
		pre_var_dump($_SESSION);

		pre_var_dump($markdown);
*/
		// icon

		//pre_var_dump($markdown);
		file_put_contents(PATH . 'setting/markdown_article_tmp.txt', $markdown);
		/* ファイルポインタをオープン */
		$file = fopen(PATH . 'setting/markdown_article_tmp.txt', 'r');
		/* ファイルを1行ずつ出力 */
		if ($file) {
			while ($line = fgets($file)) {
				preg_match('/^<|^\r\n/', $line, $line_array);
				//		 pre_var_dump($line_array);
				//		 pre_var_dump($line);
				if (!$line_array[0]) {
					if (strlen($line) > 2) {
						//pre_var_dump($line);
						//pre_var_dump($line_array);
						$txt .= '<p>' . $line . '</p>';
						//				$txt.=$line;
					}
				} else {
					$txt .= $line;
				}
				$i++;
			}
		}
		//pre_var_dump($txt);
		/* ファイルポインタをクローズ */
		fclose($file);

		// 改行を削除
		$txt = str_replace(array("\r\n", "\r", "\n"), '', $txt);
		//file_put_contents(PATH.'login/admin/markdown_page/markdown_page_tmp.txt', $txt);
		return $txt;
	}
	//------------
	//下書き保存
	//------------
	public static function markdown_page_draft_save($post) {
		// 既存の下書きの場合
		if ($post['draft_id']) {
			$primary_page_res = model_db::query("
				SELECT * 
					FROM page
					WHERE primary_id = '" . $post['draft_id'] . "'
			");
			// 更新フラグ
			$update_flag = 0;
			// パーマリンクチェック
			$permalink_check = model_login_admin_page_basis::permalink_check($post);
			// 既存のパーマリンクと同じ場合
			if ($post['permalink'] === $primary_page_res[0]['permalink']) {
				$update_flag = 1;
			}
			// パーマリンク再設定
			else if (!$permalink_check) {
				$update_flag = 1;
			} else {
				$post = false;
			}
			// 更新
			if ($update_flag) {
				model_db::query("
					UPDATE page 
					SET 
						title = '" . $post['title'] . "', 
						content = '" . $post['content'] . "',
						permalink = '" . $post['permalink'] . "'
					WHERE primary_id = " . (int)$post['draft_id'] . "
				");
				$post['primary_id'] = $post['draft_id'];
			}
			return $post;
		}
		// 初 下書き保存の場合
		else {
			// パーマリンクチェック
			$permalink_check = model_login_admin_page_basis::permalink_check($post);
			// 重複してない場合
			if (!$permalink_check) {
				$query = model_db::query("
						INSERT INTO page 
						(
							permalink, 
							basic_id, 
							title, 
							content,
							draft
						) 
						VALUES (
							'" . $post['permalink'] . "',
							'" . $_SESSION['basic_id'] . "',
							'" . $post['title'] . "',
							'" . $post['content'] . "',
							1
						)");
				// 下書き取得
				$query = model_db::query("
						SELECT * 
							FROM page
							WHERE basic_id = '" . $_SESSION['basic_id'] . "' 
							AND del = 0
							ORDER BY primary_id DESC
							LIMIT 0,1");
				$query = $query[0];
			} // if(!$permalink_check) {
			else {
				$query = false;
			}
			return $query;
		}
	}
	//---------
	//編集保存
	//---------
	public static function markdown_page_edit_save($post) {
		$primary_page_res = model_db::query("
			SELECT * 
				FROM page
				WHERE primary_id = '" . $post['page_id'] . "'
		");
		// 更新フラグ
		$update_flag = 0;
		// パーマリンクチェック
		$permalink_check = model_login_admin_page_basis::permalink_check($post);
		// 既存のパーマリンクと同じ場合
		if ($post['permalink'] === $primary_page_res[0]['permalink']) {
			$update_flag = 1;
		}
		// パーマリンク再設定
		else if (!$permalink_check) {
			// サイト情報取得
			$site_data_array = basic::site_data_get();
			$delete_permalink = $primary_page_res[0]['permalink'];
			// ディレクトリ削除パス取得
			$directory_path = PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $delete_permalink . '';
			// ディレクトリ削除
			basic::rmdirAll($directory_path);
			$new_permalink = $post['permalink'];
			// ディレクトリ作成パス取得
			$directory_path = PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $new_permalink . '';
			// ディレクトリ作成
			basic::dir_create($directory_path);
			// ファイル複製
			copy(PATH . 'setting/master/page.php', $directory_path . '/index.php');
			///////////////////////////////////////////////////////////
			$sitemap_xml_path = PATH . 'sitemap/sitemap.xml';
			// 全記事リスト取得
			$article_all_list_res = model_sitemap_basis::article_all_list_get();
			// pageリスト取得
			$page_all_list_res = model_sitemap_basis::page_all_list_get();
			// sitemap.xml生成
			$sitemap_xml = model_sitemap_html::sitemap_xml_create($article_all_list_res, $page_all_list_res);
			$update_flag = 1;
		}
		// 重複している場合
		else {
			$post = false;
		}
		if ($update_flag) {
			$now_date = date('Y-m-d H:i:s', time());
			model_db::query("
				UPDATE page
				SET 
					title = '" . $post['title'] . "', 
					content = '" . $post['content'] . "',
					permalink =  '" . $post['permalink'] . "',
					update_time = '" . $now_date . "'
				WHERE primary_id = " . (int)$post['page_id'] . "
			");
			$post['primary_id'] = $post['article_id'];
			$post['page_url'] = HTTP . $post['permalink'] . '/';
			/*
			if(file_exists(PATH.'article/'.$post['article_id'].'/index.html')) {
				// 圧縮ファイル削除
				unlink(PATH.'article/'.$post['article_id'].'/index.html');
			}
			if(file_exists(PATH.'article/'.$post['article_id'].'/index.html.gz')) {
				// 圧縮ファイル削除
				unlink(PATH.'article/'.$post['article_id'].'/index.html.gz');
			}
*/
			// 更新記事情報取得
			$res = model_db::query("
				SELECT *
				FROM page
				WHERE del = 0
				AND primary_id = " . (int)$post['article_id'] . "
				ORDER BY primary_id DESC
				LIMIT 0, 1");
		}
		return $post;
	}
	//----------
	//新規作成
	//---------
	public static function markdown_page_add($post) {
		//			pre_var_dump($post);
		$query = model_db::query("
			INSERT INTO page 
			(
				permalink, 
				basic_id, 
				title, 
				content
			) 
			VALUES (
				'" . $post['permalink'] . "',
				'" . $_SESSION['basic_id'] . "',
				'" . $post['title'] . "',
				'" . $post['content'] . "'
			)");
	}
	//------------------
	//下書きページ公開
	//-------------------
	public static function markdown_page_public($post) {
		//			pre_var_dump($post);
		$now_date = date('Y-m-d H:i:s', time());
		model_db::query("
				UPDATE page
				SET 
					title = '" . $post['title'] . "', 
					content = '" . $post['content'] . "',
					permalink =  '" . $post['permalink'] . "',
					draft = 0,
					update_time = '" . $now_date . "'
				WHERE primary_id = " . (int)$post['draft_id'] . "
			");
	}
	//--------------
	//記事OGP生成 (古い  model_media_page_basis::media_article_ogp_createが正しい
	//--------------
	public static function ________________media_article_ogp_create($res) {
		//		pre_var_dump($res);
		pre_var_dump($res[0]['primary_id']);
		pre_var_dump($res[0]['title']);
		// 基準となるOGP画像
		$im = imagecreatefrompng(PATH . 'assets/img/ogp/amatem_ogp_0.png');
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
		$text_last = preg_replace('/' . $text_16 . '/', '', $text);
		$text_16 = $text_16 . '
';
		$text = $text_16 . $text_last;

		$text_32 = mb_substr($text, 0, 32);
		$text_last = preg_replace('/' . $text_32 . '/', '', $text);
		$text_32 = $text_32 . '
';
		$text = $text_32 . $text_last;

		$text_51 = mb_substr($text, 0, 51);
		$text_last = preg_replace('/' . $text_51 . '/', '', $text);
		$text_51 = $text_51 . '
';
		$text = $text_51 . $text_last;
		// [と]を戻す
		$text = preg_replace('/顯/', '[', $text);
		$text = preg_replace('/舷/', ']', $text);
		// アップロードするディレクトリ
		$uploads_dir = PATH . 'assets/img/article_ogp/';
		// 使用するフォント
		/*
		$font = '/var/www/html/assets/font/Noto_Serif_KR/NotoSerifKR-ExtraLight.otf';
		$font = '/var/www/html/assets/font/Noto_Serif_KR/NotoSerifKR-SemiBold.otf';
		$font = '/var/www/html/assets/font/MODI_komorebi-gothic_2018_0501/komorebi-gothic-P.ttf';
*/
		$font = PATH . 'assets/font/source-han-code-jp-2.011R/OTF/SourceHanCodeJP-Medium.otf';

		//image file name
		$name = $uploads_dir . $res[0]['primary_id'] . '.png'; //this saves the image inside uploaded_files folder
		// テキスト転写
		imagettftext($im, 36, 0, 270, 290, $black, $font, $text); // 画像、フォントサイズ、なんか、横、縦
		// png作成
		imagepng($im, $name, 1);
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
		foreach ($markdown_array[2] as $kye => $value) {
			$html = file_get_contents($value);
			// ヘッダー取得
			$header = get_headers($value);
			foreach ($header as $header_key => $header_value) {
				// gzチェック
				if (preg_match('/gzip/', $header_value)) {
					$gz_check = true;
				}
			}
			// gzならデコードする
			if ($gz_check) {
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
			if (!$icon) {
				preg_match('/<link rel="icon"(.*?)href="(.*?)"(.*?)>/', $html, $html_array);
				$icon = $html_array[2];
			}
			//			pre_var_dump($icon);
			if ($icon) {
				// 相対的に表記されたアイコンを絶対的に戻す
				if (!preg_match('/http/', $icon, $icon_array)) {
					// 相対パスを絶対パスに変換
					$icon = model_login_markdown_page_basis::pathToUrl($icon, $value);
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
					$src = 'data:' . $mime . ';base64,' . $imageData;
					/*
<img src="data:image/vnd.microsoft.icon; base64,AAABAAE
<img src="data:image/vnd.microsoft.icon;AAAAAAA=" decoding="async" loading="lazy">

<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAD==">
*/
					// icon_html生成
					$icon_html = '<img src="' . $src . '" decoding="async" loading="lazy">';
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
					$src = 'data:' . $mime . ';base64,' . $imageData;
					// icon_html生成
					$icon_html = '<img src="' . $src . '" decoding="async" loading="lazy">';
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
			$markdown = preg_replace('/\[card_link:(.*?)url:"' . $value . '"(.*?)\]/s', '<div class="card_link"><a href="' . $url . '" target="_blank"><div class="card_link_left"><div class="card_link_title">' . $title . '</div><div class="card_link_domain_data">' . $icon_html . $domain . '</div></div><div class="card_link_right"><div class="card_link_img"><!-- <img src="' . HTTP . 'assets/img/common/icon-chain02.png" decoding="async" loading="lazy"> --></div></div></a></div>', $markdown);
			$url = '';
			$title = '';
			$icon = '';
			$domain = '';
			$image = '';
		} // foreach($markdown_array[2] as $kye => $value) {
		return $markdown;
	}
	//--------------
	//記事OGP生成
	//--------------
	public static function media_article_ogp_create($res) {
		//		pre_var_dump($res);
		//		pre_var_dump($site_data_array);
		/*
		pre_var_dump($res[0]['primary_id']);
		pre_var_dump($res[0]['title']);
*/
		// 基準となるOGP画像
		$im = imagecreatefrompng(PATH . 'app/theme/admin/assets/img/ogp/basic_article_common_ogp_2.png');
		// Create some colors 後で使うかも
		$white = imagecolorallocate($im, 255, 255, 255);
		$grey = imagecolorallocate($im, 128, 128, 128);
		$black = imagecolorallocate($im, 0, 0, 0);
		// OGP画像に転写するタイトルテキスト
		$text = $res[0]['title'];
		// 正しくpreg_replaceできるように変換
		$text = preg_replace('/\[/', '黽', $text);
		$text = preg_replace('/\]/', '籃', $text);
		$text = preg_replace('/\+/', '喙', $text);
		$text = preg_replace('/\*/', '膩', $text);
		$text = preg_replace('/\./', '蜚', $text);
		$text = preg_replace('/\^/', '艨', $text);
		$text = preg_replace('/\$/', '盈', $text);
		$text = preg_replace('/\|/', '槭', $text);
		$text = preg_replace('/\-/', '靂', $text);
		$text = preg_replace('/\(/', '樝', $text);
		$text = preg_replace('/\)/', '艟', $text);
		$text = preg_replace('/\{/', '冀', $text);
		$text = preg_replace('/\}/', '笆', $text);
		$text = preg_replace('/\?/', '罘', $text);
		/*
参考サイト
【難読】漢字一文字で読み方が５文字のかっこいい漢字 180種類｜珍しい日本の漢字
https://kotonohaweb.net/difficult-1kanji-5moji/
*/
		// 16文字で改行
		$text_16 = mb_substr($text, 0, 16);
		$text_last = preg_replace('/' . $text_16 . '/', '', $text);
		$text_16 = $text_16 . '
';
		$text = $text_16 . $text_last;

		$text_32 = mb_substr($text, 0, 32);
		$text_last = preg_replace('/' . $text_32 . '/', '', $text);
		$text_32 = $text_32 . '
';
		$text = $text_32 . $text_last;

		$text_51 = mb_substr($text, 0, 51);
		$text_last = preg_replace('/' . $text_51 . '/', '', $text);
		$text_51 = $text_51 . '
';
		$text = $text_51 . $text_last;
		// 戻す
		$text = preg_replace('/\黽/', '[', $text);
		$text = preg_replace('/\籃/', ']', $text);
		$text = preg_replace('/\喙/', '+', $text);
		$text = preg_replace('/膩/', '*', $text);
		$text = preg_replace('/蜚/', '.', $text);
		$text = preg_replace('/艨/', '^', $text);
		$text = preg_replace('/盈/', '$', $text);
		$text = preg_replace('/槭/', '|', $text);
		$text = preg_replace('/靂/', '-', $text);
		$text = preg_replace('/樝/', '(', $text);
		$text = preg_replace('/艟/', ')', $text);
		$text = preg_replace('/冀/', '{', $text);
		$text = preg_replace('/笆/', '}', $text);
		$text = preg_replace('/罘/', '?', $text);

		// UTF-8に変換
		$text = mb_convert_encoding($text, 'UTF-8');

		// アップロードするディレクトリ
		$uploads_dir = PATH . 'app/assets/img/article_ogp/';
		// 使用するフォント
		//		$font = PATH.'assets/font/Noto_Serif_KR/NotoSerifKR-ExtraLight.otf';
		//		$font = PATH.'assets/font/Noto_Serif_KR/NotoSerifKR-SemiBold.otf';
		//		$font = PATH.'assets/font/MODI_komorebi-gothic_2018_0501/komorebi-gothic-P.ttf';
		//		$font = PATH.'assets/font/source-han-code-jp-2.011R/OTF/SourceHanCodeJP-Medium.otf';
		//		$font = PATH.'assets/font/hiragino/hiragino_3w.ttc';
		//		$font = PATH.'assets/font/ChalkJP_3/Chalk-JP.otf';
		$font = PATH . 'app/theme/admin/assets/font/NasuFont20200227/Nasu-Regular-20200227.ttf';

		//image file name
		$article_ogp_full_dir_name = $uploads_dir . $res[0]['primary_id'] . '.png';
		//		pre_var_dump($article_ogp_full_dir_name);
		// テキスト転写
		imagettftext($im, 36, 0, 270, 290, $black, $font, $text); // 画像、フォントサイズ、なんか、横、縦
		// png作成
		imagepng($im, $article_ogp_full_dir_name, 1);
		// GD 削除
		imagedestroy($im);
		/*
// テスト
echo ('<img src="http://localhost/basic/app/assets/img/article_ogp/'.$res[0]['primary_id'].'.png">');
*/
	}
	//------------
	//ページ削除
	//------------
	public static function markdown_page_delete($page_primary_id) {
		model_db::query("
			UPDATE page 
			SET 
				del = 1
			WHERE primary_id = " . (int)$page_primary_id . "
		");
		//		return $query;
	}
	//-----------------------
	//パーマリンクチェック
	//-----------------------
	public static function permalink_check($post) {
		//		pre_var_dump($post);
		$permalink_check_res = model_db::query("
			SELECT * FROM page 
			WHERE permalink = '" . $post['permalink'] . "'");
		//		pre_var_dump($permalink_check_res);
		return $permalink_check_res;
	}
}
