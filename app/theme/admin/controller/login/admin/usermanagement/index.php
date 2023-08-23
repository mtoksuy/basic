<?php

	// 定義されていない変数を空定義
	$contact_unread_count_html = '';
	$user_add_html = '';
	// 定義されていない変数を空定義
	if(empty($_GET['basic_id'])) { $_GET['basic_id'] = ''; }
	if(empty($_GET['edit'])) { $_GET['edit'] = ''; }
	if(empty($_GET['delete'])) { $_GET['delete'] = ''; }
	if(empty($_GET['add'])) { $_GET['add'] = ''; }
	if(empty($_POST['basic_id'])) { $_POST['basic_id'] = ''; }

	// ロールアクセス制御コンテンツ判断強制アドミン移動
	model_login_admin_basis::role_access_control_admin_move(array('admin'));

	if($_SESSION['basic_id']) {
		$now = 'usermanagement';
		// ポストの中身をエンティティ化する
		$post = basic::post_security();
		// ゲットの中身をエンティティ化する
		$get = basic::get_security();
		/**
		* 
		**/
		///////////
		// 新規追加
		///////////
		if($post['basic_id'] && $post['password'] && $post['submit']) {
			// basic_idチェック
			$user_basic_id_check = basic::basic_id_check($post);
			// パスワードをチェックする
			$user_password_check = basic::password_check($post);
			// アカウント・パスワード共にOKであれば
			if($user_basic_id_check && $user_password_check) {
				// 重複チェック
				$user_res = model_db::query("
					SELECT * FROM user 
					WHERE basic_id = '".$post['basic_id']."'
					AND del = 0
				");
				if(!$user_res) {
					// ユーザー追加
					model_login_admin_usermanagement_basis::user_add($post);
					// ユーザーディレクトリセットアップ
					basic::user_dir_setup($post);
					header('Location: '.HTTP.'login/admin/usermanagement/');
					exit;
				}
			}
		}
		///////////////
		// 新規追加画面
		///////////////
		if($get['add']) {
			// 後ほど実装する
			// ユーザー新規追加画面HTML生成
			$content_html = model_login_admin_usermanagement_html::usermanagement_useradd_html_create();

			// テンプレート読み込み
			require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
			exit;
		}
		///////////
		// 削除する
		///////////
		if($get['basic_id'] && $get['delete']) {
			// ユーザー削除
			model_login_admin_usermanagement_basis::user_delete($get);
			// ユーザー管理へ移動
			header('Location: '.HTTP.'login/admin/usermanagement/');
			exit;
		}

		// 全ユーザーarray取得
		$all_user_data_array = model_login_admin_usermanagement_basis::all_user_data_get();
		// ユーザー追加HTML生成
		$user_add_html = model_login_admin_usermanagement_html::user_add_html_create();
		// ユーザー管理HTML生成
		$content_html = model_login_admin_usermanagement_html::usermanagement_html_create($all_user_data_array);

		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>