<?php
class model_sample_basis {
	//----------------
	//記事リスト取得
	//----------------
	public static function article_list_get($get_num = 10, $page_num = 1) {
		// 取得する場所取得
		$start_list_num = ($page_num*$get_num)-$get_num;
		$article_list_res = model_db::query("
			SELECT *
			FROM article
			WHERE del = 0
			ORDER BY primary_id DESC
			LIMIT ".$start_list_num.", ".$get_num."");
		return $article_list_res;
	}
	//------------------------------
	//まとめページングデータ取得
	//------------------------------
	public static function article_paging_data_get($list_num, $paging_num) {
		// last_num取得
		$max_res = model_db::query("
			SELECT COUNT(primary_id)
			FROM article
			WHERE del = 0");
		foreach($max_res as $key => $value) {
			$last_num = (int)$value['COUNT(primary_id)'];
		}
		// 最大ページング数取得
		$max_paging_num = (int)ceil($last_num/$list_num);
		// new_article_paging_data生成
		$new_article_paging_data_array = array(
			'last_num'       => $last_num,
			'list_num'       => $list_num,
			'paging_num'     => $paging_num,
			'max_paging_num' => $max_paging_num,
		);
		return $new_article_paging_data_array;
	}
	//--------------
	//記事データ取得
	//--------------
	public static function article_get($method) {
		$article_res = model_db::query("
			SELECT * 
			FROM article 
			WHERE primary_id = ".$method."
			AND del = 0
			LIMIT 0, 1");
		return $article_res;
	}
}