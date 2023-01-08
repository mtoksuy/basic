<?php
	if($_SESSION['basic_id']) {
		$now = 'coreupdate';
		// ゲットの中身をエンティティ化する
		$get = basic::get_security();
		if($get['coreupdate'] == 'true') {
			// Basicを最新のバージョンにする
			model_login_admin_coreupdate_basis::basic_coreupdate();
		}
		// コアアップデートHTML生成
		$coreupdate_html = model_login_admin_coreupdate_html::coreupdate_html_create();
		$content_html = $coreupdate_html;

			// テンプレート読み込み
			require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
