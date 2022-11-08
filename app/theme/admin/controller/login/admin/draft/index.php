<?php
	if($_SESSION['basic_id']) {
		$now = 'draft';
		// 下書き一覧取得
		$article_draft_list_res = model_login_admin_draft_basis::article_draft_list_get();
		// 下書きHTML生成
		$content_html = model_login_admin_draft_html::article_draft_list_html_create($article_draft_list_res);

		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>