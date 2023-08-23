<?php

	$contact_unread_count_html = '';

	// ロールアクセス制御コンテンツ判断強制アドミン移動
	model_login_admin_basis::role_access_control_admin_move();

	if($_SESSION['basic_id']) {
		$now = 'pagelist';
		// ページ一覧取得
		$pagelist_res = model_login_admin_pagelist_basis::pagelist_get();
		// ページ一覧HTML生成
		$content_html = model_login_admin_pagelist_html::pagelist_html_create($pagelist_res);
		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>