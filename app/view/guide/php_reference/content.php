
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
							<a href="<?php echo HTTP; ?>guide/php_reference/">
								<span>RsizeCDNリファレンス</span>
							</a>
						</li>
					</ol>
				</div><!-- bread_list -->


			<div class="direct_html">
				<div class="direct_html_inner">
					<h1>RsizeCDNリファレンス</h1>
					<!--content_block -->
					<div class="content_block">
						<h2>RsizeCDN ライブラリ</h2>
						<div class="content_block_flex">
							<div class="left">

								<p>ResizeCDNのライブラリはPHP製でシンプルに画像をCDN化する事が可能です。</p>
							</div> <!--left -->
							<div class="right">

							</div> <!--right -->
						</div> <!--content_block_flex -->
					</div> <!--content_block -->



					<!--content_block -->
					<div class="content_block">
						<h2>ダウンロード</h2>
						<div class="content_block_flex">
							<div class="left">
								<p><a href="https://resizecdn.com/assets/php/resizecdn-1.0.zip">RsizeCDNライブラリ1.0 ダウンロード</a></p>
								<p><a href="https://resizecdn.com/assets/php/resizecdn-1.0.min.zip">RsizeCDNライブラリ1.0.min ダウンロード</a></p>
								<p></p>
							</div> <!--left -->
							<div class="right">

							</div> <!--right -->
						</div> <!--content_block_flex -->
					</div> <!--content_block -->


					<!--content_block -->
					<div class="content_block">
						<h2>使い方</h2>
						<div class="content_block_flex">
							<div class="left">
								<p>ダウンロードしたresizecdn-1.0を解凍してルートディレクトリ配下の任意のディレクトリ に格納して下さい。</p>
								<p>右側にあるHow to use通りに記述しましょう。</p>
								<p>変換したいHTMLは1ページ丸ごとのHTMLでも問題ありませんが、記述量が多い場合は変換に時間がかかります。使い方としては部分変換に適しています。最速を目指す場合は総変換したHTMLで静的ページを生成するか、または<a href="<?php echo HTTP; ?>guide/html_conversion_tool/">CDN自動変換ツール</a>で変換作業を行うのがベストプラクティスです。 </p>
								<p>imgタグのみを変換致します。svgは変換しません。</p>
								<p>imgタグのsrcパスは基本的には絶対パス必須ですが、<span class="marker_1">set_convert_to_uriをセットすれば相対パスも可能</span>になります。</p>
								<p>変換後のHTMLはダイレクト型リファレンスの<a href="<?php echo HTTP; ?>guide/direct_reference/#seo">SEO Optimize Template HTML</a>をご覧下さい。</p>



							</div> <!--left -->
							<div class="right">
								<div class="code_block">
									<div class="code_block_top">
										<div class="code_block_top_title">How to use</div>
									</div>
									<pre class=""><code><span class="code_comment_color">// ResizeCDN読み込み</span>
<span class="code_1_color">require_once</span> <span class="code_2_color">'[ルートパス]/[任意ディレクトリ]/resizecdn-1.0.min.php'</span>;
<span class="code_comment_color">// インスタンスを生成</span>
<span class="code_3_color">$ResizeCDN</span> = <span class="code_1_color">new</span> <span class="code_4_color">ResizeCDN</span>();
<span class="code_comment_color">// 変換したいHTML</span>
<span class="code_3_color">$html</span> = <span class="code_2_color">'&lt;img src="[絶対パスor相対パス]"&gt;'</span>;
<span class="code_comment_color">// resizecdn_idをセット</span>
<span class="code_3_color">$ResizeCDN</span>-&gt;<span class="code_4_color">set_resizecdn_id</span>(<span class="code_2_color">'<?php if($resizecdn_id) {echo $resizecdn_id;} else {echo 'test';} ?>'</span>);
<span class="code_comment_color">// エラー表示セット</span>
<span class="code_3_color">$ResizeCDN</span>-&gt;<span class="code_4_color">set_resizecdn_display_errors</span>(<span class="code_3_color">1</span>);
<span class="code_comment_color">// 相対パスを絶対パスに変換セット</span>
<span class="code_3_color">$ResizeCDN</span>-&gt;<span class="code_4_color">set_convert_to_uri</span>(<span class="code_3_color">$base</span>);
<span class="code_comment_color">// htmlを変換</span>
<span class="code_3_color">$html</span> = <span class="code_3_color">$ResizeCDN</span>-&gt;<span class="code_4_color">html_conversion</span>(<span class="code_3_color">$html</span>);</code></pre>
								</div> <!--code_block -->
							</div> <!--right -->
						</div> <!--content_block_flex -->
					</div> <!--content_block -->
















					<!--content_block -->
					<div class="content_block">
						<h2>set_resizecdn_id</h2>
						<div class="content_block_flex">
							<div class="left">
								<p>resizecdn_idをセットする関数です。</p>
								<h3>引数</h3>
								<ul class="option">
									<li><h4>resizecdn_id <span style="color: rgb(251, 59, 61);">必須</span></h4><span>resizecdn_idの記述が必須です。</span></li>
								</ul>
							</div> <!--left -->
							<div class="right">
								<div class="code_block">
									<div class="code_block_top">
										<div class="code_block_top_title">ResizeCDN Function</div>
									</div>
									<pre class=""><code><span class="code_comment_color">// resizecdn_idをセット</span>
