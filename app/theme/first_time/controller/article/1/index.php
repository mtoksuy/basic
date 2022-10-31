<?php 
	$method = preg_replace('/article\//', '', $controller_query);
	var_dump($method);

	// テンプレート読み込み
//	require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/article/template.php');