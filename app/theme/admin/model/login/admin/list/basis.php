<?php 
class model_login_admin_list_basis {
	//-------------
	//投稿一覧取得
	//-------------
	public static function article_list_get() {
		/*
		管理者：admin
		編集者：editor
		投稿者：postor
		*/
		// ロールアクセス制御
		switch($_SESSION['role']) {
			// 管理者
			case 'admin':
				$article_list_res = model_db::query("
					SELECT * 
					FROM article
					WHERE del = 0
					ORDER BY primary_id DESC
					LIMIT 0, 1000
				");
			break;
			// 編集者
			case 'editor':
				$article_list_res = model_db::query("
					SELECT * 
					FROM article
					WHERE del = 0
					ORDER BY primary_id DESC
					LIMIT 0, 1000
				");
			break;
			// 投稿者
			case 'postor':
				$article_list_res = model_db::query("
					SELECT * 
					FROM article
					WHERE del = 0
					AND basic_id = '".$_SESSION['basic_id']."'
					ORDER BY primary_id DESC
					LIMIT 0, 1000
				");
			break;
		}
		return $article_list_res;
	}

}
