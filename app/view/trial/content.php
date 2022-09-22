<?php preg_match('/Version\/(.*?) Safari/', $_SERVER['HTTP_USER_AGENT'], $agent_array); ?>
<div class="trial">
	<div class="trial_inner">
		<h1 class="trial_inner_title">お試し</h1>
		<p class="trial_inner_sub m_0">お試しですので画像管理はできません。</p>
		<p class="trial_inner_sub m_0">出来るのは画像アップ、HTML生成、HTMLコピペのみです。</p>
		<p class="trial_inner_sub">※ アップされた画像は一定期間で削除されます</p>
		<div class="trial_inner_box">
			<!-- ドロップ画像 -->
			<div id="upFileWrap">
			    <div id="inputFile">
			        <!-- ドラッグ&ドロップエリア -->
			        <p id="dropArea">ここに<?php if($agent_array) { echo 'フォルダ・ファイル';}else {echo 'ファイル';}?>をドロップしてください<br>または</p>
			        <!-- 通常のinput[type=file] -->
			        <div id="inputFileWrap">
						<form id="upload_form" name="upload_form" method="post" action="" enctype="multipart/form-data">
							<?php
// safariだけ
if($agent_array) {
	echo '<input type="file" name="uploadFile[]" id="uploadFile" accept="image/*" multiple="multiple" webkitdirectory directory />';
}
	// それ以外
	else {
		echo '<input type="file" name="uploadFile[]" id="uploadFile" accept="image/*" multiple>';
	}
/*
string(119) "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.5 Safari/605.1.15"
string(121) "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36"
string(137) "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36 Edg/87.0.664.75"
string(82) "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:80.0) Gecko/20100101 Firefox/80.0"
string(139) "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.121 Safari/537.36 OPR/71.0.3770.198"

*/
/*
後で！
chrome用
<input type="file" name="uploadFile[]" id="uploadFile" accept="image/*" multiple>
safari用
<input type="file" name="uploadFile[]" id="uploadFile" accept="image/*" multiple="multiple" webkitdirectory directory />
*/
							?>
<!-- テスト用
								<input  class="upload_form_submit" type="submit" value="送信" name="submit">
-->
						</form>
			            <div id="btnInputFile">
							<span><?php if($agent_array) { echo 'フォルダ・ファイル';}else {echo 'ファイル';}?>を選択する</span>
						</div>
			        </div>
			    </div>
			</div> <!-- ドロップ画像 -->
			<!-- ローディング -->
            <div class="loding">

			</div> <!-- ローディング -->
			<div class="trial_inner_html_create_box">
				<textarea  class="trial_inner_html_create" placeholder="アップした画像のHTMLが生成されます" name="trial_inner_html_create" id="trial_inner_html_create"></textarea>
				<div class="cdn_html_copy_btn">HTMLコピー</div>
				<div class="torst">　</div>
			</div>
		</div> <!-- trial_inner_box -->
		<!-- upload_cdn_view -->
		<div class="upload_cdn_view">


		</div> <!-- upload_cdn_view -->
	</div> <!-- trial_inner -->
</div> <!-- trial -->
