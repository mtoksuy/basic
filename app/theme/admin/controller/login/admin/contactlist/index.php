<?php
	if($_SESSION['basic_id']) {
		$now = 'contactlist';
		// お問い合わせ一覧取得
		$contact_list_res = model_login_admin_contactlist_basis::contact_list_get();
		// お問い合わせ一覧HTML生成
		$content_html = model_login_admin_contactlist_html::contact_list_html_create($contact_list_res);

		// ゲットの中身をエンティティ化する
		$get = basic::get_security($_GET);
		// 削除
		if($get['delete'] && $get['contact_id']) {
			pre_var_dump($get);
			// お問い合わせ削除
			model_login_admin_contactlist_basis::contact_delete((int)$get['contact_id']);
			// 移動
			header('Location: '.HTTP.'login/admin/contactlist/');
			exit();
		}
		// 詳細開く
		if($get['contact_id']) {
			// 既読にする
			model_login_admin_contactlist_basis::contact_read((int)$get['contact_id']);
			// お問い合わせ取得
			$contact_data_array = model_login_admin_contactlist_basis::contact_data_array_get((int)$get['contact_id']);
			// お問い合わせ詳細HTML生成
			$content_html = model_login_admin_contactlist_html::contact_detail_html_create($contact_data_array);
		}


		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>