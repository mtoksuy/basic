<?php
$contact_unread_count_html = '';

// ロールアクセス制御コンテンツ判断強制アドミン移動
model_login_admin_basis::role_access_control_admin_move(array('admin'));

if ($_SESSION['basic_id']) {
	$now = 'import';
	// ポストの中身をエンティティ化する
	$post = basic::post_security();
	// ゲットの中身をエンティティ化する
	$get = basic::get_security();
	// ユーザー情報取得
	$user_data_array = basic::user_data_get($_SESSION['primary_id']);
	// インポート詳細 step2
	if ($get) {
		if ($post) {
			$xml_string = '';
			$name_array = [];
			if (isset($_FILES['import_file']) && preg_match('/xml/', $_FILES['import_file']['name'], $name_array) && $name_array[0]) {
				$xml_string = file_get_contents($_FILES['import_file']['tmp_name']);
				// インポートを走らせる
				model_login_admin_import_basis::import_run($xml_string, $get['import']);
			}
		}
		// インポート詳細設定HTML生成
		$content_html = model_login_admin_import_html::import_detail_html_create($user_data_array, $get);
	}
	// 通常時
	else {
		// インポート設定HTML生成
		$content_html = model_login_admin_import_html::import_html_create($user_data_array);
	}

	// テンプレート読み込み
	require_once(PATH . 'app/theme/admin/view/' . $controller_query . '/template.php');
} else {
	// クッキーログイン
	model_login_basis::cookie_login();
}
