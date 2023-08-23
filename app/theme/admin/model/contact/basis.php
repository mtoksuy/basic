<?php
class model_contact_basis {
	//-----------------------------
	//お問い合わせ内容を登録する
	//-----------------------------
	public static function contact_register($post) {
// Todo 後ほど閲覧時使用
//echo '<a class="mail-app" href="mailto:info@example.com?subject=件名&amp;body=本文">あああ</a>';
		 model_db::query("
			INSERT INTO contact (
				title,
				company,
				name,
				email,
				contents
			)
			VALUES (
				'".$post['contact_content']."',
				'".$post['company_name']."',
				'".$post['name']."',
				'".$post['email']."',
				'".$post['summary']."'
			)");
	}
}