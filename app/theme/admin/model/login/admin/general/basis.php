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
	//-------------------------------------------------
	//  サイト情報更新のため静的&圧縮ファイル削除
	//-------------------------------------------------
	public static function general_submit_delete($site_data_array) {
		// 定義されていない変数を空定義
		if(empty($html_gzip_delete_list_array)) { $html_gzip_delete_list_array = ''; }
		$html_gzip_delete_list_array = array(
			0 => PATH.'app/theme/'.$site_data_array['theme'].'/controller/root/index.html',
			1 => PATH.'app/theme/'.$site_data_array['theme'].'/controller/root/index.html.gz',
			2 => PATH.'app/theme/'.$site_data_array['theme'].'/controller/newarticle/index.html',
			3 => PATH.'app/theme/'.$site_data_array['theme'].'/controller/newarticle/index.html.gz',
		); // $html_gzip_delete_list_array = array(
		foreach($html_gzip_delete_list_array as $key => $value) {
			if(file_exists($value)) {
				unlink($value);
			}
		}
	}
	//----------------------
	// cron残り実行数取得
	//----------------------
	public static function cron_run_num_get() {
		$cron_run_num = 0;
		// 最新記事情報取得
		$new_article_res = model_db::query("
			SELECT primary_id
			FROM article
			WHERE del = 0
			ORDER BY primary_id DESC
			LIMIT 0, 1
		");
		if(empty($new_article_res[0]['primary_id'])) { $new_article_res[0]['primary_id'] = ''; }
		$latest_article_num = $new_article_res[0]['primary_id'];
		// 進めるcron取得
		$cron_res = model_db::query("
			SELECT *
			FROM cron
			WHERE complete = 0
			ORDER BY primary_id ASC
		");
		foreach($cron_res as $key => $value) {
			// type:articleの場合
			if($value['type'] == 'article') {
				$count = (int)$value['count'];
				$run_count_num = ($latest_article_num - $count);
				// 加算
				$cron_run_num = ($cron_run_num+$run_count_num);
			}
		}
	return $cron_run_num;
}






}









