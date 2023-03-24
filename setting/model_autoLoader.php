<?php 
	require_once(PATH.'setting/basic.php');
	$basic = new basic();
	require_once(PATH.'setting/db.php');
	$model_db = new model_db();

	$load_class_list = array();

	$cmd_2  = 'find '.PATH.'app/theme/admin/model -type f -name "*.php"';
	exec($cmd_2, $arr_2, $res_2);


	$PATH = preg_replace('/setting/', '', dirname(__FILE__));
define('PATH', $PATH);
$path = PATH . 'app/theme/admin';

$getPhpFilesInModelDirectory = function ($dir) use (&$getPhpFilesInModelDirectory) {
    $files = glob($dir . '/*');
    $phpFiles = [];
    foreach ($files as $file) {
        if (is_dir($file)) {
            $phpFiles = array_merge($phpFiles, $getPhpFilesInModelDirectory($file));
        } elseif (strpos($file, '/model/') !== false && pathinfo($file, PATHINFO_EXTENSION) == 'php') {
            $phpFiles[] = $file;
        }
    }
    return $phpFiles;
};

$phpFiles = $getPhpFilesInModelDirectory($path);
//var_dump($phpFiles);
if($phpFiles) {
	foreach($phpFiles as $key => $value) {
		$value = str_replace(PATH.'app/theme/admin/model', '' , $value);
		preg_match('/^\/(.*)\//', $value, $value_array);
	   $dir_data = $value_array[0];
	   $file_name = str_replace($value_array[0], '' , $value);
	   $class_name = preg_replace('/\.php/', '' , $file_name);
	   require_once(PATH.'app/theme/admin/model'.$dir_data.$file_name);
	   $dir_data_under = preg_replace('/\//', '_' , $dir_data);
	   $dir_data_under =  'model'.$dir_data_under.$class_name;
	   $load_class_list[] = $dir_data_under;
	   ${$dir_data_under} = new $dir_data_under();
	}
}
	if($arr_2) {
		foreach($arr_2 as $key => $value) {
			$value = str_replace(PATH.'app/theme/admin/model', '' , $value);
			 preg_match('/^\/(.*)\//', $value, $value_array);
			$dir_data = $value_array[0];
			$file_name = str_replace($value_array[0], '' , $value);
			$class_name = preg_replace('/\.php/', '' , $file_name);
			require_once(PATH.'app/theme/admin/model'.$dir_data.$file_name);
			$dir_data_under = preg_replace('/\//', '_' , $dir_data);
			$dir_data_under =  'model'.$dir_data_under.$class_name;
			$load_class_list[] = $dir_data_under;
			${$dir_data_under} = new $dir_data_under();
		}
	}

	$theme_name = 'first_time'; // デフォルト設定
	if(file_exists(PATH.'setting/db_config.php')) {
		require_once('setting/db_config.php');
		//  DB接続チェック
		$connect_check = basic::db_conect_check($db_config_array);
		if(empty($site_data_array['theme'])) { $site_data_array['theme'] = ''; }
		if($connect_check) {
			// サイト情報取得
			$site_data_array = basic::site_data_get();
		}
		// 現在設定しているテーマのモデル読み込み
		$theme_name = $site_data_array['theme'];
	}
	$cmd = 'find '.PATH.'app/theme/'.$theme_name.'/model -type f -name "*.php"';
	exec($cmd, $arr_1, $res_1);
	if($arr_1) {
		foreach($arr_1 as $key => $value) {
			$value = str_replace(PATH.'app/theme/'.$theme_name.'/model', '' , $value);
			 preg_match('/^\/(.*)\//', $value, $value_array);
			$dir_data = $value_array[0];
			$file_name = str_replace($value_array[0], '' , $value);
			$class_name = preg_replace('/\.php/', '' , $file_name);
			require_once(PATH.'app/theme/'.$theme_name.'/model'.$dir_data.$file_name);
			$dir_data_under = preg_replace('/\//', '_' , $dir_data);
			$dir_data_under =  'model'.$dir_data_under.$class_name;
			$load_class_list[] = $dir_data_under;
			${$dir_data_under} = new $dir_data_under();
		}
	}
// ソート逆
$load_class_list = array_reverse($load_class_list);
