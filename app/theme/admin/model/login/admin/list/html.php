<?php
class model_login_admin_list_html {
	//---------------------
	//投稿一覧HTML生成
	//---------------------
	public static function article_list_html_create($article_list_res) {
		//		pre_var_dump($article_list_res);
		$article_list_html = '';
		foreach ($article_list_res as $key => $value) {
			if ($value['update_time'] == NULL) {
				$hiduke = '公開日：' . $value['create_time'];
			} else {
				$hiduke = '更新日：' . $value['update_time'];
			}
			$article_list_html .= '<div class="draft_list_content">
				<p><b>No：</b>' . $value['primary_id'] . '</p>
				<p class="m_b_0"><b>タイトル：' . $value['title'] . '</b></p>
				<p class="m_b_0"><b>著者：<a href="' . HTTP . 'writer/' . $value['basic_id'] . '/" target="_blank">' . $value['basic_id'] . '</a></b></p>
				<p><b>日付：' . $hiduke . '</b></p>
				<div class="draft_list_content_edit">
					<ul class="clearfix">
						<li><a target="_blank" href="' . HTTP . 'login/admin/post?article_id=' . $value['primary_id'] . '&edit=true" target="_blank">編集する</a></li>
						<li><a href="' . HTTP . 'article/' . $value['primary_id'] . '/" target="_blank">確認する</a></li>
						<li><a class="delete" href="' . HTTP . 'login/admin/post?article_id=' . $value['primary_id'] . '&delete=true">削除する</a></li>
					</ul>
				</div>
			</div>';
		}
		return $article_list_html;
	}
}
