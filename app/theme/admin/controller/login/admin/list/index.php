<?php
	$contact_unread_count_html = '';

	if($_SESSION['basic_id']) {
		$now = 'list';
		// 記事一覧取得
		$article_list_res = model_login_admin_list_basis::article_list_get();
		// 投稿一覧HTML生成
		$content_html = model_login_admin_list_html::article_list_html_create($article_list_res);

		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>