<?php
$controller_query_explode = explode('/', $controller_query);
// 定義されていない変数を空定義
if (empty($controller_query_explode[2])) {
	$controller_query_explode[2] = '';
}
if ($controller_query_explode[2] == '') {
	$method = 0;
} else if ((int)$controller_query_explode[2] == 1) {
	$method = 1;
} else {
	$method = (int)$controller_query_explode[2];
}

// ライターbasic_id名取得
$writer_basic_id = $controller_query_explode[1];

// ライターデータ取得
$writer_res = model_writer_basis::writer_get($writer_basic_id);
// ライター情報のHTML生成
$writer_info_html = model_writer_html::writer_info_html_create($writer_res);
// writerタイトル挿入
$page_data_array['title'] = $writer_res[0]['name'] . '：' . ($method + 1) . 'ページ目';

// ページング1回でn回表示設定
$article_view_num = $site_data_array['article_view_num'];
// さらに前の記事を見るデータ取得
list($next_article_list_res, $paging_num) = model_writer_basis::next_article_list_res_get($writer_basic_id, $method, $article_view_num);
// ページング機能向け ライター記事データがない場合
if (!$next_article_list_res && $method != 0) {
	header("HTTP/1.1 404 Not Found");
	$controller_query = 'error';
	require_once(PATH . 'app/theme/admin/controller/' . $controller_query . '/index.php');
	exit;
}
// ライター記事リストHTML生成
$writer_article_list_html = model_article_html::article_list_html_create($next_article_list_res);
// 次のさらに前の記事を見る記事リストがあるかチェック
$next_article_check = model_writer_basis::next_article_check($writer_basic_id, $method, $article_view_num);
// さらに前の記事を見るHTML生成
$next_article_html = model_writer_html::next_article_html_create($writer_basic_id, $next_article_check, $paging_num);

// テンプレート読み込み
require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/view/writer/template.php');
