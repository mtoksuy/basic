<?php 

	$contact_unread_count_html  = '';

	// ロールアクセス制御コンテンツ判断強制アドミン移動
	model_login_admin_basis::role_access_control_admin_move();

	// エンティティ
	$get = basic::get_security();

	if($_SESSION['basic_id']) {
		$now = 'plugin';
		$content_html = '
			<h1>プラグイン追加 実装中</h1>
			<p>Basic version .0.9.6</p>
			<p style="border-bottom:1px solid var(--theme-border-color2);"> </p>';

		if($get) {

		}
		else {
			// テーマリストarray取得
			$theme_list_array = model_login_admin_themeswitching_basis::theme_list_array_get();
			// テーマリストhtml生成
			$theme_list_html = model_login_admin_themeswitching_html::theme_list_html_create($theme_list_array);
//			$content_html = $theme_list_html;
		}
		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>