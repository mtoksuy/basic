<?php
class model_login_admin_coreupdate_html {
	//------------------------------
	// コアアップデートHTML生成
	//------------------------------
	public static function coreupdate_html_create() {
		$alert_text = '';
		// サイト情報取得
		$site_data_array = basic::site_data_get();
		// コンテキスト
		$context = stream_context_create([
			'ssl' => [
				'allow_self_signed' => true,
				'verify_peer'            => false,
				'verify_peer_name' => false,
			],
		]);
		// basic_version_get API出力受け取る
		$response = file_get_contents('https://basic.dance/api/?basic_version_get=true', false, $context);
		$json_decode_response = json_decode($response , true);
		// バージョン判定
		$result = basic::compareVersions($site_data_array['basic_version'], $json_decode_response['latest_basic_version']);
		if($result < 0) {
			// $update_action_text
			$update_action_text = '<a href="'.HTTP.'login/admin/coreupdate/?coreupdate=true">Basicを最新のバージョンにする</a>';
		}
		else {
			$update_action_text = '<p>最新バージョンの Basic をお使いです。</p>';
		}
		 // アップデート範囲内に入るディレクトリのパスリスト
		$dir_array = array(
			PATH,
			PATH.'tmp/',
			PATH.'setting/',
			PATH.'app/',
			PATH.'app/theme/',
			PATH.'app/theme/admin/',
		);
		foreach($dir_array as $key => $value) {
			// ディレクトリの権限情報を取得する
			$dir_permission_info_data_array = model_login_admin_coreupdate_basis::dir_permission_info_get($value);
			// ディレクトリが存在する場合
			if($dir_permission_info_data_array['is_file_exists']) {
//				pre_var_dump($dir_permission_info_data_array);
				// ローカル環境
				if(preg_match('/localhost/',$_SERVER["HTTP_HOST"])) {
					// 何もしない
				}
				// 本番環境
				else {
					// Apache サーバーの場合
					if(strpos($_SERVER['SERVER_SOFTWARE'], 'Apache') !== false) {
						if(!($dir_permission_info_data_array['ownerName'] === 'apache')) {
//							pre_var_dump($dir_permission_info_data_array);
							$alert_text .= '<div class="alert"><p>注意</p><p>ディレクトリ：'.$dir_permission_info_data_array['directory'].'のユーザー名が apache ではないので apache に変更してください。</p></div>';
						}
					}
					// Nginx サーバーの場合
					elseif(strpos($_SERVER['SERVER_SOFTWARE'], 'nginx') !== false) {
						if(!($dir_permission_info_data_array['ownerName'] === 'nginx')) { // www-dataの配慮も必要かも
//							pre_var_dump($dir_permission_info_data_array);
							$alert_text .= '<div class="alert"><p>注意</p><p>ディレクトリ：'.$dir_permission_info_data_array['directory'].'のユーザー名が nginx ではないので nginx に変更してください。</p></div>';
						}
					}
					// それ以外のサーバーの場合
					else {

					}
				} // else {
			} // if($dir_permission_info_data_array['is_file_exists']) {
		} // foreach($dir_array as $key => $value) {

		$coreupdate_html = 
			'<div class="coreupdate">
				<div class="coreupdate_inner">
					<h2>Basic の更新</h2>
					<p>更新についての詳細はこちらをご覧ください。</p>
					<p>現在使用のバージョン: '.$site_data_array['basic_version'].'</p>
					<p>Basic最新のバージョン: '.$json_decode_response['latest_basic_version'].'</p>
						'.$update_action_text.'
						'.$alert_text.'
				</div>
			</div>';
		return $coreupdate_html;
	}


}