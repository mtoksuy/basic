<?php 
	$contact_unread_count_html = '';
	// サイト情報取得
	$site_data_array = basic::site_data_get();
	$now = $plugin_name;

	// 公開されている記事数取得
	$article_res = model_plugin_sample_basis::public_article_count_get();
	// テンプレート読み込み
	require_once(PATH.'app/plugin/'.$plugin_name.'/view/'.$controller_query.'/template.php');
