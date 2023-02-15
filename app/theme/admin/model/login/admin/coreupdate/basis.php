<?php 
class model_login_admin_coreupdate_basis {
	//-----------------------------------
	// Basicを最新のバージョンにする
	//-----------------------------------
	public static function basic_coreupdate() {
		// サイト情報取得
		$site_data_array = basic::site_data_get();
		// 最新バージョン取得
		$response = file_get_contents('https://basic.dance/api/?basic_version_get=true');
		$json_decode_response = json_decode($response , true);
		// 最新バージョンより低い場合に起動
		if($site_data_array['basic_version'] < $json_decode_response['latest_basic_version']) { 
			// tmpフォルダ作成
			if(!file_exists(PATH.'/tmp')) {
				basic::dir_create(PATH.'/tmp');
			}
			// 最新バージョンダウンロード
			$fileData = file_get_contents('https://github.com/mtoksuy/basic/archive/refs/tags/v'.$json_decode_response['latest_basic_version'].'.zip');
			// tmp配下へ一時的に保存
			file_put_contents(PATH.'/tmp/v'.$json_decode_response['latest_basic_version'].'.zip',$fileData);
			// 圧縮・解凍するためのオブジェクト生成
			$zip = new ZipArchive();
			// 解凍
			$result = $zip->open(PATH.'/tmp/v'.$json_decode_response['latest_basic_version'].'.zip');
			if($result === true) {
				// tmp配下へ配置
				$zip->extractTo(PATH.'/tmp');
				$zip->close();
			}
		}  // if($site_data_array['basic_version'] < $json_decode_response['latest_basic_version']) { 
		// setting書き換え
		basic::copy_dir(PATH.'tmp/basic-'.$json_decode_response['latest_basic_version'].'/setting', PATH.'setting');
		// app/theme/admin書き換え
		basic::copy_dir(PATH.'tmp/basic-'.$json_decode_response['latest_basic_version'].'/app/theme/admin', PATH.'app/theme/admin');
		// バージョン書き換え
		model_db::query("
			UPDATE setting SET basic_version = '".$json_decode_response['latest_basic_version']."'
			WHERE setting_id = 1
		");
		// tmp削除
		basic::removeDir(PATH.'tmp');
	}
}