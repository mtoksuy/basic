<?php 

	if($_SESSION) {
		// サイト情報取得
		$site_data_array = model_login_admin_basis::site_data_get();
		
		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			header('location: '.HTTP.'');
			exit;
		}