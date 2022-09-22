<?php 
// エラー回避
error_reporting(0);

// エラー表示
error_reporting(E_ALL);

// 開発
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

// 本番
ini_set('display_errors', 0);

/*********
ini_set設定
**********/
ini_set('memory_limit', '128M');
ini_set('post_max_size', '10M');
ini_set('upload_max_filesize', '10M');
ini_set('max_file_uploads', 1000);
ini_set('max_execution_time', 180);

/*********
basic定数
*********/
define('theme', 'basic');
/***************
タイムゾーン指定
***************/
date_default_timezone_set('Asia/Tokyo');
/*******
独自関数
*******/
// プレヴァーダンプ
function pre_var_dump($data = '') {
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}
/**
 * オブジェクトや変数の中身を分かりやすくリストアップしたものを取得
 * @param  String $name $valが変数や配列だった場合の出力に使うラベルテキスト。
 * @param  Any $val  出力対象の変数またはオブジェクト。
 * @return String       リストアップされた変数、プロパティ、メソッドのリスト。
 */
function obj_var_dump($name, $val) {
    // if (!isset($val)) {return ('');}
    if (is_array($val)) {
        ksort($val);
        foreach ($val as $key => $contents) {
            $key = $name . "['" . $key . "']";
            $ret .= obj_var_dump($key, $contents);
        }
    } else if (is_object($val)) {
        $className = get_class($val);
        $vars = get_class_vars($className);
        $props = get_object_vars($val);
        $methods = get_class_methods($className);
        if (is_array($props) && count($props) > 0) {
            $key = 'OBJECT:' . $className . '->(property)';
            $ret .= obj_var_dump($key, $props);
        }
        if (is_array($methods) && count($methods) > 0) {
            $key = 'OBJECT:' . $className . '->(method)';
            $ret .= obj_var_dump($key, $methods);
        }
    } else {
        if (is_numeric($val)) {
            $ret = '$' . $name . ' = ' . $val . ";\n";
        } else {
            $val = htmlspecialchars($val);
            $val = preg_replace('/[\r\n]/', '\\n ', $val);
            $ret = '$' . $name . ' = \'' . $val . "';\n";
        }
    }
    echo '<pre>'.$ret.'</pre>';
}

/********************************
 * ローカルと本番環境のpathを吸収
 *******************************/
// ローカル環境
if(preg_match('/localhost/',$_SERVER["HTTP_HOST"])) {
	// デフォルト変数生成
	define('HTTP', 'http://localhost/amatem/');
	define('PATH', dirname(__FILE__).'/');
	define('INTERNAL_PATH', dirname(__FILE__).'/');
	define('TITLE', 'あまてむ - モノを通じて人と人が繋がる。');
	define('META_KEYWORDS', '');
	define('META_DESCRIPTION', 'Amazonでお買い物する際のお助け支援サイトあまてむ。パソコンやカメラ、キャンプ用品などのあらゆるAmazonカテゴリー全てを網羅して徹底的な比較・検討ができるモノのSaaSを目指してます。');
	define('TWITTER_ID', '');
}
	// 本番環境
	else {
		// cron対策
		if($_SERVER["HTTP_HOST"]) {
			define('HTTP', 'https://'.$_SERVER["HTTP_HOST"].'/');
			define('PATH', $_SERVER["DOCUMENT_ROOT"].'/');
		}
			else {
				define('HTTP', 'https://amatem.jp/');
				define('PATH', '/var/www/html/');
			}
		// デフォルト変数生成
		define('INTERNAL_PATH', $_SERVER["DOCUMENT_ROOT"]);
		define('TITLE', 'あまてむ - モノを通じて人と人が繋がる。');
		define('META_KEYWORDS', '');
		define('META_DESCRIPTION', 'Amazonでお買い物する際のお助け支援サイトあまてむ。パソコンやカメラ、キャンプ用品などのあらゆるAmazonカテゴリー全てを網羅して徹底的な比較・検討ができるモノのSaaSを目指してます。');
		define('TWITTER_ID', '');
		define('amatem_cache_server_ip_address', '118.27.102.63');
		define('amatem_cache_server_http', 'http://118.27.102.63/');
	}

/********************
セッションスタート
********************/
session_start();
