<?php 
class model_login_admin_general_basis {
	//----------------------
	// 一般データarray取得
	//----------------------
	public static function general_data_array_get() {
		// 取得
		$general_res = model_db::query("
			SELECT * 
			FROM setting ");
			$general_data_array = $general_res[0];
		return $general_data_array;
	}
	//----------------------
	//  一般設定保存
	//----------------------
	public static function general_save($post) {
		$general_res = model_db::query("
			UPDATE setting 
			SET 
				admin_theme_color = '".$post['admin_theme_color']."', 
				title = '".$post['site_name']."',
				description = '".$post['site_summary']."',
				compression = '".$post['compression']."',
				article_view_num = '".$post['article_view_num']."'
			WHERE setting_id = 1");
	}
	//----------
	//  ico保存
	//----------
	public static function ico_save($files) {
		if(move_uploaded_file($files['site_icon']['tmp_name'], PATH.'app/assets/img/icon/'.$files['site_icon']['name'])) {
		$general_res = model_db::query("
			UPDATE setting 
			SET 
				icon = '".$files['site_icon']['name']."'
			WHERE setting_id = 1");
		}
	}
	//----------
	//  apple_touch_icon保存
	//----------
	public static function apple_touch_icon_save($files) {
		if(move_uploaded_file($files['apple_touch_icon']['tmp_name'], PATH.'app/assets/img/icon/'.$files['apple_touch_icon']['name'])) {
		$general_res = model_db::query("
			UPDATE setting 
			SET 
				apple_touch_icon = '".$files['apple_touch_icon']['name']."', 
				apple_touch_icon_precomposed = '".$files['apple_touch_icon']['name']."'
			WHERE setting_id = 1");
		}
	}

}