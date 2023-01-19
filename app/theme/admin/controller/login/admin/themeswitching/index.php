<?php 
	if($_SESSION['basic_id']) {
		$now = 'themeswitching';
		$content_html = '
			<h1>テーマ切り替え 実装中</h1>
			<p>Basic version .0.2</p>
			<p style="border-bottom:1px solid var(--theme-border-color2);"> </p>';

		// エンティティ
		$get = basic::get_security();
		if($get) {
			// テーマ切り替え
			if($get['theme_name'] && $get['active'] == 'true') {
				// テーマ切り替え
				model_login_admin_themeswitching_basis::themeswitching($get);
				// テーマリストarray取得
				$theme_list_array = model_login_admin_themeswitching_basis::theme_list_array_get();
				// テーマリストhtml生成
				$theme_list_html = model_login_admin_themeswitching_html::theme_list_html_create($theme_list_array);
				$content_html = $theme_list_html;
				// 移動
//				header('Location: '.HTTP.'login/admin/themeswitching/');
//				exit;	
			}
			// テーマ詳細
			else if($get['theme_name'] && $get['detail_view'] == 'true') {
				// テーマ詳細html生成
				$theme_detail_view_html = model_login_admin_themeswitching_html::theme_detail_view_html_create($get);
				$content_html = $theme_detail_view_html;
			}
		}
		// デフォルト表示
		else {
			// テーマリストarray取得
			$theme_list_array = model_login_admin_themeswitching_basis::theme_list_array_get();
			// テーマリストhtml生成
			$theme_list_html = model_login_admin_themeswitching_html::theme_list_html_create($theme_list_array);
			$content_html = $theme_list_html;
		}
		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>