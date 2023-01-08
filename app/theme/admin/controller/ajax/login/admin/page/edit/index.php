<?php
/*
* Ajax 下書き コントローラー
* 
* 
* 
*/
header("Content-Type: application/json; charset=UTF-8");

// ポストの中身をエンティティ化する
$post = basic::post_security();
// ログインしている場合
if($_SESSION) {
	$basic_id = $_SESSION['basic_id'];
	// 本人確認
	if($post['basic_id'] == $basic_id) {
		// 編集保存
		$query = model_login_admin_page_basis::markdown_page_edit_save($post);
		// 静的化+圧縮化する際のリストarray取得
		$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('page', $post['permalink']);
		// multi版：静的化+圧縮化
		basic::multi_html_gzip_create($html_gzip_create_list_array);
	}
}
// データセット
$json_data = array(
	'post'           => $post,
	'query'         => $query,
	'primary_id' => $query['page_id'],
	'basic_id'     => $query['basic_id'],
	'page_url'     => $query['page_url'],
);
echo json_encode($json_data);

?>