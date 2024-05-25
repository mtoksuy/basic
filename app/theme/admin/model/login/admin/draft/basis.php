<?php
class model_login_admin_draft_basis {
	//-------------------------
	//下書きの記事データ取得
	//-------------------------
	public static function article_draft_get($method) {
		$article_draft_res = model_db::query("
			SELECT * 
			FROM article_draft
			WHERE primary_id = " . $method . "
			AND del = 0
			LIMIT 0, 1");
		return $article_draft_res;
	}
	//-----------------
	// 下書き記事削除
	//------------------
	public static function article_draft_delete($draft_id) {
		model_db::query("
			UPDATE article_draft 
			SET del = 1
			WHERE primary_id = " . (int)$draft_id . "");
	}
	//---------------------------------
	//下書きの記事リストデータ取得
	//---------------------------------
	public static function article_draft_list_get() {
		/*
		管理者：admin
		編集者：editor
		投稿者：postor
		*/
		switch ($_SESSION['role']) {
				// 管理者
			case 'admin':
				$article_draft_list_res = model_db::query("
					SELECT * 
					FROM article_draft
					WHERE del = 0
					ORDER BY primary_id DESC
					LIMIT 0, 100");
				break;
				// 編集者
			case 'editor':
				$article_draft_list_res = model_db::query("
					SELECT * 
					FROM article_draft
					WHERE del = 0
					ORDER BY primary_id DESC
					LIMIT 0, 100");
				break;
				// 投稿者
			case 'postor':
				$article_draft_list_res = model_db::query("
					SELECT * 
					FROM article_draft
					WHERE del = 0
					AND basic_id = '" . $_SESSION['basic_id'] . "'
					ORDER BY primary_id DESC
					LIMIT 0, 100");
				break;
		}
		return $article_draft_list_res;
	}
}
