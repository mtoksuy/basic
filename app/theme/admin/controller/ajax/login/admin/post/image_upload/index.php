<?php
/*
* Ajax ブログ機能：画像アップロード コントローラー
* 画像だけではなく全てのファイル対応
* 
* 
*/
header("Content-Type: application/json; charset=UTF-8");

$flle_array = '';
$image_http = '';

// ポストの中身をエンティティ化する
$post = basic::post_security();
// ログインしている場合
if($_SESSION) {
	// ファイルが送られてきた場合
	if($_FILES) {
		$files = $_FILES;
		// file_array生成
		$flle_array = model_login_admin_fileupload_basis::single_flle_array_create($files);
		// 画像アップロード&DB登録
		$flle_array = model_login_admin_fileupload_basis::file_upload($flle_array);
		// マスターディレクトリパス
		$file_upload_directry_http = HTTP.'app/assets/fileupload';
		$now_year    = date('Y');
		$now_month = date('m');
		$image_http = $file_upload_directry_http.'/'.$now_year.'/'.$now_month.'/'.$flle_array[0]['full_name'];
	}
}
// データセット
$json_data = array(
	'FILES' => $_FILES,
	'name' => $_FILES['uploadFile']['name'],
	'flle_array' => $flle_array,
	'image_http' => $image_http,
);
echo json_encode($json_data);

?>