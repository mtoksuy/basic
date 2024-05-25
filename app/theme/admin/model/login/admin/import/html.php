<?php
class model_login_admin_import_html {
	//----------------------------
	// インポート設定HTML生成
	//----------------------------
	public static function import_html_create($user_data_array) {
		$import_html = '
			<div class="import">
				<div class="import_inner">
					<div class="content_box">
						<div class="left">
							<b>WordPress</b>
							<a href="' . HTTP . 'login/admin/import/?import=wordpress">インポートする</a>
						</div>
						<div class="right">
							<p>WordPress のエクスポートファイルから投稿をインポートします。</p>
						</div>
					</div>
				</div>
			</div>';
		return $import_html;
	}
	//--------------------------------
	// インポート詳細設定HTML生成
	//--------------------------------
	public static function import_detail_html_create($user_data_array, $get) {
		// wordpressの場合
		if ($get['import'] == 'wordpress') {
			$import_detail_html = '
			<div class="import">
				<div class="import_inner">
					<div class="content_box">
					<form enctype="multipart/form-data" id="import_form" method="post" action="">
						<div>
							<label for="upload">自分のコンピュータからファイルを選択: (最大サイズ: 256 MB)</label>
							<input type="file" id="upload" name="import_file">
						</div>
							<p class="submit"><input type="submit" name="submit" value="ファイルをアップロードしてインポート"></p>
					</form>
					</div>
					</div>
				</div>
			</div>';
		}
		return $import_detail_html;
	}
}
