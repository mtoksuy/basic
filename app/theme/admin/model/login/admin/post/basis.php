<?php 
class model_login_admin_post_basis {
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
		$markdown =model_login_admin_post_basis::card_link_conversion($markdown);

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
						basic_id, 
						title, 
						hashtag, 
						content
					) 
					VALUES (
						'".$_SESSION['basic_id']."',
						'".$post['title']."',
						'".$post['hashtag']."',
						'".$post['content']."'
					)");
				// 下書き取得
				$query = model_db::query("
					SELECT * 
						FROM article_draft
						WHERE basic_id = '".$_SESSION['basic_id']."' 
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
		model_login_admin_post_basis::media_article_ogp_create($res);
		return $post;
	}
	//----------
	//新規投稿
	//---------
	public static function markdown_post_add($post) {
		$query = model_db::query("
			INSERT INTO article 
			(
				basic_id, 
				title, 
				content
			) 
			VALUES (
				'".$_SESSION['basic_id']."',
				'".$post['title']."',
				'".$post['content']."'
			)");
	}
	//--------------
	//記事OGP生成 (古い  model_media_post_basis::media_article_ogp_createが正しい
	//--------------
	public static function ________________media_article_ogp_create($res) {
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
		$im = imagecreatefrompng(PATH.'app/theme/admin/assets/img/ogp/basic_article_common_ogp_2.png');
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
		$uploads_dir = PATH.'app/assets/img/article_ogp/';
		// 使用するフォント
//		$font = PATH.'assets/font/Noto_Serif_KR/NotoSerifKR-ExtraLight.otf';
//		$font = PATH.'assets/font/Noto_Serif_KR/NotoSerifKR-SemiBold.otf';
//		$font = PATH.'assets/font/MODI_komorebi-gothic_2018_0501/komorebi-gothic-P.ttf';
//		$font = PATH.'assets/font/source-han-code-jp-2.011R/OTF/SourceHanCodeJP-Medium.otf';
//		$font = PATH.'assets/font/hiragino/hiragino_3w.ttc';
//		$font = PATH.'assets/font/ChalkJP_3/Chalk-JP.otf';
		$font = PATH.'app/theme/admin/assets/font/NasuFont20200227/Nasu-Regular-20200227.ttf';

		//image file name
		$article_ogp_full_dir_name = $uploads_dir.$res[0]['primary_id'].'.png';
//		pre_var_dump($article_ogp_full_dir_name);
		// テキスト転写
		imagettftext($im, 36, 0, 270, 290, $black, $font, $text); // 画像、フォントサイズ、なんか、横、縦
		// png作成
		imagepng($im,$article_ogp_full_dir_name,1);
		// GD 削除
		imagedestroy($im);
/*
// テスト
echo ('<img src="http://localhost/basic/app/assets/img/article_ogp/'.$res[0]['primary_id'].'.png">');
*/
	}
	//----------
	//記事削除
	//----------
	public static function markdown_post_delete($article_primary_id) {
		model_db::query("
			UPDATE article 
			SET 
				del = 1
			WHERE primary_id = ".(int)$article_primary_id."
		");
		return $query;
	}
	//------------------------------
	// newarticleディレクトリ生成
	//------------------------------
	public static function newarticle_dir_create($site_data_array) {
		// 記事COUNT取得
		$article_count_res = model_db::query("
			SELECT COUNT(*)
			FROM article
			WHERE del = 0");
		$article_count = $article_count_res[0]['COUNT(*)'];
		$newarticle_number_need_dir = (int)($article_count/$site_data_array['article_view_num']);
		// 必要なdir生成
		for($count = 0; $count <= $newarticle_number_need_dir; $count++) {
			if($count > 0) {
				// ディレクトリ作成パス取得
				$directory_path = PATH.'app/theme/'.$site_data_array['theme'].'/controller/newarticle/'.(int)$count.'';
				if(!file_exists($directory_path)){
					// ディレクトリ作成
					basic::dir_create($directory_path);
					// ファイル複製
					copy(PATH.'setting/master/newarticle.php', $directory_path.'/index.php');
				}
			}
		} // for($count = 0; $count <= $newarticle_number_need_dir; $count++) {
	}
	//------------------------------
	// newarticleディレクトリ削除
	//------------------------------
	public static function newarticle_dir_delete($site_data_array) {
		// ディレクトリ作成パス取得
		$directory_path = PATH.'app/theme/'.$site_data_array['theme'].'/controller/newarticle/';
		$result = glob(''.$directory_path.'*', GLOB_ONLYDIR); // ディレクトリのみ取得
		foreach($result as $key => $value) {
			if(file_exists($value)){
				// ディレクトリ削除
				basic::rmdirAll($value);
			}
		}
	}













}