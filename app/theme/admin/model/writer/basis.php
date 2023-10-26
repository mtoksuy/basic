<?php
class model_writer_basis {
	//----------------------
	//ライターデータ取得
	//----------------------
	public static function writer_get($method) {
		$writer_res = model_db::query("
			SELECT * 
			FROM user
			WHERE basic_id = '".$method."'
			AND del = 0
			LIMIT 0, 1");
		return $writer_res;
	}
	//--------------------------
	//ライター記事データ取得
	//--------------------------
	public static function writer_article_get($method) {
		$writer_article_res = model_db::query("
			SELECT * 
			FROM article 
			WHERE basic_id = '".$method."'
			AND del = 0
			ORDER BY primary_id DESC
			LIMIT 0, 100
		");
		return $writer_article_res;
	}
	//-----------------------------------
	//さらに前の記事を見るデータ取得
	//-----------------------------------
	public static function next_article_list_res_get($writer_basic_id, $paging_num = 0, $article_num = 20) {
		$start_article_num = $paging_num * $article_num;
//		pre_var_dump($start_article_num);
		// 取得する場所取得
		$next_article_list_res = model_db::query("
			SELECT *
			FROM article
			WHERE del = 0
			AND basic_id = '".$writer_basic_id."'
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
	public static function next_article_diractory_create($writer_basic_id, $next_article_check, $paging_num) {
//		var_dump($next_article_check);
		if($next_article_check) {
			$new_article_path = PATH.'writer/'.$writer_basic_id.'/'.$paging_num; 
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
	public static function next_article_check($writer_basic_id, $paging_num, $article_num) {
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
			AND basic_id = '".$writer_basic_id."'
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