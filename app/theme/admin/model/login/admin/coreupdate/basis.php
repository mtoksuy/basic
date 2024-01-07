<?php 
class model_login_admin_coreupdate_basis {
	//-----------------------------------
	// Basicを最新のバージョンにする
	//-----------------------------------
	public static function basic_coreupdate() {
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
			// index.php書き換え
			basic::copy_dir(PATH.'tmp/basic-'.$json_decode_response['latest_basic_version'].'/index.php', PATH.'index.php');
			// setting書き換え
			basic::copy_dir(PATH.'tmp/basic-'.$json_decode_response['latest_basic_version'].'/setting', PATH.'setting');
			// app/theme/admin書き換え
			basic::copy_dir(PATH.'tmp/basic-'.$json_decode_response['latest_basic_version'].'/app/theme/admin', PATH.'app/theme/admin');
			// バージョン書き換え
			model_db::query("
				UPDATE setting SET basic_version = '".$json_decode_response['latest_basic_version']."'
				WHERE setting_id = 1
			");
			// DBを最新に切り替え(足りないテーブル、足りないカラムを追加
			$basic_sql_word = file_get_contents(PATH.'setting/for_update_basic.sql');
			$basic_sql_word_explode =  explode(';', $basic_sql_word);
			foreach($basic_sql_word_explode as $key => $value) {
				if($value) {
					$res = model_db::query("
						".$value."
					");
				} // if($value) {
			} // foreach($basic_sql_word_explode as $key => $value) {	
			// tmp削除
			basic::removeDir(PATH.'tmp');
		}  // if($site_data_array['basic_version'] < $json_decode_response['latest_basic_version']) { 
	}
	//-------------------------------------
	// ディレクトリの権限情報を取得する
	//-------------------------------------
	public static function dir_permission_info_get($directory) {
		$dir_permission_info_data_array = array();
		// ディレクトリが存在していたら権限情報を調べる
		if(file_exists($directory)) {
			// ディレクトリのパーミッションを取得
			$permissions = fileperms($directory);
			// パーミッションの数値を8進数から10進数に変換
			$permissions = decoct($permissions);
	
			// 末尾の3桁のパーミッションを取得
			$last_three_digits = $permissions % 1000;
	


/*************************************************************************/

// ディレクトリの所有者のユーザーIDを取得する草案実装内容
/*
			// ディレクトリの所有者のユーザーIDを取得
			$ownerId = fileowner($directory);
			// ユーザーIDからユーザー名を取得
			if(function_exists('posix_getpwuid')) {
				$ownerInfo = posix_getpwuid($ownerId);
				$ownerName = $ownerInfo['name'];
			}
			else {
				// システムコマンドを使って所有者のユーザー名を取得します
				$ownerName = trim(exec("stat -c '%U' {$directory}"));
			}
*/

/*************************************************************************/

	$os = strtoupper(substr(PHP_OS, 0, 3));

	// windowsの場合
	if ($os === 'WIN') {
		// Windowsの場合の処理
		exec("dir \"$directory\" 2>&1", $output, $returnVar);
		if ($returnVar === 0) {
			// Windowsの場合、ディレクトリの所有者情報は取得できないため、代わりにユーザー名を抽出
			preg_match('/\[(.+)\]/', $output[5], $matches);
			$ownerName = isset($matches[1]) ? $matches[1] : null;
		}
	}
	// macの場合
	elseif($os === 'DAR') {
		// macOSの場合の処理
		exec("ls -ld \"$directory\" 2>&1", $output, $returnVar);
		if ($returnVar === 0) {
			$parts = preg_split('/\s+/', $output[0]);
			$ownerName = isset($parts[2]) ? $parts[2] : null;
		}
	}
	// centosの場合
	else {
		// CentOSなどLinux系の場合の処理
		exec("ls -ld \"$directory\" 2>&1", $output, $returnVar);
		if ($returnVar === 0) {
			$parts = preg_split('/\s+/', $output[0]);
			$ownerName = isset($parts[2]) ? $parts[2] : null;
		}
	}


/********************************************************************************/


			$dir_permission_info_data_array['directory']             = $directory;
			$dir_permission_info_data_array['permissions']        = $permissions;
			$dir_permission_info_data_array['last_three_digits'] = $last_three_digits;
			$dir_permission_info_data_array['ownerName']        = $ownerName;
			$dir_permission_info_data_array['is_file_exists']       = true;
		}
		else {
			$dir_permission_info_data_array['is_file_exists'] = false;
		}
		return $dir_permission_info_data_array;
	}






}