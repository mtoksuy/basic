
		<nav class="admin_left_drawer">
			<div class="admin_left_drawer_inner">
				<ul class="border">
					<span>基本</span>
					<li<?php if($now == '') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/">サマリー</a>
					</li>
					<li<?php if($now == 'writer') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>writer/<?php echo $_SESSION['amatem_id']; ?>">マイページ</a>
					</li>
				</ul>
				<ul class="border">
					<span>基本機能</span>
					<li<?php if($now == 'php_reference') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/markdown_post/" target="_blank">ブログを書く</a>
					</li>
					<li<?php if($now == 'list') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/list/">投稿一覧</a>
					</li>
					<li<?php if($now == 'draft') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/draft/">下書き一覧</a>
					</li>
				</ul>

				<ul class="border">
					<span>記事作成補助機能</span>
					<li<?php if($now == 'images_add') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/images_add/" target="_blank">画像登録</a>
					</li>
					<li<?php if($now == 'amazon_v2_markdown_create') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/amazon_v2_markdown_create/" target="_blank">アマゾンv2マークダウン生成</a>
					</li>
				</ul>

				<ul class="border">
					<span>アカウント設定</span>
					<li<?php if($now == 'profile_edit') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/profile_edit/">プロフィール設定</a>
					</li>
				</ul>

				<?php
					if($amatem_id == 'mtoksuy' OR $amatem_id == 'amatem') {?>

				<ul class="border">
					<span>圧縮機能</span>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>gzip/generate/" target="_blank">手動で圧縮ファイル生成</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>gzip/riflesh/" target="_blank">圧縮ファイルをリフレッシュ</a>
					</li>
				</ul>


				<ul class="border">
					<span>カテゴリー管理機能</span>

					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/category_add/" target="_blank">カテゴリー追加</a>
					</li>
				</ul>

				<ul class="border">
					<span>amazon_cron_list管理機能</span>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/amazon_api/node_add.php" target="_blank">BrowseNodeId追加</a>
					</li>
				</ul>






				<ul class="border">
					<span>フェッチ機能</span>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/category_directory_fetch/" target="_blank">カテゴリーディレクトリフェッチ</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/products_directory_fetch/" target="_blank">商品ディレクトリフェッチ</a>
					</li>
				</ul>

				<ul class="border">
					<span>生成機能</span>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/article_directory_create/" target="_blank">記事ディレクトリ生成</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/category_directory_create/" target="_blank">カテゴリーディレクトリ生成</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/products_directory_create/" target="_blank">商品ディレクトリ生成</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/sitemap_xml_create/" target="_blank">sitemap.xml生成</a>
					</li>
				</ul>









				<ul class="border">
					<span>プロダクト機能</span>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/amazon_api/rating_add.php" target="_blank">評価を登録</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/amazon_api/category_performance_type_add.php" target="_blank">カテゴリ別性能種類を登録</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/amazon_api/products_performance_add.php" target="_blank">プロダクト性能を登録</a>
					</li>



				</ul>

				<ul class="border">
					<span>cron機能</span>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>cron/amazon_api/node.php" target="_blank">Amazon_nodeを進める</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>cron/amazon_api/products_cron_patrol_v2.php" target="_blank">Amazonプロダクト巡回v.2</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>gzip/generate/product.php" target="_blank">プロダクト巡回100静的</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>gzip/generate/article.php" target="_blank">記事巡回10静的</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>gzip/generate/category.php" target="_blank">カテゴリー巡回10静的</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>cron/amazon_api/products_fall_percentage_fix.php" target="_blank">プロダクト割引・割高数値修正</a>
					</li>
				</ul>

				<ul class="border">
					<span>手動修正機能</span>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>cron/amazon_api/products_performance_value_create.php" target="_blank">プロダクト性能value生成</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>cron//tool/products_contextfreename_fix.php" target="_blank">productsのContextFreeName修正ツール</a>
					</li>
				</ul>

				<?php 
				// ローカル
				if(preg_match('/localhost/',$_SERVER["HTTP_HOST"])) {?>
				<ul class="border">
					<span>ローカル機能</span>
					<li<?php if($now == 'php_reference') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>cron/tool/deploy_pre_batch_del_fix.php" target="_blank">デプロイ準備一括削除ツール</a>
					</li>
				</ul>
				<?php } ?>
				<ul class="border">
					<span>廃止機能</span>
					<li<?php if($now == 'php_reference') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/post/">(旧)ブログを書く</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>article/draft/">下書き確認</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>tool/index_h_con/">目次を見出しに変換するツール</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/product_add/">アイテム登録</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>cron//tool/products_category_id_fix.php" target="_blank">products category_id修正ツール</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>cron//tool/amazon_cron_list_category_id_fix.php" target="_blank">amazon_cron_list category_id修正ツール</a>
					</li>
					<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>cron/amazon_api/products_cron_patrol.php" target="_blank">プロダクト巡回</a>
					</li>
				</ul>









					<?php }
				?>
			</div>
		</nav>
