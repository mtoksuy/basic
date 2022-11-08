<?php
	if($_SESSION['basic_id']) {
		$now = 'fileupload';

		// ファイルアップロードHTML生成
		$content_html = model_login_admin_fileupload_html::fileupload_html_create();

		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>