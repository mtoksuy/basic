<?php 
class model_login_basis  {
	//--------
	//ログイン
	//--------
	public static function login($post) {
		$query = model_db::query("
			SELECT *
			FROM user
			WHERE amatem_id  = '".$post["user_login"]."'
			OR    email           = '".$post["user_login"]."'");
		foreach($query as $key => $value) {
			if(password_verify($post['user_password'], $value['password'])) {
				// セッション生成
				$_SESSION["primary_id"]    = $value["primary_id"];
				$_SESSION["amatem_id"] = $value["amatem_id"];
				$_SESSION["email"]            = $value["email"];
				$_SESSION["name"]            = $value["name"];
				$_SESSION["icon"]            = $value["icon"];
				$_SESSION["create_time"]  = $value["create_time"];
				$_SESSION["update_time"] = $value["update_time"];

				// クッキー生成(一ヶ月有効)
				setcookie('amatem_id', $value["amatem_id"], time() + 2592000, '/');
				setcookie('amatem_login_key', $value['password'], time() + 2592000, '/');
				// 死んでる
				model_login_basis::login_history_record($_SESSION["amatem_id"]);
				// 移動
				header('Location: '.HTTP.'/login/admin/');
				exit;
			}
				else {
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
			WHERE amatem_id  = '".$_COOKIE["amatem_id"]."'");
		foreach($query as $key => $value) {
			if($_COOKIE['amatem_login_key'] ===  $value['password']) {
				// セッション生成
				$_SESSION["primary_id"]    = $value["primary_id"];
				$_SESSION["amatem_id"] = $value["amatem_id"];
				$_SESSION["email"]            = $value["email"];
				$_SESSION["name"]            = $value["name"];
				$_SESSION["icon"]            = $value["icon"];
				$_SESSION["create_time"]  = $value["create_time"];
				$_SESSION["update_time"] = $value["update_time"];
				// クッキー生成(一ヶ月有効)
				setcookie('amatem_id', $value["amatem_id"], time() + 2592000, '/');
				setcookie('amatem_login_key', $value['password'], time() + 2592000, '/');
				// 死んでる
				model_login_basis::login_history_record($_SESSION["amatem_id"]);
				$retrun_url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				// 移動
				header('Location: '.$retrun_url);
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
		if($_SESSION["amatem_id"]) {
			$login_check = true;
		}
			// セッションがない場合
			else {
				$login_check = false;
				// クッキーがある場合
				if($_COOKIE['amatem_id']) {
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
		setcookie('amatem_id', '', time()-10000, '/');
		setcookie('amatem_login_key', '',time()-10000, '/');
		header('location: '.HTTP.'');
		exit;
	}
	//----------------------
	//ログイン履歴を記録する
	//----------------------
	public static function login_history_record($amatem_id) {
		model_db::query("
			INSERT INTO login_history (
				amatem_id
			)
			VALUES (
				'".$amatem_id."'
			)
		");
	}
}