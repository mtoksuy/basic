<?php
class model_login_admin_general_html {
	//----------------------
	// 一般設定HTML生成
	//----------------------
	public static function general_html_create($general_data_array) {
//		pre_var_dump($general_data_array);
		// icoHTML
		$ico_html = ($general_data_array['icon']) ? '<img width="48" height="48" src="'.HTTP.'app/assets/img/icon/'.$general_data_array['icon'].'">':'';
		// icoHTML
		$apple_touch_icon_html = ($general_data_array['apple_touch_icon']) ? '<img width="128" height="128"src="'.HTTP.'app/assets/img/icon/'.$general_data_array['apple_touch_icon'].'">':'';
		// 圧縮化HTML
		$compression_html = ($general_data_array['compression'] == 1) ? '<option value="1" selected>有効化</option><option value="0">無効化</option>':'<option value="1">有効化</option><option value="0" selected>無効化</option>';
		$general_html = '
			<div class="general">
				<div class="general_inner">
					<form method="post" action="" class="general_form" enctype="multipart/form-data">
						<div class="block">
							<label for="site_name">サイトのタイトル</label>
							<input type="text" placeholder="サイトのタイトル" value="'.$general_data_array['title'].'" required="required" name="site_name" id="site_name">
						</div>
						<div class="block">
							<label for="site_summary">サイトの概要</label>
							<textarea id="site_summary" placeholder="サイトの概要" name="site_summary">'.$general_data_array['description'].'</textarea>
						</div>
						<div class="block">
							<label for="site_icon">サイトのicon(推奨48px×48px)</label>
							'.$ico_html.'
							<input id="site_icon" type="file" name="site_icon" accept="image/vnd.microsoft.icon, image/x-icon">
						</div>
						<div class="block">
							<label for="site_icon">サイトのapple-touch-icon(推奨512px×512px)</label>
							'.$apple_touch_icon_html.'
							<input id="apple_touch_icon" type="file" name="apple_touch_icon" accept="image/*">
						</div>
						<div class="block">
							<label for="compression">サイトの自動高速化</label>
							<select name="compression" id="compression">
								'.$compression_html.'
							</select>
						</div>
						<div class="block">
							<label for="article_view_num">1ページに表示する最大投稿数</label>
							<input name="article_view_num" id="article_view_num" type="number" step="1" min="1" value="'.$general_data_array['article_view_num'].'">
						</div>

						<div class="block">
							<label for="admin_theme_color">管理画面のテーマカラー</label>
							<fieldset>
								<div class="admin_theme_color_option">
									<input name="admin_theme_color" id="admin_color_light" type="radio" value="light">
									<label for="admin_color_light">ライト</label>
									<div class="color_view">
										<div class="color_view_inner">
											<div class="color_block_1 light_1">

											</div>
											<div class="color_block_2 light_2">

											</div>
											<div class="color_block_3 light_3">

											</div>
											<div class="color_block_4 light_4">

											</div>	
										</div>
									</div>
								</div> <!-- admin_theme_color_option -->
								<div class="admin_theme_color_option">
									<input name="admin_theme_color" id="admin_color_light" type="radio" value="light">
									<label for="admin_color_light">ライト</label>
									<div class="color_view">
										<div class="color_view_inner">
											<div class="color_block_1 light_1">

											</div>
											<div class="color_block_2 light_2">

											</div>
											<div class="color_block_3 light_3">

											</div>
											<div class="color_block_4 light_4">

											</div>	
										</div>
									</div>
								</div> <!-- admin_theme_color_option -->







	
							</fieldset>
						</div> <!-- <div class="block"> -->





				<!-- 
						<label for="site_language">サイトの言語</label>
						<input type="text" placeholder="サイトの言語" value="" name="site_language" id="site_language">
				
						<label for="date_format">日付形式</label>
						<input type="text" placeholder="日付形式" value="" name="date_format" id="date_format">
				
						<label for="time_format">時刻形式</label>
						<input type="text" placeholder="時刻形式" value="" name="time_format" id="time_format">
				-->
						<input type="submit" class="submit" value="変更" name="submit">
					</form>
				</div>
			</div>';
		return $general_html;
	}
}