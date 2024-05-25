<?php
class model_hashtag_basis {
	//--------------------------------------
	// ハッシュタグを含む記事データ取得
	//--------------------------------------
	public static function hashtag_article_data_get($hashtag, $get_num = 10, $page_num = 1) {
		// 取得する場所取得
		$start_list_num = ($page_num * $get_num) - $get_num;
		$hashtag_data_res = model_db::query("
			SELECT *
			FROM article
			WHERE hashtag LIKE '%" . addslashes('"') . $hashtag . addslashes('"') . "%'
			AND del = 0
			ORDER BY primary_id DESC
			LIMIT " . $start_list_num . ", " . $get_num . "");
		return $hashtag_data_res;
	}
	//-----------------------------------------------------------
	//次のさらに前の記事を見る記事リストがあるかチェック
	//-----------------------------------------------------------
	public static function next_hashtag_check($hashtag, $paging_num, $article_num) {
		// ネクスト地点取得
		$paging_num = $paging_num + 1;
		$start_article_num = $paging_num * $article_num;
		// 取得する場所取得
		$next_article_check_res = model_db::query("
			SELECT *
			FROM article
			WHERE hashtag LIKE '%" . addslashes('"') . $hashtag . addslashes('"') . "%'
			AND del = 0
			ORDER BY primary_id DESC
			LIMIT " . $start_article_num . ", " . $article_num . "");
		if ($next_article_check_res) {
			$next_hashtag_check = true;
		} else {
			$next_hashtag_check = false;
		}
		return $next_hashtag_check;
	}
}
