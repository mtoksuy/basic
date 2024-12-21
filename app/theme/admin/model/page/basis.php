<?php
class model_page_basis {
	//----------------
	//記事リスト取得
	//----------------
	public static function page_list_get($get_num = 10, $page_num = 1) {
		// 取得する場所取得
		$start_list_num = ($page_num * $get_num) - $get_num;
		$page_list_res = model_db::query("
			SELECT *
			FROM page
			WHERE del = 0
			ORDER BY primary_id DESC
			LIMIT " . $start_list_num . ", " . $get_num . "");
		return $page_list_res;
	}
	//-----------------------
	//ページングデータ取得
	//------------------------
	public static function page_paging_data_get($list_num, $paging_num) {
		// last_num取得
		$max_res = model_db::query("
			SELECT COUNT(primary_id)
			FROM page
			WHERE del = 0");
		foreach ($max_res as $key => $value) {
			$last_num = (int)$value['COUNT(primary_id)'];
		}
		// 最大ページング数取得
		$max_paging_num = (int)ceil($last_num / $list_num);
		// new_page_paging_data生成
		$new_page_paging_data_array = array(
			'last_num'       => $last_num,
			'list_num'       => $list_num,
			'paging_num'     => $paging_num,
			'max_paging_num' => $max_paging_num,
		);
		return $new_page_paging_data_array;
	}
	//--------------
	//記事データ取得
	//--------------
	public static function page_get($method) {
		$page_res = model_db::query("
			SELECT * 
			FROM page 
			WHERE permalink = '" . $method . "'
			AND del = 0
			LIMIT 0, 1");
		return $page_res;
	}
	//--------------
	//記事データ取得
	//--------------
	public static function page_get_primary_id_v($method) {
		$page_res = model_db::query("
			SELECT * 
			FROM page 
			WHERE primary_id = '" . $method . "'
			AND del = 0
			LIMIT 0, 1");
		return $page_res;
	}
	//-----------------------------------
	//さらに前の記事を見るデータ取得
	//-----------------------------------
	public static function next_page_list_res_get($paging_num = 0, $page_num = 20) {
		$start_page_num = $paging_num * $page_num;
		//		pre_var_dump($start_page_num);
		// 取得する場所取得
		$next_page_list_res = model_db::query("
			SELECT *
			FROM page
			WHERE del = 0
			ORDER BY primary_id DESC
			LIMIT " . $start_page_num . ", " . $page_num . "");
		// スタート地点取得
		$paging_num = $paging_num + 1;
		//		pre_var_dump($category_page_res);
		//		pre_var_dump($paging_num);
		return array($next_page_list_res, $paging_num);
	}
	//------------------------------------------
	// さらに前の記事を見るディレクトリ生成
	//-------------------------------------------
	public static function next_page_diractory_create($next_page_check, $paging_num) {
		//		var_dump($paging_num);
		if ($next_page_check) {
			$new_page_path = PATH . 'newpage/' . $paging_num;
			// 指定されたディレクトリが存在するか確認
			if (file_exists($new_page_path)) {
				//存在したときの処理
				//			echo "作成しようとしたディレクトリは既に存在します";
			} else {
				//存在しない時ディレクトリを生成
				if (mkdir($new_page_path, 0777)) {
					//作成したディレクトリのパーミッションを変更
					chmod($new_page_path, 0777);
					// マスターファイルコピー
					copy(PATH . 'master/newpage.php', $new_page_path . '/index.php');
					//作成に成功した時の処理
					//					echo "作成に成功しました";
				}
			}
		}
		return $next_page_html;
	}
	//-----------------------------------------------------------
	//次のさらに前の記事を見る記事リストがあるかチェック
	//-----------------------------------------------------------
	public static function next_page_check($paging_num, $page_num) {
		// ネクスト地点取得
		$paging_num = $paging_num + 1;
		/*
		pre_var_dump($paging_num);
		pre_var_dump($page_num);
*/
		$start_page_num = $paging_num * $page_num;
		//		pre_var_dump($start_page_num);
		// 取得する場所取得
		$next_page_check_res = model_db::query("
			SELECT *
			FROM page
			WHERE del = 0
			ORDER BY primary_id DESC
			LIMIT " . $start_page_num . ", " . $page_num . "");
		if ($next_page_check_res) {
			$next_page_check = true;
		} else {
			$next_page_check = false;
		}
		return $next_page_check;
	}
}
