
		<!--  -->
		<nav class="drawer">
			<div class="drawer_inner">
				<ul>
					<li><a class="o_8" href="<?php echo HTTP;?>logout/">ログアウト</a></li>
					<?php
						if($amatem_idd === 'mtoksuy') {
							echo '<li style="margin: 0 15px;"><a class="o_8" href="'.HTTP.'media/post/" target="_blank">ブログを書く</a></li>
					<li style="margin: 0 15px;"><a class="o_8" href="'.HTTP.'media/article/draft/index.html" target="_blank">下書き確認</a></li>
					<li style="margin: 0 15px;"><a class="o_8" href="'.HTTP.'gzip/generate/" target="_blank">手動で圧縮ファイル生成</a></li>
					<li><a class="o_8" href="'.HTTP.'media/tool/index_h_con/" target="_blank">目次を見出しに変換するツール</a></li>';
						}
					?>
				</ul>
			</div>
		</nav>
