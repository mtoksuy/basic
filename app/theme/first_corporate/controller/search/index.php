<?php 
	// ゲットの中身をエンティティ化する
	$get = basic::get_security();
	// 記事検索res取得
	$article_search_res = model_search_basis::article_search_res_get($get);
	// resの中身カウント
	$res_count = model_search_basis::res_count_get($article_search_res);
	// 記事データHTML生成
	$article_list_html = model_article_html::article_list_html_create($article_search_res);

	// テンプレート読み込み
	require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/'.$controller_query.'/template.php');