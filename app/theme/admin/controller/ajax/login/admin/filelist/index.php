<?php
/*
* Ajax ファイルモーダル コントローラー
* 
* 
* 
*/
header("Content-Type: application/json; charset=UTF-8");

ini_set('display_errors', 0);
// ログインしている場合
if ($_SESSION) {
	// ポストの中身をエンティティ化する
	$post = basic::post_security();
	// ゲットの中身をエンティティ化する
	//	$get = basic::get_security();
	if ($post['is_type'] == 'next') {
		// ファイルes取得
		$file_res = model_login_admin_filelist_basis::file_res_get($post);
		// ファイルnext_prev_res取得
		$file_next_prev_res = model_login_admin_filelist_basis::file_next_prev_res_get($post);
		// ファイルモーダルdata_array取得
		$file_modal_data_array = model_login_admin_filelist_basis::file_modal_data_array_get($file_res, $file_next_prev_res);
	} else if ($post['is_type'] == 'prev') {
	} else {
		// ファイルes取得
		$file_res = model_login_admin_filelist_basis::file_res_get($post);
		// ファイルnext_prev_res取得
		$file_next_prev_res = model_login_admin_filelist_basis::file_next_prev_res_get($post);
		// ファイルモーダルHTML生成
		$content_html = model_login_admin_filelist_html::file_modal_html_create($file_res, $file_next_prev_res);
	}
}
// データセット
$json_data = array(
	'file_modal_html'           => $content_html,
	'file_modal_data_array' => $file_modal_data_array,
	'next_file_id'                  => $file_next_prev_res['next']['primary_id'],
	'prev_file_id'                  => $file_next_prev_res['prev']['primary_id'],
	'post'                              => $post,
);
echo json_encode($json_data);
