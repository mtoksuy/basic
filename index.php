<?php
// core読み込み
require_once('setting/config_core.php');
require_once('setting/model_autoLoader.php'); 
// 必要な変数定義
$controller_query = '';
$theme_name      = '';

// アクセスURL 重複スラッシュを1スラッシュに戻す
if(preg_match('/\/\//', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])) {
	$FULL_HTTP = preg_replace('/\/\//', '/', FULL_HTTP);
	header('Location: '.$FULL_HTTP);
	exit;
}
// URLをスラッシュで分解
$array_parse_uri = explode('/', $_SERVER['REQUEST_URI']);
foreach($array_parse_uri as $kye => $value) {
	// basic配置ディレクトリ、'', getをスキップ
	if($value == ROOT_DIR || $value == '' || preg_match('/\?/', $value) == true) {

	}
		// コントローラークエリ生成 (関数を作って変数リターンの方がいいかも
		else {
			$controller_query = $controller_query.'/'.$value;
			$controller_query = preg_replace('/^\/{1}/', '', $controller_query);
		}
}

/***********
// setup遷移
***********/
// config.phpがある場合
if(file_exists(PATH.'setting/config.php')) {
	require_once('setting/config.php');
}
	// config.phpがない場合
	else {
		// urlにsetupがある場合何もしない
		if(preg_match('/\/setup\//', FULL_HTTP)) {

		}
			// urlにsetupがない場合setupに遷移する
			else {
				header('Location: '.HTTP.'setup/');
				exit;
			}
	}
/****
setup
*****/
if($controller_query == 'setup') {
	// コントローラー読み込み
	require_once(PATH.'app/theme/admin/controller/'.$controller_query.'/index.php');
	exit;
}
/****
login
*****/
if($controller_query == 'login') {
	// コントローラー読み込み
	require_once(PATH.'app/theme/admin/controller/'.$controller_query.'/index.php');
	exit;
}


/*******
通常遷移
********/
// app/controller/配下に同名のPHPファイルがないか探す。
if(file_exists(PATH.'app/theme/'.$theme_name.'/controller/'.$controller_query.'/index.php')) {
	// コントローラー読み込み
	require_once(PATH.'app/theme/'.$theme_name.'/controller/'.$controller_query.'/index.php');
}
	else {
		pre_var_dump('エラー');
		// ファイルがなければ404エラー
//		header("https/1.0 404 Not Found"); // あとで修正
//		exit;
}
