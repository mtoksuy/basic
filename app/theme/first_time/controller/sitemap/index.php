<?php 

pre_var_dump($controller_query);


	// テンプレート読み込み
	require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/'.$controller_query.'/template.php');