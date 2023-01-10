<?php 
	// 全記事リスト取得
	$article_res = model_sitemap_basis::article_list_get();
	// サイトマップリストHTML生成
	$article_list_li = model_sitemap_html::sitemap_article_list_html_create($article_res);
	// 全ページリスト取得
	$page_res = model_sitemap_basis::page_list_get();
	// サイトマップリストHTML生成
	$page_list_li = model_sitemap_html::sitemap_article_list_html_create($page_res);

	// テンプレート読み込み
	require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/'.$controller_query.'/template.php');