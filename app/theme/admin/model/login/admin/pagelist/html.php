<?php
class model_login_admin_pagelist_html {
	//---------------------
	//ページ一覧HTML生成
	//---------------------
	public static function pagelist_html_create($pagelist_res) {
		$pagelist_html = '';
		foreach ($pagelist_res as $key => $value) {
			$pagelist_html .= '<div class="draft_list_content">
				<p><b>No：</b>' . $value['primary_id'] . '</p>
				<p><b>パーマリンク名：</b>' . $value['permalink'] . '</p>
				<p><b>タイトル：' . $value['title'] . '</b></p>
				<div class="draft_pagelist_content_edit">
					<ul class="clearfix">
						<li><a target="_blank" href="' . HTTP . 'login/admin/page?page_id=' . $value['primary_id'] . '&edit=true" target="_blank">編集する</a></li>
						<li><a href="' . HTTP . $value['permalink'] . '/" target="_blank">確認する</a></li>
						<li><a class="delete" href="' . HTTP . 'login/admin/page?page_id=' . $value['primary_id'] . '&delete=true">削除する</a></li>
					</ul>
				</div>
			</div>';
		}
		return $pagelist_html;
	}
}
