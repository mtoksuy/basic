<div class="root">
	<div class="root_inner">
		<h1><?php echo $get['q']; ?> の検索結果</h1>
		<span><?php echo $res_count; ?>件</span>
		<div class="card_article">
			<div class="card_article_inner">
				<?php echo $article_list_html; ?>
			</div> <!-- card_article -->
		</div> <!-- card_article_inner -->
	</div> <!-- search_inner -->
</div> <!-- search -->