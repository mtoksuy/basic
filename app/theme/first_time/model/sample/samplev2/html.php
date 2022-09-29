<?php 
class model_sample_samplev2_html {
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