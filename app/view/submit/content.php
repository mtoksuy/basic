

	 <!-- analytics -->
	<div class="analytics">
		<div class="analytics_inner">
			<!-- section_block -->
			<div class="section_block" style="margin:-50px 0 150px 0;">
				<p>チェック結果</p>
				<div class="table_block">
					<div class="hr">
						<p class="hd w_30">URL</p><p class="w_70"><?php echo $json_array_data[0][0]; ?></p>
					</div>
				</div>

				<div class="table_block">
					<div class="hr">
						<p class="hd">キーワード</p><p class="hd">Google</p>
					</div>
					<?php		
					foreach($json_array_data as $key => $value) {
						echo 
						'<div class="hr">
							<p>'.$value[1].'</p><p>'.$value[2].'</p>
						</div>';
					}
					?>
				</div>
			</div> <!-- section_block -->




			<!-- section_block -->
			<div class="section_block">
				<p>UXSEOが提供するSEO検索順位チェックツールです。キーワードを設定して全自動でRank Tracking(ログインが必要 新規登録は <a class="o_8" href="<?php echo HTTP;?>seo-tool/analytics/signup/">はじめる</a> )。いつでもどんな時も好きな時に。完全無料。</p>
			</div> <!-- section_block -->
			<!-- section_block -->
			<div class="section_block">
				<form method="post" action="" class="analytics_form">
					<p>URL</p>
					<input type="text" placeholder="http://" value="" required="required" name="url" id="url">

					<p>検索順位を知りたいキーワード(3つ同時までチェックできます)</p>
					<input type="text" placeholder="" value="" required="required" name="keyword_1" id="keyword_1">
					<input type="text" placeholder="" value="" name="keyword_2" id="keyword_2">
					<input type="text" placeholder="" value="" name="keyword_3" id="keyword_3">
					<input type="submit" value="チェックする" name="submit">
				</form>
			</div> <!-- section_block -->





		</div> <!-- analytics_inner -->
	</div> <!-- analytics -->
