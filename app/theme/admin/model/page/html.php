<?php 
class model_page_html {
	//-----------------------
	//記事リストHTML生成
	//-----------------------
	public static function page_list_html_create($page_list_res) {
		foreach($page_list_res as $key => $value) {
			// 記事データ取得
			$unix_time            = strtotime($value["create_time"]);
			$local_time           = date('Y-m-d', $unix_time);
			$local_japanese_time  = date('Y年m月d日', $unix_time);
			$page_year_time    = date('Y', $unix_time);
//pre_var_dump($value);
			// 記事HTMLテキスト取得
			$page_contents     = htmlspecialchars_decode($value["content"]);
			// 改行を消す&タブ削除
			$page_contests = str_replace(array("\r\n", "\r", "\n", "\t"), '', $page_contents);
			// 本文を5680文字に丸める
			$page_contests = mb_strimwidth($page_contests, 0, 5680, '...', 'utf8');
			// HTMLタグを取り除く
			$page_contests = strip_tags($page_contests);
			// 本文を168文字に丸める
			$summary_contents = mb_strimwidth($page_contests, 0, 168, "...", 'utf8');
			// エンティティを戻す
			$title        = htmlspecialchars_decode($value["title"], ENT_NOQUOTES);
			// タイトルを82文字に丸める
			$title = mb_strimwidth($title, 0, 82, "...", 'utf8');

			 $page_list_li .=
				 '<li>
					<page>
						<a href="'.HTTP.'page/'.$value['primary_id'].'/" class="o_8">
							<div class="card_page_contents">
								<h1>'.$title.'</h1>
								<div class="card_page_contents_summary">'.$summary_contents.'</div>
								<div class="card_page_contents_time">'.$local_japanese_time.'</div>
							</div>
						</a>
					</page>
				</li>';
		}
		// 合体
		$page_list_html = 
		'<ul>
			'.$page_list_li.'
		</ul>';
		return $page_list_html;
	}
	//------------------
	//記事のHTML生成
	//-------------------
	public static function page_html_create($page_res) {
		// 記事HTML生成
		foreach($page_res as $key => $value) {
			$page_primary_id  = $value["primary_id"];
			// 記事タイトル取得
			$page_title  = $value["title"];
			// 記事HTMLテキスト取得
			$page_contents     = htmlspecialchars_decode($value["content"]);
			// マークダウンをhtmlに変換
			$page_contents = model_login_admin_post_basis::markdown_html_conversion($page_contents, $amatem_id_data_array);

			// 記事HTML
			$page_html = ('
				<article>
					<h1>'.$page_title.'</h1>
					'.$page_contents.'
				</article>');

			// page_data_array
			$page_data_array = array(
				'page_primary_id'      => (int)$page_primary_id,
				'page_html'            => $page_html, 
				'page_title'           => $title, 
				'page_contents'        => $page_contents,
			);
		}
		return $page_data_array;
	}
	//----------------------------------
	//オールカテゴリリストHTML取得
	//----------------------------------
	public static function all_category_page_list_html_create($all_page_res) {
		foreach($all_page_res as $key => $value) {
			// 記事データ取得
			$unix_time            = strtotime($value["create_time"]);
			$local_time           = date('Y-m-d', $unix_time);
			$local_japanese_time  = date('Y年m月d日', $unix_time);
			$page_year_time    = date('Y', $unix_time);
//pre_var_dump($value);
			// 記事HTMLテキスト取得
			$page_contents     = htmlspecialchars_decode($value["content"]);
			// 改行を消す&タブ削除
			$page_contests = str_replace(array("\r\n", "\r", "\n", "\t"), '', $page_contents);
			// 本文を5680文字に丸める
			$page_contests = mb_strimwidth($page_contests, 0, 5680, '...', 'utf8'); // 応急処置 2018.01.31 なぜこれで直るかはわからん 下記のpreg_replaceが重すぎた
			// 画像変換 サムネイル対策
			$page_contests = preg_replace('/\(http:\/\/(.*?)jpg\)/', '', $page_contests);
			$page_contests = preg_replace('/\(https:\/\/(.*?)jpg\)/', '', $page_contests);
	
			$page_contests = preg_replace('/\(http:\/\/(.*?)jpeg\)/', '', $page_contests);
			$page_contests = preg_replace('/\(https:\/\/(.*?)jpeg\)/', '', $page_contests);
	
			$page_contests = preg_replace('/\(http:\/\/(.*?)JPG\)/', '', $page_contests);
			$page_contests = preg_replace('/\(https:\/\/(.*?)JPG\)/', '', $page_contests);
	
			$page_contests = preg_replace('/\(http:\/\/(.*?)png\)/', '', $page_contests);
			$page_contests = preg_replace('/\(https:\/\/(.*?)png\)/', '', $page_contests);
	
			$page_contests = preg_replace('/\(http:\/\/(.*?)PNG\)/', '', $page_contests);
			$page_contests = preg_replace('/\(https:\/\/(.*?)PNG\)/', '', $page_contests);

			// HTMLタグを取り除く
//			$page_contests = preg_replace('/<("[^"]*"|\'[^\']*\'|[^\'">])*>/', '', $page_contests);
			$page_contests = strip_tags($page_contests);

			// 本文を168文字に丸める
			$summary_contents = mb_strimwidth($page_contests, 0, 168, "...", 'utf8');

			// エンティティを戻す
			$title        = htmlspecialchars_decode($value["title"], ENT_NOQUOTES);
			// タイトルを82文字に丸める
			$title = mb_strimwidth($title, 0, 82, "...", 'utf8');

			 $page_list_li .=
				 '<li>
					<page>
						<a href="'.HTTP.'page/'.$value['primary_id'].'/" class="o_8">
							<div class="card_page_contents">
								<img src="'.HTTP.'assets/img/page_ogp/'.$value['primary_id'].'.png" decoding="async" loading="lazy">
								<h1>'.$title.'</h1>
								<div class="card_page_contents_summary">'.$summary_contents.'</div>
								<div class="card_page_contents_time">'.$local_japanese_time.'</div>
							</div>
						</a>
					</page>
				</li>';
			} // foreach
			if($page_list_li) {
				// 合体
				$page_list_html .= 
				'<div class="category_page_list">
					<h2>'.$name.'</h2>
					<ul>
						'.$page_list_li.'
					</ul>
				</div>';
			}
		return $page_list_html;
	}
	//-----------------------------------
	//さらに前の記事を見るHTML生成
	//-----------------------------------
	public static function next_page_html_create($next_page_check, $paging_num) {
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
							<a href="'.HTTP.'newpage/'.$back_paging_num.'/">
								新しい記事に戻る
							</a>
						</div>';
				}

		// チェック
		if($next_page_check) {
			$next_page_html = '
				<div class="next">
					<a href="'.HTTP.'newpage/'.$paging_num.'/">
						さらに前の記事を見る
					</a>
				</div>';
		}
		$page_new_back_list_html = '
			<div class="page_new_back_list">
				'.$back_html.'
				'.$next_page_html.'
			</div>';
		return $page_new_back_list_html;
	}














}