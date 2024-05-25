<?php
class model_login_admin_contactlist_basis {
	//------------------------
	// お問い合わせ一覧取得
	//------------------------
	public static function contact_list_get() {
		$contact_list_res = model_db::query("
			SELECT * 
			FROM contact
			WHERE del = 0
			ORDER BY primary_id DESC
		");
		return $contact_list_res;
	}
	//--------------------
	// お問い合わせ取得
	//--------------------
	public static function contact_data_array_get($contact_id) {
		$contact_res = model_db::query("
			SELECT * 
			FROM contact
			WHERE primary_id = " . $contact_id . "
			AND del = 0
			ORDER BY primary_id DESC
		");
		$contact_data_array = $contact_res[0];
		return $contact_data_array;
	}
	//--------------------
	// お問い合わせ削除
	//--------------------
	public static function contact_delete($contact_id) {
		$contact_res = model_db::query("
			UPDATE contact
			SET del = 1 
			WHERE primary_id = " . $contact_id . "
		");
	}
	//-------------
	// 既読にする
	//-------------
	public static function contact_read($contact_id) {
		$contact_res = model_db::query("
			SELECT * 
			FROM contact
			WHERE primary_id = " . $contact_id . "
			AND del = 0
			ORDER BY primary_id DESC
		");
		if ((int)$contact_res[0]['read_check'] == 0) {
			$contact_res = model_db::query("
				UPDATE contact
				SET read_check = 1 
				WHERE primary_id = " . $contact_id . "
			");
			// 移動
			header('Location: ' . HTTP . 'login/admin/contactlist/?contact_id=' . $contact_id . '');
			exit();
		}
	}
}