<span class="code_3_color">$ResizeCDN</span>-&gt;<span class="code_4_color">set_resizecdn_id</span>(<span class="code_2_color">'<?php if($resizecdn_id) {echo $resizecdn_id;} else {echo 'test';} ?>'</span>);</code></pre>
								</div> <!--code_block -->
							</div> <!--right -->
						</div> <!--content_block_flex -->
					</div> <!--content_block -->










					<!--content_block -->
					<div class="content_block">
						<h2>set_resizecdn_display_errors</h2>
						<div class="content_block_flex">
							<div class="left">
								<p>ResizeCDN内のエラー表示・非表示するセット関数です。</p>
								<h3>引数</h3>
								<ul class="option">
									<li><h4>0 or 1 <span style="color: rgb(251, 59, 61);">必須</span></h4><span>1でエラー表示。0でエラー非表示。<span></li>
								</ul>
							</div> <!--left -->
							<div class="right">
								<div class="code_block">
									<div class="code_block_top">
										<div class="code_block_top_title">ResizeCDN Function</div>
									</div>
									<pre class=""><code><span class="code_comment_color">// set_resizecdn_display_errorsをセット</span>
<span class="code_3_color">$html</span> = <span class="code_3_color">$ResizeCDN</span>-&gt;<span class="code_4_color">set_resizecdn_display_errors</span>(<span class="code_3_color">1</span>);</code></pre>
								</div> <!--code_block -->
							</div> <!--right -->
						</div> <!--content_block_flex -->
					</div> <!--content_block -->






























					<!--content_block -->
					<div class="content_block">
						<h2>set_convert_to_uri</h2>
						<div class="content_block_flex">
							<div class="left">
								<p>HTML内にある画像の相対パスを絶対パスに変換するセット関数です。</p>
								<h3>引数</h3>
								<ul class="option">
									<li><h4>$base <span style="color: rgb(251, 59, 61);">必須</span></h4><span>相対パスが配置してあったURLの変数。<br>
例 https://resizecdn.com/contact/など<span></li>
								</ul>
							</div> <!--left -->
							<div class="right">
								<div class="code_block">
									<div class="code_block_top">
										<div class="code_block_top_title">ResizeCDN Function</div>
									</div>
									<pre class=""><code><span class="code_comment_color">// convert_to_uriをセット</span>
<span class="code_3_color">$html</span> = <span class="code_3_color">$ResizeCDN</span>-&gt;<span class="code_4_color">set_convert_to_uri</span>(<span class="code_3_color">$base</span>);</code></pre>
								</div> <!--code_block -->
							</div> <!--right -->
						</div> <!--content_block_flex -->
					</div> <!--content_block -->


































					<!--content_block -->
					<div class="content_block">
						<h2>html_conversion</h2>
						<div class="content_block_flex">
							<div class="left">
								<p>HTMLからimgタグを探索してResizeCDNに変換する関数です。</p>
								<h3>引数</h3>
								<ul class="option">
									<li><h4>$html <span style="color: rgb(251, 59, 61);">必須</span></h4><span>変換したい変数。1ページ丸ごとのHTMLでも問題ありません。imgタグのみを変換致します。set_convert_to_uriをセットしない場合<span class="marker_1">srcは絶対パス必須</span>です。<span></li>
								</ul>
							</div> <!--left -->
							<div class="right">
								<div class="code_block">
									<div class="code_block_top">
										<div class="code_block_top_title">ResizeCDN Function</div>
									</div>
									<pre class=""><code><span class="code_comment_color">// htmlを変換</span>
<span class="code_3_color">$html</span> = <span class="code_3_color">$ResizeCDN</span>-&gt;<span class="code_4_color">html_conversion</span>(<span class="code_3_color">$html</span>);</code></pre>
								</div> <!--code_block -->
							</div> <!--right -->
						</div> <!--content_block_flex -->
					</div> <!--content_block -->































					<!--content_block -->
					<div class="content_block">
						<h2>convert_to_uri</h2>
						<div class="content_block_flex">
							<div class="left">
								<p>相対パスを絶対パスに変換する関数です。</p>
								<h3>引数</h3>
								<ul class="option">
									<li><h4>$target_path <span style="color: rgb(251, 59, 61);">必須</span></h4><span>相対パスの変数。<br>例 ../img/test.jpgなど</span></li>
									<li><h4>$base <span style="color: rgb(251, 59, 61);">必須</span></h4><span>相対パスが配置してあったURLの変数。<br>例 https://resizecdn.com/contact/など<span></li>
								</ul>
							</div> <!--left -->
							<div class="right">
								<div class="code_block">
									<div class="code_block_top">
										<div class="code_block_top_title">ResizeCDN Function</div>
									</div>
									<pre class=""><code><span class="code_comment_color">// 例</span>
<span class="code_3_color">$target_path</span> = <span class="code_2_color">'../img/test.jpg'</span>;
<span class="code_3_color">$base</span> = <span class="code_2_color">'https://resizecdn.com/contact'</span>;

<span class="code_comment_color">// 相対パスを絶対パスに変換</span>
<span class="code_3_color">$target_path</span> = <span class="code_3_color">$ResizeCDN</span>-><span class="code_4_color">convert_to_uri</span>(<span class="code_3_color">$target_path</span>, <span class="code_3_color">$base</span>);
<span class="code_comment_color">/***
echo $target_path;
出力結果
https://resizecdn.com/img/test.jpg
***/</span></code></pre>
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
