<?php 
class model_login_admin_profile_basis {
	//----------------------
	// 一般データarray取得
	//----------------------
	public static function profile_data_array_get() {
		// 取得
		$profile_res = model_db::query("
			SELECT * 
			FROM setting ");
			$profile_data_array = $profile_res[0];
		return $profile_data_array;
	}
	//------------------------
	//  プロフィール設定保存
	//------------------------
	public static function profile_save($post) {
		// 現在時刻取得
		$now_time = date('Y-m-d H:i:s');
		$profile_res = model_db::query("
			UPDATE user 
			SET 
				name = '".$post['name']."',
				profile = '".$post['profile']."',
				update_time = '".$now_time."'
			WHERE primary_id = ".$_SESSION['primary_id']."");
	}
	//-----------------------------
	//  プロフィールicon設定保存
	//-----------------------------
	public static function profile_icon_save($post) {
		 model_db::query("
			UPDATE user 
			SET 
				icon = '".$post['icon']."'
			WHERE primary_id = ".$_SESSION['primary_id']."");
	}
	//--------------------------
	// アイコンを正方形にする
	//--------------------------
	public static function image_square_edit($image_path, $random_hash, $savePath, $square_size = 256) {
		// svg対策
		$height = 0;
		$width = 0;
		$imginfo[2] = '';

		// $image_pathから拡張子取得前料理
		$extension_explode = explode('.', $image_path);
		// ソートを逆にする
		$extension_explode = array_reverse($extension_explode);
		// 拡張子取得
		$extension = '.'.$extension_explode[0];
		// オリジナルパスを渡す
		$orgFile = $image_path;
		// 保存先パス
//		$savePath = PATH.'app/assets/img/user/';
		 // 出力ピクセルサイズで新規画像作成
		 $square_width  = $square_size;
		 $square_height = $square_size;

		// 画像のピクセルサイズ情報を取得
		$imginfo = getimagesize($orgFile);
		//getimagesize関数で画像情報を取得する
		list($img_width, $img_height, $mime_type, $attr) = getimagesize($image_path);
		switch($mime_type) {
			//jpegの場合
			case IMAGETYPE_JPEG:
				// イメージリソース取得
				$ImageResource = imagecreatefromjpeg($orgFile);
			break;
			//pngの場合
			case IMAGETYPE_PNG:
				// イメージリソース取得
				$ImageResource = imagecreatefrompng($orgFile);
			break;
			//gifの場合
			case IMAGETYPE_GIF:
				// イメージリソース取得
				$ImageResource = imagecreatefromgif($orgFile);
			break;
			//webpの場合
			case 18:
				// イメージリソース取得
				$ImageResource = imagecreatefromwebp($orgFile);
			break;
		}
		// svg対応
		if($mime_type != NULL) {
			// イメージリソースから、横、縦ピクセルサイズ取得
			$width  = imagesx($ImageResource);    // 横幅
			$height = imagesy($ImageResource);    // 縦幅
			if ($width >= $height) {
				// 横長の画像の時
				$side = $height;
				$x = floor(($width - $height) / 2);
				$y = 0;
				$width = $side;
			}
			else {
				// 縦長の画像の時
				$side = $width;
				$y = floor(($height - $width) / 2);
				$x = 0;
				$height = $side;
			}
			switch($imginfo[2]) {
				 // jpeg
				 case 2:
					// 出力ファイル名
					$filename = $random_hash.$extension;
					$square_new = imagecreatetruecolor($square_width, $square_height);
					imagecopyresized($square_new, $ImageResource, 0, 0, $x, $y, $square_width, $square_height, $width, $height);
					imagejpeg($square_new, $savePath . $filename, 100);
				 break;
				 
				 // gif
				 case 1:
				 	// 何もしない
				 break;
				 // png
				 case 3:
					// 出力ファイル名
					$filename = $random_hash.$extension;
					 $square_new = imagecreatetruecolor($square_width, $square_height);
					 imagealphablending($square_new, false);        // アルファブレンディングを無効
					 imageSaveAlpha($square_new, true);             // アルファチャンネルを有効
					 $transparent = imagecolorallocatealpha($square_new, 0, 0, 0, 127); // 透明度を持つ色を作成
					 imagefill($square_new, 0, 0, $transparent);    // 塗りつぶす
					 imagecopyresampled($square_new, $ImageResource, 0, 0, $x, $y, $square_width, $square_height, $width, $height);
					 imagepng($square_new, $savePath . $filename);
				break;
				 // webp
				 case 18:
					// 出力ファイル名
					$filename = $random_hash.$extension;
					$square_new = imagecreatetruecolor($square_width, $square_height);
					imagecopyresized($square_new, $ImageResource, 0, 0, $x, $y, $square_width, $square_height, $width, $height);
					imagewebp($square_new, $savePath . $filename, 100);
				 break;
				 // デフォルト
				 Default:
				 break;
				} // switch ($imginfo[2]) {
			}  // if($mime_type != NULL) {
	}




}