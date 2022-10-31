<?php 
class model_sample_html {
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
	static function article_html_create($article_res) {
		// 記事HTML生成
		foreach($article_res as $key => $value) {
			// 記事タイトル取得
			$article_primary_id  = $value["primary_id"];
			// 記事タイトル取得
			$article_title  = $value["title"];
			// 記事内容取得
			$article_contents  = $value["content"];
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
}