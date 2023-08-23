<?php
/*
* Ajax ファイルアップロード コントローラー
* 
* 
* 
*/
header("Content-Type: application/json; charset=UTF-8");

$ajax_fileupload_html = '';
$flle_array = '';

// ポストの中身をエンティティ化する
//$post = library_security_basis::post_security();
//ini_set('display_errors', 0);
// ログインしている場合
if($_SESSION) {
	// ファイルが送られてきた場合
	if($_FILES) {
		$files = $_FILES;
//		pre_var_dump($_FILES);
		// file_array生成
		$flle_array = model_login_admin_fileupload_basis::flle_array_create($files);
		// 画像アップロード&DB登録
		$flle_array = model_login_admin_fileupload_basis::file_upload($flle_array);
		// Ajax後ファイルアップロードHTML取得
		$ajax_fileupload_html = model_login_admin_fileupload_html::ajax_fileupload_html_create($flle_array);
	}
}
// データセット
$json_data = array(
	'ajax_fileupload_html' => $ajax_fileupload_html,
	'flle_array'                   => $flle_array,
);
echo json_encode($json_data);

?>