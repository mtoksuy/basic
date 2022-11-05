<?php
if($_POST['submit'] == '確認') {
	// テンプレート読み込み
	require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/'.$controller_query.'/confirm_template.php');
}
	else if($_POST['submit'] == '修正する') {
				// テンプレート読み込み
				require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/'.$controller_query.'/template.php');
	}
		else if($_POST['submit'] == '送信') {
			// ポストの中身をエンティティ化する
			$post = basic::post_security($_POST);
			// お問い合わせ内容を登録する
			model_contact_basis::contact_register($post);
			// お問い合わせ内容をinfo@spacenavi.jpに送信する
//			model_mail_basis::contact_report_mail($post);
				// テンプレート読み込み
				require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/'.$controller_query.'/submit_template.php');
		}
			else {
				// テンプレート読み込み
				require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/'.$controller_query.'/template.php');
			}
