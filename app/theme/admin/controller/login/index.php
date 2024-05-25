<?php
if ($_SESSION) {
	$now = '';
	// 移動
	header('Location: ' . HTTP . 'login/admin/');
	exit;
}
if ($_POST) {
	// ポストの中身をエンティティ化する
	$post = basic::post_security();
	//		pre_var_dump($post);
	// ログイン
	$lohin_message = model_login_basis::login($post);
	//		pre_var_dump($lohin_message);
}
if (empty($post)) {
	$post['user_login'] = '';
	$lohin_message = '';
}
// ログインのHTML生成
//	$setup_data_array = model_setup_html::login_html_create();

// テンプレート読み込み
require_once(PATH . 'app/theme/admin/view/' . $controller_query . '/template.php');
