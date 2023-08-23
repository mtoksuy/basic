<?php 
/**********
エラー設定
**********/
// ローカル環境
if(preg_match('/localhost/',$_SERVER["HTTP_HOST"])) {
	// エラー表示レベル
	error_reporting(E_ALL & ~E_NOTICE);
	error_reporting(E_ALL);
	// エラー表示
	ini_set('display_errors', 1);
}
// 本番環境
else {
	// エラー表示レベル
	error_reporting(E_ALL & ~E_NOTICE);
	// エラー表示
	ini_set('display_errors', 1);
}


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
	echo '<pre class="debug">';
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
/***************************************************************
 * ローカルと本番環境でどのディレクトリでも正常に動くように調整
 ***************************************************************/
// index.php削除
$SCRIPT_NAME = preg_replace('/\/index.php/', '', $_SERVER['SCRIPT_NAME']);
// 先頭のスラッシュ削除
$SCRIPT_NAME = preg_replace('/^\//', '', $SCRIPT_NAME);
// ROOT_DIR生成
$ROOT_DIR = $SCRIPT_NAME;
// $SCRIPT_NAME 中身があれば文末にスラッシュ追加
if($SCRIPT_NAME) {$SCRIPT_NAME = $SCRIPT_NAME.'/';}

/********************************
 * ローカルと本番環境のpathを吸収
 *******************************/
// ローカル環境
if(preg_match('/localhost/',$_SERVER["HTTP_HOST"])) {
	// デフォルト変数生成
	define('HTTP', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$SCRIPT_NAME);
	define('ROOT_DIR', $ROOT_DIR);
	define('FULL_HTTP', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	$PATH = preg_replace('/setting/', '', dirname(__FILE__));
	$PATH = str_replace('\\', '/', $PATH);
	define('PATH', $PATH);
	define('INTERNAL_PATH', dirname(__FILE__).'/');
	define('TITLE', 'basic サイト構築するならベーシック。世界一簡単なCMS');
	define('META_DESCRIPTION', '概要');
}
	// 本番環境
	else {
		if($_SERVER["HTTP_HOST"]) {
			define('HTTP', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$SCRIPT_NAME);
//			define('PATH', $_SERVER["DOCUMENT_ROOT"].'/'); 削除は一旦保留
			$PATH = preg_replace('/setting/', '', dirname(__FILE__));
			define('PATH', $PATH);
		}
			// cron対策
			else {
				define('HTTP', 'https://amatem.jp/');
				define('PATH', '/var/www/html/');
			}
		// デフォルト変数生成
		define('ROOT_DIR', $ROOT_DIR);
		define('FULL_HTTP', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		define('INTERNAL_PATH', $_SERVER["DOCUMENT_ROOT"]);
		define('TITLE', 'あまてむ - モノを通じて人と人が繋がる。');
		define('META_DESCRIPTION', 'Amazonでお買い物する際のお助け支援サイトあまてむ。パソコンやカメラ、キャンプ用品などのあらゆるAmazonカテゴリー全てを網羅して徹底的な比較・検討ができるモノのSaaSを目指してます。');
	}

/********************
セッションスタート
********************/
session_start();