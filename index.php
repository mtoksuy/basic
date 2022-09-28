<?php
// core読み込み
require_once('setting/core.php');
//require_once('setting/autoLoader.php'); // 後で実装
// 必要な変数
$controller_query = '';

pre_var_dump(HTTP);
pre_var_dump(ROOT_DIR);
pre_var_dump(FULL_HTTP);

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

/*******
// setup
*******/
if(file_exists(PATH.'setting/config.php')) {
	require_once('setting/config.php');
}
	else {
		if(preg_match('/setup/', FULL_HTTP)) {
			
		}
			else {
				header('Location: '.HTTP.'setup/');
				exit;
			}
	}

// app/controller/配下に同名のPHPファイルがないか探す。
if(file_exists(PATH.'app/controller/'.$controller_query.'/index.php')) {
	// コントローラー読み込み
	require_once(PATH.'app/controller/'.$controller_query.'/index.php');
}
	else {
		pre_var_dump('エラー');
		// ファイルがなければ404エラー
//		header("https/1.0 404 Not Found"); // あとで修正
//		exit;
}
