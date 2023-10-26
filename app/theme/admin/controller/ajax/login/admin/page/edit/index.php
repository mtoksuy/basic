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
	// 本人確認またはロール、admi,editor確認
	if($_SESSION['basic_id'] == $post['basic_id'] || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'editor') {
		// 特定の文字列が2連続である場合1つにする
		$post['permalink'] = basic::replace_recursive($post['permalink'], '/');
		// 文末の/を削除
		$post['permalink'] = rtrim($post['permalink'], '/');
		// 先頭の/を削除
		$post['permalink'] = ltrim($post['permalink'], '/');
		// 編集保存
		$query = model_login_admin_page_basis::markdown_page_edit_save($post);
		// 静的化+圧縮化する際のリストarray取得
		$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('page', $post['permalink']);
		// multi版：静的化+圧縮化
		basic::multi_html_gzip_create($html_gzip_create_list_array);
		// 全記事リスト取得
		$article_all_list_res = model_sitemap_basis::article_all_list_get();
		// pageリスト取得
		$page_all_list_res = model_sitemap_basis::page_all_list_get();
		// sitemap.xml生成
		$sitemap_xml = model_sitemap_html::sitemap_xml_create($article_all_list_res, $page_all_list_res);
	}
}

if($query) {
	// データセット
	$json_data = array(
		'post'           => $post,
		'query'         => $query,
		'primary_id' => $query['page_id'],
		'basic_id'     => $query['basic_id'],
		'page_url'     => $query['page_url'],
	);
}
else {
	// データセット
	$json_data = array(
		'post'           => $post,
		'query'         => $query,
		'primary_id' => '',
		'basic_id'     => '',
		'page_url'     => '',
	);
}

echo json_encode($json_data);

?>