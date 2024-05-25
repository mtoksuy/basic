<?php
class model_login_admin_contactlist_html {
	//------------------------------
	// お問い合わせ一覧HTML生成
	//------------------------------
	public static function contact_list_html_create($contact_list_res) {
		$article_list_html = '';
		$read_check_html = '';
		foreach ($contact_list_res as $key => $value) {
			if ($value['read_check'] == 0) {
				$read_check_html = '<span class="contact_unread_count"> </span>';
			}
			// 本文を256文字に丸める
			$contact_contests = mb_strimwidth($value['contents'], 0, 256, '...', 'utf8');
			$article_list_html .= '<div class="draft_list_content">
' . $read_check_html . '
				<p><b>No：</b>' . $value['primary_id'] . '<span class="time">' . $value['create_time'] . '</span></p>
				<p><b>問い合わせ内容：' . $value['title'] . '</b></p>
				<p><b>問い合わせ詳細：' . $contact_contests . '</b></p>
				<div class="draft_list_content_edit">
					<ul class="clearfix">
						<li><a href="' . HTTP . 'login/admin/contactlist?contact_id=' . $value['primary_id'] . '">お問い合わせを開く</a></li>
						<li><a class="delete" href="' . HTTP . 'login/admin/contactlist?contact_id=' . $value['primary_id'] . '&delete=true">削除する</a></li>
					</ul>
				</div>
			</div>';
			// 初期化
			$read_check_html = '';
		}
		return $article_list_html;
	}
	//------------------------------
	// お問い合わせ詳細HTML生成
	//------------------------------
	public static function contact_detail_html_create($contact_data_array) {
		$content_html = '<div class="draft_list_content">
			<p><b>問い合わせ内容：' . $contact_data_array['title'] . '</b></p>
			<p><b>貴社名：' . $contact_data_array['company'] . '</b></p>
			<p><b>お名前：' . $contact_data_array['name'] . '</b></p>
			<p><b>メールアドレス：' . $contact_data_array['email'] . '</b></p>
			<pre><b>お問い合わせ詳細：' . $contact_data_array['contents'] . '</b></pre>
			<div class="draft_list_content_edit">
				<ul class="clearfix">
					<li><a class="mail-app" href="mailto:' . $contact_data_array['email'] . '?subject=Re: ' . urlencode($contact_data_array['title']) . '&amp;body=">返信</a></li>
				</ul>
			</div>
		</div>';
		return $content_html;
	}
}
