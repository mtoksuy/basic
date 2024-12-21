<?php
class model_login_admin_filelist_html {
	//--------------------------
	// ファイル一覧HTML生成
	//--------------------------
	public static function filelist_html_create($filelist_res) {
		$filelist_li = '';
		//		pre_var_dump($filelist_res);
		foreach ($filelist_res as $key => $value) {
			preg_match('/imag/', $value['type'], $type_array);
			//			pre_var_dump($value['type']);
			// gifの場合
			if ($value['type'] == 'image/gif' ||  $value['type'] == 'image/svg+xml') {
				$filelist_li .=
					'<li class="img" file_id="' . $value['primary_id'] . '">
						<a href="' . HTTP . 'login/admin/filelist/?file_id=' . $value['primary_id'] . '" class="o_8">
							<img src="' . HTTP . 'app/assets/fileupload' . '/' . $value['year'] . '/' . $value['month'] . '/' . $value['full_name'] . '">
						</a>
					</li>';
			}
			// 画像の場合
			else if ($type_array) {
				$filelist_li .=
					'<li class="img" file_id="' . $value['primary_id'] . '">
						<a href="' . HTTP . 'login/admin/filelist/?file_id=' . $value['primary_id'] . '" class="o_8">
							<img src="' . HTTP . 'app/assets/fileupload' . '/' . $value['year'] . '/' . $value['month'] . '/square_' . $value['full_name'] . '">
						</a>
					</li>';
			}
			/*
メモ：Safariだと表示されたが、Chromeだと表示されない。
			// PDFの場合  
			else if($value['type'] == 'application/pdf' || $value['type'] == 'video/mp4') {
				 $filelist_li .=
					 '<li class="img" file_id="'.$value['primary_id'].'">
						<a href="'.HTTP.'login/admin/filelist/?file_id='.$value['primary_id'].'" class="o_8">
							<img src="'.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'">
						</a>
					</li>';
			}
*/
			// 画像以外の場合
			else {
				$filelist_li .=
					'<li class="img" file_id="' . $value['primary_id'] . '">
					<a href="' . HTTP . 'login/admin/filelist/?file_id=' . $value['primary_id'] . '" class="o_8">
						<img src="' . HTTP . 'app/theme/admin/assets/img/svg/basic_fileupload_file_2.svg">
						<div class="file_name">' . $value['full_name'] . '</div>
					</a>
				</li>';
			}
		}
		// 合体
		$filelist_html =
			'<ul class="filelist">
			' . $filelist_li . '
		</ul>';
		return $filelist_html;
	}

