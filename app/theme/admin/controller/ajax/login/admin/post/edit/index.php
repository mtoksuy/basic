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
	if(!empty($post)) {
		// 本人確認
		if($post['basic_id'] == $basic_id) {
			// ハッシュタグリスト json_encodeで取得
			$hashtag_selection_json = model_login_admin_post_basis::hashtag_selection_list_json_encode_get($post['content']);
			// 編集保存
			$query = model_login_admin_post_basis::markdown_post_edit_save($post, $hashtag_selection_json);
			// 静的化+圧縮化する際のリストarray取得
			$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('article', (int)$post['article_id']);
			// multi版：静的化+圧縮化
			basic::multi_html_gzip_create($html_gzip_create_list_array);
		}
	} // if(!empty($post)) {
}
// データセット
$json_data = array(
	'primary_id' => $query['primary_id'],
	'basic_id' => $query['basic_id'],
);
echo json_encode($json_data);

?>