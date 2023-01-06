<?php
	if($_SESSION['basic_id']) {
		$now = 'coreupdate';
		
/*
ひとまず
ダウンロード、解凍、配置まで完成
*/
/*
		$response = file_get_contents('https://basic.dance/api/?basic_version_get=true');
		$json_decode_response = json_decode($response , true);
		// 最新バージョンより低い場合
		if($site_data_array['basic_version'] < $json_decode_response['latest_basic_version']) { 
			if(!file_exists(PATH.'/tmp')) {
				basic::dir_create(PATH.'/tmp');
			}
			$fileData = file_get_contents('https://github.com/mtoksuy/basic/archive/refs/tags/v'.$json_decode_response['latest_basic_version'].'.zip');
			file_put_contents(PATH.'/tmp/v'.$json_decode_response['latest_basic_version'].'.zip',$fileData);
			// 圧縮・解凍するためのオブジェクト生成
			$zip = new ZipArchive();
			// 解凍
			$result = $zip->open(PATH.'/tmp/v'.$json_decode_response['latest_basic_version'].'.zip');
			if($result === true) {
				// 配置
				$zip->extractTo(PATH.'/tmp');
				$zip->close();
			}
		}  // if($site_data_array['basic_version'] < $json_decode_response['latest_basic_version']) { 
*/




			// ファイル複製
//			copy(PATH.'setting/db_config.php', PATH.'tmp/db_config.php');


basic::copy_dir(PATH.'tmp/basic-0.6/setting', PATH.'setting2');






			// テンプレート読み込み
//			require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
