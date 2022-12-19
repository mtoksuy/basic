<?php
class model_login_admin_template_html {
	//---------------------------------------------
	// common配下のファイルリストHTML生成
	//---------------------------------------------
	public static function view_common_list_html_create($view_common_list_array, $file_word) {
//		pre_var_dump($file_word);
//		if($file_word == 'drawer.php') {echo ' class="now"';}
		switch($file_word) {
			case 'drawer.php':

			break;
		}

		foreach($view_common_list_array as $key => $value) {
			if($value === 'drawer.php') {
				$now = '';
				if($file_word == 'drawer.php') {$now = ' class="now"';}
				$view_common_list_html .= '<li'.$now.' data-clip_name="'.$value.'"><a href="?file=drawer.php"><span class="description">ドロワー</span>'.$value.'</a></li>';
			}
				else if($value === 'footer.php') {
					$now = '';
					if($file_word == 'footer.php') {$now = ' class="now"';}
					$view_common_list_html .= '<li'.$now.' data-clip_name="'.$value.'"><a href="?file=footer.php"><span class="description">フッター</span>'.$value.'</a></li>';
				}
				else if($value === 'google_analytics.php') {
					$now = '';
					if($file_word == 'google_analytics.php') {$now = ' class="now"';}
					$view_common_list_html .= '<li'.$now.' data-clip_name="'.$value.'"><a href="?file=google_analytics.php"><span class="description">アナリティクス</span>'.$value.'</a></li>';
				}
				else if($value === 'head.php') {
					$now = '';
					if($file_word == 'head.php') {$now = ' class="now"';}
					$view_common_list_html .= '<li'.$now.' data-clip_name="'.$value.'"><a href="?file=head.php"><span class="description">ヘッド</span>'.$value.'</a></li>';
				}
				else if($value === 'head_footer.php') {
					$now = '';
					if($file_word == 'head_footer.php') {$now = ' class="now"';}
					$view_common_list_html .= '<li'.$now.' data-clip_name="'.$value.'"><a href="?file=head_footer.php"><span class="description">ヘッドフッター</span>'.$value.'</a></li>';
				}
				else if($value === 'header.php') {
					$now = '';
					if($file_word == 'header.php') {$now = ' class="now"';}
					$view_common_list_html .= '<li'.$now.' data-clip_name="'.$value.'"><a href="?file=header.php"><span class="description">ヘッダー</span>'.$value.'</a></li>';
				}
				else if($value === 'navi_slide_menu.php') {
					$now = '';
					if($file_word == 'navi_slide_menu.php') {$now = ' class="now"';}
					$view_common_list_html .= '<li'.$now.' data-clip_name="'.$value.'"><a href="?file=navi_slide_menu.php"><span class="description">ナビサイドメニュー</span>'.$value.'</a></li>';
				}
					else {
						$view_common_list_html .= '<li data-clip_name="'.$value.'">'.$value.'</li>';
					}
		}
		$now = '';
		if($file_word == 'common.css') {$now = ' class="now"';}
		$view_common_list_html = '<ul>
			<li'.$now.' data-clip_name="common.css"><a href="'.HTTP.'login/admin/template/"><span class="description">スタイルシート</span>common.css</a></li>
			'.$view_common_list_html.'</ul>';

		return $view_common_list_html;
	}
}