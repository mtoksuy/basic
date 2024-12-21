<?php
class model_login_basis {
	//--------
	//ログイン
	//--------
	public static function login($post) {
		$query = model_db::query("
			SELECT *
			FROM user
			WHERE basic_id  = '" . $post["user_login"] . "'
			AND del = 0
			OR email           = '" . $post["user_login"] . "'
			AND del = 0");
		foreach ($query as $key => $value) {
			if (password_verify($post['user_password'], $value['password'])) {
				// セッション生成
				$_SESSION["primary_id"]    = $value["primary_id"];
				$_SESSION["basic_id"]        = $value["basic_id"];
				$_SESSION["email"]            = $value["email"];
				$_SESSION["name"]            = $value["name"];
				$_SESSION["icon"]              = $value["icon"];
				$_SESSION["profile"]           = $value["profile"];
				$_SESSION["role"]               = $value["role"];
				$_SESSION["del"]                = $value["del"];
				$_SESSION["create_time"]  = $value["create_time"];
				$_SESSION["update_time"] = $value["update_time"];
				$_SESSION["basic_http"]    = HTTP;

				// クッキー生成(一ヶ月有効)
				setcookie('basic_id', $value["basic_id"], time() + 2592000, '/');
				setcookie('basic_login_key', $value['password'], time() + 2592000, '/');
				// 死んでる
				model_login_basis::login_history_record($_SESSION["basic_id"]);
				// send_support_infoに対してポストする
				model_login_basis::send_support_info_post();
				// 移動
				header('Location: ' . HTTP . 'login/admin/');
				exit;
			} else {
				// ログイン出来ない場合
				$lohin_message = 'ユーザー名かパスワードが間違っています。';
			}
		}
		// ログイン出来ない場合
		$lohin_message = 'ユーザー名かパスワードが間違っています。';
		return $lohin_message;
	}
	//----------------
	//クッキーログイン
	//----------------
	public static function cookie_login() {
		$query = model_db::query("
			SELECT *
			FROM user
			WHERE basic_id  = '" . $_COOKIE["basic_id"] . "'");
		foreach ($query as $key => $value) {
			if ($_COOKIE['basic_login_key'] ===  $value['password']) {
				// セッション生成
				$_SESSION["primary_id"]    = $value["primary_id"];
				$_SESSION["basic_id"]        = $value["basic_id"];
				$_SESSION["email"]            = $value["email"];
				$_SESSION["name"]            = $value["name"];
				$_SESSION["icon"]              = $value["icon"];
				$_SESSION["profile"]           = $value["profile"];
				$_SESSION["role"]               = $value["role"];
				$_SESSION["del"]                = $value["del"];
				$_SESSION["create_time"]  = $value["create_time"];
				$_SESSION["update_time"] = $value["update_time"];
				// クッキー生成(一ヶ月有効)
				setcookie('basic_id', $value["basic_id"], time() + 2592000, '/');
				setcookie('basic_login_key', $value['password'], time() + 2592000, '/');
				// 死んでる
				model_login_basis::login_history_record($_SESSION["basic_id"]);
				$retrun_url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				// 移動
				header('Location: ' . $retrun_url);
				exit;
			}
		}
	}
	//----------------
	//ログインチェック
	//----------------
	public static function login_check() {
		// エラー表示設定()
		error_reporting(0);
		ini_set('display_errors', 1);

		$login_check = '';
		// セッションがある場合
		if ($_SESSION["basic_id"]) {
			$login_check = true;
		}
		// セッションがない場合
		else {
			$login_check = false;
			// クッキーがある場合
			if ($_COOKIE['basic_id']) {
				// クッキーでログイン
				$login_check  = Model_Login_Basis::cookie_login();
			}
		}
		return $login_check;
	}
	//----------
	//ログアウト
	//----------
	public static function logout() {
		// セッション削除
		$_SESSION = array();
		session_destroy();
		// クッキー削除
		setcookie('basic_id', '', time() - 10000, '/');
		setcookie('basic_login_key', '', time() - 10000, '/');
		header('location: ' . HTTP . '');
		exit;
	}
	//----------------------
	//ログイン履歴を記録する
	//----------------------
	public static function login_history_record($basic_id) {
		/*
		model_db::query("
			INSERT INTO login_history (
				basic_id
			)
			VALUES (
				'" . $basic_id . "'
			)
		");
			*/
	}
	//-----------------------------------------
	// send_support_infoに対してポストする
	//-----------------------------------------
	public static function send_support_info_post() {
		// 定義されていない変数を空定義
		if (empty($_SERVER['HTTP_HOST'])) {
			$_SERVER['HTTP_HOST'] = '';
		}
		if (empty($_SERVER['HTTP_USER_AGENT'])) {
			$_SERVER['HTTP_USER_AGENT'] = '';
		}
		if (empty($_SERVER['SERVER_SOFTWARE'])) {
			$_SERVER['SERVER_SOFTWARE'] = '';
		}
		if (empty($_SERVER['SERVER_PORT'])) {
			$_SERVER['SERVER_PORT'] = '';
		}
		if (empty($_SERVER['DOCUMENT_ROOT'])) {
			$_SERVER['DOCUMENT_ROOT'] = '';
		}
		if (empty($_SERVER['REQUEST_SCHEME'])) {
			$_SERVER['REQUEST_SCHEME'] = '';
		}

		$api_url = 'https://basic.dance/api/?send_support_info';

		$data = array(
			'send_support_info'     => true,
			'HTTP_HOST'              => $_SERVER['HTTP_HOST'],
			'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
			'SERVER_SOFTWARE' => $_SERVER['SERVER_SOFTWARE'],
			'SERVER_PORT'          => $_SERVER['SERVER_PORT'],
			'DOCUMENT_ROOT'   => $_SERVER['DOCUMENT_ROOT'],
			'REQUEST_SCHEME'  => $_SERVER['REQUEST_SCHEME'],
		);
		// send_support_info API POSTで送信する
		basic::api_post($api_url, $data);
	}
}
