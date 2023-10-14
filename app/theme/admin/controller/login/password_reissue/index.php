<?php 

		// 定義されていない変数を空定義
		if(empty($_GET['token'])) { $_GET['token'] = ''; }
		if(empty($post['confirmation'])) { $post['confirmation'] = ''; }
		$lohin_message = '';

	// メールを忘れた人にメール送信
	if($_POST) {
		// ポストの中身をエンティティ化する
		$post = basic::post_security();
		// basic_id or メールアドレスチェック(存在するか
		$user_data_array = model_login_password_reissue_basis::confirmation_check_user_data_get($post);
		// 存在する場合メールを送信する
		if($user_data_array) {
//			pre_var_dump($user_data_array);
			// サイト情報取得
			$site_data_array = basic::site_data_get();
//			pre_var_dump($site_data_array);
			// トークン生成
			$token = model_login_password_reissue_basis::generate_secure_token(32);
			// トークン登録
			model_login_password_reissue_basis::token_set($user_data_array, $token);
			$api_url = 'https://basic.dance/api/?send_support_mail';
			$data = array(
				'send_support_mail' => true,
				'to'                            => $user_data_array['email'],
				'from_name'             => $site_data_array['title'],
				'subject'                   => '['.$site_data_array['title'].']パスワード再発行の確認メールを送りました',
				'body'                       => ''.$site_data_array['title'].'\n\n basic_id：'.$user_data_array['basic_id'].'\n\nパスワード再発行するためのURLを送信致しました。\n\nパスワード再設定URL\n'.HTTP.'login/password_reissue?token='.$token.'',
			);
		// basic_version_get API POSTで送信する
			model_login_password_reissue_basis::api_post($api_url, $data);
			$lohin_message = 'パスワード再発行のURLをメールアドレスに送信致しました。';
		} // if($user_data_array) {
		// 存在しない場合
		else {
			$lohin_message = 'basic_idかメールアドレスが間違っています。';
		}
	}
	// メール内URL開いた場合
	if($_GET['token']) {
		// ゲットの中身をエンティティ化する
		$get = basic::get_security();
//		pre_var_dump($get);
		// トークンの有効期限を確認する
		$token_data_array = model_login_password_reissue_basis::token_expiration_date_check($get);
		// 有効だった場合
		if($token_data_array) {
			// パスワード再発行
			$new_password = model_login_password_reissue_basis::password_reissue($token_data_array);
			// テンプレート読み込み
			require_once(PATH.'app/theme/admin/view/'.$controller_query.'/complete/template.php');
		}
		exit;
	}
	// ログインのHTML生成
//	$setup_data_array = model_setup_html::login_html_create();

	// テンプレート読み込み
	require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');