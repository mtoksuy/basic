
<div class="markdown_editor">
	<div class="markdown_editor_inner">
		<form method="post" action="" class="post_form" style="<?php $is_mac = basic::is_mac();if(!$is_mac) {echo 'width: 75%;';}?>">
			<div class="title"><?php echo $site_data_array['theme'].'　：　'.$file_word; ?></div>
			<textarea placeholder="テンプレート内容記入" name="content" id="content"><?php echo $file_content; ?></textarea>
			<!--  記事・basic_id情報 -->
			<input  type="hidden" value="<?php echo $preview_array['basic_id']; ?>" name="basic_id" id="basic_id">
			<!-- 保存機能 -->
			<div class="save_button_list">
					<input class="submit" type="submit" value="ファイルを保存" name="submit">
			</div>
		</form>
		<!-- ファイル選択機能 -->
		<div class="clip">
			<?php echo $view_common_list_html; ?>
		</div> <!-- クリップ機能 -->
	</div>
</div>
