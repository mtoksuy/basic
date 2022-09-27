<?php
// core読み込み
require_once('setting/core.php');
require_once('setting/config.php');
//require_once('setting/autoLoader.php');

// アクセスURL 重複スラッシュを1スラッシュに戻す
if(preg_match('/\/\//', $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])) {
	$FULL_HTTP = preg_replace('/\/\//', '/', FULL_HTTP);
	header('Location: '.$FULL_HTTP);
	exit;
}

// URLをスラッシュで分解
$array_parse_uri = explode('/', $_SERVER['REQUEST_URI']);
//pre_var_dump($array_parse_uri);
//pre_var_dump(ROOT_DIR);
foreach($array_parse_uri as $kye => $value) {
	if($value == ROOT_DIR || $value == '' || preg_match('/\?/', $value) == true) {
//			pre_var_dump($value);
	}
		else {
			$controller_query = $controller_query.'/'.$value;
			pre_var_dump($value);
		}
}
	pre_var_dump($controller_query);
	pre_var_dump(PATH.'app/controller'.$controller_query.'/index.php');

// app/controller/配下に同名のPHPファイルがないか探す。
if(file_exists('../app/controller'.$controller_query.'index.php')) {
	// いまここ
}
	else {
		pre_var_dump('エラー');
		// ファイルがなければ404エラー
		header("https/1.0 404 Not Found"); // あとで修正
		exit;
}
