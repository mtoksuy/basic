<?php
class model_login_admin_fileupload_html {
	//------------------------
	// 下書き一覧HTML生成
	//------------------------
	public static function article_draft_list_html_create($article_draft_list_res) {
		foreach($article_draft_list_res as $key => $value) {
			$article_list_html .= '<div class="draft_list_content">
				<p><b>No：</b>'.$value['primary_id'].'</p>
				<p><b>タイトル：'.$value['title'].'</b></p>
				<div class="draft_list_content_edit">
					<ul class="clearfix">
						<li><a target="_blank" href="'.HTTP.'login/admin/post?draft_id='.$value['primary_id'].'&edit=true" target="_blank">編集する</a></li>
						<li><a href="'.HTTP.'login/admin/post/?draft_id='.$value['primary_id'].'" target="_blank">確認する</a></li>
						<li><a class="delete" href="'.HTTP.'login/admin/post/?draft_id='.$value['primary_id'].'&delete=true" target="_blank">削除する</a></li>
					</ul>
				</div>
			</div>';
		}
		return $article_list_html;
	}

}