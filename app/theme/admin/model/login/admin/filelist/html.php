<?php
class model_login_admin_filelist_html {
	//--------------------------
	// ファイル一覧HTML生成
	//--------------------------
	public static function filelist_html_create($filelist_res) {
//		pre_var_dump($filelist_res);
		foreach($filelist_res as $key => $value) {
			preg_match('/imag/', $value['type'], $type_array);
			// 画像の場合
			if($type_array) {
				 $filelist_li .=
					 '<li class="img" file_id="'.$value['primary_id'].'">
						<a href="'.HTTP.'login/admin/filelist/?file_id='.$value['primary_id'].'" class="o_8">
							<img src="'.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'">
						</a>
					</li>';
			}
				// 画像以外の場合
				else {
				 $filelist_li .=
					 '<li class="img">
						<a href="'.HTTP.'login/admin/filelist/?file_id='.$value['primary_id'].'" class="o_8">
							<img src="'.HTTP.'app/theme/admin/assets/img/svg/basic_fileupload_file_2.svg">
							<div class="file_name">'.$value['full_name'].'</div>
						</a>
					</li>';

				}
		}
		// 合体
		$filelist_html = 
		'<ul class="filelist">
			'.$filelist_li.'
		</ul>';
		return $filelist_html;
	}

	//-----------------------------
	// ファイルモーダルHTML生成
	//-----------------------------
	public static function file_modal_html_create($file_res, $file_next_prev_res) {
		foreach($file_res as $key => $value) {
			preg_match('/imag/', $value['type'], $type_array);
			// 画像の場合
			if($type_array) {
				$image_path = (PATH.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name']);
				$image_path_imagesize = getimagesize($image_path);
				$image_path_filesize = filesize($image_path);
				// バイト数のフォーマット変換
				$image_path_byte_format = basic::byte_format($image_path_filesize, 0);
				 $file_html = '
					<div class="file_modal">
						<div class="file_modal_inner">
							<div class="file_modal_inner_top">
								<h1>ファイル詳細</h1>
								<div class="next" file_id="'.$file_next_prev_res['next']['primary_id'].'"><</div>
								<div class="prev" file_id="'.$file_next_prev_res['prev']['primary_id'].'">></div>
								<div class="delete">×</div>
							</div>

							<div class="left">
								<div class="image_box">
									<img src="'.HTTP.'app/assets/fileupload'.'/'.$value['year'].'/'.$value['month'].'/'.$value['full_name'].'">
								</div>
							</div>
							<div class="right">
								<div class="file_data">
									<div class="full_name">
										ファイル名：　<span class="data">'.$value['full_name'].'<span>
									</div>
									<div class="byte">
										ファイルサイズ：　<span class="data">'.$image_path_byte_format.'<span>
									</div>
									<div class="size">
										サイズ：　<span class="data">'.$image_path_imagesize[0].'x'.$image_path_imagesize[1].' ピクセル<span>
									</div>
									<div class="type">
										タイプ：　<span class="data">'.$value['type'].'<span>
									</div>
									<div class="create_time">
										アップロード時間：　<span class="data">'.$value['create_time'].'<span>
									</div>
								</div>
							</div> <!-- right -->
						</div> <!-- file_modal_inner -->
					</div> <!-- file_modal -->

					<div class="file_modal_overlay">
						<div class="file_modal_overlay_inner">
						　
						</div>
					</div>';
			}
				// 画像以外の場合
				else {
				 $filelist_li .=
					 '';
				}
		}
		return $file_html;
	}

}