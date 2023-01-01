<?php
	if($_SESSION['basic_id']) {
		///////
		// 投稿
		///////
		if($_POST['title'] && $_POST['content']) {
			// ポストの中身をエンティティ化する
			$post = basic::post_security($_POST);
			///////////////////////////////////////////////////////////
			// 下記事があった場合
			if($post['draft_id'] && $post['basic_id'] == $_SESSION['basic_id']) {
				// 下書き記事削除
				model_login_admin_draft_basis::article_draft_delete($post['draft_id']);
			}
			///////////////////////////////////////////////////////////
			// 新規投稿
			model_login_admin_post_basis::markdown_post_add($post);
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
			$directory_path = PATH.'app/theme/'.$site_data_array['theme'].'/controller/article/'.(int)$res[0]['primary_id'].'';
			// ディレクトリ作成
			basic::dir_create($directory_path);
			// ファイル複製
			copy(PATH.'setting/master/article.php', $directory_path.'/index.php');
			// 記事OGP画像生成
			model_login_admin_post_basis::media_article_ogp_create($res, $site_data_array);
			//////////////////////////newarticleディレクトリ生成/////////////////////////////////
			model_login_admin_post_basis::newarticle_dir_create($site_data_array);
			///////////////////////////////////////////////////////////
			//////////////////////////sitemap_xml/////////////////////////////////
			$sitemap_xml_path = PATH.'sitemap/sitemap.xml';
			// 全記事リスト取得
			$article_all_list_res = model_sitemap_basis::article_all_list_get();
			// pageリスト取得
			$page_all_list_res = model_sitemap_basis::page_all_list_get();
			// sitemap.xml生成
			$sitemap_xml = model_sitemap_html::sitemap_xml_create($article_all_list_res, $page_all_list_res);
//			pre_var_dump($sitemap_xml);
			// sitemap.xmlの場所
			$sitemap_xml_path = PATH.'/app/theme/'.$site_data_array['theme'].'/controller/sitemap/sitemap.xml';
			// sitemap.xml書き込み
			file_put_contents($sitemap_xml_path, $sitemap_xml);

			///////////////////////////////////////////////////////////
			// Todo 一旦置いとく  のちほど実装
			// gzipファイル更新&作成 本番でのみ動く
//			exec("/usr/bin/php ".PATH."gzip/generate/index.php > /dev/null &");
			///////////////////////////////////////////////////////////
			header('Location: '.HTTP.'login/admin/');
		} // if($_POST['title'] && $_POST['content']) {
		/////////////////
		// 下記事削除機能
		/////////////////
		if($_GET['draft_id'] && $_GET['delete'] == true) {
			$draft_id = (int)$_GET['draft_id'];
			// 記事データ取得
			$article_draft_res = model_login_admin_draft_basis::article_draft_get($draft_id);
			// 本人確認
			if($_SESSION['basic_id'] == $article_draft_res[0]['basic_id']) {
//				pre_var_dump($article_draft_res[0]['primary_id']);
				// 下書き削除
				 model_login_admin_draft_basis::article_draft_delete($article_draft_res[0]['primary_id']);
				header('Location: '.HTTP.'login/admin/draft/');
				return false;
			}
		}
		///////////////
		// 記事削除機能
		///////////////
		if($_GET['article_id'] && $_GET['delete'] == true) {
			$article_id = (int)$_GET['article_id'];
			// 記事データ取得
			$article_res = model_article_basis::article_get($article_id);
			// 本人確認
			if($_SESSION['basic_id'] == $article_res[0]['basic_id']) {
//				pre_var_dump($article_res[0]['primary_id']);
				// 記事削除
				 model_login_admin_post_basis::markdown_post_delete($article_res[0]['primary_id']);
				// サイト情報取得
				$site_data_array = basic::site_data_get();
				// 削除ディレクトリパス取得
				$directory_path = PATH.'app/theme/'.$site_data_array['theme'].'/controller/article/'.(int)$article_res[0]['primary_id'].'';
				// ディレクトリ削除
				basic::rmdirAll($directory_path);
				//////////////////////////newarticleディレクトリ生成/////////////////////////////////
				model_login_admin_post_basis::newarticle_dir_create($site_data_array);
				header('Location: '.HTTP.'login/admin/list/');
				return false;
			}

		}
		/////////////////
		// 下書き編集機能
		/////////////////
		if($_GET['draft_id'] && $_GET['edit'] == true) {
			$draft_id = (int)$_GET['draft_id'];
			// 記事データ取得
			$article_res = model_login_admin_draft_basis::article_draft_get($draft_id);
			// 本人確認
			if($_SESSION['basic_id'] == $article_res[0]['basic_id']) {
//				pre_var_dump($article_res);
//				pre_var_dump($_SESSION);

				$preview_array['title'] = $article_res[0]['title'];
				$preview_array['content'] = $article_res[0]['content'];
				$preview_array['draft_id'] = $article_res[0]['primary_id'];
				$preview_array['basic_id'] = $article_res[0]['basic_id'];
			// テンプレート読み込み
			require_once(PATH.'app/theme/admin/view/login/admin/post/template.php');
				return false;
			}
		}
		///////////////////////
		// 下書きプレビュー機能
		////////////////////////
		if($_GET['draft_id']) {
			$draft_id = (int)$_GET['draft_id'];
			// 記事データ取得
			$article_draft_res = model_login_admin_draft_basis::article_draft_get($draft_id);
			// 記事データHTML生成
			$article_data_array = model_article_html::article_html_create($article_draft_res);
			// テンプレート読み込み
			require_once(PATH.'app/theme/admin/view/login/admin/post/preview/template.php');
			return false;
		}
		///////////////////////
		// 投稿済み記事編集機能
		///////////////////////
		if($_GET['article_id'] && $_GET['edit'] == true) {
			$article_id = (int)$_GET['article_id'];
			// 記事データ取得
			$article_res = model_article_basis::article_get($article_id);
			// 本人確認
			if($_SESSION['basic_id'] == $article_res[0]['basic_id']) {
//				pre_var_dump($article_res);
//				pre_var_dump($_SESSION);
				$preview_array['title'] = $article_res[0]['title'];
				$preview_array['content'] = $article_res[0]['content'];
				$preview_array['article_id'] = $article_res[0]['primary_id'];
				$preview_array['basic_id'] = $article_res[0]['basic_id'];
			// テンプレート読み込み
			require_once(PATH.'app/theme/admin/view/login/admin/post/template.php');
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