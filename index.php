<?php
// core読み込み
require_once('setting/config.php');
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
// db_config.phpがある場合
if(file_exists(PATH.'setting/db_config.php')) {
	require_once('setting/db_config.php');
}
	// db_config.phpがない場合
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






// サイト情報取得
$site_data_array = basic::site_data_get();
//pre_var_dump($site_data_array);
// ページ情報取得
$page_data_array = basic::page_data_get($controller_query);
//pre_var_dump($controller_query);
//pre_var_dump($page_data_array);

/****
login
*****/
if($controller_query == 'login') {
	// コントローラー読み込み
	require_once(PATH.'app/theme/admin/controller/'.$controller_query.'/index.php');
	exit;
}

/**********
login/admin
***********/
if(preg_match('/login\/admin/', $controller_query, $controller_query_array)) {
	// コントローラー読み込み
	require_once(PATH.'app/theme/admin/controller/'.$controller_query.'/index.php');
	exit;
}
/*****
logout
******/
if($controller_query == 'logout') {
	// コントローラー読み込み
	require_once(PATH.'app/theme/admin/controller/'.$controller_query.'/index.php');
	exit;
}
/***********
sitemap/xml
***********/
if($controller_query == 'sitemap/sitemap.xml') {
	// サイト情報取得
	$site_data_array = basic::site_data_get();
	// コントローラー読み込み
	require_once(PATH.'app/theme/'.$site_data_array['theme'].'/controller/'.$controller_query.'');
	exit;
}

// トップであればrootにする
if($controller_query == '') {
	$controller_query = 'root';
}



/*******
通常遷移
********/
// app/controller/配下に同名のPHPファイルがないか探す。
if(file_exists(PATH.'app/theme/'.$site_data_array['theme'].'/controller/'.$controller_query.'/index.html.gz')) {
	// gz読み込み
	header('Content-Encoding: gzip');
	readfile(PATH.'app/theme/'.$site_data_array['theme'].'/controller/'.$controller_query.'/index.html.gz');
}
	else if(file_exists(PATH.'app/theme/'.$site_data_array['theme'].'/controller/'.$controller_query.'/index.html')) {
		// コントローラー読み込み
		require_once(PATH.'app/theme/'.$site_data_array['theme'].'/controller/'.$controller_query.'/index.html');
	}
		else if(file_exists(PATH.'app/theme/'.$site_data_array['theme'].'/controller/'.$controller_query.'/index.php')) {
			// コントローラー読み込み
			require_once(PATH.'app/theme/'.$site_data_array['theme'].'/controller/'.$controller_query.'/index.php');
		}
			// エラー表示
			else {
				header("HTTP/1.1 404 Not Found");
				$controller_query = 'error';
				require_once(PATH.'app/theme/admin/controller/'.$controller_query.'/index.php');
				exit;
		}
