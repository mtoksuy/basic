

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

					</ol>
				</div><!-- bread_list -->


				<h1>ResizeCDNとは？</h1>

				<!--guide_block -->
				<div class="guide_block">
					<p>ResizeCDNはCDN(コンテンツ・デリバリーネットワーク)というジャンルのWebサイト支援ツールです。</p>
					<p>サイト上で使用している画像をCDN化し表示速度を上げ、Google評価とユーザーの評価を上げる事を得意としています。</p>
					
					<p>そのCDNサービスであるResizeCDNは画像に特化しており自動で画像の圧縮と新しい画像フォーマットであるwebpの画像を生成致します。更にwebp対応しているブラウザにはwebpを返し、対応していないブラウザにはそのままの画像を返しますのでサイト運営者様がwebpを作成したりブラウザ別対応をしなくて良いので時間短縮にも繋がりコンテンツ作成に集中できますのでぜひご活用して下さい。</p>
					<ul>
						<li><a href="<?php echo HTTP; ?>guide/introduction/you_can_do_with_it/">ResizeCDNを利用してできること</a></li>
						<li><a href="<?php echo HTTP; ?>guide/introduction/server_installed/">導入するサーバー環境について</a></li>
						<li><a href="<?php echo HTTP; ?>guide/introduction/description_login/">ログイン後の画面の説明</a></li>
						<li><a href="<?php echo HTTP; ?>guide/introduction/resizecdn_glossary/">ResizeCDN用語集</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div> <!-- guide_inner -->
</div>
