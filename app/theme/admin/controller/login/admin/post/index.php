<?php
// 定義されていない変数を空定義
$save_html = '';
// 定義されていない変数を空定義
if (empty($_GET['draft_id'])) {
	$_GET['draft_id'] = '';
}
if (empty($_GET['delete'])) {
	$_GET['delete'] = '';
}
if (empty($_GET['article_id'])) {
	$_GET['article_id'] = '';
}
if (empty($_GET['edit'])) {
	$_GET['edit'] = '';
}
// 定義されていない変数を空定義
if (empty($_POST)) {
	$_POST['title'] = '';
}
// 定義されていない変数を空定義
if (empty($preview_array)) {
	$preview_array['title'] = '';
	$preview_array['content'] = '';
	$preview_array['draft_id'] = '';
	$preview_array['article_id'] = '';
	$preview_array['basic_id'] = '';
}
if (empty($page_data_array['title'])) {
	$page_data_array['title'] = '';
}
if (empty($site_data_array['title'])) {
	$site_data_array['title'] = '';
}

/*********************************************************************************/

// /login/admin/post/ へアクセスの場合
if ($_GET['article_id'] == '' && $_GET['edit'] == '' && $_GET['delete'] == '' && $_GET['draft_id'] == '') {
	//			pre_var_dump('login/admin/post/ へアクセスの場合');
}
// 編集系、削除系はこちら
else {
	$article_id = (int)$_GET['article_id'];
	// 記事編集、削除
	if ($article_id) {
		// 記事データ取得
		$article_res = model_article_basis::article_get($article_id);
		/*
				pre_var_dump($_SESSION['basic_id']);
				pre_var_dump($_SESSION['role']);
				pre_var_dump($article_res[0]['basic_id']);
*/
		// ロールアクセス制御
		switch ($_SESSION['role']) {
				// 管理者
			case 'admin':

				break;
				// 編集者
			case 'editor':

				break;
				// 投稿者
			case 'postor':
				// 同じ場合
				if ($_SESSION['basic_id'] === $article_res[0]['basic_id']) {
				}
				// 違う人の記事を開いた場合adminに戻す
				else {
					// 強制移動
					header('Location: ' . HTTP . 'login/admin/');
					exit;
				}
				break;
		}
	}
	$draft_id = (int)$_GET['draft_id'];
	// 下記事編集、削除
	if ($draft_id) {
		// 記事データ取得
		$article_draft_res = model_login_admin_draft_basis::article_draft_get($draft_id);
		/*
				pre_var_dump($_SESSION['basic_id']);
				pre_var_dump($_SESSION['role']);
				pre_var_dump($article_draft_res[0]['basic_id']);
*/
		// ロールアクセス制御
		switch ($_SESSION['role']) {
				// 管理者
			case 'admin':

				break;
				// 編集者
			case 'editor':

				break;
				// 投稿者
			case 'postor':
				// 同じ場合
				if ($_SESSION['basic_id'] === $article_draft_res[0]['basic_id']) {
				}
				// 違う人の記事を開いた場合adminに戻す
				else {
					// 強制移動
					header('Location: ' . HTTP . 'login/admin/');
				}
				break;
		}
	}
}

/*********************************************************************************/

