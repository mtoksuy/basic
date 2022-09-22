
<div class="sitemap">
	<div class="sitemap_inner">
		<p class="sitemap_title_top"></p>
		<h1 class="sitemap_title">あまてむのサイトマップ</h1>
		<div class="sitemap_contents">
			<div class="section_block">
				<h2>トップページ</h2>
				<ul>
					<li><a href="<?php echo HTTP;?>"><?php echo TITLE;?></a></li>
				</ul>
				<h2>お問い合わせ</h2>
				<ul>
					<li><a href="<?php echo HTTP;?>contact/"><?php echo 'お問い合わせ｜'.TITLE;?></a></li>
				</ul>
				<h2>私たちについて</h2>
				<ul>
					<li><a href="<?php echo HTTP;?>aboutus/"><?php echo '私たちについて｜'.TITLE;?></a></li>
				</ul>
				<h2>規約関連</h2>
				<ul>
					<li><a href="<?php echo HTTP;?>rule/"><?php echo '利用規約｜'.TITLE;?></a></li>
					<li><a href="<?php echo HTTP;?>privacy_policy/"><?php echo 'プライバシーポリシー｜'.TITLE;?></a></li>
					<li><a href="<?php echo HTTP;?>sct/"><?php echo '特定商取引法に基づく表記｜'.TITLE;?></a></li>
				</ul>
				<h2>コンテンツ</h2>
				<ul>
					<?php echo $li_html_list; ?>
				</ul>


				<h2>カテゴリー・プロダクト</h2>
				<?php echo $category_products_list_html; ?>


				<h2>サイトマップ</h2>
				<ul>
					<li><a href="<?php echo HTTP;?>sitemap/"><?php echo 'サイトマップ｜'.TITLE;?></a></li>
					<li><a href="<?php echo HTTP;?>sitemap/sitemap.xml">sitemap.xml</a></li>
				</ul>
			</div>
		</div>
	</div> <!-- contact_inner -->
</div>
