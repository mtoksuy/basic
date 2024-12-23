<?php
$get = basic::get_security();
$post = basic::post_security();
if (empty($get['file'])) {
	$get['file'] = '';
}

if ($_SESSION['basic_id']) {
	if ($get['file']) {
		$file_word = $get['file'];
		$file_path = PATH . 'app/theme/' . $site_data_array['theme'] . '/view/common/' . $get['file'];
	}
	// デフォルト設定
	else {
		$file_word = 'content.php';
		$file_path = PATH . 'app/theme/' . $site_data_array['theme'] . '/view/root/content.php';
	}

	// ロールアクセス制御コンテンツ判断強制アドミン移動
	model_login_admin_basis::role_access_control_admin_move();

	if ($post) {
		// ファイルの内容を保存
		model_login_admin_template_basis::file_content_save($post, $file_path);
		// 静的化+圧縮化する際のリストarray取得
		$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('root');
		// multi版：静的化+圧縮化
		basic::multi_html_gzip_create($html_gzip_create_list_array);
	}
	// サイト情報取得
	$site_data_array = basic::site_data_get();
	// 選択しているテーマのcommon配下のファイルリストarray取得
	$view_common_list_array = model_login_admin_rootedit_basis::view_common_list_array_get($site_data_array);
	// common配下のファイルリストHTML生成
	$view_common_list_html = model_login_admin_rootedit_html::view_common_list_html_create($view_common_list_array, $file_word);
	// ファイルの内容を取得
	$file_content = model_login_admin_rootedit_basis::file_content_get($file_path);

	// テンプレート読み込み
	require_once(PATH . 'app/theme/admin/view/' . $controller_query . '/template.php');
} else {
	// クッキーログイン
	model_login_basis::cookie_login();
}
