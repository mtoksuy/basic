<?php
class model_login_admin_coreupdate_html {
	//------------------------------
	// コアアップデートHTML生成
	//------------------------------
	public static function coreupdate_html_create() {
		// サイト情報取得
		$site_data_array = basic::site_data_get();
		$response = file_get_contents('https://basic.dance/api/?basic_version_get=true'); $json_decode_response = json_decode($response , true);
		if($site_data_array['basic_version'] < $json_decode_response['latest_basic_version']) {
			$text = '<a href="'.HTTP.'login/admin/coreupdate/?coreupdate=true">Basicを最新のバージョンにする</a>';
		}
		else {
			$text = '<p>最新バージョンの Basic をお使いです。</p>';
	}
		$coreupdate_html = 
			'<div class="coreupdate">
				<div class="coreupdate_inner">
					<h2>Basic の更新</h2>
					<p>更新についての詳細はこちらをご覧ください。</p>
					<p>現在使用のバージョン: '.$site_data_array['basic_version'].'</p>
					<p>Basic最新のバージョン: '.$json_decode_response['latest_basic_version'].'</p>
						'.$text.'
				</div>
			</div>';
		return $coreupdate_html;
	}


}