<?php 
class model_article_html {
	//-----------------------
	//記事リストHTML生成
	//-----------------------
	public static function article_list_html_create($article_list_res) {
		foreach($article_list_res as $key => $value) {
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
			// 記事タイトル取得
			$article_primary_id  = $value["primary_id"];
			// 記事タイトル取得
			$article_title  = $value["title"];
			// 記事HTMLテキスト取得
			$article_contents     = htmlspecialchars_decode($value["content"]);
			// amatemのユーザーデータ取得
//			$amatem_id_data_array = basic::amatem_user_data_get($amatem_id);
			// マークダウンをhtmlに変換
			$article_contents = model_login_admin_post_basis::markdown_html_conversion($article_contents, $amatem_id_data_array);

			// 記事HTML
			$article_html = ('
				<article>
					<h1>'.$article_title.'</h1>
					'.$article_contents.'
				</article>');

			// article_data_array
			$article_data_array = array(
				'article_primary_id'      => (int)$article_primary_id,
				'article_html'            => $article_html, 
				'article_title'           => $title, 
				'article_contents'        => $article_contents,
			);
		}
		return $article_data_array;
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
	public static function next_article_html_create($next_article_check, $paging_num) {
//		var_dump($paging_num);
		// トップから1進んだurlの場合
		if($paging_num == 2) {
			$back_html = '
				<div class="back">
					<a href="'.HTTP.'">
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














}