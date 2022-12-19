<?php 
class model_login_admin_filelist_basis {
	//----------------------
	// ファイル一覧res取得
	//----------------------
	public static function filelist_res_get($get_num = 1000, $page_num = 1) {
		// 取得する場所取得
		$start_list_num = ($page_num*$get_num)-$get_num;
		$filelist_res = model_db::query("
			SELECT *
			FROM fileupload
			WHERE del = 0
			ORDER BY primary_id DESC
			LIMIT ".$start_list_num.", ".$get_num."");
		return $filelist_res;
	}
	//------------------
	// ファイルres取得
	//------------------
	public static function file_res_get($get) {
		// 取得する場所取得
		$file_res = model_db::query("
			SELECT *
			FROM fileupload
			WHERE primary_id = ".$get['file_id']."
			AND del = 0
		");
		return $file_res;
	}
	//-----------------------------
	// ファイルnext_prev_res取得
	//-----------------------------
	public static function file_next_prev_res_get($get) {
		// 取得する場所取得
		$next_res = model_db::query("
			SELECT *
			FROM fileupload
			WHERE primary_id > ".$get['file_id']."
			AND del = 0
			ORDER BY primary_id ASC
			LIMIT 0, 1");
		$prev_res = model_db::query("
			SELECT *
			FROM fileupload
			WHERE primary_id < ".$get['file_id']."
			AND del = 0
			ORDER BY primary_id DESC
			LIMIT 0, 1");
			$file_next_prev_res = array(
				'next' => $next_res[0],
				'prev' => $prev_res[0],
			);
		return $file_next_prev_res;
	}


	//----------------------------------
	// ファイルモーダルdata_array取得
	//-----------------------------------
	public static function file_modal_data_array_get($file_res, $file_next_prev_res) {
		foreach($file_res as $key => $value) {
			preg_match('/imag/', $value['type'], $type_array);
			// 画像の場合
			if($type_array) {
				$image_path = (PATH.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name']);
				$image_path_imagesize = getimagesize($image_path);
				$image_path_filesize = filesize($image_path);
				// 横長
				if($image_path_imagesize[0] > $image_path_imagesize[1]) {
					$image_class = 'landscape';
				}
				// 縦長
				else {
					$image_class = 'portrait';
				}
				// バイト数のフォーマット変換
				$image_path_byte_format = basic::byte_format($image_path_filesize, 0);
				$file_modal_data_array = array(
					'img_src'       => ''.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'',
					'img_class'    => $image_class,
					'full_name'    => $value['full_name'],
					'byte'             => $image_path_byte_format,
					'size'              => $image_path_imagesize[0].'x'.$image_path_imagesize[1].' ピクセル',
					'type'             => $value['type'],
					'create_time' => $value['create_time'],
					'next_file_id'  => $file_next_prev_res['next']['primary_id'],
					'prev_file_id'  => $file_next_prev_res['prev']['primary_id'],
				);
			}
				// 画像以外の場合
				else {
					$file_modal_data_array = array(
						'img_src'       => ''.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'',
						'full_name'    => $value['full_name'],
						'byte'             => $image_path_byte_format,
						'size'              => $image_path_imagesize[0].'x'.$image_path_imagesize[1].' ピクセル',
						'type'             => $value['type'],
						'create_time' => $value['create_time'],
						'next_file_id'  => $file_next_prev_res['next']['primary_id'],
						'prev_file_id'  => $file_next_prev_res['prev']['primary_id'],
					);
				}
		}
		return $file_modal_data_array;
	}















}