<?php
class model_setup_basis {
	//--------------
	//記事データ取得
	//--------------
	public static function article_get($method) {
		$article_res = model_db::query("
			SELECT * 
			FROM article 
			WHERE primary_id = " . $method . "
			AND del = 0
			LIMIT 0, 1");
		return $article_res;
	}
}
