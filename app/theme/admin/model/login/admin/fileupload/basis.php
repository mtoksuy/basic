<?php 
class model_login_admin_fileupload_basis {
	//--------------
	// file_array生成
	//---------------
	public static function flle_array_create($files, $length = 32) {
//		pre_var_dump($files);
		// name取得
		foreach($files['uploadFile']['name'] as $key => $value) {
			$full_name_array[$key] = $value;	
		}
		// 拡張子取得+拡張子なしname取得
		foreach($files['uploadFile']['name'] as $key => $value) {
			$mb_strrpos = mb_strrpos($value, '.');
			$mb_substr = mb_substr($value, $mb_strrpos);
			$extension_array[$key] = $mb_substr;
			$name_array[$key] = preg_replace('/'.$mb_substr.'/', '', $value);
		}
		// size取得
		foreach($files['uploadFile']['size'] as $key => $value) {
			$size_array[$key] = $value;	
		}
		// tmp_name取得
		foreach($files['uploadFile']['tmp_name'] as $key => $value) {
			$tmp_name_array[$key] = $value;	
		}
		//type取得
		foreach($files['uploadFile']['type'] as $key => $value) {
			$type_array[$key] = $value;
		}
		// $flle_array生成
		foreach($type_array as $key => $value) {
			$mk_passwd = substr(bin2hex(random_bytes($length)), 0, $length);
			$flle_array[$key]['full_name'] = $full_name_array[$key];
			$flle_array[$key]['name'] = $name_array[$key];
			$flle_array[$key]['extension'] = $extension_array[$key];
			$flle_array[$key]['type'] = $value;
			$flle_array[$key]['size'] = $size_array[$key];
			$flle_array[$key]['tmp_name'] = $tmp_name_array[$key];
			$flle_array[$key]['random_name'] = $mk_passwd;
		}
		return $flle_array;
	}
	//-----------------------------
	// 画像アップロード&DB登録
	//-----------------------------
	public static function file_upload($flle_array) {
		// マスターディレクトリパス
		$file_upload_directry_path = PATH.'app/assets/fileupload';
		$now_year    = date('Y');
		$now_month = date('m');
		// ディレクトリチェック
		if(file_exists($file_upload_directry_path.'/'.$now_year)) {
	
		}
			// ない場合
			else {
				// ディレクトリ作成
				mkdir($file_upload_directry_path.'/'.$now_year, 0755);
			}
		// ディレクトリチェック
		if(file_exists($file_upload_directry_path.'/'.$now_year.'/'.$now_month)) {
	
		}
			// ない場合
			else {
				// ディレクトリ作成
				mkdir($file_upload_directry_path.'/'.$now_year.'/'.$now_month, 0755);
			}
//////////////////////////////////////////////////////////////////////////
		// $flle_arrayぶんまわしアップロード開始
		foreach($flle_array as $key => $value) {
//			pre_var_dump($value);
			// ファイル名
			$file_name = $value['full_name'];
			// 一時アップロード先ファイルパス
			$file_tmp = $value['tmp_name'];
			// ファイル配置パス
			$file_upload_path = $file_upload_directry_path.'/'.$now_year.'/'.$now_month;
			// 重複チェック
			if(file_exists($file_upload_path.'/'.$file_name)) {
				// 重複ファイル複製 再帰処理
				$value = model_login_admin_fileupload_basis::file_duplication_copy_recursive($file_tmp, $file_upload_path, $file_name, $value);
			}
				else {
					// ファイル移動
					$result = move_uploaded_file($file_tmp, $file_upload_directry_path.'/'.$now_year.'/'.$now_month.'/'.$file_name);
				}
			// アイコン正方形で使用する変数
			$image_path = $file_upload_directry_path.'/'.$now_year.'/'.$now_month.'/'.$file_name;
			$square_file_name = 'square_'.$value['name'];
			$savePath = $file_upload_directry_path.'/'.$now_year.'/'.$now_month.'/';
			// アイコンを正方形にする
			model_login_admin_profile_basis::image_square_edit($image_path, $square_file_name, $savePath, 256);
			// webpで使用する変数
			$image_path = $file_upload_directry_path.'/'.$now_year.'/'.$now_month.'/'.$file_name;
			$webp_file_name = 'webp_'.$value['name'];
			$savePath = $file_upload_directry_path.'/'.$now_year.'/'.$now_month.'/';
			// webp生成
			model_login_admin_fileupload_basis::image_to_webp_create($image_path, $webp_file_name, $savePath, 80, 85);

			// DB登録
			$query = model_db::query("
				INSERT INTO fileupload (
					full_name, 
					name,
					extension,
					type,
					year,
					month
					) 
					VALUES (
					'".$value['full_name']."', 
					'".$value['name']."', 
					'".$value['extension']."', 
					'".$value['type']."', 
					'".$now_year."', 
					'".$now_month."'
					)
			");
		} // foreach($flle_array as $key => $value) {
		return $flle_array;
	}
	//-----------------------------
	// 重複ファイル複製 再帰処理
	//-----------------------------
	public static function file_duplication_copy_recursive($file_tmp, $file_upload_path, $file_name, $value) {
		preg_match('/_([0-9]{0,64})$/', $value['name'], $name_array);
//		pre_var_dump($name_array);
		if($name_array[0]) {
			$num = (int)$name_array[1];
			$num++;
			$next_name = preg_replace('/_([0-9]{0,64})$/', '_'.$num.'', $value['name']);
		}
			else {
				$next_name = $value['name'].'_1';
			}
		// 重複チェック
		if(file_exists($file_upload_path.'/'.$next_name.$value['extension'])) {
			$file_name = $next_name.$value['extension'];
			$value['full_name'] =$next_name.$value['extension'];
			$value['name'] = $next_name;
			// 重複ファイル複製 再帰処理
			$value = model_login_admin_fileupload_basis::file_duplication_copy_recursive($file_tmp, $file_upload_path, $file_name, $value);
		}
			else {
				$value['full_name'] =$next_name.$value['extension'];
				$value['name'] = $next_name;
				// ファイル移動
				$result = move_uploaded_file($file_tmp, $file_upload_path.'/'.$next_name.$value['extension']);
			}
		return $value;
	}
	
	//-----------
	// webp生成
	//-----------
	public static function image_to_webp_create($image_path, $file_name, $savePath, $webp_compression_ratio = 80, $img_compression_ratio = 85) {
		list($original_w, $original_h, $type) = getimagesize($image_path);
/*
		pre_var_dump($image_path);
		pre_var_dump($file_name);
		pre_var_dump($savePath);
		pre_var_dump($compression_ratio);
		pre_var_dump($type);
*/
			// webp保存先ファイルパス
//			$savePath = $img_directry_path.$value['webp_name'];
			switch ($type) {
				case IMAGETYPE_JPEG:
					imagewebp(imagecreatefromjpeg($image_path), $savePath.$file_name.'.webp', $webp_compression_ratio);
					// WebP ファイルを読み込みます
					$im = imagecreatefromwebp($savePath.$file_name.'.webp');
					// 80% のクオリティで jpeg ファイルに変換します
					imagejpeg($im, $image_path, $img_compression_ratio);
				break;
				case IMAGETYPE_PNG:
					$src = imagecreatefrompng($image_path);
					$dst = imagecreatetruecolor(imagesx($src),imagesy($src));
					//ブレンドモードを無効にする
					imagealphablending($dst, false);
					//完全なアルファチャネル情報を保存するフラグをonにする
					imagesavealpha($dst, true);
					imagecopy($dst,$src,0,0,0,0,imagesx($src),imagesy($src));
					imagewebp($dst, $savePath.$file_name.'.webp', $webp_compression_ratio);
				break;
				case IMAGETYPE_GIF:
					$src = imagecreatefromgif($image_path);
					$dst = imagecreatetruecolor(imagesx($src),imagesy($src));
					//ブレンドモードを無効にする
					imagealphablending($dst, false);
					//完全なアルファチャネル情報を保存するフラグをonにする
					imagesavealpha($dst, true);
					imagecopy($dst,$src,0,0,0,0,imagesx($src),imagesy($src));
					imagewebp($dst, $savePath.$file_name.'.webp', $webp_compression_ratio);
				break;
				case 18: // webp
					// WebP ファイルを読み込みます
					$im = imagecreatefromwebp($image_path);
					// 80% のクオリティで jpeg ファイルに変換します
					imagejpeg($im, $savePath.$file_name.'.jpg', $img_compression_ratio);
				break;
			}
}













}