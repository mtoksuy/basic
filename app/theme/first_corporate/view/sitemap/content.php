
<div class="sitemap">
	<div class="sitemap_inner">
		<h1 class="sitemap_title">サイトマップ</h1>
		<div class="sitemap_contents">
			<div class="section_block">
				<h2>トップページ</h2>
				<ul>
					 <li>
						<a href="<?php echo HTTP; ?>"><?php echo $site_data_array['title']; ?></a>
					</li>
				</ul>
				<h2>お問い合わせ</h2>
				<ul>
					 <li>
						<a href="<?php echo HTTP.'contact/'; ?>"><?php echo 'お問い合わせ｜'.$site_data_array['title']; ?></a>
					</li>
				</ul>
				<h2>コンテンツ</h2>
				<ul>
					<?php echo $article_list_li; ?>
				</ul>
				<h2>ページ</h2>
				<ul>
					<?php echo $page_list_li; ?>
				</ul>
				<h2>サイトマップ</h2>
				<ul>
					 <li>
						<a href="<?php echo HTTP.'sitemap/'; ?>"><?php echo 'サイトマップ｜'.$site_data_array['title']; ?></a>
					</li>
					 <li>
						<a href="<?php echo HTTP.'sitemap/sitemap.xml'; ?>">sitemap.xml</a>
					</li>
				</ul>
			</div>
		</div> <!-- card_article_inner -->
	</div> <!-- content_inner -->
</div> <!-- content -->
