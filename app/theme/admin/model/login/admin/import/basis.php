<?php 
class model_login_admin_import_basis {
	//------------------------
	// インポートを走らせる
	//------------------------
	public static function import_run($xml_string, $import_name) {
		if($import_name == 'wordpress') {

		}
		else {
			return;
		}
		$export_file_article_array = array();
		$title = '';
		$content = '';
		$article_i = 0;
		
		$items = explode('<item>', $xml_string); // itemタグごとに分割
		array_shift($items); // 最初の要素は不要なので削除
		// item毎繰り返し
		foreach($items as $item) {
			preg_match('/<wp:post_type>(.*?)<\/wp:post_type>/', $item, $item_array);
			preg_match('/post/', $item_array[1], $item_array_array);
			// 一旦記事のみ絞り込み
			if($item_array_array) {
				// 初期化
				$item_array_array = '';
				preg_match('/<wp:status>(.*?)<\/wp:status>/', $item, $item_array);
				preg_match('/publish/', $item_array[1], $item_array_array);
				// さらに公開のみ絞り込み
				if($item_array_array) {
					$title_start = strpos($item, '<title><![CDATA[') + strlen('<title><![CDATA[');
					$title_end = strpos($item, ']]></title>');
					$title = substr($item, $title_start, $title_end - $title_start);
					$content_start = strpos($item, '<content:encoded><![CDATA[') + strlen('<content:encoded><![CDATA[');
					$content_end = strpos($item, ']]></content:encoded>');
					$content = substr($item, $content_start, $content_end - $content_start);
					$content = preg_replace('/<\!-- wp:paragraph -->/', '', $content);
					$content = preg_replace('/<\!-- \/wp:paragraph -->/', '', $content);
					$export_file_article_array[$article_i]['title'] = $title;
					$export_file_article_array[$article_i]['content'] = $content;
					$article_i++;
				} // if($item_array_array) {
			} // if($item_array_array) {
		} // foreach($items as $item) {
		//pre_var_dump($export_file_article_array);
		// 登録、ディレクトリ作成、記事OGP画像生成、単独で静的化+圧縮化
		foreach($export_file_article_array as $key => $value) {
			// 登録
			$query = model_db::query("
				INSERT INTO article 
				(
					basic_id, 
					title, 
					content
				) 
				VALUES (
					'".$_SESSION['basic_id']."',
					'".$value['title']."',
					'".$value['content']."'
				)");
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
			if(file_exists(PATH.'setting/master/custom_article.php')) {
				// ファイル複製
				copy(PATH.'setting/master/custom_article.php', $directory_path.'/index.php');
			}
			// custom_articleがない場合
			else {
				// ファイル複製
				copy(PATH.'setting/master/article.php', $directory_path.'/index.php');
			}
			// 記事OGP画像生成
			model_login_admin_post_basis::media_article_ogp_create($res, $site_data_array);
			// 静的化+圧縮化する際のリストarray取得
		//			$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('article', (int)$res[0]['primary_id']);
			// 単独で静的化+圧縮化する
			$html_gzip_create_list_array = 
				[
					[
						'http_path' => HTTP.'article/'.$res[0]['primary_id'].'/', 
						'directory_path' => $directory_path, 
					]
				];
			// multi版：静的化+圧縮化
			basic::multi_html_gzip_create($html_gzip_create_list_array);
		} // foreach($export_file_article_array as $key => $value) {
		//////////////////////////sitemap_xml/////////////////////////////////
		$sitemap_xml_path = PATH.'sitemap/sitemap.xml';
		// 全記事リスト取得
		$article_all_list_res = model_sitemap_basis::article_all_list_get();
		// pageリスト取得
		$page_all_list_res = model_sitemap_basis::page_all_list_get();
		// sitemap.xml生成
		$sitemap_xml = model_sitemap_html::sitemap_xml_create($article_all_list_res, $page_all_list_res);
		///////////////////////////////////////////////////////////////////////
		header('Location: '.HTTP.'login/admin/');
	}



}