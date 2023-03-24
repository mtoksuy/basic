<?php
class model_plugin_sample_basis {
	//----------------------------
	// 公開されている記事数取得
	//-----------------------------
	public static function public_article_count_get() {
		$article_res = model_db::query("
			SELECT COUNT(*) 
			FROM article 
			WHERE del = 0
		");
		return $article_res;
	}
}