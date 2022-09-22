
<div class="guide">
	<div class="guide_inner">
		<?php require_once(PATH.'view/guide/guide_drawer.php'); /* guide_drawer読み込み*/ ?>
		<div class="guide_box">
			<div class="guide_box_inner">

				<!-- bread_list -->
				<div class="bread_list">
					<ol>
						<li>
							<a href="<?php echo HTTP; ?>">
								<span>ResizeCDN</span>
							</a>
						</li>
						<li>
							<a href="<?php echo HTTP; ?>guide/">
								<span>ガイド</span>
							</a>
						</li>
						<li>
							<a href="<?php echo HTTP; ?>guide/html_conversion_tool/">
								<span>RCDN自動変換ツール</span>
							</a>
						</li>
					</ol>
				</div><!-- bread_list -->


			<div class="direct_html">
				<div class="direct_html_inner">
					<h1>CDN自動変換ツール</h1>
					<!--content_block -->
					<div class="content_block">
						<div class="content_block_flex">
							<div class="left">
								<textarea placeholder="変換したいHTMLを挿入" name="before" id="before"></textarea>
							</div> <!--left -->
							<div class="right">
								<textarea placeholder="CDN化されたHTMLが出力されます" name="after" id="after"></textarea>



							</div> <!--right -->
						</div> <!--content_block_flex -->
						<div class="before_after_notice"></div>
						<div class="before_after_error_notice"></div>
					</div> <!--content_block -->

























				</div> <!-- direct_html_inner -->
			</div> <!-- direct_html -->









			</div>
		</div>
	</div> <!-- guide_inner -->
</div>
