<?php
	// 記事リスト取得
	$article_list_res = model_sample_basis::article_list_get(10,1);
//	pre_var_dump($article_list_res);
	// 記事リストHTML生成
	$article_list_html = model_sample_html::article_list_html_create($article_list_res);
?>

<div class="root">
	<div class="root_inner">
		<h1>テーマ first_time のトップページです。</h1>
		<div class="card_article">
			<div class="card_article_inner">
					<?php echo $article_list_html; ?>
			</div> <!-- card_article -->
		</div> <!-- card_article_inner -->
	</div> <!-- content_inner -->
</div> <!-- content -->
