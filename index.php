<?php
////////////////////////////
// core読み込み
////////////////////////////
require_once('setting/config.php');
////////////////////////////
// 必要な変数定義
////////////////////////////
$controller_query = '';
$theme_name      = '';

////////////////////////////
// setupエラー文非表示
////////////////////////////
if (preg_match('/setup/', FULL_HTTP)) {
	// エラー表示
	ini_set('display_errors', 0);
}
////////////////////////////
// オートローダー読み込み
////////////////////////////
require_once('setting/model_autoLoader.php');

////////////////////////////
// コントローラークエリ生成
////////////////////////////
$controller_query = basic::controller_query_create();

/////////////////////////////////////////////////////////////////
// 同ドメイン他階層、別basicでログインがある場合、強制ログアウト
/////////////////////////////////////////////////////////////////
if ($_SESSION) {
	if (!($_SESSION['basic_http'] == HTTP)) {
		// ログアウト
		model_login_basis::logout();
	}
}
//////////////////////////////////////////////////
// アクセスURL 重複スラッシュを1スラッシュに戻す
//////////////////////////////////////////////////
if (preg_match('/\/\//', $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'])) {
	$FULL_HTTP = preg_replace('/\/\//', '/', FULL_HTTP);
	header('Location: ' . $FULL_HTTP);
	exit;
}

/***********
// setup遷移
 ***********/
// db_config.phpがある場合
if (file_exists(PATH . 'setting/db_config.php')) {
	require_once('setting/db_config.php');
}
// db_config.phpがない場合
else {
	// urlにsetupがある場合何もしない
	if (preg_match('/\/setup\//', FULL_HTTP)) {
	}
	// urlにsetupがない場合setupに遷移する
	else {
		header('Location: ' . HTTP . 'setup/');
		exit;
	}
}

/****
setup
 *****/
if ($controller_query == 'setup') {
	// コントローラー読み込み
	require_once(PATH . 'app/theme/admin/controller/' . $controller_query . '/index.php');
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
if ($controller_query == 'login') {
	// コントローラー読み込み
	require_once(PATH . 'app/theme/admin/controller/' . $controller_query . '/index.php');
	exit;
}
/**********************
login/password_reissue
 **********************/
if ($controller_query == 'login/password_reissue') {
	// コントローラー読み込み
	require_once(PATH . 'app/theme/admin/controller/' . $controller_query . '/index.php');
	exit;
}

/*******************
login/admin/plugin/
 *******************/
if (preg_match('/login\/admin\/plugin\//', $controller_query, $controller_query_array)) {
	// プラグイン用 $controller_query
	$controller_query = preg_replace('/login\/admin\/plugin\//', '', $controller_query);
	// root
	if (!preg_match('/\//', $controller_query)) {
		$plugin_name = $controller_query;
		$controller_query = 'root';
	}
	// rootじゃない
	else {
		$controller_query_e = explode('/', $controller_query);
		$plugin_name = $controller_query_e[0];
		$controller_query = preg_replace('/' . $plugin_name . '\//', '', $controller_query);
	}
	// コントローラー読み込み
	require_once(PATH . 'app/plugin/' . $plugin_name . '/controller/' . $controller_query . '/index.php');
	exit;
}
/**********
login/admin
 ***********/
if (preg_match('/login\/admin/', $controller_query, $controller_query_array)) {
	// セッションがない場合、ログインページに遷移させる
	if (!($_SESSION)) {
		header('location: ' . HTTP . 'login/');
		exit;
	}
	// page機能 複数階層への対処
	$controller_query_array = explode('/', $controller_query);
	$controller_query_trimmed = implode('/', array_slice($controller_query_array, 0, 3));
	$valid_queries = ["login/admin/page", "login/admin/pagelist", "login/admin/pagedraft"];
	if (in_array($controller_query_trimmed, $valid_queries)) {
		$controller_query = $controller_query_trimmed;
	}
	// コントローラー読み込み
	require_once(PATH . 'app/theme/admin/controller/' . $controller_query . '/index.php');
	////////////////
	// Basic内部cron
	////////////////
	$increment = 5;
	basic::start_cron($site_data_array, $increment);
	exit;
}
/*****
logout
 ******/
if ($controller_query == 'logout') {
	// コントローラー読み込み
	require_once(PATH . 'app/theme/admin/controller/' . $controller_query . '/index.php');
	exit;
}
/***********
sitemap/xml
 ***********/
if (preg_match('/sitemap\/(.*?)\.xml/', $controller_query, $controller_query_array)) {
	if (file_exists(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '')) {
		// サイト情報取得
		$site_data_array = basic::site_data_get();
		header('Content-Type: application/xml');
		// コントローラー読み込み
		require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '');
		exit;
	}
	// エラー表示
	else {
		header("HTTP/1.1 404 Not Found");
		$controller_query = 'error';
		require_once(PATH . 'app/theme/admin/controller/' . $controller_query . '/index.php');
		exit;
	}
}

// トップであればrootにする
if ($controller_query == '') {
	$controller_query = 'root';
}


/************
ハッシュタグ
 ************/
if (preg_match('/hashtag\//', $controller_query, $controller_query_array)) {
	$controller_query = urldecode($controller_query);
	$hashtag_explode = explode('/', $controller_query);
	// コントローラー読み込み
	require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $hashtag_explode[0] . '/index.php');
	exit;
}
/****
記事
 ****/
