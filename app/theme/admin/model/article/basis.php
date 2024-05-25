<?php
class model_article_basis {
	//----------------
	//記事リスト取得
	//----------------
	public static function article_list_get($get_num = 10, $page_num = 1) {
		// 取得する場所取得
		$start_list_num = ($page_num * $get_num) - $get_num;
		$article_list_res = model_db::query("
			SELECT *
			FROM article
			WHERE del = 0
			ORDER BY primary_id DESC
			LIMIT " . $start_list_num . ", " . $get_num . "");
		return $article_list_res;
	}
	//-----------------------
	//ページングデータ取得
	//------------------------
	public static function article_paging_data_get($list_num, $paging_num) {
		// last_num取得
		$max_res = model_db::query("
			SELECT COUNT(primary_id)
			FROM article
			WHERE del = 0");
		foreach ($max_res as $key => $value) {
			$last_num = (int)$value['COUNT(primary_id)'];
		}
		// 最大ページング数取得
		$max_paging_num = (int)ceil($last_num / $list_num);
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
			WHERE primary_id = " . $method . "
			AND del = 0
			LIMIT 0, 1");
		return $article_res;
	}
	//----------------------------
	//前の記事、次の記事データ取得
	//----------------------------
	public static function article_previous_next_get($article_primary_id) {
		$query_p = model_db::query("SELECT * 
									FROM article
									WHERE primary_id < $article_primary_id
									AND del = 0
									ORDER BY primary_id DESC
									LIMIT 0 , 1");
		$query_n = model_db::query("SELECT * 
									FROM article
									WHERE primary_id > $article_primary_id
									AND del = 0
									ORDER BY primary_id ASC
									LIMIT 0 , 1");
		$article_previous_next_res_array = array(
			'previous' => $query_p,
			'next'     => $query_n,
		);
		return $article_previous_next_res_array;
	}

	//------------------------------
	//カテゴリー別記事データ取得
	//------------------------------
	public static function category_article_list_get($category_name) {
		// 取得する場所取得
		$category_article_res = model_db::query("
			SELECT *
			FROM article
			WHERE del = 0
			AND category = '" . $category_name . "'
			ORDER BY primary_id DESC");
		return $category_article_res;
	}
	//----------------------
	//カテゴリー情報取得
	//----------------------
	public static function category_data_get($category_name) {
		// 取得する場所取得
		$category_res = model_db::query("
			SELECT *
			FROM media_category
			WHERE category_name = '" . $category_name . "'
		");
		return $category_res;
	}
	//--------------------------
	//ライター記事データ取得
	//--------------------------
	public static function writer_article_get($method) {
		$article_res = model_db::query("
			SELECT * 
			FROM article 
			WHERE amatem_id = '" . $method . "'
			AND del = 0
			ORDER BY primary_id DESC");
		return $article_res;
	}
	//-----------------
	//関連記事res取得
	//-----------------
	public static function related_articles_res_get($primary_id, $hashtag) {
		$query = '';
		$related_articles_data_array = array();
		$related_articles_res = array();
		// hashtag(json)をarrayに戻す
		$hashtag_list_json_decode = json_decode($hashtag);
		// ある場合正常に実行
		if ($hashtag_list_json_decode) {
			foreach ($hashtag_list_json_decode as $key => $value) {
				$related_articles_res = model_db::query("
						SELECT * 
						FROM article 
						WHERE hashtag LIKE '%" . $value . "%'
						AND primary_id != " . $primary_id . "
						AND del = 0
						ORDER BY primary_id DESC
						LIMIT 0, 8
				");
				// 関連記事のprimary_id取得
				foreach ($related_articles_res as $key_1 => $value_1) {
					$related_articles_data_array[] = $value_1['primary_id'];
				}
			} // foreach($hashtag_list_json_decode as $key => $value) {
			// 重複ハッシュタグを削除
			$related_articles_data_array = array_unique($related_articles_data_array);
			// 歯抜けarrayを揃える
			$related_articles_data_array = array_values($related_articles_data_array);
			// INのリスト作成
			foreach ($related_articles_data_array as $key_2 => $value_2) {
				$query .= $value_2 . ', ';
			}
			// 文末の, を削除
			$query = rtrim($query, ', ');
			$query = 'WHERE primary_id IN (' . $query . ')';
			if ($related_articles_data_array) {
				$related_articles_res = model_db::query("
						SELECT * 
						FROM article 
						" . $query . "
						ORDER BY primary_id DESC
						LIMIT 0, 8
				");
			}
		}
		return $related_articles_res;
	}













	//-----------------------------------
	//さらに前の記事を見るデータ取得
	//-----------------------------------
	public static function next_article_list_res_get($paging_num = 0, $article_num = 20) {
		$start_article_num = $paging_num * $article_num;
		//		pre_var_dump($start_article_num);
		// 取得する場所取得
		$next_article_list_res = model_db::query("
			SELECT *
			FROM article
			WHERE del = 0
			ORDER BY primary_id DESC
			LIMIT " . $start_article_num . ", " . $article_num . "");
		// スタート地点取得
		$paging_num = $paging_num + 1;
		//		pre_var_dump($category_article_res);
		//		pre_var_dump($paging_num);
		return array($next_article_list_res, $paging_num);
	}
	//------------------------------------------
	// さらに前の記事を見るディレクトリ生成
	//-------------------------------------------
	public static function next_article_diractory_create($next_article_check, $paging_num) {
		//		var_dump($paging_num);
		if ($next_article_check) {
			$new_article_path = PATH . 'newarticle/' . $paging_num;
			// 指定されたディレクトリが存在するか確認
			if (file_exists($new_article_path)) {
				//存在したときの処理
				//			echo "作成しようとしたディレクトリは既に存在します";
			} else {
				//存在しない時ディレクトリを生成
				if (mkdir($new_article_path, 0777)) {
					//作成したディレクトリのパーミッションを変更
					chmod($new_article_path, 0777);
					// マスターファイルコピー
					copy(PATH . 'master/newarticle.php', $new_article_path . '/index.php');
					//作成に成功した時の処理
					//					echo "作成に成功しました";
				}
			}
		}
		return $next_article_html;
	}
	//-----------------------------------------------------------
	//次のさらに前の記事を見る記事リストがあるかチェック
	//-----------------------------------------------------------
	public static function next_article_check($paging_num, $article_num) {
		// ネクスト地点取得
		$paging_num = $paging_num + 1;
		/*
		pre_var_dump($paging_num);
		pre_var_dump($article_num);
*/
		$start_article_num = $paging_num * $article_num;
		//		pre_var_dump($start_article_num);
		// 取得する場所取得
		$next_article_check_res = model_db::query("
			SELECT *
			FROM article
			WHERE del = 0
			ORDER BY primary_id DESC
			LIMIT " . $start_article_num . ", " . $article_num . "");
		if ($next_article_check_res) {
			$next_article_check = true;
		} else {
			$next_article_check = false;
		}
		return $next_article_check;
	}
}
