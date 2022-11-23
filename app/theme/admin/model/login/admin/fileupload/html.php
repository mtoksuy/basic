<?php
class model_login_admin_fileupload_html {
	//-----------------------------------
	// ファイルアップロードHTML生成
	//-----------------------------------
	public static function fileupload_html_create() {
		$fileupload_html = '
			<!-- ドロップ画像 -->
			<div id="upFileWrap">
			    <div id="inputFile">
			        <!-- ドラッグ&ドロップエリア -->
			        <p id="dropArea">ここにフォルダ・ファイルをドロップしてください<br>または</p>
			        <!-- 通常のinput[type=file] -->
			        <div id="inputFileWrap">
						<form id="upload_form" name="upload_form" method="post" action="" enctype="multipart/form-data">
							<!-- 全て許可 --> <!-- image/* なら画像のみ -->
							<input type="file" name="uploadFile[]" id="uploadFile" accept="" multiple="multiple" webkitdirectory="" directory="">
							<input type="submit" value="確認" name="submit" style="top: -42px;position: relative;">
						</form>
			            <div id="btnInputFile">
							<span>フォルダ・ファイルを選択する</span>
						</div>
			        </div>
			    </div>
			</div> <!-- ドロップ画像 -->';
		return $fileupload_html;
	}
	//--------------
	// byte計算関数
	//---------------
	public static function byte_cal($bytes) {
	    if ($bytes > 0) {
	        $unit = intval(log($bytes, 1024));
	        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
	        if (array_key_exists($unit, $units) === true) {
	            return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
	        }
	    }
	    return $bytes;
	}
	//------------------------
	// byte計算関数、強化版
	//-------------------------
	public static function byte_format($size, $dec=-1, $separate=false){
		$units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
		$digits = ($size == 0) ? 0 : floor( log($size, 1024) );
		
		$over = false;
		$max_digit = count($units) -1 ;
	
		if($digits == 0){
			$num = $size;
		} else if(!isset($units[$digits])) {
			$num = $size / (pow(1024, $max_digit));
			$over = true;
		} else {
			$num = $size / (pow(1024, $digits));
		}
		
		if($dec > -1 && $digits > 0) $num = sprintf("%.{$dec}f", $num);
		if($separate && $digits > 0) $num = number_format($num, $dec);
		
		return ($over) ? $num . $units[$max_digit] : $num . $units[$digits];
	}
	//------------------
	// CDN_HTML生成
	//------------------
	public static function cdn_html_create($upload_type, $flle_array) {
//pre_var_dump($flle_array);
		$image_num = 0;
		foreach($flle_array as $key => $value) {
			$before_size = $before_size+$value['size'];
			$filesize = filesize(PATH.$upload_type.'/img/'.$value['webp_name']);
			$after_size = $after_size+$filesize;
			$img_directry_path = PATH.$upload_type.'/img/';
			$file_path = PATH.$upload_type.'/img/'.$value['name'];
			list($w, $h, $type) = getimagesize($file_path);
			switch($value['type']) {
				case 'image/webp':
					$img_html = '<img src="'.HTTP.$upload_type.'/img/?space='.$value['dir_name'].'&type=jpg&w='.$w.'" width="'.$w.'" height="'.$h.'" decoding="async" loading="lazy">';
				break;
				case 'image/jpeg':
					$img_html = '<img src="'.HTTP.$upload_type.'/img/?space='.$value['dir_name'].'&type='.preg_replace('/image\//', '', $value['type']).'&w='.$w.'" width="'.$w.'" height="'.$h.'" decoding="async" loading="lazy">';
				break;
				case 'image/png':
					$img_html = '<img src="'.HTTP.$upload_type.'/img/?space='.$value['dir_name'].'&type='.preg_replace('/image\//', '', $value['type']).'&w='.$w.'" width="'.$w.'" height="'.$h.'" decoding="async" loading="lazy">';

				break;
				case 'image/gif':
					$img_html = '<img src="'.HTTP.$upload_type.'/img/?space='.$value['dir_name'].'&type='.preg_replace('/image\//', '', $value['type']).'&w='.$w.'" width="'.$w.'" height="'.$h.'" decoding="async" loading="lazy">';
				break;
			}
$cdn_html = $cdn_html.
'<picture>
	<source type="image/webp" srcset="'.HTTP.$upload_type.'/img/?space='.$value['dir_name'].'&type=webp&w='.$w.'">
	'.$img_html.'
</picture>
';
			$image_num++;
		}
		$cdn_html = rtrim($cdn_html, '
');
		$diff_size = $before_size-$after_size;
		 $diff_ratio = number_format(((1-($after_size/$before_size))*100), 2).'%';
		$before_size = model_upload_html::byte_format($before_size, 2, true);
		$after_size = model_upload_html::byte_format($after_size, 2, true);
		$diff_size = model_upload_html::byte_format($diff_size, 2, true);

		return array($cdn_html, $image_num, $before_size, $after_size, $diff_size, $diff_ratio);
/*
原本
<picture>
	<source type="image/webp" srcset="">
	<img src="" width="2876" height="1550" decoding="async" loading="lazy">
</picture>
*/
	}
	//------------------------------------------
	// Ajax後ファイルアップロードHTML取得
	//------------------------------------------
	public static function ajax_fileupload_html_create($flle_array) {
		// マスターディレクトリパス
		$file_upload_directry_path = HTTP.'app/assets/fileupload';
		$now_year    = date('Y');
		$now_month = date('m');
		foreach($flle_array as $key => $value) {
//			pre_var_dump($value);
			preg_match('/image/', $value['type'], $value_array);
//			pre_var_dump($value_array);
			if($value_array[0]) {
				$ajax_fileupload_html .= '<li>
					<img src="'.$file_upload_directry_path.'/'.$now_year.'/'.$now_month.'/'.$value['full_name'].'">
					<span class="name">'.$value['full_name'].'</span>
					<span class="hidden_url">'.$file_upload_directry_path.'/'.$now_year.'/'.$now_month.'/'.$value['full_name'].'</span>
					<div class="url_copy_btn">URL をクリップボードにコピー</div>
					<div class="torst">　</div>
				</li>';
			}
				else {
					$ajax_fileupload_html .= '<li>
						<img class="svg" src="'.HTTP.'app/theme/admin/assets/img/svg/basic_fileupload_file_1.svg">
						<span class="name">'.$value['full_name'].'</span>
						<span class="hidden_url">'.$file_upload_directry_path.'/'.$now_year.'/'.$now_month.'/'.$value['full_name'].'</span>
						<div class="url_copy_btn">URL をクリップボードにコピー</div>
						<div class="torst">　</div>
					</li>';
				}

/*
<pre class="debug">array(7) {
  ["full_name"]=>
  string(5) "1.png"
  ["name"]=>
  string(1) "1"
  ["extension"]=>
  string(4) ".png"
  ["type"]=>
  string(9) "image/png"
  ["size"]=>
  int(459193)
  ["tmp_name"]=>
  string(36) "/Applications/MAMP/tmp/php/phpTGzgUf"
  ["random_name"]=>
  string(32) "d87104e9164c1bc5c2fdd0976132e921"
}*/
		}
		$ajax_fileupload_html = 
		'<div class="fileupload_show">
			<ul>'.
				$ajax_fileupload_html
			.'</ul>
		</div>';
		return $ajax_fileupload_html;
	}




}