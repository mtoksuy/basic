
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
							<a href="<?php echo HTTP; ?>guide/direct_reference/">
								<span>ダイレクト型リファレンス</span>
							</a>
						</li>
					</ol>
				</div><!-- bread_list -->



			<div class="direct_html">
				<div class="direct_html_inner">
					<h1>ダイレクト型リファレンス</h1>
					<!--content_block -->
					<div class="content_block">
						<h2>API</h2>
						<div class="content_block_flex">
							<div class="left">
								<p>ダイレクト型はたった1つのREST(GET)で構成されています。ResizeCDNのAPIはスピーディーかつパワフルに動きます。</p>
							</div> <!--left -->
							<div class="right">
								<div class="code_block">
									<div class="code_block_top">
										<div class="code_block_top_title">Base REST</div>
									</div>
									<pre class=""><code>https://resizecdn.com/direct/img/</code></pre>
								</div> <!--code_block -->
							</div> <!--right -->
						</div> <!--content_block_flex -->
					</div> <!--content_block -->



					<!--content_block -->
					<div class="content_block">
						<h2>使い方</h2>
						<div class="content_block_flex">
							<div class="left">
								<p>元から記述されたimgタグのsrcを変更するだけでResizeCDNがご利用いただけます。</p>
							</div> <!--left -->
							<div class="right">
								<div class="code_block">
									<div class="code_block_top">
										<div class="code_block_top_title">Change HTML</div>
									</div>
									<pre class=""><code>&lt;img src="[絶対パス]"&gt;
↓
&lt;img src="https://resizecdn.com/direct/img/?resizecdn_id=[resizecdn_id]&url=[絶対パス]"&gt;</code></pre>
								</div> <!--code_block -->
							</div> <!--right -->
						</div> <!--content_block_flex -->
					</div> <!--content_block -->


					<!--content_block -->
					<div class="content_block">
						<h2>オプション</h2>
						<div class="content_block_flex">
							<div class="left">
								<p>4つのオプションがご利用いただけます。</p>
								<ul class="option">
									<li><h4>resizecdn_id <span style="color: rgb(251, 59, 61);">必須</span></h4><span>resizecdn_idの記述が必須です。</span></li>
									<li><h4>url <span style="color: rgb(251, 59, 61);">必須</span></h4><span>絶対パスのみ指定できます。画像URL。<span></li>
									<li><h4>w</h4><span>横サイズの指定できます。縦サイズは横の大きさに応じて自動で変更致します。</span></li>
									<li><h4>type</h4><span>画像のタイプを指定できます。元の画像タイプとwebpを指定する事が可能です。<span></li>
								</ul>
							</div> <!--left -->
							<div class="right">
								<div class="code_block">
									<div class="code_block_top">
										<div class="code_block_top_title">Option Template HTML</div>
									</div>
									<pre class=""><code>&lt;img src="https://resizecdn.com/direct/img/?<span style="color: rgb(110, 177, 78); ">resizecdn_id=[resizecdn_id]&url=[絶対パス]&w=1280&type=jpg</span>"&gt;</code></pre>
								</div> <!--code_block -->
							</div> <!--right -->
						</div> <!--content_block_flex -->
					</div> <!--content_block -->



















					<!--content_block -->
					<div class="content_block" id="seo">
						<h2>SEO最適化</h2>
						<div class="content_block_flex">
							<div class="left">
								<p>SEOに最適化した記述方法はこちらになります。</p>
							</div> <!--left -->
							<div class="right">
								<div class="code_block">
									<div class="code_block_top">
										<div class="code_block_top_title">SEO Optimize Template HTML</div>
									</div>
									<pre class=""><code>&lt;picture&gt;
	&lt;source type="image/webp" srcset="https://resizecdn.com/direct/img/?<span style="color: rgb(110, 177, 78); ">resizecdn_id=[resizecdn_id]&url=[絶対パス]&w=1280&type=webp</span>"&gt;
	&lt;img src="https://resizecdn.com/direct/img/?<span style="color: rgb(110, 177, 78); ">resizecdn_id=[resizecdn_id]&url=[絶対パス]&w=1280&type=jpg</span>" width="1280" height="800" decoding="async" loading="lazy"&gt;
&lt;/picture&gt;</code></pre>
								</div> <!--code_block -->
							</div> <!--right -->
						</div> <!--content_block_flex -->
					</div> <!--content_block -->








				</div> <!-- direct_html_inner -->
			</div> <!-- direct_html -->













			</div>
		</div>
	</div> <!-- guide_inner -->
</div>
