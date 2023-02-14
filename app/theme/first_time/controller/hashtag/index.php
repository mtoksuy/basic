<?php 
	$controller_query_explode = explode('/', $controller_query);
	// 定義されていない変数を空定義
	if(empty($controller_query_explode[2])) { $controller_query_explode[2] = ''; }
	if($controller_query_explode[2] == '') {
		$method = 0;
	}
	else if((int)$controller_query_explode[2] == 1) {
		$method = 1;
	}
	else {
		$method = (int)$controller_query_explode[2];
	}

	// 記事タイトル挿入
	$page_data_array['title'] = $hashtag_explode[1].'一覧：'.($method+1).'ページ目';
	// ページング1回でn回表示設定
	 $article_view_num = $site_data_array['article_view_num'];
	 // 次のページング数
	 $paging_num = $method+1;
	// ハッシュタグを含む記事データ取得
	$hashtag_data_res = model_hashtag_basis::hashtag_article_data_get($hashtag_explode[1], $article_view_num, $paging_num);
	// オールカテゴリー別記事データHTML生成
	$hashtag_list_html = model_article_html::article_list_html_create($hashtag_data_res);
	// 次のさらに前のハッシュタグを見るリストがあるかチェック
	$next_hashtag_check = model_hashtag_basis::next_hashtag_check($hashtag_explode[1], $method, $article_view_num);
	// ハッシュタグページングHTML生成
	$next_hashtag_html = model_hashtag_html::next_article_html_create($hashtag_explode[1], $next_hashtag_check, $paging_num);

	// 記事タイトル挿入
//	$page_data_array['title'] = $hashtag_explode[1];
	// ハッシュタグがある記事一覧HTML生成
//	$article_list_html = model_hashtag_html::hashtag_article_html_create($hashtag_data_res);

	// テンプレート読み込み
	require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/hashtag/template.php');