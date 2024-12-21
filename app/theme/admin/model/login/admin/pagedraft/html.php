<?php
class model_login_admin_pagedraft_html {
	//------------------------
	// 下書き一覧HTML生成
	//------------------------
	public static function page_draft_list_html_create($article_draft_list_res) {
		$article_list_html = '';
		foreach ($article_draft_list_res as $key => $value) {
			$article_list_html .= '<div class="draft_list_content">
				<p><b>No：</b>' . $value['primary_id'] . '</p>
				<p><b>タイトル：' . $value['title'] . '</b></p>
				<div class="draft_list_content_edit">
					<ul class="clearfix">
						<li><a target="_blank" href="' . HTTP . 'login/admin/page?draft_id=' . $value['primary_id'] . '&edit=true" target="_blank">編集する</a></li>
						<li><a href="' . HTTP . 'login/admin/page/?permalink=' . $value['permalink'] . '" target="_blank">確認する</a></li>
						<li><a class="delete" href="' . HTTP . 'login/admin/page/?draft_id=' . $value['primary_id'] . '&delete=true">削除する</a></li>
					</ul>
				</div>
			</div>';
		}
		return $article_list_html;
	}
}
