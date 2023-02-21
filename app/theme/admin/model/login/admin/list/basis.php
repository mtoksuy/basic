<?php 
class model_login_admin_list_basis {
	//-------------
	//投稿一覧取得
	//-------------
	public static function article_list_get() {
		$article_list_res = model_db::query("
			SELECT * 
			FROM article
			WHERE del = 0
			AND basic_id = '".$_SESSION['basic_id']."'
			ORDER BY primary_id DESC
			LIMIT 0, 1000
		");
		return $article_list_res;
	}

}
