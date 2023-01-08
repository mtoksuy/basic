<?php
	if($_SESSION['basic_id']) {
		$now = 'themeswitching';
		$content_html = '
						<h1>テーマ切り替え 実装中</h1>
						<p>Basic version .0.2</p>
						<p style="border-bottom:1px solid var(--theme-border-color2);"> </p>';
		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>