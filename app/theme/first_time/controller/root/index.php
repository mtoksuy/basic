<?php 
	$method = 0;
	// ページング1回でn回表示設定
	 $article_view_num = $site_data_array['article_view_num'];
	// さらに前の記事を見るデータ取得
	list($next_article_list_res, $paging_num) = model_article_basis::next_article_list_res_get($method, $article_view_num);
	// オールカテゴリー別記事データHTML生成
	$article_list_html = model_article_html::article_list_html_create($next_article_list_res);
	// 次のさらに前の記事を見る記事リストがあるかチェック
	$next_article_check = model_article_basis::next_article_check($method, $article_view_num);
	// さらに前の記事を見るHTML生成
	$next_article_html = model_article_html::next_article_html_create($next_article_check, $paging_num);

/*
	// 記事リスト取得
	$article_list_res = model_sample_basis::article_list_get(10,1);
	// 記事リストHTML生成
	$article_list_html = model_sample_html::article_list_html_create($article_list_res);
	// さらに前の記事を見るHTML生成
	$next_article_html = model_article_html::next_article_html_create($next_article_check, $paging_num);
*/

	// テンプレート読み込み
	require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/'.$controller_query.'/template.php');