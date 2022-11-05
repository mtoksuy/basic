<?php
class model_article_basis {
	//-------------------
	//全記事リスト取得
	//-------------------
	public static function article_all_list_get() {
		$article_all_list_res = model_db::query("
			SELECT *
			FROM article
			WHERE del = 0
			ORDER BY primary_id DESC");
		return $article_all_list_res;
	}
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
	//-----------------------
	//ページングデータ取得
	//------------------------
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
			LIMIT ".$start_article_num.", ".$article_num."");
		// スタート地点取得
		$paging_num = $paging_num+1;
//		pre_var_dump($category_article_res);
//		pre_var_dump($paging_num);
		return array($next_article_list_res, $paging_num);
	}
	//------------------------------------------
	// さらに前の記事を見るディレクトリ生成
	//-------------------------------------------
	public static function next_article_diractory_create($next_article_check, $paging_num) {
//		var_dump($paging_num);
		if($next_article_check) {
			$new_article_path = PATH.'newarticle/'.$paging_num; 
			// 指定されたディレクトリが存在するか確認
			if(file_exists($new_article_path)){
				//存在したときの処理
	//			echo "作成しようとしたディレクトリは既に存在します";
			}
				else {
					//存在しない時ディレクトリを生成
					if(mkdir($new_article_path, 0777)) {
						//作成したディレクトリのパーミッションを変更
						chmod($new_article_path, 0777);
						// マスターファイルコピー
						copy(PATH.'master/newarticle.php', $new_article_path.'/index.php');
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
		$paging_num = $paging_num+1;
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
			LIMIT ".$start_article_num.", ".$article_num."");
			if($next_article_check_res) {
				$next_article_check = true;
			}
				else {
					$next_article_check = false;
				}
		return $next_article_check;
	}
}