	//-----------------------------
	// ファイルモーダルHTML生成
	//-----------------------------
	public static function file_modal_html_create($file_res, $file_next_prev_res) {

		foreach ($file_res as $key => $value) {
			///////////////
			// common設定
			///////////////
			// ファイルパス
			$file_path = (PATH . 'app/assets/fileupload' . '/' . $value['year'] . '/' . $value['month'] . '/' . $value['full_name']);
			// ファイルサイズ
			$file_path_filesize = filesize($file_path);
			// バイト数のフォーマット変換
			$file_path_byte_format = basic::byte_format($file_path_filesize, 0);
			/////////////
			// 画像の場合
			////////////
			if (preg_match('/imag/', $value['type'], $type_array)) {
				$image_path_imagesize = getimagesize($file_path);
				// 横長
				if ($image_path_imagesize[0] > $image_path_imagesize[1]) {
					$image_class = 'landscape';
				}
				// 縦長
				else {
					$image_class = 'portrait';
				}
				$image_box_html = '<img class="' . $image_class . '" src="' . HTTP . 'app/assets/fileupload' . '/' . $value['year'] . '/' . $value['month'] . '/' . $value['full_name'] . '">';
			} // if(preg_match('/imag/', $value['type'], $type_array)) {
			/////////////
			// PDFの場合
			/////////////
			else if (preg_match('/pdf/', $value['type'], $type_array)) {
				$image_box_html =
					'<embed class="pdf" src="' . HTTP . 'app/assets/fileupload' . '/' . $value['year'] . '/' . $value['month'] . '/' . $value['full_name'] . '" type="application/pdf" width="100%" height="500px">';
			}
			/////////////
			// videoの場合
			/////////////
			else if (preg_match('/video/', $value['type'], $type_array)) {
				$image_box_html =
					'<video controls width="100%" height="auto">
						<source src="' . HTTP . 'app/assets/fileupload' . '/' . $value['year'] . '/' . $value['month'] . '/' . $value['full_name'] . '" type="video/mp4">
					</video>';
			}
			/////////////
			// xmlの場合
			/////////////
			else if (preg_match('/xml/', $value['type'], $type_array)) {
				$image_box_html = '<img src="' . HTTP . 'app/theme/admin/assets/img/svg/basic_fileupload_file_2.svg">';
			}
			/////////////
			// phpの場合
			/////////////
			else if (preg_match('/php/', $value['type'], $type_array)) {
				$image_box_html = '<img src="' . HTTP . 'app/theme/admin/assets/img/svg/basic_fileupload_file_2.svg">';
			}
			/////////////
			// textの場合
			/////////////
			else if (preg_match('/text/', $value['type'], $type_array)) {
				$image_box_html =
					'<object width="100%" height="100%" data="' . HTTP . 'app/assets/fileupload' . '/' . $value['year'] . '/' . $value['month'] . '/' . $value['full_name'] . '"  type="text/plain"></object>';
			}
			//////////////////
			// javascriptの場合
			//////////////////
			else if (preg_match('/javascript/', $value['type'], $type_array)) {
				$image_box_html =
					'<object width="100%" height="100%" data="' . HTTP . 'app/assets/fileupload' . '/' . $value['year'] . '/' . $value['month'] . '/' . $value['full_name'] . '"  type="text/plain"></object>';
			}
			/////////////
			// jsonの場合
			//////////////
			else if (preg_match('/json/', $value['type'], $type_array)) {
				$image_box_html =
					'<object width="100%" height="100%" data="' . HTTP . 'app/assets/fileupload' . '/' . $value['year'] . '/' . $value['month'] . '/' . $value['full_name'] . '"  type="text/plain"></object>';
			}
			/////////////
			// 音声の場合
			/////////////
			else if (preg_match('/audio/', $value['type'], $type_array)) {
				$image_box_html =
					'<audio controls src="' . HTTP . 'app/assets/fileupload' . '/' . $value['year'] . '/' . $value['month'] . '/' . $value['full_name'] . '" type="audio/mp3"></audio>';
			}
			// 上記以外の場合
			else {
				$image_box_html = '<img src="' . HTTP . 'app/theme/admin/assets/img/svg/basic_fileupload_file_2.svg">';
			}
			// ファイル情報挿入
			$file_data_contents =
				'<div class="full_name">
										ファイル名：　<span class="data">' . $value['full_name'] . '<span>
									</div>
									<div class="byte">
										ファイルサイズ：　<span class="data">' . $file_path_byte_format . '<span>
									</div>
									<div class="size">
										サイズ：　<span class="data">' . $image_path_imagesize[0] . 'x' . $image_path_imagesize[1] . ' ピクセル<span>
									</div>
									<div class="type">
										タイプ：　<span class="data">' . $value['type'] . '<span>
									</div>
									<div class="create_time">
										アップロード時間：　<span class="data">' . $value['create_time'] . '<span>
									</div>';
			// 出力html
			$file_html = '
					<div class="file_modal">
						<div class="file_modal_inner">
							<div class="file_modal_inner_top">
								<h1>ファイル詳細</h1><!-- デバッグでMIMEタイプを確認する際はh1内に $value[type]を仕込む -->
								<div class="next" file_id="' . $file_next_prev_res['next']['primary_id'] . '"><</div>
								<div class="prev" file_id="' . $file_next_prev_res['prev']['primary_id'] . '">></div>
								<div class="delete">×</div>
							</div>

							<div class="left">
								<div class="image_box">
									' . $image_box_html . '
								</div>
							</div>
							<div class="right">
								<div class="file_data">
									' . $file_data_contents . '
									<span class="hidden_url">' . HTTP . 'app/assets/fileupload' . '/' . $value['year'] . '/' . $value['month'] . '/' . $value['full_name'] . '</span>
									<div class="url_copy_btn">URL をクリップボードにコピー</div>
									<div class="torst">　</div>
								</div>
							</div> <!-- right -->
						</div> <!-- file_modal_inner -->
					</div> <!-- file_modal -->

					<div class="file_modal_overlay">
						<div class="file_modal_overlay_inner">
						　
						</div>
					</div>';
		}
		return $file_html;
	}
}
