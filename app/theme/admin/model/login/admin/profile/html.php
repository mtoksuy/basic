<?php
class model_login_admin_profile_html {
	//----------------------
	// 一般設定HTML生成
	//----------------------
	public static function profile_html_create($user_data_array) {
//		pre_var_dump($profile_data_array);
		// アイコンHTML
		$icon_html = ($user_data_array['icon']) ? '<img width="128" height="128" src="'.HTTP.'app/assets/img/user/'.$user_data_array['icon'].'">':'';

		$profile_html = '
			<div class="profile">
				<div class="profile_inner">
					<form method="post" action="" class="profile_form" enctype="multipart/form-data">
						<div class="block">
							<label for="basic_id">basic_id名</label>
							'.$user_data_array['basic_id'].'
						</div>


						<div class="block">
							<label for="name">ユーザー名</label>
							<input id="name" maxlength="64" name="name" type="text" placeholder="好きな名前を付けれます" value="'.$user_data_array['name'].'">
						</div>


						<div class="block">
							<label for="profile">プロフィール</label>
							<textarea id="profile" placeholder="プロフィールを入力" name="profile">'.$user_data_array['profile'].'</textarea>
						</div>


						<div class="block">
							<label for="profile">メールアドレス</label>
							<input id="email" maxlength="64" name="email" type="email" placeholder="メールアドレスを入力" value="'.$user_data_array['email'].'">
						</div>


						<div class="block">
							<label for="icon">アイコン</label>
							'.$icon_html.'
							<div class="upload_button">
								<input id="icon" type="file" name="icon" accept="image/*">
							</div>
						</div>

						<input type="submit" class="submit" value="変更" name="submit">
					</form>
				</div>
			</div>';
		return $profile_html;
	}
}