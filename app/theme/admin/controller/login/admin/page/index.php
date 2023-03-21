<?php

		// 定義されていない変数を空定義
		$save_html = '';
		// 定義されていない変数を空定義
		if(empty($_GET['page_id'])) { $_GET['page_id'] = ''; }
		if(empty($_GET['draft_id'])) { $_GET['draft_id'] = ''; }
		if(empty($_GET['delete'])) { $_GET['delete'] = ''; }
		if(empty($_GET['article_id'])) { $_GET['article_id'] = ''; }
		if(empty($_GET['edit'])) { $_GET['edit'] = ''; }
		if(empty($_GET['permalink'])) { $_GET['permalink'] = ''; }

		// 定義されていない変数を空定義
		if(empty($_POST)) {
			$_POST['title'] = '';
		}
		// 定義されていない変数を空定義
		if(empty($preview_array)) {
			$preview_array['page_id'] = '';
			$preview_array['title'] = '';
			$preview_array['content'] = '';
			$preview_array['draft_id'] = '';
			$preview_array['article_id'] = '';
			$preview_array['basic_id'] = '';
			$preview_array['permalink'] = '';
		}

	if($_SESSION['basic_id']) {
		///////
		// 作成
		///////
		if($_POST['title'] && $_POST['content'] && $_POST['permalink'] && !$_POST['draft_id']) {
			// ポストの中身をエンティティ化する
			$post = basic::post_security($_POST);
			// 文末の/を削除
			$post['permalink'] = rtrim($post['permalink'], '/');
			// 特定の文字列が2連続である場合1つにする
			$post['permalink'] = basic::replace_recursive($post['permalink'], '/');
			// パーマリンクチェック
			$permalink_check = model_login_admin_page_basis::permalink_check($post);
			// 重複してない場合
			if(!$permalink_check) {
				// 新規ページ作成
				model_login_admin_page_basis::markdown_page_add($post);
				// 最新記事情報取得
				$res = model_db::query("
					SELECT *
					FROM page
					WHERE del = 0
					ORDER BY primary_id DESC
					LIMIT 0, 1");
				// サイト情報取得
				$site_data_array = basic::site_data_get();
				// ディレクトリ作成パス取得
				$directory_path = PATH.'app/theme/'.$site_data_array['theme'].'/controller/'.$res[0]['permalink'].'';
				// ディレクトリ作成
				basic::dir_create($directory_path);
				// ファイル複製
				copy(PATH.'setting/master/page.php', $directory_path.'/index.php');
				// 静的化+圧縮化する際のリストarray取得
				$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('page', $res[0]['permalink']);
				// multi版：静的化+圧縮化
				basic::multi_html_gzip_create($html_gzip_create_list_array);
				///////////////////////////////////////////////////////////
				$sitemap_xml_path = PATH.'sitemap/sitemap.xml';
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
				header('Location: '.HTTP.'login/admin/');
			}
			// 重複している場合
			else {

			}
		} // if($_POST['title'] && $_POST['content']) {
		//////////////////
		// 下書きから作成
		/////////////////
		if($_POST['title'] && $_POST['content'] && $_POST['permalink'] && $_POST['draft_id']) {
			// ポストの中身をエンティティ化する
			$post = basic::post_security($_POST);
			// 文末の/を削除
			$post['permalink'] = rtrim($post['permalink'], '/');
			// 特定の文字列が2連続である場合1つにする
			$post['permalink'] = basic::replace_recursive($post['permalink'], '/');
			$primary_page_res = model_db::query("
				SELECT * 
					FROM page
					WHERE primary_id = '".$post['draft_id']."'
			");
			// 更新フラグ
			$update_flag = 0;
			// パーマリンクチェック
			$permalink_check = model_login_admin_page_basis::permalink_check($post);
			// 既存のパーマリンクと同じ場合
			if($post['permalink'] === $primary_page_res[0]['permalink']) {
				$update_flag = 1;
			}
				// パーマリンク再設定
				else if(!$permalink_check) {
					$update_flag = 1;
				}
					else {
						$post = false;
					}
			if($update_flag) {
				// 下書きページ公開
				model_login_admin_page_basis::markdown_page_public($post);
				// 最新記事情報取得
				$res = model_db::query("
					SELECT *
					FROM page
					WHERE primary_id = ".$post['draft_id']."
					ORDER BY primary_id DESC
					LIMIT 0, 1");
//					pre_var_dump($res);
				// サイト情報取得
				$site_data_array = basic::site_data_get();
				// ディレクトリ作成パス取得
				$directory_path = PATH.'app/theme/'.$site_data_array['theme'].'/controller/'.$res[0]['permalink'].'';
				// ディレクトリ作成
				basic::dir_create($directory_path);
				// ファイル複製
				copy(PATH.'setting/master/page.php', $directory_path.'/index.php');
				// 静的化+圧縮化する際のリストarray取得
				$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('page', $res[0]['permalink']);
				// multi版：静的化+圧縮化
				basic::multi_html_gzip_create($html_gzip_create_list_array);
				///////////////////////////////////////////////////////////
				$sitemap_xml_path = PATH.'sitemap/sitemap.xml';
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
			header('Location: '.HTTP.'login/admin/');
			}
		} // if($_POST['title'] && $_POST['content'] && $_POST['permalink'] && $_POST['draft_id']) {
		/////////////////
		// 下記事削除機能
		/////////////////
		if($_GET['draft_id'] && $_GET['delete'] == true) {
			$draft_id = (int)$_GET['draft_id'];
			//  ページデータ取得
			$page_res = model_page_basis::page_get_primary_id_v($draft_id);
			// 本人確認
			if($_SESSION['basic_id'] == $page_res[0]['basic_id']) {
				// ページ削除
				 model_login_admin_page_basis::markdown_page_delete($page_res[0]['primary_id']);
				header('Location: '.HTTP.'login/admin/pagedraft/');
				return false;
			}
		}
		/////////////////
		// ページ削除機能
		/////////////////
		if($_GET['page_id'] && $_GET['delete'] == true) {
			$page_id = (int)$_GET['page_id'];
			//  ページデータ取得
			$page_res = model_page_basis::page_get_primary_id_v($page_id);
			// 本人確認
			if($_SESSION['basic_id'] == $page_res[0]['basic_id']) {
				// ページ削除
				 model_login_admin_page_basis::markdown_page_delete($page_res[0]['primary_id']);
				$delete_permalink = $page_res[0]['permalink'];
				// ディレクトリ削除パス取得
				$directory_path = PATH.'app/theme/'.$site_data_array['theme'].'/controller/'.$delete_permalink.'';
				// ディレクトリ削除
				basic::rmdirAll($directory_path);
				// 静的化+圧縮化する際のリストarray取得
				$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('page_del');
				// multi版：静的化+圧縮化
				basic::multi_html_gzip_create($html_gzip_create_list_array);
				// 全記事リスト取得
				$article_all_list_res = model_sitemap_basis::article_all_list_get();
				// pageリスト取得
				$page_all_list_res = model_sitemap_basis::page_all_list_get();
				// sitemap.xml生成
				$sitemap_xml = model_sitemap_html::sitemap_xml_create($article_all_list_res, $page_all_list_res);
				header('Location: '.HTTP.'login/admin/pagelist/');
				return false;
			}
		}
		/////////////////
		// 下書き編集機能
		/////////////////
		if($_GET['draft_id'] && $_GET['edit'] == true) {
			$draft_id = (int)$_GET['draft_id'];
			//  ページデータ取得
			$page_res = model_page_basis::page_get_primary_id_v($draft_id);
			// 本人確認
			if($_SESSION['basic_id'] == $page_res[0]['basic_id']) {
//				pre_var_dump($page_res);
//				pre_var_dump($_SESSION);
				$preview_array['title'] = $page_res[0]['title'];
				$preview_array['content'] = $page_res[0]['content'];
				$preview_array['draft_id'] = $page_res[0]['primary_id'];
				$preview_array['basic_id'] = $page_res[0]['basic_id'];
				$preview_array['permalink'] = $page_res[0]['permalink'];
				// テンプレート読み込み
				require_once(PATH.'app/theme/admin/view/login/admin/post/template.php');
				return false;
			}
		}
		///////////////////////
		// 下書きプレビュー機能
		////////////////////////
		if($_GET['permalink']) {
			$method = $_GET['permalink'];
			//  ページデータ取得
			$page_res = model_page_basis::page_get($method);
			// ページのHTML生成
			$page_data_array = model_page_html::page_html_create($page_res);
			// タイトル挿入
			$page_data_array['title'] = $page_res[0]['title'];
			// テンプレート読み込み
			require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/page/template.php');
			return false;
		}
		///////////////////////
		// 投稿済み記事編集機能
		///////////////////////
		if($_GET['page_id'] && $_GET['edit'] == true) {
			$page_id = (int)$_GET['page_id'];
			//  ページデータ取得
			$page_res = model_page_basis::page_get_primary_id_v($page_id);
			// 本人確認
			if($_SESSION['basic_id'] == $page_res[0]['basic_id']) {
//				pre_var_dump($page_res);
//				pre_var_dump($_SESSION);
				$preview_array['title']       = $page_res[0]['title'];
				$preview_array['content'] = $page_res[0]['content'];
				$preview_array['page_id'] = $page_res[0]['primary_id'];
				$preview_array['basic_id'] = $page_res[0]['basic_id'];
				$preview_array['permalink'] = $page_res[0]['permalink'];
			// テンプレート読み込み
			require_once(PATH.'app/theme/admin/view/login/admin/page/template.php');
				return false;
			}
		}
		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>