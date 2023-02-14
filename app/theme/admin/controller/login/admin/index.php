<?php 
	$contact_unread_count_html = '';

	if($_SESSION) {
		// サイト情報取得
		$site_data_array = basic::site_data_get();

		$now = '';

		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			header('location: '.HTTP.'');
			exit;
		}