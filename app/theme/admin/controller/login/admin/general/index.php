<?php
	if($_SESSION['basic_id']) {
		$now = 'general';
		// ポストの中身をエンティティ化する
		$post = basic::post_security();
		if($post) {
			//pre_var_dump($post);
			if($_FILES['site_icon']['tmp_name']) {
				// ico保存
				model_login_admin_general_basis::ico_save($_FILES);
			}
			if($_FILES['apple_touch_icon']['tmp_name']) {
				// apple_touch_icon保存
				model_login_admin_general_basis::apple_touch_icon_save($_FILES);
			}
			// 一般設定保存
			model_login_admin_general_basis::general_save($post);
			// サイト情報取得(更新のため
			$site_data_array = basic::site_data_get();
			// newarticleディレクトリ削除
			model_login_admin_post_basis::newarticle_dir_delete($site_data_array);
			// newarticleディレクトリ生成
			model_login_admin_post_basis::newarticle_dir_create($site_data_array);
		}
		// 一般データarray取得
		$general_data_array = model_login_admin_general_basis::general_data_array_get();
		// 一般設定HTML生成
		$content_html = model_login_admin_general_html::general_html_create($general_data_array);
			// ファイルnext_prev_res取得
//			$file_next_prev_res = model_login_admin_filelist_basis::file_next_prev_res_get($get);

		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>