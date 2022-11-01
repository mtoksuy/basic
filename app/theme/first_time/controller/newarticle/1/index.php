<?php 

	$method = preg_replace('/newarticle\//', '', $controller_query);

	//  記事データ取得
	$article_res = model_article_basis::article_get($method);
	// 記事のHTML生成
	$article_data_array = model_article_html::article_html_create($article_res);
	// 記事タイトル挿入
	$page_data_array['title'] = $article_res[0]['title'];

	// テンプレート読み込み
	require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/article/template.php');