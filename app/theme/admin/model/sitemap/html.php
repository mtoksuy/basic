<?php
class model_sitemap_html {
	//------------------
	//sitemap.xml生成
	//------------------
	public static function sitemap_xml_create($article_all_list_res, $page_all_list_res) {
		// 記事
		foreach($article_all_list_res as $key => $value) {
			// 更新されていた場合
			if($value['update_time']) {
				$lastmod_time = $value['update_time'];
			}
				// されてない場合
				else {
					$lastmod_time = $value['create_time'];
				}
			$lastmod_time_object = new DateTime($lastmod_time);
			$lastmod_time = $lastmod_time_object->format(DateTime::ATOM);
			$article_list = $article_list.'
				<url>
					<loc>'.HTTP.'article/'.$value['primary_id'].'/</loc>
					<changefreq>weekly</changefreq>
					<lastmod>'.$lastmod_time.'</lastmod>
					<priority>0.7</priority>
				</url>';
		} // foreach($article_res as $key => $value) {
		// ページ
		foreach($page_all_list_res as $key => $value) {
			if(!($value['permalink'] == 'root')) {
				$page_list = $page_list.'
					<url>
						<loc>'.HTTP.$value['permalink'].'/</loc>
						<changefreq>weekly</changefreq>
						<priority>0.7</priority>
					</url>';
			}
		}
	// 合体
	$sitemap_xml = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

	<url>
		<loc>'.HTTP.'</loc>
		<changefreq>weekly</changefreq>
		<priority>1.0</priority>
	</url>
	'.$page_list.'
	'.$article_list.'
</urlset>';
		return $sitemap_xml;
	}
	//-------------------------
	//全記事リストHTML生成
	//-------------------------
	public static function article_list_html_create($article_res) {
		foreach($article_res as $key => $value) {
			$li_html_list = $li_html_list.'<li><a href="'.HTTP.'article/'.$value['primary_id'].'/">'.$value['title'].'</a></li>';
		}
		return $li_html_list;
	}
	//---------------------------------------
	//オールカテゴリ記事リストHTML取得
	//----------------------------------------
	public static function all_category_article_list_html_create($all_category_article_list_data_array) {
		foreach($all_category_article_list_data_array as $key_1 => $value_1) {
			$category_name = $value_1['category_name'];
			// カテゴリー情報取得
			$category_res = model_article_basis::category_data_get($category_name);
			$category_name = $category_res[0]['category_name'];
			$name = $category_res[0]['name'];
			$description = $category_res[0]['description'];
			$article_list_li = '';
			foreach($value_1['res'] as $key => $value) {
			// 記事データ取得
			$unix_time            = strtotime($value["create_time"]);
			$local_time           = date('Y-m-d', $unix_time);
			$local_japanese_time  = date('Y年m月d日', $unix_time);
			$article_year_time    = date('Y', $unix_time);
//pre_var_dump($value);
			// 記事HTMLテキスト取得
			$article_contents     = htmlspecialchars_decode($value["content"]);
			// 改行を消す&タブ削除
			$article_contests = str_replace(array("\r\n", "\r", "\n", "\t"), '', $article_contents);
			// 本文を5680文字に丸める
			$article_contests = mb_strimwidth($article_contests, 0, 5680, '...', 'utf8'); // 応急処置 2018.01.31 なぜこれで直るかはわからん 下記のpreg_replaceが重すぎた

			// HTMLタグを取り除く
//			$article_contests = preg_replace('/<("[^"]*"|\'[^\']*\'|[^\'">])*>/', '', $article_contests);
			$article_contests = strip_tags($article_contests);

			// 本文を168文字に丸める
			$summary_contents = mb_strimwidth($article_contests, 0, 168, "...", 'utf8');

			// エンティティを戻す
			$title        = htmlspecialchars_decode($value["title"], ENT_NOQUOTES);
			// タイトルを82文字に丸める
			$title = mb_strimwidth($title, 0, 82, "...", 'utf8');

			 $article_list_li .=
				 '<li>
					<a href="'.HTTP.'article/'.$value['primary_id'].'/">'.$title.'</a>
				</li>';
			} // foreach
		} // foreach
		return $article_list_li;
	}
	//-------------------------
	//全記事リストHTML生成
	//-------------------------
	public static function category_products_list_html_create($category_res) {
		foreach($category_res as $key => $value) {
			$directory_http = HTTP.'category/'.$value['full_path'].'/';
			// プロダクトリストres取得
			$products_res = model_sitemap_basis::products_res_get($value['name']);
			if($products_res) {
				foreach($products_res as $products_key => $products_value) {
					$products_li_html .= '
						<li>
							<a href="'.HTTP.'products/'.$products_value['ASIN'].'/">あまてむ｜'.$products_value['Title'].'｜'.$value['name'].'</a>
						</li>';
				}
				$products_li_html = '<ul>'.$products_li_html.'</ul>';
				// カテゴリー登録
//				pre_var_dump($directory_http);
				$li_html .= '
					<li><a href="'.$directory_http.'">'.$value['name'].'</a>'.$products_li_html.'</li>';
			}
		// 初期化
		$products_li_html = '';
		}
		// 合体
		$category_products_list_html = '
			<ul>
				'.$li_html.'
			</ul>';
		return $category_products_list_html;
	}
	//-------------------------------
	//全カテゴリーリストHTML生成
	//--------------------------------
	public static function category_list_html_create($category_res) {
		foreach($category_res as $key => $value) {
			$directory_http = HTTP.'category/'.$value['full_path'].'/';
			$li_html .= '
				<li><a href="'.$directory_http.'">'.$value['name'].'</a></li>';
		}
		// 合体
		$category_list_html = '
		<ul>
			'.$li_html.'
		</ul>';
		// とりあえず
		$category_list_html = $li_html;
		return $category_list_html;
	}
}