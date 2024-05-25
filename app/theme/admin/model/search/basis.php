<?php
class model_search_basis {
	//-------------------------
	// プロダクト検索res取得
	//-------------------------
	public static function products_search_res_get($get) {
		/*
		12.9.2 ブール全文検索
		https://dev.mysql.com/doc/refman/5.6/ja/fulltext-boolean.html
		
		世界一わかりやすい FULLTEXT INDEX の説明と気を付けるべきポイント
		https://zenn.dev/hiroakey/articles/9f68ad249af20c
		
		MySQLの全文検索で商品検索を作ってみた
		https://tech.smartshopping.co.jp/mysql_fulltextindex

		MySQL5.7で遊んでみよう
		https://www.slideshare.net/yoku0825/mysql57-54349575

		MySQL（Maria DB）で全文検索 (FULLTEXT INDEX) を使用する
		https://pgmemo.tokyo/data/archives/1299.html

		Mroongaの全文検索がいい感じだった
		https://qiita.com/nayuneko/items/e1d4cad31b9ec23fd12c

		Mroonga v12.03 documentation » 2. インストール
		https://mroonga.org/ja/docs/install.html

		MySQL 8.0 でも utf8mb4_general_ci を使い続けたい僕らは
		https://mita2db.hateblo.jp/entry/2020/12/07/000000

		MySQL パーティションで大規模なレコードを管理しよう
		https://sys-guard.com/post-12138/
		INSERT INTO taiou (user_id, name, title, naiyou)
		SELECT t1.user_id, t1.name, t1.title, t1.naiyou
		FROM taiou t1, taiou t2, taiou t3, taiou t4, taiou t5, taiou t6, taiou t7;
		↑結合してインサートするやり方。すごい。

		MySQL5.7と8.0における文字コード/照合順序の設定方法
		https://yoneyore.hatenablog.com/entry/2020/11/26/232128
		死ぬほど助かった。

		*/
		// キーワード部分クエリ生成
		list($query, $multi_query_check) = model_search_basis::keyword_partial_query_create($get);
		/*
		pre_var_dump($query);
		pre_var_dump($multi_query_check);
*/
		/*
LIKE 部分一致検索
		$products_search_res = model_db::query("
			SELECT primary_id, Title, ASIN, BrowseNodes, PrimaryImages, Brand, rating, review, Price, fall_percentage, rise_percentage
			FROM products
			WHERE ContextFreeName LIKE '%".$get['q']."%' AND del = 0
			OR Title LIKE '%".$get['q']."%' AND del = 0
			OR performance LIKE '%".$get['q']."%' AND del = 0
			OR Brand LIKE '%".$get['q']."%' AND del = 0
			ORDER BY ranking ASC
			LIMIT 0, 1000
		");
*/

		/*
LIKE 前文一致検索
		$products_search_res = model_db::query("
			SELECT primary_id, Title, ASIN, BrowseNodes, PrimaryImages, Brand, rating, review, Price, fall_percentage, rise_percentage
			FROM products
			WHERE ContextFreeName LIKE '".$get['q']."%' AND del = 0
			OR Title LIKE '".$get['q']."%' AND del = 0
			OR performance LIKE '".$get['q']."%' AND del = 0
			OR Brand LIKE '".$get['q']."%' AND del = 0
			ORDER BY ranking ASC
			LIMIT 0, 1000
		");
*/
		// 複数キーワードの場合
		if ($multi_query_check) {
			// 複数かつ「-」オプションが付与されてる場合
			if (preg_match('/-/', $query)) {
				$products_search_res = model_db::query("
					SELECT * 
					FROM products 
					WHERE MATCH(ContextFreeName, Title, performance, Brand) 
					AGAINST ('" . $query . "' IN BOOLEAN MODE)
					AND del = 0
					ORDER BY ranking ASC
					LIMIT 0, 1000
				");
			}
			// 通常の複数キーワードの場合
			else {
				$products_search_res = model_db::query("
						SELECT *, 
						MATCH (ContextFreeName, Title, performance, Brand) AGAINST ('" . $query . "' IN NATURAL LANGUAGE MODE) AS score 
						FROM products 
						WHERE del = 0
						ORDER BY score desc
						LIMIT 0, 1000
					");
			}
		}
		// 単一キーワードの場合
		else {
			$products_search_res = model_db::query("
					SELECT * 
					FROM products 
					WHERE MATCH(ContextFreeName, Title, performance, Brand) 
					AGAINST ('" . $query . "' IN BOOLEAN MODE)
					AND del = 0
					ORDER BY ranking ASC
					LIMIT 0, 1000
				");
		}
		//pre_var_dump($query);

		/**********************************************************
	例 FULLTEXTのインデックスを貼るSQL文
	ALTER TABLE `amatem`.`products` ADD FULLTEXT `FULLTEXT_INDEX` (`ContextFreeName`, `Title`, `performance`, `Brand`) KEY_BLOCK_SIZE = 2 WITH PARSER ngram;
FULLTEXT_INDEXはインデックスと名前(なんでもいい)


NATURAL LANGUAGE MODE 類似一致
SELECT *, MATCH (ContextFreeName, Title, performance, Brand) AGAINST ('スマホ' IN NATURAL LANGUAGE MODE) AS score FROM products ORDER BY score desc;

BOOLEAN MODE 完全に一致
('*アイズ*' IN BOOLEAN MODE) 部分一致
- NOT
+ AND
例
SELECT * FROM products WHERE MATCH(ContextFreeName, Title, performance, Brand) AGAINST ('+シリーズ +ワイヤレ' IN BOOLEAN MODE)

('あい こい' IN BOOLEAN MODE) OR一致 あんま使わんかも 基本は+でANDで繋げてく
		 **********************************************************/
		return $products_search_res;
	}
	//------------------
	// 記事検索res取得
	//------------------
	public static function article_search_res_get($get) {
		$article_search_res = model_db::query("
			SELECT *
			FROM article
			WHERE title LIKE '%" . $get['q'] . "%' AND del = 0
			OR content LIKE '%" . $get['q'] . "%' AND del = 0
			ORDER BY primary_id DESC
			LIMIT 0, 1000
		");
		return $article_search_res;
	}
	//--------------------
	//  resの中身カウント
	//--------------------
	public static function res_count_get($res) {
		$res_count = 0;
		foreach ($res as $key => $value) {
			$res_count++;
		}
		return $res_count;
	}
	//-----------------------------
	//  キーワード部分クエリ生成
	//-----------------------------
	public static function keyword_partial_query_create($get) {
		// 複数クエリチェック変数
		$multi_query_check = false;
		// 半角全角スペースを統一する
		$get['q'] = preg_replace('/ /', '　', $get['q']);
		$get_q_explode = explode('　', $get['q']);
		foreach ($get_q_explode as $key => $value) {
			if ($value === '') {
				// 削除
				unset($get_q_explode[$key]);
			}
		}
		// 配列を詰める
		$get_q_explode = array_merge($get_q_explode);
		foreach ($get_q_explode as $key => $value) {
			// 複数クエリチェック変数 true変更
			if ($key >= 1) {
				$multi_query_check = true;
			}
			// オプション「-」である場合(NOT)
			if (preg_match('/^-/', $value)) {
				$value = preg_replace('/-/', '', $value);
				$query = $query . '-' . $value . ' ';
			}
			// オプション「""」である場合(完全一致)
			else if (preg_match('/^\&quot;(.*?)\&quot;$/', $value, $value_array)) {
				$query = $query . $value_array[1] . ' ';
			} else {
				$query = $query . '+' . $value . ' ';
			}
		}
		// 文末の半角空白を削除
		$query = preg_replace('/ $/', '', $query);
		return array($query, $multi_query_check);
	}
	//--------------------------
	//  キーワードexplode取得
	//--------------------------
	public static function keyword_explode_get($get) {
		// 複数クエリチェック変数
		$multi_query_check = false;
		// 半角全角スペースを統一する
		$get['q'] = preg_replace('/ /', '　', $get['q']);
		$get_q_explode = explode('　', $get['q']);
		foreach ($get_q_explode as $key => $value) {
			if ($value === '') {
				// 削除
				unset($get_q_explode[$key]);
			}
		}
		// 配列を詰める
		$get_q_explode = array_merge($get_q_explode);
		foreach ($get_q_explode as $key => $value) {
			// オプション「-」である場合(NOT)
			if (preg_match('/^-/', $value)) {
				$value = preg_replace('/-/', '', $value);
				$get_q_explode[$key] = $value;
			}
			// オプション「""」である場合(完全一致)
			else if (preg_match('/^\&quot;(.*?)\&quot;$/', $value, $value_array)) {
				$get_q_explode[$key] = $value_array[1];
			} else {
			}
		}
		return $get_q_explode;
	}
}
