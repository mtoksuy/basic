<?php 
class model_login_admin_basis  {
	//----------------
	//サイト情報取得
	//-----------------
	public static function site_data_get() {
		$site_data_array = array();
		$query = model_db::query("
			SELECT *
			FROM setting
		");
		$site_data_array = $query[0];
		return $site_data_array;
	}
}