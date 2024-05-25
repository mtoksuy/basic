<?php
// ローカル開発
if ($_SERVER['HTTP_HOST'] == 'localhost') {
	$database_name = 'develop_basic';
	$host_name     = 'localhost';
	$user_name     = 'root';
	$password      = 'root';
}
// 本番
else {
	$database_name = 'develop_basic';
	$host_name     = 'localhost';
	$user_name     = 'root';
	$password      = 'root';
}
$db_config_array = array(
	'default' => array(
		'type'         => 'mysql',        //
		'profiling'    => 'true',         // 
		'table_prefix' => '',             // 
		'charset'      => 'utf8',         // 
		'connection'   => array(          // 
			'database'   => $database_name, // 
			'hostname'   => $host_name,     // 
			'username'   => $user_name,     // 
			'password'   => $password,      //
		),
		'charset' => 'utf8mb4', // charaset をutf8mb4に指定して追加
	),
);
