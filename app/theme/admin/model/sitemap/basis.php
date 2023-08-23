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
			ORDER BY primary_id DESC
			LIMIT 0, 1000
		");
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
	//-------------------
	//全記事リスト取得
	//-------------------
	public static function article_list_get() {
		$article_array = array();
		$article_res = model_db::query("
			SELECT *
			FROM article
			WHERE del = 0
			ORDER BY primary_id DESC
			LIMIT 0, 1000
		");
		return $article_res;
	}
	//------------------------
	//カテゴリーリスト取得
	//------------------------
	public static function category_list_get() {
		$category_res = model_db::query("
			SELECT *
			FROM category
			WHERE del = 0
			ORDER BY layer DESC");
		return $category_res;
	}

	//------------------------
	//プロダクトリスト取得
	//------------------------
	public static function products_list_get() {
		$products_res = model_db::query("
			SELECT *
			FROM products
			WHERE del = 0
			ORDER BY primary_id DESC");
		return $products_res;
	}
	//-----------------------------
	//プロダクトASINリスト取得
	//-----------------------------
	public static function products_ASIN_list_get() {
		$products_res = model_db::query("
			SELECT primary_id, ASIN
			FROM products
			WHERE del = 0
			ORDER BY primary_id DESC");
		return $products_res;
	}
	//--------------------------
	//カテゴリデータarray取得
	//--------------------------
	public static function category_res_get() {
		$category_res = model_db::query("
			SELECT * 
			FROM category 
			WHERE del = 0
			ORDER BY layer ASC");
		return $category_res;
	}
	//--------------------------
	//プロダクトデータarray取得
	//--------------------------
	public static function products_res_get($name) {
		$products_res = model_db::query("
			SELECT * 
			FROM products 
			WHERE del = 0
			AND ContextFreeName = '".$name."'");
		return $products_res;
	}
	//----------------------------------------------
	//削除していないプロダクトデータの数を取得
	//----------------------------------------------
	public static function products_count_res_get() {
		$products_count_res = model_db::query("
			SELECT COUNT(*)
			FROM products 
			WHERE del = 0");
		return $products_count_res;
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
	//----------------------
	// 全ページリスト取得
	//----------------------
	public static function page_list_get() {
		$page_res = array();
		$page_res = model_db::query("
			SELECT *
			FROM page
			WHERE del = 0
			AND draft = 0
			ORDER BY primary_id DESC");
		return $page_res;
	}

















}
