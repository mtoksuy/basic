<?php
class model_login_admin_basis {
	//--------------------------------------------------------
	// ロールアクセス制御コンテンツ判断強制アドミン移動
	//--------------------------------------------------------
	public static function role_access_control_admin_move($role_data_array = array('admin', 'editor')) {
		$is_access = false;
		foreach ($role_data_array as $key => $value) {
			if ($_SESSION['role'] == $value) {
				$is_access = true;
			}
		} // foreach($role_data_array as $key => $value) {
		// 権限がなかったらアドミンへ移動
		if (!$is_access) {
			// 移動
			header('Location: ' . HTTP . 'login/admin/');
			exit;
		}
		/*
草案ソースコード
固定で良くない
		// ロールアクセス制御
		switch($_SESSION['role']) {
		// 管理者
		case 'admin':

		break;
		// 編集者
		case 'editor':
			// 移動
			header('Location: '.HTTP.'login/admin/');
		break;
		// 投稿者
		case 'postor':
			// 移動
			header('Location: '.HTTP.'login/admin/');
		break;
		}
*/
	}
}
