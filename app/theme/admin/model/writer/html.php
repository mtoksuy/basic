<?php
class model_writer_html {
	//-----------------------------
	// ライター情報のHTML生成
	//-----------------------------
	public static function writer_info_html_create($writer_res) {
		$writer_info_html = '
		<div class="writer_info">
			<div class="writer_info_inner">
				<img width="128" height="128" title="' . $writer_res[0]['name'] . '" alt="' . $writer_res[0]['name'] . '" src="' . HTTP . 'app/assets/img/user/' . $writer_res[0]['icon'] . '">
				<div class="writer_info_inner_name">
					<h1>' . $writer_res[0]['name'] . '</h1>
				</div>
				<div class="writer_info_inner_summary">
					<p>' . htmlspecialchars_decode($writer_res[0]['profile']) . '</p>
				</div>
			</div>
		</div>';
		return $writer_info_html;
	}
	//---------------------------------
	// ライター記事リストHTML生成
	//---------------------------------
	public static function category_article_list_html_create($category_article_res) {
		foreach ($category_article_res as $key => $value) {
			// 記事データ取得
			$unix_time            = strtotime($value["create_time"]);
			$local_time           = date('Y-m-d', $unix_time);
			$local_japanese_time  = date('Y年m月d日', $unix_time);
			$article_year_time    = date('Y', $unix_time);
			$basic_id = $value['basic_id'];

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
						<a href="' . HTTP . 'article/' . $value['primary_id'] . '/" class="o_8">
							<div class="card_article_contents">
<!--
								<img src="' . HTTP . 'assets/img/article_ogp/' . $value['primary_id'] . '.png" decoding="async" loading="lazy">
-->
								<h1>' . $title . '</h1>
								<div class="card_article_contents_summary">' . $summary_contents . '</div>
								<div class="card_article_contents_time">' . $local_japanese_time . '</div>
							</div>
						</a>
					</article>
				</li>';
		} // foreach
		// 合体
		$article_list_html =
			'<div class="category_article_list">
			<h2>' . $name . '</h2>
			<span>' . $description . '</span>
			<ul>
				' . $article_list_li . '
			</ul>
		</div>';
		return $article_list_html;
	}
	//-----------------------------------
	//さらに前の記事を見るHTML生成
	//-----------------------------------
	public static function next_article_html_create($writer_basic_id, $next_article_check, $paging_num) {
		$back_html = '';
		$next_article_html = '';
		$root_dir = 'writer' . '/' . $writer_basic_id;

		// トップから1進んだurlの場合
		if ($paging_num == 2) {
			$back_html = '
				<div class="back">
					<a href="' . HTTP . $root_dir . '/">
						新しい記事に戻る
					</a>
				</div>';
		}
		// トップページの場合
		else if ($paging_num == 1) {
		}
		// それ以外
		else {
			$back_paging_num = $paging_num - 2;
			$back_html = '
						<div class="back">
							<a href="' . HTTP . $root_dir . '/' . $back_paging_num . '/">
								新しい記事に戻る
							</a>
						</div>';
		}
		// チェック
		if ($next_article_check) {
			$next_article_html = '
				<div class="next">
					<a href="' . HTTP . $root_dir . '/' . $paging_num . '/">
						さらに前の記事を見る
					</a>
				</div>';
		}
		$article_new_back_list_html = '
			<div class="article_new_back_list">
				' . $back_html . '
				' . $next_article_html . '
			</div>';
		return $article_new_back_list_html;
	}
}
