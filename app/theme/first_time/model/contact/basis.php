<?php
class model_contact_basis {
	//-----------------------------
	//お問い合わせ内容を登録する
	//-----------------------------
	public static function contact_register($post) {
		 $contents = "お問い合わせ内容：".$post['contact_content']."
貴社名：".$post['company_name']."
お名前：".$post['name']."
メールアドレス：".$post['email']."
お問い合わせ内容
".$post['summary']."";

// Todo 後ほど閲覧時使用
//echo '<a class="mail-app" href="mailto:info@example.com?subject=件名&amp;body=本文">あああ</a>';

		 model_db::query("
			INSERT INTO contact (
				title,
				email,
				contents
			)
			VALUES (
				'".$post['contact_content']."',
				'".$post['email']."',
				'".$contents."'
			)");
	}
}