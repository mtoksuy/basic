<?php
class model_login_admin_pagelist_basis {
	//-------------
	//ページ一覧取得
	//-------------
	public static function pagelist_get() {
		$article_pagelist_res = model_db::query("
			SELECT * 
			FROM page
			WHERE del = 0
			AND draft = 0
			ORDER BY primary_id DESC
		");
		return $article_pagelist_res;
	}
}
