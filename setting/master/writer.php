<?php 
	$method = preg_replace('/writer\//', '', $controller_query);
	// ライターデータ取得
	$writer_res = model_writer_basis::writer_get($method);
	// ライター情報のHTML生成
	$writer_info_html = model_writer_html::writer_info_html_create($writer_res);

	// ライター記事データ取得
	$writer_article_res = model_writer_basis::writer_article_get($method);
	// ライター記事リストHTML生成
	$writer_article_list_html = model_article_html::article_list_html_create($writer_article_res);

	// writerタイトル挿入
	$page_data_array['title'] = $writer_res[0]['name'];

	// テンプレート読み込み
	require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/writer/template.php');