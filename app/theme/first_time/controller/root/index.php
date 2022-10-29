<?php 
	// ルートのHTML生成
//	$setup_data_array = model_setup_html::setup_html_create();

	// テンプレート読み込み
	require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/'.$controller_query.'/template.php');