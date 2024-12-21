<?php
$controller_query_explode = explode('/', $controller_query);
// 定義されていない変数を空定義
if (empty($controller_query_explode[1])) {
	$controller_query_explode[1] = '';
}
if ($controller_query_explode[1] == '') {
	$method = 0;
} else if ((int)$controller_query_explode[1] == 1) {
	$method = 1;
} else {
	$method = (int)$controller_query_explode[1];
}
/*
以前の方法
	$method = preg_replace('/newarticle\//', '', $controller_query);
	if($method == 'newarticle') {
		$method = 0;
	}
		else if($method == 1) {
			$method = 1;
		}
*/
// 記事タイトル挿入
$page_data_array['title'] = '新着記事一覧：' . ($method + 1) . 'ページ目';
// ページング1回でn回表示設定
$article_view_num = $site_data_array['article_view_num'];
// さらに前の記事を見るデータ取得
list($next_article_list_res, $paging_num) = model_article_basis::next_article_list_res_get($method, $article_view_num);
// 新着記事データがない場合
if (!$next_article_list_res) {
	header("HTTP/1.1 404 Not Found");
	$controller_query = 'error';
	require_once(PATH . 'app/theme/admin/controller/' . $controller_query . '/index.php');
	exit;
}
// オールカテゴリー別記事データHTML生成
$article_list_html = model_article_html::article_list_html_create($next_article_list_res);
// 次のさらに前の記事を見る記事リストがあるかチェック
$next_article_check = model_article_basis::next_article_check($method, $article_view_num);
// さらに前の記事を見るディレクトリ生成
//	model_article_basis::next_article_diractory_create($next_article_check, $paging_num);
// さらに前の記事を見るHTML生成
$next_article_html = model_article_html::next_article_html_create($next_article_check, $paging_num, 'newarticle');
// テンプレート読み込み
require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/view/newarticle/template.php');
