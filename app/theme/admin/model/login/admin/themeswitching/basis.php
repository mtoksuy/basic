<?php
class model_login_admin_themeswitching_basis {
	//----------------------
	// 一般データarray取得
	//----------------------
	public static function theme_list_array_get() {
		$result = glob(PATH . 'app/theme/*', GLOB_ONLYDIR);
		foreach ($result as $key => $value) {
			// 特定の文字列から後ろを取得
			$dir_name = mb_substr($value, mb_strrpos($value, '/') + 1, mb_strlen($value)); // MS-06S
			if (!($dir_name == 'admin')) {
				$theme_list_array[] = $dir_name;
			}
		} // foreach($result as $key => $value) {
		return $theme_list_array;
	}
	//------------------
	// テーマ切り替え
	//------------------
	public static function themeswitching($get) {
		model_db::query("
			UPDATE setting 
			SET theme = '" . $get['theme_name'] . "'
			WHERE setting_id = 1
		");
	}
	//----------------------
	// 記事専用のcron作成
	//----------------------
	public static function cron_add_article($site_data_array) {
		// 重複した稼働中cron確認
		$res = model_db::query("
			SELECT *
			FROM cron
			WHERE complete = 0
			AND target = '" . $site_data_array['theme'] . "'
			AND type = 'article'
		");
		// 重複した稼働中cronがなければ登録
		if (!$res) {
			// cron登録
			model_db::query("
			INSERT INTO cron (
				target, 
				type
			) 
			VALUES (
				'" . $site_data_array['theme'] . "', 
				'article'
			)
		");
		}
	}
	//-------------------------------------------------------------
	// テーマ切り替え先のページ、ライター物理ファイル再生成
	//-------------------------------------------------------------
	public static function regenerate_physical_files($site_data_array) {
		// 記事情報取得
		$res = model_db::query("
			SELECT *
			FROM page
			WHERE del = 0
			ORDER BY primary_id DESC
		");
		// ページ
		foreach ($res as $key => $value) {
			// ディレクトリ作成パス取得
			$directory_path = PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/' . $value['permalink'] . '';
			// ディレクトリがなかった場合
			if (!file_exists($directory_path)) {
				// ディレクトリ作成
				basic::dir_create($directory_path);
				// ファイル複製
				copy(PATH . 'setting/master/page.php', $directory_path . '/index.php');
				// 静的化+圧縮化する際のリストarray取得
				$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('page', $value['permalink']);
				// multi版：静的化+圧縮化
				basic::multi_html_gzip_create($html_gzip_create_list_array);
			}
			// ディレクトリがあった場合
			else if (file_exists($directory_path)) {
			}
			// htmlがなかった場合
			if (!file_exists($directory_path . '/index.html')) {
				// 静的化+圧縮化する際のリストarray取得
				$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('page', $value['permalink']);
				// multi版：静的化+圧縮化
				basic::multi_html_gzip_create($html_gzip_create_list_array);
			}
		} // foreach($res as $key => $value) {
		// ライター取得
		$res = model_db::query("
			SELECT *
			FROM user
			WHERE del = 0
		");

		// ライター
		foreach ($res as $key => $value) {
			// ディレクトリ作成パス取得
			$directory_path = PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/writer/' . $value['basic_id'] . '';
			// ディレクトリがなかった場合
			if (!file_exists($directory_path)) {
				// ディレクトリ作成
				basic::dir_create($directory_path);
				// ファイル複製
				copy(PATH . 'setting/master/writer.php', $directory_path . '/index.php');
				// 静的化+圧縮化する際のリストarray取得
				// $html_gzip_create_list_array = basic::html_gzip_create_list_array_get('page', $value['permalink']);
				// 手動代替
				$html_gzip_create_list_array = array(
					0 => array(
						'http_path'         => HTTP . 'writer/' . $value['basic_id'] . '/',
						'directory_path' => PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/writer/' . $value['basic_id'] . '',
					),
				); // $html_gzip_create_list_array = array(
				// multi版：静的化+圧縮化
				basic::multi_html_gzip_create($html_gzip_create_list_array);
			}
			// htmlがなかった場合
			if (!file_exists($directory_path . '/index.html')) {
				// 手動代替
				$html_gzip_create_list_array = array(
					0 => array(
						'http_path'         => HTTP . 'writer/' . $value['basic_id'] . '/',
						'directory_path' => PATH . 'app/theme/' . $site_data_array['theme'] . '/controller/writer/' . $value['basic_id'] . '',
					),
				); // $html_gzip_create_list_array = array(
				// multi版：静的化+圧縮化
				basic::multi_html_gzip_create($html_gzip_create_list_array);
			}
		}
	}
}
