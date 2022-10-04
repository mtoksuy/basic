<?php 
			require_once(PATH.'setting/basic_core.php');
			$basiccdshjhjhjhjh = new basic();

	$load_class_list = array();

  $cmd_2  = 'find '.PATH.'app/theme/admin/model -type f -name "*.php"';
    exec($cmd_2, $arr_2, $res_2);
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

	$theme_name = 'first_time'; // のちほど自動化
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
