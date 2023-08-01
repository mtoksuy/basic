<?php

	$contact_unread_count_html = '';

	if($_SESSION['basic_id']) {
		$now = 'profile';
		// ポストの中身をエンティティ化する
		$post = basic::post_security();
		// 更新があった場合
		if($post) {
			//pre_var_dump($post);
			if($_FILES['icon']['tmp_name']) {
				//getimagesize関数で画像情報を取得する
				list($img_width, $img_height, $mime_type, $attr) = getimagesize($_FILES['icon']['tmp_name']);
				//list関数の第3引数にはgetimagesize関数で取得した画像のMIMEタイプが格納されているので条件分岐で拡張子を決定する
				switch($mime_type){
				//jpegの場合
				case IMAGETYPE_JPEG:
				//拡張子の設定
				$img_extension = "jpg";
				break;
				//pngの場合
				case IMAGETYPE_PNG:
				//拡張子の設定
				$img_extension = "png";
				break;
				//gifの場合
				case IMAGETYPE_GIF:
				//拡張子の設定
				$img_extension = "gif";
				break;
				//webpの場合
				case 18:
				//拡張子の設定
				$img_extension = "webp";
				break;
				}
				$length = 32;
				$random_hash = substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, $length);
				//画像を保存
				move_uploaded_file($_FILES['icon']['tmp_name'], PATH.'app/assets/img/user/'.$random_hash.'.'.$img_extension);
				$image_path = PATH.'app/assets/img/user/'.$random_hash.'.'.$img_extension;
				// プロフィール変更
					model_db::query("
						UPDATE user SET icon = '".$random_hash.'.'.$img_extension."'
						WHERE primary_id = ".$_SESSION['primary_id']."
					");
				$savePath = PATH.'app/assets/img/user/';
				// アイコンを正方形にする
				model_login_admin_profile_basis::image_square_edit($image_path, $random_hash, $savePath, 512);
			}
			// 一般設定保存
			model_login_admin_profile_basis::profile_save($post);
			// 静的化+圧縮化する際のリストarray取得
			$html_gzip_create_list_array = basic::html_gzip_create_list_array_get('profile');
			// multi版：静的化+圧縮化
			basic::multi_html_gzip_create($html_gzip_create_list_array);
		} // if($post) {
		// プロフィールデータarray取得
		$user_data_array = basic::user_data_get($_SESSION['primary_id']);
		// プロフィール設定HTML生成
		$content_html = model_login_admin_profile_html::profile_html_create($user_data_array);

		// テンプレート読み込み
		require_once(PATH.'app/theme/admin/view/'.$controller_query.'/template.php');
	}
		else {
			// クッキーログイン
			model_login_basis::cookie_login();
		}
?>