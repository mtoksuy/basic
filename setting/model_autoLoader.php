<?php 
	require_once(PATH.'setting/basic.php');
	$basic = new basic();
	require_once(PATH.'setting/db.php');
	$model_db = new model_db();

	$load_class_list = array();
	////////////////////////////////////////////
	// theme > admin
	////////////////////////////////////////////
	$path = PATH . 'app/theme/admin';
	$phpModelFiles_1 = basic::getPhpFilesInSelectDirectory($path, 'model', 'php');
	if($phpModelFiles_1) {
		foreach($phpModelFiles_1 as $key => $value) {
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

	////////////////////////////////////////////
	// theme > $theme_name
	////////////////////////////////////////////
	$path = PATH . 'app/theme/'.$theme_name.'';
	$phpModelFiles_2 = basic::getPhpFilesInSelectDirectory($path, 'model', 'php');
	if($phpModelFiles_2) {
		foreach($phpModelFiles_2 as $key => $value) {
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
	////////////////////////////////////////////
	// plugin > 
	////////////////////////////////////////////
	$dir = PATH.'app/plugin';
	foreach (glob("$dir/*", GLOB_ONLYDIR)  as $folder) {
		$path = PATH . 'app/plugin/'.basename($folder).'';
		$phpModelFiles_3 = basic::getPhpFilesInSelectDirectory($path, 'model', 'php');
		if($phpModelFiles_3) {
			foreach($phpModelFiles_3 as $key => $value) {
				$value = str_replace(PATH.'app/plugin/'.basename($folder).'/model', '' , $value);
				 preg_match('/^\/(.*)\//', $value, $value_array);
				$dir_data = $value_array[0];
				$file_name = str_replace($value_array[0], '' , $value);
				$class_name = preg_replace('/\.php/', '' , $file_name);
				require_once(PATH.'app/plugin/'.basename($folder).'/model'.$dir_data.$file_name);
				$dir_data_under = preg_replace('/\//', '_' , $dir_data);
				$dir_data_under =  'model_plugin'.$dir_data_under.$class_name;
				$load_class_list[] = $dir_data_under;
				${$dir_data_under} = new $dir_data_under();
			}
		}
		// 初期化
		$phpModelFiles_3 = '';
	}

// ソート逆
$load_class_list = array_reverse($load_class_list);
