<?php

	$contact_unread_count_html = '';

	if($_SESSION['basic_id']) {
		$now = 'filelist';
		if($_GET) {
			// ゲットの中身をエンティティ化する
			$get = basic::get_security();
			// ファイルres取得
			$file_res = model_login_admin_filelist_basis::file_res_get($get);
			// ファイルnext_prev_res取得
			$file_next_prev_res = model_login_admin_filelist_basis::file_next_prev_res_get($get);
			// ファイルモーダルHTML生成
			$content_html = model_login_admin_filelist_html::file_modal_html_create($file_res, $file_next_prev_res);
		}
			else {
				// ファイル一覧res取得
				$filelist_res = model_login_admin_filelist_basis::filelist_res_get();
				// ファイル一覧HTML生成
				$content_html = model_login_admin_filelist_html::filelist_html_create($filelist_res);
			}
			// テンプレート読み込み
			require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>