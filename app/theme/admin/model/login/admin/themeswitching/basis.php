<?php 
class model_login_admin_themeswitching_basis {
	//----------------------
	// 一般データarray取得
	//----------------------
	public static function theme_list_array_get() {
		$result = glob(PATH.'app/theme/*', GLOB_ONLYDIR);
		foreach($result as $key => $value) {
			// 特定の文字列から後ろを取得
			$dir_name = mb_substr($value, mb_strrpos($value, '/') + 1, mb_strlen($value)); // MS-06S
			if(!($dir_name == 'admin')) {
				$theme_list_array[] = $dir_name;
			}
		} // foreach($result as $key => $value) {
		return $theme_list_array;
	}
	//------------------
	// テーマ切り替え
	//------------------
	public static function themeswitching($get) {
		model_db::query("
			UPDATE setting 
			SET theme = '".$get['theme_name']."'
			WHERE setting_id = 1
		");
	}













}