if ($_SESSION['basic_id']) {
	//////////////////
	// 投稿(下書き含む
	//////////////////
	if ($_POST['title'] && $_POST['content']) {
		// ポストの中身をエンティティ化する
		$post = basic::post_security($_POST);
		///////////////////////////////////////////////////////////
		// 下記事があった場合(本人,admi,eitor対応
		if ($post['draft_id'] && $post['basic_id'] == $_SESSION['basic_id'] || $post['draft_id'] && $_SESSION['role'] == 'admin' || $post['draft_id'] && $_SESSION['role'] == 'editor') {
			// 下書き記事削除
			model_login_admin_draft_basis::article_draft_delete($post['draft_id']);
		}
		///////////////////////////////////////////////////////////
		// ハッシュタグリスト json_encodeで取得
		$hashtag_selection_json = model_login_admin_post_basis::hashtag_selection_list_json_encode_get($post['content']);
		// 新規投稿
		model_login_admin_post_basis::markdown_post_add($post, $hashtag_selection_json);
		// 最新記事情報取得
		$res = model_db::query("
					SELECT *
					FROM article
					WHERE del = 0
					ORDER BY primary_id DESC
					LIMIT 0, 1");
		// サイト情報取得
		$site_data_array = basic::site_data_get();
		// ディレクトリ作成パス取得
		$directory_path = PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/article/' . (int)$res[0]['primary_id'] . '';
		// ディレクトリ作成
		basic::dir_create($directory_path);
		// custom_articleがある場合
		if (file_exists(PATH . 'setting/master/custom_article.php')) {
			// ファイル複製
			copy(PATH . 'setting/master/custom_article.php', $directory_path . '/index.php');
		}
		// custom_articleがない場合
		else {
			// ファイル複製
			copy(PATH . 'setting/master/article.php', $directory_path . '/index.php');
		}
		// 記事OGP画像生成
		model_login_admin_post_basis::media_article_ogp_create($res, $site_data_array);
		// 静的化+圧縮化する際のリストarray取得
		$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('article', (int)$res[0]['primary_id']);
		// multi版：静的化+圧縮化
		basic::multi_html_gzip_create($html_gzip_create_list_array);
		//////////////////////////newarticleディレクトリ生成/////////////////////////////////
		//				[ページング関連機能]記事が膨大な状況になった時のために挙動を改修 #88
		//				https://github.com/mtoksuy/basic/issues/88
		//				ディレクトリ生成からコントローラー制御で表示に変更
		//				model_login_admin_post_basis::newarticle_dir_create($site_data_array);
		///////////////////////////////////////////////////////////
		//////////////////////////sitemap_xml/////////////////////////////////
		$sitemap_xml_path = PATH . 'sitemap/sitemap.xml';
		// 全記事リスト取得
		$article_all_list_res = model_sitemap_basis::article_all_list_get();
		// pageリスト取得
		$page_all_list_res = model_sitemap_basis::page_all_list_get();
		// sitemap.xml生成
		$sitemap_xml = model_sitemap_html::sitemap_xml_create($article_all_list_res, $page_all_list_res);
		///////////////////////////////////////////////////////////
		// Todo 一旦置いとく  のちほど実装
		// gzipファイル更新&作成 本番でのみ動く
		//			exec("/usr/bin/php ".PATH."gzip/generate/index.php > /dev/null &");
		///////////////////////////////////////////////////////////
		header('Location: ' . HTTP . 'login/admin/');
	} // if($_POST['title'] && $_POST['content']) {
	/////////////////
	// 下記事削除機能
	/////////////////
	if ($_GET['draft_id'] && $_GET['delete'] == true) {
		$draft_id = (int)$_GET['draft_id'];
		// 記事データ取得
		$article_draft_res = model_login_admin_draft_basis::article_draft_get($draft_id);
		// 本人確認,admi,eitor対応
		if ($_SESSION['basic_id'] == $article_draft_res[0]['basic_id'] || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'editor') {
			//				pre_var_dump($article_draft_res[0]['primary_id']);
			// 下書き削除
			model_login_admin_draft_basis::article_draft_delete($article_draft_res[0]['primary_id']);
			header('Location: ' . HTTP . 'login/admin/draft/');
			return false;
		}
	}
	///////////////
	// 記事削除機能
	///////////////
	if ($_GET['article_id'] && $_GET['delete'] == true) {
		$article_id = (int)$_GET['article_id'];
		// 記事データ取得
		$article_res = model_article_basis::article_get($article_id);
		// 本人確認 or admin,ediotr権限あれば表示
		if ($_SESSION['basic_id'] == $article_res[0]['basic_id'] || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'editor') {
			//				pre_var_dump($article_res[0]['primary_id']);
			// 記事削除
			model_login_admin_post_basis::markdown_post_delete($article_res[0]['primary_id']);
			// サイト情報取得
			$site_data_array = basic::site_data_get();
			// 削除ディレクトリパス取得
			$directory_path = PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/article/' . (int)$article_res[0]['primary_id'] . '';
			// ディレクトリ削除
			basic::rmdirAll($directory_path);
			// 静的化+圧縮化する際のリストarray取得
			$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('article_del');
			// multi版：静的化+圧縮化
			basic::multi_html_gzip_create($html_gzip_create_list_array);
			// 全記事リスト取得
			$article_all_list_res = model_sitemap_basis::article_all_list_get();
			// pageリスト取得
			$page_all_list_res = model_sitemap_basis::page_all_list_get();
			// sitemap.xml生成
			$sitemap_xml = model_sitemap_html::sitemap_xml_create($article_all_list_res, $page_all_list_res);
			//////////////////////////newarticleディレクトリ生成/////////////////////////////////
			//					model_login_admin_post_basis::newarticle_dir_create($site_data_array);
			header('Location: ' . HTTP . 'login/admin/list/');
			return false;
		}
	}
	/////////////////
	// 下書き編集機能
	/////////////////
	if ($_GET['draft_id'] && $_GET['edit'] == true) {
		$draft_id = (int)$_GET['draft_id'];
		// 記事データ取得
		$article_res = model_login_admin_draft_basis::article_draft_get($draft_id);
		// 本人確認 or admin,ediotr権限あれば表示
		if ($_SESSION['basic_id'] == $article_res[0]['basic_id'] || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'editor') {
			//				pre_var_dump($article_res);
			//				pre_var_dump($_SESSION);
			$preview_array['title'] = $article_res[0]['title'];
			$preview_array['content'] = $article_res[0]['content'];
			$preview_array['draft_id'] = $article_res[0]['primary_id'];
			$preview_array['basic_id'] = $article_res[0]['basic_id'];
			// テンプレート読み込み
			require_once(PATH . 'app/theme/admin/view/login/admin/post/template.php');
			return false;
		}
	}
	///////////////////////
	// 下書きプレビュー機能
	////////////////////////
	if ($_GET['draft_id']) {
		$draft_id = (int)$_GET['draft_id'];
		// 記事データ取得
		$article_draft_res = model_login_admin_draft_basis::article_draft_get($draft_id);
		// 記事JSON-LDリッチリザルト生成
		$article_json_ld_rich_lizarto = model_article_html::article_json_ld_rich_lizarto_create($article_draft_res);
		// タイトル取得
		$page_data_array['title'] = $article_draft_res[0]['title'];
		// 記事データHTML生成
		$article_data_array = model_article_html::article_html_create($article_draft_res);
		// テンプレート読み込み
		require_once(PATH . 'app/theme/admin/view/login/admin/post/preview/template.php');
		return false;
	}
	///////////////////////
	// 投稿済み記事編集機能
	///////////////////////
	if ($_GET['article_id'] && $_GET['edit'] == true) {
		$article_id = (int)$_GET['article_id'];
		// 記事データ取得
		$article_res = model_article_basis::article_get($article_id);
		// 本人確認 or admin,ediotr権限あれば表示
		if ($_SESSION['basic_id'] == $article_res[0]['basic_id'] || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'editor') {
			//				pre_var_dump($article_res);
			//				pre_var_dump($_SESSION);
			$preview_array['title'] = $article_res[0]['title'];
			$preview_array['content'] = $article_res[0]['content'];
			$preview_array['article_id'] = $article_res[0]['primary_id'];
			$preview_array['basic_id'] = $article_res[0]['basic_id'];
			// テンプレート読み込み
			require_once(PATH . 'app/theme/admin/view/login/admin/post/template.php');
			return false;
		}
	} // if($_GET['article_id'] && $_GET['edit'] == true) {
	// テンプレート読み込み
	require_once(PATH . 'app/theme/admin/view/' . $controller_query . '/template.php');
} // if($_SESSION['basic_id']) {
else {
	// クッキーログイン
	model_login_basis::cookie_login();
}
