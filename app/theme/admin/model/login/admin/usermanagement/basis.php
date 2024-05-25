<?php
class model_login_admin_usermanagement_basis {
	//----------------------
	// 全ユーザーarray取得
	//----------------------
	public static function all_user_data_get() {
		// 取得
		$all_user_res = model_db::query("
			SELECT * 
			FROM user 
			WHERE del = 0
			ORDER BY primary_id DESC");
		$all_user_data_array = $all_user_res;
		return $all_user_data_array;
	}
	//---------------
	// ユーザー削除
	//---------------
	public static function user_delete($get) {
		$all_user_res = model_db::query("
			UPDATE user 
			SET del = 1
			WHERE basic_id = '" . $get['basic_id'] . "'");
	}
	//---------------
	// ユーザー追加
	//---------------
	public static function user_add($post) {
		// 現在時刻取得
		$now_time = date('Y-m-d H:i:s');
		// hash生成
		$password_hash = password_hash($post['password'], PASSWORD_DEFAULT);
		// iconランダム選択
		$icon_array = array(
			0 => 'basic_default_icon_black_1.png',
			1 => 'basic_default_icon_blue_1.png',
			2 => 'basic_default_icon_green_1.png',
			3 => 'basic_default_icon_pink_1.png',
			4 => 'basic_default_icon_yellow_1.png',
			5 => 'default_1.png',
		);
		// ランダムなキーを取得
		$random_key = array_rand($icon_array);
		// ランダムに選択されたアイコンのファイル名を取得
		$random_icon_name = $icon_array[$random_key];
		// ユーザー登録
		model_db::query("
			INSERT INTO user (
				basic_id,
				password,
				name,
				icon,
				role,
				update_time
			)
			VALUES (
				'" . $post['basic_id'] . "', 
				'" . $password_hash . "',
				'" . $post['basic_id'] . "', 
				'" . $random_icon_name . "',
				'" . $post['role'] . "',
				'" . $now_time . "'
			)
		");
	}
	//---------------------------------
	// ユーザー記事投稿カウント取得
	//---------------------------------
	public static function user_article_post_count_get($basic_id) {
		// 取得
		$user_article_post_count_res = model_db::query("
			SELECT COUNT(basic_id) 
			FROM article 
			WHERE basic_id = '" . $basic_id . "'
			AND del = 0
			ORDER BY primary_id DESC");
		return $user_article_post_count_res;
	}
}
