<?php
/*
* Ajax 下書き コントローラー
* 
* 
* 
*/
header("Content-Type: application/json; charset=UTF-8");

// ポストの中身をエンティティ化する
$post = library_security_basis::post_security();

// ログインしている場合
if($_SESSION) {
	$basic_id = $_SESSION['basic_id'];
	// 下書き保存
	$query = model_login_markdown_post_basis::markdown_post_draft_save($post);
}
// データセット
$json_data = array(
	'primary_id' => $query['primary_id'],
	'basic_id' => $query['basic_id'],
);
echo json_encode($json_data);

?>