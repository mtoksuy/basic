<?php
$coreupdate = '';
$contact_unread_count_html = '';

// ロールアクセス制御コンテンツ判断強制アドミン移動
model_login_admin_basis::role_access_control_admin_move(array('admin'));

// ログインしている場合
if ($_SESSION['basic_id']) {
	$now = 'coreupdate';
	// ゲットの中身をエンティティ化する
	$get = basic::get_security();
	if (!empty($get)) {
		if ($get['coreupdate'] == 'true') {
			// php内部ライブラリチェック
			$zip_check = basic::extensions_check('zip');
			if ($zip_check) {
				// Basicを最新のバージョンにする
				model_login_admin_coreupdate_basis::basic_coreupdate();
				// サイト情報取得(更新
				$site_data_array = basic::site_data_get();
			} else {
				$error_wording = '<p>PHP内部ライブラリのzipがインストールされていませんのでBasicを最新のバージョンにできませんでした。<br>サーバー管理者に確認をお願い致します。</p>';
			}
		}
	} // if(!empty($get)) {
	// コアアップデートHTML生成
	$coreupdate_html = model_login_admin_coreupdate_html::coreupdate_html_create();
	$content_html = $coreupdate_html;

	// テンプレート読み込み
	require_once(PATH . 'app/theme/admin/view/' . $controller_query . '/template.php');
} else {
	// クッキーログイン
	model_login_basis::cookie_login();
}
