

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
							<a href="<?php echo HTTP; ?>guide/introduction/resizecdn_glossary/">
								<span>ResizeCDN用語集</span>
							</a>
						</li>





					</ol>
				</div><!-- bread_list -->


				<h1>ResizeCDN用語集</h1>

				<!--guide_block -->
				<div class="guide_block">
					<p>ResizeCDN内で使用される用語に関しての説明ページです。</p>
				</div>

				<!--guide_block -->
				<div class="guide_block">
				<h2>CDNとは</h2>
					<p>コンテンツデリバリーネットワークとはウェブコンテンツをインターネット経由で配信するために最適化されたネットワークの事です。</p>
				</div>

				<!--guide_block -->
				<div class="guide_block">
				<h2>プッシュ型のCDN</h2>
					<p>CDNサービスを展開している会社のサーバーにファイルを配置してコンテンツを配信するタイプのCDNです。</p>
				</div>


				<!--guide_block -->
				<div class="guide_block">
				<h2>独自のダイレクト型とデータ型</h2>
				<h3>ダイレクト型とは</h3>
					<p>ダイレクト型とは「ResizeCDNライブラリ(PHP製)」を使用してファイル編集するだけで自動でCDN化される仕様の独自の型となっております。
なお、HTML編集時も「CDN自動変換ツール」を使用して手軽にCDNを利用する事が可能です。</p>
				<h3>データ型とは</h3>
					<p>データ型とは事前にResizeCDN内で画像をアップロードしてCDN化する仕様となっております。
フォルダ概念で画像の管理も可能でダイレクト型とは一味違うお手軽さです。「ResizeCDNライブラリ(PHP製)」や「CDN自動変換ツール」が難しい初心者様に向けた型となっております。</p>
				</div>






			</div>
		</div>
	</div> <!-- guide_inner -->
</div>
