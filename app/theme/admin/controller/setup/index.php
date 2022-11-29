<?php 
	$step = 0;
if($_GET['step'] == 1) {
	$step = $_GET['step'];
	// db_config.phpがある場合
	if(file_exists(PATH.'setting/db_config.php')) {
//		require_once('setting/db_config.php');
//		header('Location: '.HTTP.'setup/?step=2');
//		exit;
	}
}
if($_GET['step'] == 2) {
	if(file_exists(PATH.'setting/db_config.php')) {
		require_once('setting/db_config.php');
		//  DB接続チェック
		$connect_check = basic::db_conect_check($db_config_array);
		pre_var_dump($connect_check.'aa');
	}
	if($_POST['submit'] == '送信') {
		$step = $_GET['step'];
		// ポストの中身をエンティティ化する
		$post = basic::post_security();
		// configファイル生成
		basic::config_file_create($post);
		// 再読み込み
		require(PATH.'setting/db_config.php');
		//  DB接続チェック
		$connect_check = basic::db_conect_check($db_config_array);
		var_dump($connect_check);
		if($connect_check) {
			// 重複チェック
			$setting_res = model_db::query("
				SELECT * FROM `setting` WHERE `setting_id` = 1
			");
			if(!$setting_res) {
				// ファイルを読み込み
				$basic_sql_word = file_get_contents(PATH.'setting/basic.sql');
				$basic_sql_word_explode =  explode(';', $basic_sql_word);
				foreach($basic_sql_word_explode as $key => $value) {
					if($value) {
						$res = model_db::query("
							".$value."
						");
					} // if($value) {
				} // foreach($basic_sql_word_explode as $key => $value) {	
			} // if(!$setting_res) {
		} // if($connect_check) {
	} // if($_POST['submit'] == '送信') {
} // if($_GET['step'] == 2) {
var_dump('コンプリート：'.$_GET['complete']);
if($_GET['step'] == 3 && $_GET['complete'] == '') {
	if($_POST['submit']) {
		$step = $_GET['step'];
		// ポストの中身をエンティティ化する
		$post = basic::post_security();
		pre_var_dump($post);	
		// basic_idチェック
		$user_basic_id_check = basic::basic_id_check($post);
		// パスワードをチェックする
		$user_password_check = basic::password_check($post);
		pre_var_dump('アカウントチェック：'.$user_basic_id_check);
		pre_var_dump('パスワードチェック：'.$user_password_check);
		// アカウント・パスワード共にOKであれば
		if($user_basic_id_check && $user_password_check) {
			// 重複チェック
			$user_res = model_db::query("
				SELECT * FROM user 
				WHERE basic_id = '".$post['basic_id']."'
			");
			if(!$user_res) {
				// セットアップからユーザー登録
				basic::setup_to_user_signup($post);
				// データベース調整
				basic::setup_to_database_coordinate($post);
				header('Location: '.FULL_HTTP.'&complete=1');
				exit;
			}
		}
	}
}
	else if($_GET['step'] == 3 && $_GET['complete'] == 1) {
		$step = 'complete';
	}
	// セットアップのHTML生成
	$setup_data_array = model_setup_html::setup_html_create($step, $connect_check, $user_basic_id_check, $user_password_check);

	// テンプレート読み込み
	require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');