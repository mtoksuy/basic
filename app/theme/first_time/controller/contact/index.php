<?php

	// 定義されていない変数を空定義
	if(empty($_POST['submit'])) { $_POST['submit'] = ''; }
	if(empty($_POST['company_name'])) { $_POST['company_name'] = ''; }
	if(empty($_POST['name'])) { $_POST['name'] = ''; }
	if(empty($_POST['email'])) { $_POST['email'] = ''; }
	if(empty($_POST['summary'])) { $_POST['summary'] = ''; }
	if(empty($selected_1)) { $selected_1 = ''; }
	if(empty($selected_2)) { $selected_2 = ''; }
	if(empty($selected_3)) { $selected_3 = ''; }

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
