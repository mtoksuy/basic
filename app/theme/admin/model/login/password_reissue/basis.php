<?php
class model_login_password_reissue_basis {
	//---------------------------------------------------
	// basic_id or メールアドレスチェック(存在するか
	//---------------------------------------------------
	public static function confirmation_check_user_data_get($post) {
		$confirmation_check = '';
		$confirmation_res = model_db::query("
			SELECT *
			FROM user 
			WHERE basic_id = '" . $post['confirmation'] . "'
			AND del = 0
			OR email = '" . $post['confirmation'] . "'
			AND del = 0	
		");
		// 存在する場合
		if ($confirmation_res) {
			$confirmation_check = $confirmation_res[0];
		}
		// 存在しない場合
		else {
			$confirmation_check = false;
		}
		return $confirmation_check;
	}
	//---------------
	// トークン生成
	//---------------
	public static function generate_secure_token($length = 32) {
		return bin2hex(random_bytes($length));
	}
	//----------------
	// トークンセット
	//----------------
	public static function token_set($user_data_array, $token) {
		// 30分後設定
		$expiration_date = date("Y-m-d H:i:s", strtotime('+30 min'));
		model_db::query("
			INSERT INTO token (
				basic_id,
				token,
				expiration_date
			)
			VALUES (
				'" . $user_data_array['basic_id'] . "',
				'" . $token . "',
				'" . $expiration_date . "'
			)
		");
	}
	//-------------
	//  API POST
	//-------------
	public static function api_post($api_url, $data) {
		// cURLセッションを初期化
		$ch = curl_init($api_url);

		// POSTリクエストを設定
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

		// レスポンスを文字列で取得するオプションを設定
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// SSL証明書のホスト名の検証を無効化
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		// SSL証明書の検証を無効化
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		// リクエストを実行し、レスポンスを取得
		$response = curl_exec($ch);

		// エラー処理（必要に応じて）
		if (curl_errno($ch)) {
			echo 'cURLエラー: ' . curl_error($ch);
		}

		// cURLセッションを終了
		curl_close($ch);
		// レスポンスを表示
		echo $response;
	}
	//---------------------------------
	// トークンの有効期限を確認する
	//---------------------------------
	public static function token_expiration_date_check($get) {
		$token_expiration_date_check = false;
		$check_date = date("Y-m-d H:i:s");
		$token_expiration_date_check_res = model_db::query("
			SELECT *
			FROM token 
			WHERE token = '" . $get['token'] . "'
			AND expiration_date > '" . $check_date . "'
		");
		if ($token_expiration_date_check_res) {
			$token_expiration_date_check = true;
			$token_data_array = $token_expiration_date_check_res[0];
			return $token_data_array;
		} else {
			return $token_expiration_date_check;
		}
	}




	//--------------------
	// パスワード再発行
	//--------------------
	public static function password_reissue($token_data_array) {
		// トークン生成(パスワード生成に使用)
		$new_password = self::generate_secure_token(6);
		// hash生成
		$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
		$password_reissue_res = model_db::query("
			UPDATE user
			SET password = '" . $password_hash . "'
			WHERE basic_id = '" . $token_data_array['basic_id'] . "'
		");
		if ($password_reissue_res) {
			return $new_password;
		}
	}
}
