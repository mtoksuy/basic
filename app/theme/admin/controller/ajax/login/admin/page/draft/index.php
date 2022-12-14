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
	// 下書き保存
	$query = model_login_admin_page_basis::markdown_page_draft_save($post);
}
// データセット
$json_data = array(
	'post'                     => $post,
	'query'                   => $query,
	'primary_id'           => $query['primary_id'],
	'basic_id'               => $query['basic_id'],
	'permalink'            => $query['permalink'],
	'permalink_check' => $permalink_check,
);
echo json_encode($json_data);

?>