<?php 
class model_article_html {
	//-----------------------
	//記事リストHTML生成
	//-----------------------
	public static function article_list_html_create($article_list_res) {
		$article_list_li = '';
		$thumbnail_html = '';
		foreach($article_list_res as $key => $value) {
			// 記事データ取得
			$unix_time                   = strtotime($value["create_time"]);
			$local_time                  = date('Y-m-d', $unix_time);
			$local_japanese_time  = date('Y年m月d日', $unix_time);
			$article_year_time       = date('Y', $unix_time);
//pre_var_dump($value);
			// 記事HTMLテキスト取得
			$article_contents     = htmlspecialchars_decode($value["content"]);
			// basicのユーザーデータ取得
			$user_data_array = basic::user_data_get($value['basic_id']);
			// サムネイルHTML生成
			$thumbnail_html = model_article_html::thumbnail_html_create($article_contents);
			// サムネイルを指定してなかった場合はデフォルトサムネイル表示
			if(!$thumbnail_html) {
				if(file_exists(PATH.'app/assets/img/article_ogp/'.$value['primary_id'].'.png')) {
					$thumbnail_html = '<div class="thumbnail"> <img src="'.HTTP.'app/assets/img/article_ogp/'.$value['primary_id'].'.png" decoding="async" loading="lazy"> </div>';
				}
			}
			// マークダウンをhtmlに変換
			$article_contents = model_login_admin_post_basis::markdown_html_conversion($article_contents, $user_data_array);
			// 改行を消す&タブ削除
			$article_contests = str_replace(array("\r\n", "\r", "\n", "\t"), '', $article_contents);
			// 本文を5680文字に丸める
			$article_contests = mb_strimwidth($article_contests, 0, 5680, '...', 'utf8');
			// HTMLタグを取り除く
			$article_contests = strip_tags($article_contests);
			// 本文を168文字に丸める
			$summary_contents = mb_strimwidth($article_contests, 0, 168, "...", 'utf8');
			// エンティティを戻す
			$title        = htmlspecialchars_decode($value["title"], ENT_NOQUOTES);
			// タイトルを82文字に丸める
			$title = mb_strimwidth($title, 0, 82, "...", 'utf8');

			 $article_list_li .=
				 '<li>
					<article>
						<a href="'.HTTP.'article/'.$value['primary_id'].'/" class="o_8">
							<div class="card_article_contents">
								'.$thumbnail_html.'
								<h1>'.$title.'</h1>
								<div class="card_article_contents_summary">'.$summary_contents.'</div>
								<div class="card_article_contents_time">'.$local_japanese_time.'</div>
							</div>
						</a>
					</article>
				</li>';
		}
		// 合体
		$article_list_html = 
		'<ul>
			'.$article_list_li.'
		</ul>';
		return $article_list_html;
	}
	//------------------
	//記事のHTML生成
	//-------------------
	public static function article_html_create($article_res) {
		// 記事HTML生成
		foreach($article_res as $key => $value) {
			// 記事作成時間取得
			$creation_time            = $value["create_time"];
			$unix_time                  = strtotime($value["create_time"]);
			$year_time                  = date('Y', $unix_time);
			$local_time                 = date('Y-m-d', $unix_time);
			$local_japanese_time = date('Y年m月d日', $unix_time);

			// 記事更新時間取得
			if($value["update_time"]) {
				$update_time                          = $value["update_time"];
				$update_unix_time                  = strtotime($value["update_time"]);
				$local_update_time                 = date('Y-m-d', $update_unix_time);
				$local_update_japanese_time = date('Y年m月d日', $update_unix_time);
			}
			$article_year_time = date('Y', $unix_time);

			// 記事タイトル取得
			$article_primary_id  = $value["primary_id"];
			// 記事タイトル取得 // エンティティを戻す
			$article_title        = htmlspecialchars_decode($value["title"], ENT_NOQUOTES); // ダブルクォート、シングルクォートの両方をそのままにします。
			// 記事HTMLテキスト取得
			$article_contents     = htmlspecialchars_decode($value["content"]);
			// basicのユーザーデータ取得
			$user_data_array = basic::user_data_get($value['basic_id']);
			// サムネイルHTML生成
			$thumbnail_html = model_article_html::thumbnail_html_create($article_contents);
			// マークダウンをhtmlに変換
			$article_contents = model_login_admin_post_basis::markdown_html_conversion($article_contents, $user_data_array);
			// 画像をwebpに差し替える(既存で存在していたら)
			$article_contents = model_article_html::image_to_webp_replace($article_contents);

			// 投稿日・更新日HTML生成
			$posted_date_time_html = model_article_html::posted_date_time_html_create($local_time, $local_japanese_time);
			if($value["update_time"]) {
				$update_date_time_html = model_article_html::update_date_time_html_create($local_update_time, $local_update_japanese_time);
			}
			else {
				$update_date_time_html = '';
			}
			// ハッシュタグhtml取得
//			$hashtag_html = model_article_html::hashtag_html_create($value['hashtag']);
			$hashtag_html = '';
			/*のちほど実装*/

			// シェアボタンhtml取得
			$share_button_html = model_article_html::share_button_html_create($article_primary_id, $article_title);
			// 著者プロフィールhtml取得
			$author_profile_html = model_article_html::author_profile_html_create($user_data_array);
			// 記事HTMLテキスト取得
			$author_profile_html = htmlspecialchars_decode($author_profile_html);

			// /関連記事res取得
			$related_articles_res = model_article_basis::related_articles_res_get($value['primary_id'], $value['hashtag']);
			// 関連記事html取得
			$related_articles_html = model_article_html::related_articles_html_create($related_articles_res);

			// 前の記事、次の記事データ取得
			$article_previous_next_res_array = model_article_basis::article_previous_next_get($article_primary_id);
			$detail_article_bottom_html = model_article_html::article_previous_next_html_create($article_primary_id);

			// 記事HTML
			$article_html = ('
				<article>
					<h1>'.$article_title.'</h1>
					<div class="article_data">
						<div class="writer_data">
							<span>著者：</span><a class="o_8" rel="author" href="'.HTTP.'writer/'.$user_data_array['basic_id'].'/"><img width="24" height="24" title="'.$user_data_array['name'].'" alt="'.$user_data_array['name'].'" src="'.HTTP.'app/assets/img/user/'.$user_data_array['icon'].'">'.$user_data_array['name'].'</a>
						</div>
						'.$posted_date_time_html.'
						'.$update_date_time_html.'
						'.$thumbnail_html.'
					</div>
					'.$article_contents.'
					'.$hashtag_html.'
					'.$share_button_html.'
					'.$related_articles_html.'
					'.$author_profile_html.'
					'.$detail_article_bottom_html.'
				</article>');

			// article_data_array
			$article_data_array = array(
				'article_primary_id' => (int)$article_primary_id,
				'article_html'           => $article_html, 
				'article_title'            => $article_title, 
				'article_contents'    => $article_contents,
			);
		}
		return $article_data_array;
	}
	//--------------
	//投稿日HTML生成
	//--------------
	public static function posted_date_time_html_create($local_time, $local_japanese_time) {
		$posted_date_time_html= 
			'<div class="posted_date_time">
				<span>投稿日：</span><time datetime="'.$local_time.'" itemprop="datePublished">'.$local_japanese_time.'</time>
			</div>';
		return $posted_date_time_html;
	}
	//------------------
	//更新日HTML生成
	//------------------
	public static function update_date_time_html_create($local_update_time, $local_update_japanese_time) {
		if($local_update_time) {
			$update_date_time_html= 
				'<div class="update_date_time">
					<span>更新日：</span><time datetime="'.$local_update_time.'" itemprop="dateModified">'.$local_update_japanese_time.'</time>
				</div>';
		}
			else {

			}
		return $update_date_time_html;
	}
	//--------------------------------
	//前の記事、次の記事HTML生成
	//--------------------------------
	public static function article_previous_next_html_create($article_primary_id) {
		// 変数
		$preview_html = '';
		$next_html    = '';
		// 前の記事、次の記事データ取得
		$article_previous_next_res_array = Model_Article_Basis::article_previous_next_get($article_primary_id);
		// 前の記事HTML生成
		foreach($article_previous_next_res_array["previous"] as $key => $value) {
			$preview_html = ('<div class="previous"><span>前の記事</span><a href="'.HTTP.'article/'.$value["primary_id"].'/">'.mb_strimwidth($value["title"], 0,124, '...').'</a></div>');
		}
		// 次の記事HTML生成
		foreach($article_previous_next_res_array["next"] as $key => $value) {
			$next_html = ('<div class="next"><span>次の記事</span><a href="'.HTTP.'article/'.$value["primary_id"].'/">'.mb_strimwidth($value["title"], 0, 124, '...').'</a></div>');
		}
		// 関連記事、前の記事、次の記事HTML生成
		$detail_article_bottom_html = 
			('<div class="previous_next">
				'.$preview_html.$next_html.'
			</div>');
		return $detail_article_bottom_html;
	}
	//------------------------------
	//カテゴリ別リストHTML取得
	//------------------------------
	public static function category_article_list_html_create($category_article_res) {
		foreach($category_article_res as $key => $value) {
			// 記事データ取得
			$unix_time            = strtotime($value["create_time"]);
			$local_time           = date('Y-m-d', $unix_time);
			$local_japanese_time  = date('Y年m月d日', $unix_time);
			$article_year_time    = date('Y', $unix_time);
			$basic_id = $value['basic_id'];

//pre_var_dump($value);
			// 記事HTMLテキスト取得
			$article_contents     = htmlspecialchars_decode($value["content"]);
			// 改行を消す&タブ削除
			$article_contests = str_replace(array("\r\n", "\r", "\n", "\t"), '', $article_contents);
			// 本文を5680文字に丸める
			$article_contests = mb_strimwidth($article_contests, 0, 5680, '...', 'utf8'); // 応急処置 2018.01.31 なぜこれで直るかはわからん 下記のpreg_replaceが重すぎた
			// 画像変換 サムネイル対策
			$article_contests = preg_replace('/\(http:\/\/(.*?)jpg\)/', '', $article_contests);
			$article_contests = preg_replace('/\(https:\/\/(.*?)jpg\)/', '', $article_contests);
	
			$article_contests = preg_replace('/\(http:\/\/(.*?)jpeg\)/', '', $article_contests);
			$article_contests = preg_replace('/\(https:\/\/(.*?)jpeg\)/', '', $article_contests);
	
			$article_contests = preg_replace('/\(http:\/\/(.*?)JPG\)/', '', $article_contests);
			$article_contests = preg_replace('/\(https:\/\/(.*?)JPG\)/', '', $article_contests);
	
			$article_contests = preg_replace('/\(http:\/\/(.*?)png\)/', '', $article_contests);
			$article_contests = preg_replace('/\(https:\/\/(.*?)png\)/', '', $article_contests);
	
			$article_contests = preg_replace('/\(http:\/\/(.*?)PNG\)/', '', $article_contests);
			$article_contests = preg_replace('/\(https:\/\/(.*?)PNG\)/', '', $article_contests);

			// HTMLタグを取り除く
//			$article_contests = preg_replace('/<("[^"]*"|\'[^\']*\'|[^\'">])*>/', '', $article_contests);
			$article_contests = strip_tags($article_contests);

			// 本文を168文字に丸める
			$summary_contents = mb_strimwidth($article_contests, 0, 168, "...", 'utf8');

			// エンティティを戻す
			$title        = htmlspecialchars_decode($value["title"], ENT_NOQUOTES);
			// タイトルを82文字に丸める
			$title = mb_strimwidth($title, 0, 82, "...", 'utf8');

			// カテゴリー情報取得
			$category_name = $value['category'];
			$category_res = model_article_basis::category_data_get($category_name);
			$category_name = $category_res[0]['category_name'];
			$name = $category_res[0]['name'];
			$description = $category_res[0]['description'];

			 $article_list_li .=
				 '<li>
					<article>
						<a href="'.HTTP.'article/'.$value['primary_id'].'/" class="o_8">
							<div class="card_article_contents">
<!--
								<img src="'.HTTP.'assets/img/article_ogp/'.$value['primary_id'].'.png" decoding="async" loading="lazy">
-->
								<h1>'.$title.'</h1>
								<div class="card_article_contents_summary">'.$summary_contents.'</div>
								<div class="card_article_contents_time">'.$local_japanese_time.'</div>
							</div>
						</a>
					</article>
				</li>';
		} // foreach
		// 合体
		$article_list_html = 
		'<div class="category_article_list">
			<h2>'.$name.'</h2>
			<span>'.$description.'</span>
			<ul>
				'.$article_list_li.'
			</ul>
		</div>';
		return $article_list_html;
	}
	//--------------------------
	//シェアボタンHTML取得
	//--------------------------
	public static function share_button_html_create($article_primary_id, $article_title) {
		$share_button_html = '
<div class="social_share_uri_scheme clearfix">
	<!-- はてなブックマーク -->
	<a target="_blank" title="記事をブックマークする" alt="記事をブックマークする" href="https://b.hatena.ne.jp/add?mode=confirm&amp;is_bm=1&amp;url='.urlencode(HTTP.'article/'.(int)$article_primary_id.'/').'">
		<div class="social_share_uri_scheme_left_block">
			<img width="30" height="50" src="'.HTTP.'app/assets/svg/article/bookmark_logo_1.svg">
		</div>
	</a>
	<!-- LINE -->
	<a target="_blank" title="LINEで共有する" alt="LINEで共有する" href="https://social-plugins.line.me/lineit/share?url='.urlencode(HTTP.'article/'.(int)$article_primary_id.'/').'">
		<div class="social_share_uri_scheme_left_block">
			<img width="30" height="50" src="'.HTTP.'app/assets/svg/article/line_logo_1.svg">
		</div>
	</a>
	<!-- Facebook -->
	<a class="fb_color o_8 clearfix" target="_blank" title="Facebookで投稿する" alt="Facebookで投稿する" href="http://www.facebook.com/share.php?u='.urlencode(HTTP.'article/'.(int)$article_primary_id.'/').'">
		<div class="social_share_uri_scheme_left_block">
			<img width="30" height="50" src="'.HTTP.'app/assets/svg/article/f_logo_1.svg">
		</div>
	</a>
	<!-- Twitter -->
	<a class="tw_color o_8" target="_blank" title="Twitterでツイートする" alt="Twitterでツイートする" href="http://twitter.com/intent/tweet?url='.urlencode(HTTP.'article/'.(int)$article_primary_id.'/').'&text='.urlencode($article_title).'">
		<div class="social_share_uri_scheme_left_block">
			<img width="30" height="50" src="'.HTTP.'app/assets/svg/article/twitter_logo_1.svg">
		</div>
	</a>
	<!-- クリップボードコピー -->
	<a class="clipboard_copy" target="_blank" title="リンクをコピーする" alt="リンクをコピーする">
		<div class="social_share_uri_scheme_left_block">
			<img width="30" height="50" src="'.HTTP.'app/assets/svg/article/copy_logo_1.svg">
		</div>
	</a>
	<textarea class="clipboard_copy_textarea">'.HTTP.'article/'.(int)$article_primary_id.'/</textarea>
</div>';
		return $share_button_html;
	}
	//-----------------------------------
	//記事JSON-LDリッチリザルト生成
	//-----------------------------------
	public static function article_json_ld_rich_lizarto_create($article_res) {
/*
		pre_var_dump($article_res[0]['create_time']);
		pre_var_dump($article_res[0]['update_time']);
*/
		$datePublished = '';
		$dateModified = '';
		$article_json_ld_rich_lizarto = '';
		foreach($article_res as $kye => $value) {
//			pre_var_dump($value);
//pre_var_dump($value);
		$headline = mb_strimwidth($value['title'], 0, 94, "...");
		$create_date = new DateTime($value['create_time']);
		// ユーザー情報取得
		$user_data_array = basic::user_data_get($value['basic_id']);
		$author_name = $user_data_array['name'];
		// 更新がある場合
		if($value['update_time']) {
			$update_date = new DateTime($value['update_time']);
			$datePublished = '"datePublished": "'.$create_date->format(DateTime::ATOM).'", ';
			$dateModified = '"dateModified": "'.$update_date->format(DateTime::ATOM).'"';
		}
			// ない場合
			else {
				$datePublished = '"datePublished": "'.$create_date->format(DateTime::ATOM).'"';
			}
		$article_json_ld_rich_lizarto = 
'<script type="application/ld+json">
{
	"@context": "https://schema.org/",
	"@type": "NewsArticle",
	"headline": "'.$headline.'",
	"image": [
		"'.HTTP.'assets/img/article_ogp/'.$value['primary_id'].'.png"
	],
    "author": [
	{
		"@type": "Person",
		"name": "'.$author_name.'",
		"url": "'.HTTP.'writer/'.$value['basic_id'].'/"
	}],
	'.$datePublished.'
	'.$dateModified.'
}
</script>';
//pre_var_dump($article_json_ld_rich_lizarto);
		}
		return $article_json_ld_rich_lizarto;
	}
	//------------------------
	// ハッシュタグhtml取得
	//------------------------
	public static function hashtag_html_create($hashtag) {
		$hashtag_list = explode(', ', $hashtag);
		foreach($hashtag_list as $hashtag_list_key => $hashtag_list_value) {
			if($hashtag_list_value) {
				$hashtag_li .= '<li><a href="'.HTTP.'hathtag/'.$hashtag_list_value.'/">'.$hashtag_list_value.'</a></li>';
			}
		}
		$hashtag_html = 
		'<div class="article_hashtag">
		<ul>'.$hashtag_li.'</ul>
		</div>';
		return $hashtag_html;
	}
	//----------------------------
	// 著者プロフィールhtml取得
	//----------------------------
	public static function author_profile_html_create($user_data_array) {
		$author_profile_html = 
			'<div class="author_profile">
				<span>著者プロフィール</span>
				<div class="author_profile_icon">
					<img width="128" height="128" title="'.$user_data_array['name'].'" alt="'.$user_data_array['name'].'" src="'.HTTP.'app/assets/img/user/'.$user_data_array['icon'].'">
				</div>
				<div class="author_profile_contents">
					<div class="author_profile_name">
						<a rel="author" href="'.HTTP.'writer/'.$user_data_array['basic_id'].'/">
						'.$user_data_array['name'].'
						</a>
					</div>
					<p class="m_0">
						'.$user_data_array['profile'].'
					</p>
					<div class="profile_card_content_sns">

					</div>
				</div>
			</div>';
		return $author_profile_html;
	}
	//--------------------
	// 関連記事html取得
	//--------------------
	public static function related_articles_html_create($related_articles_res) {
		$li = '';
		$related_articles_html = '';
		foreach((array)$related_articles_res as $kye => $value) {
			// 記事データ取得
			$unix_time            = strtotime($value["create_time"]);
			$local_time           = date('Y-m-d', $unix_time);
			$local_japanese_time  = date('Y年m月d日', $unix_time);
			$article_year_time    = date('Y', $unix_time);
			// 記事HTMLテキスト取得
			$article_contents     = htmlspecialchars_decode($value["content"]);
			// 改行を消す&タブ削除
			$article_contests = str_replace(array("\r\n", "\r", "\n", "\t"), '', $article_contents);
			// 本文を5680文字に丸める
			$article_contests = mb_strimwidth($article_contests, 0, 5680, '...', 'utf8'); // 応急処置 2018.01.31 なぜこれで直るかはわからん 下記のpreg_replaceが重すぎた
			// html除去
			$article_contests = strip_tags($article_contests);
			// 本文を168文字に丸める
			$summary_contents = mb_strimwidth($article_contents, 0, 168, "...", 'utf8');
			// エンティティを戻す
			$title        = htmlspecialchars_decode($value["title"], ENT_NOQUOTES);
			// タイトルを82文字に丸める
			$title = mb_strimwidth($title, 0, 82, "...", 'utf8');
			$li .= '
			<li>
			<article>
				<a href="'.HTTP.'article/'.$value['primary_id'].'/" class="o_8">
					<div class="card_article_contents">
						<h1>'.$title.'</h1>
						<div class="card_article_contents_summary">'.$summary_contents.'</div>
						<div class="card_article_contents_time">'.$local_japanese_time.'</div>
					</div>
				</a>
			</article>
			</li>
';
		}
		if($related_articles_res) {
			$related_articles_html = 
				'<div class="related_articles">
					<span>関連記事</span>
					<ul>
						'.$li.'
					</ul>
				</div>';
		}
		return $related_articles_html;
	}

	//----------------------------------
	//オールカテゴリリストHTML取得
	//----------------------------------
	public static function all_category_article_list_html_create($all_article_res) {
		foreach($all_article_res as $key => $value) {
			// 記事データ取得
			$unix_time            = strtotime($value["create_time"]);
			$local_time           = date('Y-m-d', $unix_time);
			$local_japanese_time  = date('Y年m月d日', $unix_time);
			$article_year_time    = date('Y', $unix_time);
//pre_var_dump($value);
			// 記事HTMLテキスト取得
			$article_contents     = htmlspecialchars_decode($value["content"]);
			// 改行を消す&タブ削除
			$article_contests = str_replace(array("\r\n", "\r", "\n", "\t"), '', $article_contents);
			// 本文を5680文字に丸める
			$article_contests = mb_strimwidth($article_contests, 0, 5680, '...', 'utf8'); // 応急処置 2018.01.31 なぜこれで直るかはわからん 下記のpreg_replaceが重すぎた
			// 画像変換 サムネイル対策
			$article_contests = preg_replace('/\(http:\/\/(.*?)jpg\)/', '', $article_contests);
			$article_contests = preg_replace('/\(https:\/\/(.*?)jpg\)/', '', $article_contests);
	
			$article_contests = preg_replace('/\(http:\/\/(.*?)jpeg\)/', '', $article_contests);
			$article_contests = preg_replace('/\(https:\/\/(.*?)jpeg\)/', '', $article_contests);
	
			$article_contests = preg_replace('/\(http:\/\/(.*?)JPG\)/', '', $article_contests);
			$article_contests = preg_replace('/\(https:\/\/(.*?)JPG\)/', '', $article_contests);
	
			$article_contests = preg_replace('/\(http:\/\/(.*?)png\)/', '', $article_contests);
			$article_contests = preg_replace('/\(https:\/\/(.*?)png\)/', '', $article_contests);
	
			$article_contests = preg_replace('/\(http:\/\/(.*?)PNG\)/', '', $article_contests);
			$article_contests = preg_replace('/\(https:\/\/(.*?)PNG\)/', '', $article_contests);

			// HTMLタグを取り除く
//			$article_contests = preg_replace('/<("[^"]*"|\'[^\']*\'|[^\'">])*>/', '', $article_contests);
			$article_contests = strip_tags($article_contests);

			// 本文を168文字に丸める
			$summary_contents = mb_strimwidth($article_contests, 0, 168, "...", 'utf8');

			// エンティティを戻す
			$title        = htmlspecialchars_decode($value["title"], ENT_NOQUOTES);
			// タイトルを82文字に丸める
			$title = mb_strimwidth($title, 0, 82, "...", 'utf8');

			 $article_list_li .=
				 '<li>
					<article>
						<a href="'.HTTP.'article/'.$value['primary_id'].'/" class="o_8">
							<div class="card_article_contents">
								<img src="'.HTTP.'assets/img/article_ogp/'.$value['primary_id'].'.png" decoding="async" loading="lazy">
								<h1>'.$title.'</h1>
								<div class="card_article_contents_summary">'.$summary_contents.'</div>
								<div class="card_article_contents_time">'.$local_japanese_time.'</div>
							</div>
						</a>
					</article>
				</li>';
			} // foreach
			if($article_list_li) {
				// 合体
				$article_list_html .= 
				'<div class="category_article_list">
					<h2>'.$name.'</h2>
					<ul>
						'.$article_list_li.'
					</ul>
				</div>';
			}
		return $article_list_html;
	}
	//-----------------------------------
	//さらに前の記事を見るHTML生成
	//-----------------------------------
	public static function next_article_html_create($next_article_check, $paging_num, $newarticle = '') {
		$back_html = '';
		$next_article_html = '';
/*
		pre_var_dump($paging_num);
		pre_var_dump($newarticle);
*/
		// トップから1進んだurlの場合
		if($paging_num == 2) {
			if($newarticle == 'newarticle') {$root_dir = 'newarticle';}
			$back_html = '
				<div class="back">
					<a href="'.HTTP.$root_dir.'/">
						新しい記事に戻る
					</a>
				</div>';
		}
			// トップページの場合
			else if($paging_num == 1) {

			}
				// それ以外
				else {
				$back_paging_num = $paging_num-2;
					$back_html = '
						<div class="back">
							<a href="'.HTTP.'newarticle/'.$back_paging_num.'/">
								新しい記事に戻る
							</a>
						</div>';
				}
		// チェック
		if($next_article_check) {
			$next_article_html = '
				<div class="next">
					<a href="'.HTTP.'newarticle/'.$paging_num.'/">
						さらに前の記事を見る
					</a>
				</div>';
		}
		$article_new_back_list_html = '
			<div class="article_new_back_list">
				'.$back_html.'
				'.$next_article_html.'
			</div>';
		return $article_new_back_list_html;
	}
	//--------------------------------------------------
	// 画像をwebpに差し替える(既存で存在していたら)
	//--------------------------------------------------
	public static function image_to_webp_replace($article_contents) {
//		var_dump($article_contents);
//		preg_match_all();
		preg_match_all('/<img(.*?)>/', $article_contents, $img_array_1);
		preg_match_all('/src="(.*?)"/', $article_contents, $img_array_2);
		// 下準備
		foreach($img_array_1[0] as $key => $value) {
			$img_array_1_oni = preg_replace('/\//', '\/', $value);
//			pre_var_dump($img_array_1_oni);
			$img_html_array[] = $img_array_1_oni;
		}
//			pre_var_dump($img_html_array);

		// webp変換
		foreach($img_array_2[1] as $key => $value) {
			$result = strstr($value, 'app');
//			pre_var_dump($value);
//			pre_var_dump(PATH.$result);
			// パスインフォ
			$file_info = pathinfo(PATH.$result);
			preg_match('/\/[0-9]{4}\/[0-9]{2}\//', $result, $result_array);
//		pre_var_dump($result_array[0]);
			// ファイル名の頭にwebp_追加
			$webp_path = preg_replace('/(\/[0-9]{4}\/[0-9]{2}\/)/', '\\1webp_', $result);
			// エラー回避 image:"(画像URL)" など書かれた場合
			if(empty($file_info['extension'])) {
				$file_info['extension'] = '';
			}
			// 拡張子をwebpに変換
			$webp_path = preg_replace('/\.'.$file_info['extension'].'$/i', '.webp', $webp_path);
//			pre_var_dump($webp_path);
			// パスがあった場合
			if($webp_path) {
				$webp_exists_path = PATH.$webp_path;
				// webp存在確認
				if(file_exists($webp_exists_path)) {
					// 画像サイズ取得
					$image_path_filesize = getimagesize($webp_exists_path);
					// webp変換
					$article_contents = preg_replace('/'.$img_html_array[$key].'/', '<picture> <source type="image/webp" srcset="'.HTTP.$webp_path.'"> <img src="'.HTTP.$result.'" width="'.$image_path_filesize[0].'" height="'.$image_path_filesize[1].'" decoding="async" loading="lazy"> </picture>', $article_contents);
				}
			}
		} // foreach($img_array_2[1] as $key => $value) {
		return $article_contents;
	}

	//------------------------
	// サムネイルHTML生成
	//------------------------
	public static function thumbnail_html_create($markdown) {
		// ()削除
		$patterns = array (
			'/"\(/s',
			'/\)"/s',
		);
		$markdown = preg_replace($patterns , '"', $markdown);
		// サムネイル変換
		$markdown = preg_match('/\[thumbnail:(.*?)image:"(.*?)"(.*?)]/s' , $markdown, $markdown_array);
		if($markdown_array) {
			$thumbnail_html = 
				'<div class="thumbnail">
					<img src="'.$markdown_array[2].'">
				</div>';
			// 画像をwebpに差し替える(既存で存在していたら)
			$thumbnail_html = model_article_html::image_to_webp_replace($thumbnail_html);
		}
		else {
			$thumbnail_html = '';
		}
		return  $thumbnail_html;
	}





















}