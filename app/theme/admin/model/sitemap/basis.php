<?php 
class model_sitemap_basis {
	//--------------------
	// 全記事リスト取得
	//--------------------
	public static function article_all_list_get() {
		$article_all_list_res = model_db::query("
			SELECT *
			FROM article
			WHERE del = 0
			ORDER BY primary_id DESC");
		return $article_all_list_res;
	}
	//------------------
	// pageリスト取得
	//------------------
	public static function page_all_list_get() {
		$page_all_list_res = model_db::query("
			SELECT *
			FROM page
			WHERE del = 0
			ORDER BY primary_id ASC");
		return $page_all_list_res;
	}
	//----------------------------------------
	//削除していない記事データの数を取得
	//----------------------------------------
	public static function article_count_res_get() {
		$article_count_res = model_db::query("
			SELECT COUNT(*)
			FROM article 
			WHERE del = 0");
		return $article_count_res;
	}
}
