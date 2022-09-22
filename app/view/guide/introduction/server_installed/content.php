

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
							<a href="<?php echo HTTP; ?>guide/introduction/">
								<span>ResizeCDNとは？</span>
							</a>
						</li>
						<li>
							<a href="<?php echo HTTP; ?>guide/introduction/server_installed/">
								<span>導入するサーバー環境について</span>
							</a>
						</li>
					</ol>
				</div><!-- bread_list -->


				<h1>導入するサーバー環境について</h1>


				<!--guide_block -->
				<div class="guide_block">
					<h2>はじめに</h2>
					<p>基本的にはResizeCDNはどんな環境でも使用可能です。なぜならプレーンのHTMLを書き換えるだけで利用できる仕様だからです。ですが、その上でライブラリを使用するなどのパターンもありますので説明させていただきます。</p>
				</div>


				<!--guide_block -->
				<div class="guide_block">
					<h2>ResizeCDNライブラリを使用する前提であれば</h2>
					<ul>
						<li>Webサーバー</li>
						<li>PHP.5.4以上</li>
					</ul>

					<p>ライブラリは最小限のコードで構築しました。1ファイルのみでほぼデフォルトの状態で動くようになっています。</p>
				</div>


			</div>
		</div>
	</div> <!-- guide_inner -->
</div>
