<?php
echo 'お問い合わせ';
if($_POST['submit'] == '確認') {
	// テンプレート読み込み
	require_once(PATH.'view/contact/confirm_template.php');
}
	else if($_POST['submit'] == '修正する') {
		// テンプレート読み込み
		require_once(PATH.'view/contact/template.php');
	}
		else if($_POST['submit'] == '送信') {
			// ポストの中身をエンティティ化する
			$post = library_security_basis::post_security($_POST);
			// お問い合わせ内容をinfo@spacenavi.jpに送信する
			model_mail_basis::contact_report_mail($post);
			// テンプレート読み込み
			require_once(PATH.'view/contact/submit_template.php');
		}
			else {
				// テンプレート読み込み
				require_once(PATH.'app/view/'.$controller_query.'/template.php');
			}
echo 'お問い合わせ';
echo 'お問い合わせ';
?>