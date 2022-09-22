<div class="search_result root">
	<div class="search_result_inner root_inner">
		<div class="card_article">
			<div class="card_article_inner">
				<h1><?php echo $get['q'] ?> の検索結果</h1>
				<span><?php echo $Number_of_expand;?>件</span>
				<div class="category_section">
					<ol>	
						<?php echo $all_bargain_product_list_li_html; ?>
					</ol>
				</div>
				<?php echo $article_list_html; ?>
			</div>
		</div>

	</div>
</div>