if (preg_match('/article\//', $controller_query, $controller_query_array)) {
	$controller_query = urldecode($controller_query);
	$hashtag_explode = explode('/', $controller_query);
	if (file_exists(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '/index.html.gz')) {
		// ローカルかつwidnows判定
		$is_local_and_windows = basic::is_local_and_windows();
		// ローカルwidnows用
		if ($is_local_and_windows) {
			// gz読み込み
			header('Content-Encoding: gzip');
			$file_path = PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '/index.html.gz'; // 圧縮されたファイルパス
			// windowsでのキモ
			$contents = file_get_contents("compress.zlib://" . $file_path); // gzファイルを読み込む
			// エンコーディングを検出し、UTF-8に変換して表示する
			$detected_encoding = mb_detect_encoding($contents);
			if ($detected_encoding !== "UTF-8") {
				$contents = mb_convert_encoding($contents, "UTF-8", $detected_encoding);
			}
			echo $contents;
		}
		// 通常
		else {
			// gz読み込み
			header('Content-Encoding: gzip');
			readfile(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '/index.html.gz');
		}
		exit;
	} else if (file_exists(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '/index.html')) {
		// コントローラー読み込み
		require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '/index.html');
		exit;
	} else if (file_exists(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $hashtag_explode[0] . '/index.php')) {
		// コントローラー読み込み
		require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $hashtag_explode[0] . '/index.php');
		exit;
	}
}
/********
新規記事
 ********/
if (preg_match('/newarticle\//', $controller_query, $controller_query_array)) {
	$controller_query = urldecode($controller_query);
	$hashtag_explode = explode('/', $controller_query);

	// コントローラー読み込み
	require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $hashtag_explode[0] . '/index.php');
	exit;
}
/********
ライター
 ********/
if (preg_match('/writer\//', $controller_query, $controller_query_array)) {
	$controller_query = urldecode($controller_query);
	$hashtag_explode = explode('/', $controller_query);
	/*
pre_var_dump($controller_query);
pre_var_dump($hashtag_explode);
pre_var_dump(PATH.'app/theme/'.$site_data_array['theme'].'/controller/'.$hashtag_explode[0].'/'.$hashtag_explode[1].'/index.php');
*/
	if (file_exists(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $hashtag_explode[0] . '/' . $hashtag_explode[1] . '/index.php')) {
		// コントローラー読み込み
		require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $hashtag_explode[0] . '/' . $hashtag_explode[1] . '/index.php');
		exit;
	}
	// エラー表示
	else {
		header("HTTP/1.1 404 Not Found");
		$controller_query = 'error';
		require_once(PATH . 'app/theme/admin/controller/' . $controller_query . '/index.php');
		exit;
	}
}

/*******
通常遷移
 ********/
// app/controller/配下に同名のPHPファイルがないか探す。
if (file_exists(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '/index.html.gz')) {
	// ローカルかつwidnows判定
	$is_local_and_windows = basic::is_local_and_windows();
	// ローカルwidnows用
	if ($is_local_and_windows) {
		// gz読み込み
		header('Content-Encoding: gzip');
		$file_path = PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '/index.html.gz'; // 圧縮されたファイルパス
		// windowsでのキモ
		$contents = file_get_contents("compress.zlib://" . $file_path); // gzファイルを読み込む
		// エンコーディングを検出し、UTF-8に変換して表示する
		$detected_encoding = mb_detect_encoding($contents);
		if ($detected_encoding !== "UTF-8") {
			$contents = mb_convert_encoding($contents, "UTF-8", $detected_encoding);
		}
		echo $contents;
	} else {
		// gz読み込み
		header('Content-Encoding: gzip');
		readfile(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '/index.html.gz');
	}
} else if (file_exists(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '/index.html')) {
	// コントローラー読み込み
	require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '/index.html');
} else if (file_exists(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '/index.php')) {
	// コントローラー読み込み
	require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $controller_query . '/index.php');
} else if (file_exists(PATH . $controller_query)) {
	// 純粋な読み込み
	require_once(PATH . $controller_query);
}
// エラー表示
else {
	header("HTTP/1.1 404 Not Found");
	$controller_query = 'error';
	require_once(PATH . 'app/theme/admin/controller/' . $controller_query . '/index.php');
	exit;
}
