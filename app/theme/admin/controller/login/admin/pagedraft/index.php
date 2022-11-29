<?php
	if($_SESSION['basic_id']) {
		$now = 'pagedraft';
		// 下書き一覧取得
		$page_draft_list_res = model_login_admin_pagedraft_basis::page_draft_list_get();
		// 下書きHTML生成
		$content_html = model_login_admin_pagedraft_html::page_draft_list_html_create($page_draft_list_res);

		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>