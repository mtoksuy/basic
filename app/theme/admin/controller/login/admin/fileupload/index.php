<?php

$contact_unread_count_html = '';

/*
max_file_uploads
memory_limit
post_max_size
upload_max_filesize
*/

//phpinfo();
if ($_SESSION['basic_id']) {
	$now = 'fileupload';
	// ファイルアップロードHTML生成
	$content_html = model_login_admin_fileupload_html::fileupload_html_create();

	/*
$content_html = $content_html.'<div class="fileupload_show">
			<ul><li>
						<img class="svg" src="http://localhost/basic/app/theme/admin/assets/img/svg/basic_fileupload_file_1.svg">
						<span class="name">[working]monthly_individual_working_list_custom20221028215409 (1).xls</span>
						<span class="hidden_url">http://localhost/basic/app/assets/fileupload/2022/11/[working]monthly_individual_working_list_custom20221028215409 (1).xls</span>
						<button type="button" class="url_copy">URL をクリップボードにコピー</button>
					</li></ul>
		</div>';
*/


	// ファイルが送られてきた場合
	if ($_FILES) {
		$files = $_FILES;
		//		pre_var_dump($_FILES);
		// file_array生成
		$flle_array = model_login_admin_fileupload_basis::flle_array_create($files);
		//		pre_var_dump($flle_array);
		// 画像アップロード&DB登録
		model_login_admin_fileupload_basis::file_upload($flle_array);
	}
	// テンプレート読み込み
	require_once(PATH . 'app/theme/admin/view/' . $controller_query . '/template.php');
} else {
	// クッキーログイン
	model_login_basis::cookie_login();
}
