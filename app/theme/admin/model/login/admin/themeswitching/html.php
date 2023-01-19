<?php
class model_login_admin_themeswitching_html {
	//-------------------------
	// テーマリストhtml生成
	//-------------------------
	public static function theme_list_html_create($theme_list_array) {
		// サイト情報取得
		$site_data_array = basic::site_data_get();
		foreach($theme_list_array as $key => $value) {
//			pre_var_dump(PATH.'app/theme/'.$value.'/readme.txt');
			// screenshot_http取得
			if(file_exists(PATH.'app/theme/'.$value.'/assets/theme_info/screenshot.jpg') || file_exists(PATH.'app/theme/'.$value.'/assets/theme_info/screenshot.png')) {
				$glob_screenshot = glob(PATH.'app/theme/'.$value.'/assets/theme_info/screenshot.*');
//				pre_var_dump($glob_screenshot[0]);
				$screenshot_path = $glob_screenshot[0];
				// 特定の文字列から後ろを取得
				$screenshot_name = mb_substr($screenshot_path, mb_strrpos($screenshot_path, '/') + 1, mb_strlen($screenshot_path)); // MS-06S
				$screenshot_http = HTTP.'app/theme/'.$value.'/assets/theme_info/'.$screenshot_name;
/*
詳細処理で使う
				pre_var_dump(PATH.'app/theme/'.$value.'/readme.txt');
				$readme_txt = file_get_contents(PATH.'app/theme/'.$value.'/readme.txt');
//				pre_var_dump($readme_txt);
				preg_match('/Themename:(.*?)\n/', $readme_txt, $readme_txt_array);
				pre_var_dump($readme_txt_array[1]);
				// 改行を消す&タブ&空白削除
				$Themename = str_replace(array("\r\n", "\r", "\n", "\t", " ", "　"), '', $readme_txt_array[1]);
				pre_var_dump($Themename);
*/
			} // if(file_exists(PATH.'app/theme/'.$value.'/screenshot.jpg') || file_exists(PATH.'app/theme/'.$value.'/screenshot.png')) {
			else {
				$screenshot_http = HTTP.'app/theme/admin/assets/img/common/no_image_1.png';
			}
			/////////////////////////////////////////////////////////////////////////////////////////////
			// アクティブli
			if($value == $site_data_array['theme']) {
				$theme_active_button_html = 
					'<div class="theme_active_button">
						<a class="" href="button">
							有効中
						</a>
					</div>';
					// li_html
					$active_li_html = 
						'<li>
							<div class="theme_block">
								<div class="theme_block_inner">
									<a class="" href="'.HTTP.'login/admin/themeswitching/?theme_name='.$value.'&detail_view=true">
										<img class="theme_screenshot" src="'.$screenshot_http.'">
										<div class="theme_description">
											<div class="theme_description_inner">
												テーマの詳細
											</div>
										</div>
									</a>
									<div class="theme_name active">
										<a class="" href="'.HTTP.'login/admin/themeswitching/?theme_name='.$value.'&detail_view=true">
												有効中：'.$value.'
										</a>
									</div>
								</div>
							</div>
						</li>';
			}
				// 非アクティブli
				else {
					$theme_active_button_html = 
						'<div class="theme_active_button">
							<a class="" href="'.HTTP.'login/admin/themeswitching/?theme_name='.$value.'&active=true">
								有効化
							</a>
						</div>';
					// li_html
					$li_html .= 
						'<li>
							<div class="theme_block">
								<div class="theme_block_inner">
									<a class="" href="'.HTTP.'login/admin/themeswitching/?theme_name='.$value.'&detail_view=true">
										<img class="theme_screenshot" src="'.$screenshot_http.'">
										<div class="theme_description">
											<div class="theme_description_inner">
												テーマの詳細
											</div>
										</div>
									</a>
									<div class="theme_name">
										<a class="" href="'.HTTP.'login/admin/themeswitching/?theme_name='.$value.'&detail_view=true">
												'.$value.'
										</a>
										'.$theme_active_button_html.'
									</div>
								</div>
							</div>
						</li>';
			}
		} // foreach($theme_list_array as $key => $value) {

			$theme_list_html = 
				'<div class="theme_list">
					<div class="theme_list_inner">
						<ul>
							'.$active_li_html.'
							'.$li_html.'
						</ul>
					</div>
				</div>';



		return $theme_list_html;
	}
	//----------------------
	// テーマ詳細html生成
	//----------------------
	public static function theme_detail_view_html_create($get) {
		// サイト情報取得
		$site_data_array = basic::site_data_get();
		// readmeがある場合
		if(file_exists(PATH.'app/theme/'.$get['theme_name'].'/assets/theme_info/readme.txt')) {
//			pre_var_dump($get);
			$readme_txt_content = file_get_contents(PATH.'app/theme/'.$get['theme_name'].'/assets/theme_info/readme.txt');
			// Theme Name取得
			preg_match('/Theme Name:(.*?)\n/', $readme_txt_content, $readme_txt_content_array);
			$theme_name = preg_replace('/^ |\n|\r|\r\n/', '', $readme_txt_content_array[1]);
			// Theme URL取得
			preg_match('/Theme URL:(.*?)\n/', $readme_txt_content, $readme_txt_content_array);
			$theme_url = preg_replace('/^ |\n|\r|\r\n/', '', $readme_txt_content_array[1]);
			// Author取得
			preg_match('/Author:(.*?)\n/', $readme_txt_content, $readme_txt_content_array);
			$author = preg_replace('/^ |\n|\r|\r\n/', '', $readme_txt_content_array[1]);
			// Author取得
			preg_match('/Author:(.*?)\n/', $readme_txt_content, $readme_txt_content_array);
			$author = preg_replace('/^ |\n|\r|\r\n/', '', $readme_txt_content_array[1]);
			// Requires at least取得
			preg_match('/Requires at least:(.*?)\n/', $readme_txt_content, $readme_txt_content_array);
			$requires_at_least = preg_replace('/^ |\n|\r|\r\n/', '', $readme_txt_content_array[1]);
			// Version取得
			preg_match('/Version:(.*?)\n/', $readme_txt_content, $readme_txt_content_array);
			$version = preg_replace('/^ |\n|\r|\r\n/', '', $readme_txt_content_array[1]);
			// Stable Version取得
			preg_match('/Stable Version:(.*?)\n/', $readme_txt_content, $readme_txt_content_array);
			$stable_version = preg_replace('/^ |\n|\r|\r\n/', '', $readme_txt_content_array[1]);
			// Description取得
			preg_match('/Description:(.*?)\n/', $readme_txt_content, $readme_txt_content_array);
			$description = preg_replace('/^ |\n|\r|\r\n/', '', $readme_txt_content_array[1]);
			// License取得
			preg_match('/License:(.*?)\n/', $readme_txt_content, $readme_txt_content_array);
			$license = preg_replace('/^ |\n|\r|\r\n/', '', $readme_txt_content_array[1]);
			// License URI取得
			preg_match('/License URI:(.*?)\n/', $readme_txt_content, $readme_txt_content_array);
			$license_uri = preg_replace('/^ |\n|\r|\r\n/', '', $readme_txt_content_array[1]);
			// Tags URI取得
			preg_match('/Tags:(.*?)\n/', $readme_txt_content, $readme_txt_content_array);
			$tags = preg_replace('/^ |\n|\r|\r\n/', '', $readme_txt_content_array[1]);

			$theme_detail_data_array = array(
				'theme_name'       => $theme_name, 
				'theme_url'            => $theme_url, 
				'author'                  => $author, 
				'requires_at_least' => $requires_at_least, 
				'version'                 => $version, 
				'stable_version'     => $stable_version, 
				'description'          => $description, 
				'license'                 => $license, 
				'license_uri'           => $license_uri, 
				'tags'                      => $tags, 
			);
			// screenshot_http取得
			if(file_exists(PATH.'app/theme/'.$get['theme_name'].'/assets/theme_info/screenshot.jpg') || file_exists(PATH.'app/theme/'.$get['theme_name'].'/assets/theme_info/screenshot.png')) {
				$glob_screenshot = glob(PATH.'app/theme/'.$get['theme_name'].'/assets/theme_info/screenshot.*');
				$screenshot_path = $glob_screenshot[0];
				// 特定の文字列から後ろを取得
				$screenshot_name = mb_substr($screenshot_path, mb_strrpos($screenshot_path, '/') + 1, mb_strlen($screenshot_path)); // MS-06S
				$screenshot_http = HTTP.'app/theme/'.$get['theme_name'].'/assets/theme_info/'.$screenshot_name;
			}
			else {
				$screenshot_http = HTTP.'app/theme/admin/assets/img/common/no_image_1.png';
			}
			// 非アクティブのみ theme_active_button_html 生成
			if(!($get['theme_name'] == $site_data_array['theme'])) {
				$theme_active_button_html = 
					'<div class="theme_active_button">
						<a class="" href="'.HTTP.'login/admin/themeswitching/?theme_name='.$theme_detail_data_array['theme_name'].'&active=true">
							有効化
						</a>
					</div>';
			}
			else {
				$theme_active_button_html = 
					'<div class="theme_active_button">
						<a class="" href="'.HTTP.'login/admin/themeswitching/?theme_name='.$theme_detail_data_array['theme_name'].'&active=true">
							有効中
						</a>
					</div>';
			}
			$theme_detail_view_html = '
				<div class="theme_detail_view">
					<div class="theme_detail_view_inner">
						<div class="theme_detail_view_inner_left">
							<img width="" height="" src="'.$screenshot_http.'">
						</div>
						<div class="theme_detail_view_inner_right">
							<h2 class="theme_name">'.$theme_detail_data_array['theme_name'].'<span class="theme_version">バージョン: '.$theme_detail_data_array['version'].'</span></h2>
							<p class="author">作者：<a href="'.$theme_detail_data_array['theme_url'].'">'.$theme_detail_data_array['author'].'</a></p>
							<p class="description">'.$theme_detail_data_array['description'].'</p>
							<p class="tags">タグ：'.$theme_detail_data_array['tags'].'</p>
							'.$theme_active_button_html.'
						</div>
					</div>
				</div>';
		} // if(file_exists(PATH.'app/theme/'.$get['theme_name'].'/assets/theme_info/readme.txt')) {
		return $theme_detail_view_html;
	}



}