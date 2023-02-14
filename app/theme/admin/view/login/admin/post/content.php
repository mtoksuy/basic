
<div class="markdown_editor">
	<div class="markdown_editor_inner">
		<form method="post" action="" class="post_form" style="<?php $is_mac = basic::is_mac();if(!$is_mac) {echo 'width: 75%;';}?>">
			<input type="text" placeholder="タイトルを記入" value="<?php echo $preview_array['title']; ?>" name="title" id="title">
			<textarea placeholder="投稿内容を記入" name="content" id="content"><?php echo $preview_array['content']; ?></textarea>
			<!--  記事・basic_id情報 -->
			<input  type="hidden" value="<?php echo $preview_array['draft_id']; ?>" name="draft_id" id="draft_id">
			<input  type="hidden" value="<?php echo $preview_array['article_id']; ?>" name="article_id" id="article_id">
			<input  type="hidden" value="<?php echo $preview_array['basic_id']; ?>" name="basic_id" id="basic_id">
			<!-- 保存機能 -->
			<div class="save_button_list">
			<?php 
					if($_GET['article_id']) {
							$save_html = '	<a class="check" href="'.HTTP.'article/'.$_GET['article_id'].'/" target="_blank">確認</a>
							<input class="edit" type="submit" value="編集" name="draft">';
					}
				else {
					$save_html = '<input class="preview" type="submit" value="プレビュー" name="preview">
					<input class="draft" type="submit" value="下書きとして保存" name="draft">
					<input class="submit" type="submit" value="投稿" name="submit">';
				}
				echo $save_html;
			?>
			</div>
		</form>
		<!-- 文字数チェック機能 -->
		<div class="text_count_check">
			現在の記事文字数<div class="text_count_check_num">0文字</div>
		</div>
		<!-- クリップ機能 -->
		<div class="clip">
			<ul>
				<li data-clip_name="index"><span class="howto">##index##</span>目次</li>
				<li data-clip_name="headline_1"><span class="howto"># </span>見出し1</li>
				<li data-clip_name="headline_2"><span class="howto">## </span>見出し2</li>
				<li data-clip_name="headline_3"><span class="howto">### </span>見出し3</li>
				<li data-clip_name="hashtag"><span class="howto">#</span>ハッシュタグ</li>
				<li data-clip_name="separator"><span class="howto">---</span>1行セパレーター<span class="howto"></span></li>
				<li data-clip_name="strong"><span class="howto">*</span>太文字<span class="howto">*</span></li>
				<li data-clip_name="marker"><span class="howto">__</span>マーカー<span class="howto">__</span></li>
				<li data-clip_name="link"><span class="howto">[text](url)</span>リンク</li>
				<li data-clip_name="card_link"><span class="howto"></span>カード形式リンク</li>
				<li data-clip_name="image"><span class="howto">(url)</span>画像</li>
				<li data-clip_name="list"><span class="howto">*</span>リスト</li>
				<li data-clip_name="checkpoint">チェックポイント</li>
				<li data-clip_name="box">囲み</li>
				<li data-clip_name="blowing">吹き出し</li>
				<li data-clip_name="quote">引用</li>
				<li data-clip_name="amazon">アマゾン</li>
			</ul>
		</div> <!-- クリップ機能 -->

		<!-- ショートカット下書き保存お知らせ機能 -->
		<div class="shortcut_notice">お知らせ</div>
	</div>
</div>
