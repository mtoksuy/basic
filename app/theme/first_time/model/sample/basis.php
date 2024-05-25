<?php
class model_sample_basis {
	//----------------
	//記事リスト取得
	//----------------
	public static function article_list_get($get_num = 10, $page_num = 1) {
		// 取得する場所取得
		$start_list_num = ($page_num * $get_num) - $get_num;
		$article_list_res = model_db::query("
			SELECT *
			FROM article
			WHERE del = 0
			ORDER BY primary_id DESC
			LIMIT " . $start_list_num . ", " . $get_num . "");
		return $article_list_res;
	}
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
