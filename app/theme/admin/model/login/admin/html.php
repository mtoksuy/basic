<?php
class model_login_admin_html {
	//--------------------------------
	// アドミン_ドロワーHTML生成
	//--------------------------------
	public static function admin_left_drawer_html_create($site_data_array, $now) {
		// 最終的に全てを結合させて出力させる変数
		$admin_left_drawer_html = '';
		// 今いるページに対してクラス付与
		$addClass = [
			'' => '', 
			'coreupdate' => '', 
			'post' => '', 
			'list' => '', 
			'draft' => '', 
			'fileupload' => '', 
			'filelist' => '', 
			'contactlist' => '', 
			'themeswitching' => '', 
			'page' => '', 
			'pagelist' => '', 
			'pagedraft' => '', 
			'rootedit' => '', 
			'template' => '', 
			'general' => '', 
			'usermanagement' => '', 
			'profile' => '', 
			'import' => '', 
			'plugin' => '', 
			'' => '', 
			'' => '', 
			'' => '', 
			'' => '', 
		];
		switch($now) {
			case '':
			case 'coreupdate':
			case 'post':
			case 'list':
			case 'draft':
			case 'fileupload':
			case 'filelist':
			case 'contactlist':
			case 'themeswitching':
			case 'page':
			case 'pagelist':
			case 'pagedraft':
			case 'rootedit':
			case 'template':
			case 'general':
			case 'usermanagement':
			case 'profile':
			case 'import':
			case 'plugin':
			case '':
				$addClass[$now] = ' class="now"';
			break;
		}
		// 基本パーツ
		$basis_border_parts = 
			'<ul class="border">
				<span>基本</span>
				<li'.$addClass[''].'>
					<a class="o_8" href="'.HTTP.'login/admin/">ホーム</a>
				</li>
				<li>
					<a class="o_8" href="'.HTTP.'" target="_blank">サイトを表示</a>
				</li>
			</ul>';

		// アップデートパーツ
		$update_unread_count_html = '';
		$response = file_get_contents('https://basic.dance/api/?basic_version_get=true');
		$json_decode_response = json_decode($response , true);
		if($site_data_array['basic_version'] < $json_decode_response['latest_basic_version']) {
			$update_unread_count_html = '<span class="contact_unread_count"> </span>';
		}
		$update_border_parts = 
			'<ul class="border">
				<span>アップデート機能</span>
				<li'.$addClass['coreupdate'].'>
					<a class="o_8" href="'.HTTP.'login/admin/coreupdate/">更新</a>
					'.$update_unread_count_html.'
				</li>
			</ul>';
		// ブログパーツ
		$blog_border_parts = 
			'<ul class="border">
				<span>ブログ機能</span>
				<li'.$addClass['post'].'>
					<a class="o_8" href="'.HTTP.'login/admin/post/" target="_blank">ブログを書く</a>
				</li>
				<li'.$addClass['list'].'>
					<a class="o_8" href="'.HTTP.'login/admin/list/">投稿一覧</a>
				</li>
				<li'.$addClass['draft'].'>
					<a class="o_8" href="'.HTTP.'login/admin/draft/">下書き一覧</a>
				</li>
			</ul>';
		// ファイルパーツ
		$file_border_parts = 
			'<ul class="border">
				<span>ファイル機能</span>
				<li'.$addClass['fileupload'].'>
					<a class="o_8" href="'.HTTP.'login/admin/fileupload/">ファイルアップロード</a>
				</li>

				<li'.$addClass['filelist'].'>
					<a class="o_8" href="'.HTTP.'login/admin/filelist/">ファイル一覧</a>
				</li>
			</ul>';
		// お問い合わせパーツ
		$contact_unread_count_html = '';
		if((int)$site_data_array['contact_unread_count'] > 0) {
			$contact_unread_count_html = '<span class="contact_unread_count"> </span>';
		}
		$contact_border_parts = 
			'<ul class="border">
				<span>お問い合わせ機能</span>
				<li'.$addClass['contactlist'].'>
					<a class="o_8" href="'.HTTP.'login/admin/contactlist/">お問い合わせ一覧</a>
					'.$contact_unread_count_html.'
				</li>
			</ul>';
		// テーマパーツ
		$themes_border_parts = 
			'<ul class="border">
				<span>テーマ機能</span>
				<li'.$addClass['themeswitching'].'>
					<a class="o_8" href="'.HTTP.'login/admin/themeswitching/">テーマ切り替え</a>
				</li>
			</ul>';
		// ページパーツ
		$page_border_parts = 
			'<ul class="border">
				<span>ページ機能</span>
				<li'.$addClass['page'].'>
					<a class="o_8" href="'.HTTP.'login/admin/page/" target="_blank">ページ作成</a>
				</li>
				<li'.$addClass['pagelist'].'>
					<a class="o_8" href="'.HTTP.'login/admin/pagelist/">ページ一覧</a>
				</li>
				<li'.$addClass['pagedraft'].'>
					<a class="o_8" href="'.HTTP.'login/admin/pagedraft/">下書き一覧</a>
				</li>
			</ul>';
		// トップページ編集パーツ
		$editTopPage_border_parts = '
			<ul class="border">
				<span>トップページ編集</span>
				<li'.$addClass['rootedit'].'>
					<a class="o_8" href="'.HTTP.'login/admin/rootedit/" target="_blank">トップページ編集</a>
				</li>
			</ul>';
		// テンプレート編集パーツ
		$editTemplate_border_parts = 
			'<ul class="border">
				<span>テンプレート編集</span>
				<li'.$addClass['template'].'>
					<a class="o_8" href="'.HTTP.'login/admin/template/" target="_blank">テンプレート編集</a>
				</li>
			</ul>';
		// サイト設定パーツ
		$siteSettings_border_parts = 
			'<ul class="border">
				<span>サイト設定</span>
				<li'.$addClass['general'].'>
					<a class="o_8" href="'.HTTP.'login/admin/general/">一般設定</a>
				</li>
				<li'.$addClass['usermanagement'].'>
					<a class="o_8" href="'.HTTP.'login/admin/usermanagement/">ユーザーの管理</a>
				</li>
			</ul>';
		// アカウント設定パーツ
		$accountSettings_border_parts = 
			'<ul class="border">
				<span>アカウント設定</span>
				<li'.$addClass['profile'].'>
					<a class="o_8" href="'.HTTP.'login/admin/profile/">プロフィール設定</a>
				</li>
			</ul>';
		// ツールパーツ
		$toolSettings_border_parts = 
			'<ul class="border">
				<span>ツール設定</span>
				<li'.$addClass['import'].'>
					<a class="o_8" href="'.HTTP.'login/admin/import/">インポート</a>
				</li>
			</ul>';
		// プラグインパーツ
		//
		// プラグイン機能 プロトタイプ実装
		//
		$dir = PATH.'app/plugin';
		$plugin_list_html = '';
		$now_class_name = '';
		foreach (glob("$dir/*", GLOB_ONLYDIR)  as $folder) {
			if($now == basename($folder)) {$now_class_name = ' class="now"';}
				$plugin_list_html .= ('<li'.$now_class_name.'>
					<a class="o_8" href="'.HTTP.'login/admin/plugin/'.basename($folder).'/">'.basename($folder).'</a>
				</li>');
			// 初期化
			$now_class_name = '';
		}
		$pluginSettings_border_parts = 
			'<ul class="border">
				<span>プラグイン設定</span>
				<li'.$addClass['plugin'].'>
					<a class="o_8" href="'.HTTP.'login/admin/plugin/">プラグイン追加</a>
					'.$plugin_list_html.'
				</li>
			</ul>';

//var_dump($_SESSION['role']);

		// ロール振り分け
		switch($_SESSION['role']) {
		// 管理者
		case 'admin':
			// 管理者出力
			$admin_left_drawer_html = $basis_border_parts.$update_border_parts.$blog_border_parts.$file_border_parts.$contact_border_parts.$themes_border_parts.$page_border_parts.$editTopPage_border_parts.$editTemplate_border_parts.$siteSettings_border_parts.$accountSettings_border_parts.$toolSettings_border_parts.$pluginSettings_border_parts;
		break;
		// 編集者
		case 'editor':
			// 編集者出力
			$admin_left_drawer_html = $basis_border_parts.$blog_border_parts.$file_border_parts.$contact_border_parts.$themes_border_parts.$page_border_parts.$editTopPage_border_parts.$editTemplate_border_parts.$accountSettings_border_parts.$pluginSettings_border_parts;
		break;
		// 投稿者
		case 'postor':
			// 投稿者出力
			$admin_left_drawer_html = $basis_border_parts.$blog_border_parts.$file_border_parts.$accountSettings_border_parts;
		break;
		}
		return $admin_left_drawer_html;
	}
}