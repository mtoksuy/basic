<?php
class model_writer_basis {
	//----------------------
	//ライターデータ取得
	//----------------------
	public static function writer_get($method) {
		$writer_res = model_db::query("
			SELECT * 
			FROM user
			WHERE basic_id = '".$method."'
			AND del = 0
			LIMIT 0, 1");
		return $writer_res;
	}
	//--------------------------
	//ライター記事データ取得
	//--------------------------
	public static function writer_article_get($method) {
		$writer_article_res = model_db::query("
			SELECT * 
			FROM article 
			WHERE basic_id = '".$method."'
			AND del = 0
			ORDER BY primary_id DESC");
		return $writer_article_res;
	}


}