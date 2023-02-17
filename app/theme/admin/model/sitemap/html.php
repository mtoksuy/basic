<?php
class model_sitemap_html {
	//------------------
	//sitemap.xml生成
	//------------------
	public static function sitemap_xml_create($article_all_list_res, $page_all_list_res) {
		$article_list = '';
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
			$article_list .= '
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
	//-------------------------------------
	//サイトマップ記事リストHTML取得
	//--------------------------------------
	public static function sitemap_article_list_html_create($article_res) {
		$article_list_li = '';
		foreach($article_res as $key => $value) {
			// ページ
			if(!empty($value['permalink'])) {
				// エンティティを戻す
				$title = htmlspecialchars_decode($value["title"], ENT_NOQUOTES);
				 $article_list_li .=
					 '<li>
						<a href="'.HTTP.$value['permalink'].'/">'.$title.'</a>
					</li>';
			}
			// 記事
			else {
				// エンティティを戻す
				$title = htmlspecialchars_decode($value["title"], ENT_NOQUOTES);
				 $article_list_li .=
					 '<li>
						<a href="'.HTTP.'article/'.$value['primary_id'].'/">'.$title.'</a>
					</li>';
			}
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