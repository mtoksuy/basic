<?php
class model_login_admin_rootedit_html {
	//---------------------------------------------
	// common配下のファイルリストHTML生成
	//---------------------------------------------
	public static function view_common_list_html_create($view_common_list_array, $file_word) {
//		pre_var_dump($file_word);
//		if($file_word == 'drawer.php') {echo ' class="now"';}
		$view_common_list_html = '';
		switch($file_word) {
			case 'drawer.php':

			break;
		}
		$now = '';
		if($file_word == 'content.php') {$now = ' class="now"';}
		$view_common_list_html = '<ul>
			<li'.$now.' data-clip_name="content.php"><a href="'.HTTP.'login/admin/rootedit/"><span class="description">トップページ</span>content.php</a></li>
			'.$view_common_list_html.'</ul>';

		return $view_common_list_html;
	}
}