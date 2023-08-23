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
			///////////////
			// common設定
			///////////////
			// ファイルパス
			$file_path = (PATH.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name']);
			// ファイルサイズ
			$file_path_filesize = filesize($file_path);
			// バイト数のフォーマット変換
			$file_path_byte_format = basic::byte_format($file_path_filesize, 0);
			/////////////
			// 画像の場合
			/////////////
			if(preg_match('/imag/', $value['type'], $type_array)) {
				$image_path_filesize = getimagesize($file_path);
				// 横長
				if($image_path_filesize[0] > $image_path_filesize[1]) {
					$image_class = 'landscape';
				}
				// 縦長
				else {
					$image_class = 'portrait';
				}
				$image_box_html = '<img class="'.$image_class.'" src="'.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'">';
			}
			/////////////
			// PDFの場合
			/////////////
			else if(preg_match('/pdf/', $value['type'], $type_array)) {
				$image_box_html = 
					'<embed class="pdf" src="'.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'" type="application/pdf" width="100%" height="500px">';
			}
			/////////////
			// videoの場合
			/////////////
			else if(preg_match('/video/', $value['type'], $type_array)) {
				$image_box_html = 
					'<video controls width="100%" height="auto">
						<source src="'.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'" type="video/mp4">
					</video>';
			}
			/////////////
			// xmlの場合
			/////////////
			else if(preg_match('/xml/', $value['type'], $type_array)) {
				 $image_box_html = '<img src="'.HTTP.'app/theme/admin/assets/img/svg/basic_fileupload_file_2.svg">';
			}
			/////////////
			// phpの場合
			/////////////
			else if(preg_match('/php/', $value['type'], $type_array)) {
				 $image_box_html = '<img src="'.HTTP.'app/theme/admin/assets/img/svg/basic_fileupload_file_2.svg">';
			}
			/////////////
			// textの場合
			/////////////
			else if(preg_match('/text/', $value['type'], $type_array)) {
				$image_box_html = 
					'<object width="100%" height="100%" data="'.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'"  type="text/plain"></object>';
			}
			//////////////////
			// javascriptの場合
			//////////////////
			else if(preg_match('/javascript/', $value['type'], $type_array)) {
				$image_box_html = 
					'<object width="100%" height="100%" data="'.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'"  type="text/plain"></object>';
			}
			/////////////
			// jsonの場合
			/////////////
			else if(preg_match('/json/', $value['type'], $type_array)) {
				$image_box_html = 
					'<object width="100%" height="100%" data="'.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'"  type="text/plain"></object>';
			}
			/////////////
			// 音声の場合
			/////////////
			else if(preg_match('/audio/', $value['type'], $type_array)) {
				$image_box_html = 
					'<audio controls src="'.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'" type="audio/mp3"></audio>';
			}
			// 上記以外の場合
			else {
				 $image_box_html = '<img src="'.HTTP.'app/theme/admin/assets/img/svg/basic_fileupload_file_2.svg">';
			}
			// 出力array
			$file_modal_data_array = array(
				'image_box_html' => $image_box_html, 
				'img_src'       => ''.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'',
				'img_class'    => $image_class,
				'full_name'    => $value['full_name'],
				'byte'             => $file_path_byte_format,
				'size'              => $image_path_filesize[0].'x'.$image_path_filesize[1].' ピクセル',
				'type'             => $value['type'],
				'create_time' => $value['create_time'],
				'next_file_id'  => $file_next_prev_res['next']['primary_id'],
				'prev_file_id'  => $file_next_prev_res['prev']['primary_id'],
			);
		} // foreach($file_res as $key => $value) {
		return $file_modal_data_array;
	}















}