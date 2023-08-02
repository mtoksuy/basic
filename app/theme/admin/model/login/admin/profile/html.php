<?php
class model_login_admin_profile_html {
	//----------------------
	// 一般設定HTML生成
	//----------------------
	public static function profile_html_create($user_data_array) {
//		pre_var_dump($profile_data_array);
		$basic_id = '';
		$role_select_admin_selected = '';
		$role_select_editor_selected = '';
		$role_select_postor_selected = '';

		// 管理者編集用
		if($_GET['basic_id'] && $_GET['edit']) {
			// basic_id設定
			$basic_id = $_GET['basic_id'];
			// 指定ユーザー情報取得
			$profile_user_data_array = basic::user_data_get($basic_id);
			// アイコンHTML
			$icon_html = ($profile_user_data_array['icon']) ? '<img width="128" height="128" src="'.HTTP.'app/assets/img/user/'.$profile_user_data_array['icon'].'">':'';
			// 権限セレクトHTML生成
			if($profile_user_data_array['role'] == 'admin') {
				$role_select_admin_selected = ' selected';
			}
			else if($profile_user_data_array['role'] == 'editor') {
				$role_select_editor_selected = ' selected';
			}
			else if($profile_user_data_array['role'] == 'postor') {
				$role_select_postor_selected = ' selected';
			}
			// 合体
			$role_select_html = 
				'<div class="block">
					<label for="icon">権限</label>
					<select name="role">
						<option value="admin"'.$role_select_admin_selected.'>管理者</option>
						<option value="editor"'.$role_select_editor_selected.'>編集者</option>
						<option value="postor"'.$role_select_postor_selected.'>投稿者</option>
					</select>
				</div>';
		}
		// 通常はこちら
		else {
			// basic_id設定
			$basic_id = $user_data_array['basic_id'];
			// ユーザー情報取得
			$profile_user_data_array = $user_data_array;
			// アイコンHTML
			$icon_html = ($user_data_array['icon']) ? '<img width="128" height="128" src="'.HTTP.'app/assets/img/user/'.$user_data_array['icon'].'">':'';
			// 通常は権限指定不可
			$role_select_html = '<input type="hidden" id="role" name="role" value="'.$user_data_array['role'].'">';
		}

		$profile_html = '
			<div class="profile">
				<div class="profile_inner">
					<form method="post" action="" class="profile_form" enctype="multipart/form-data">
						<div class="block">
							<label for="basic_id">basic_id名</label>
							'.$basic_id.'
							<input type="hidden" id="basic_id" name="basic_id" value="'.$basic_id.'">
						</div>


						<div class="block">
							<label for="name">ユーザー名</label>
							<input id="name" maxlength="64" name="name" type="text" placeholder="好きな名前を付けれます" value="'.$profile_user_data_array['name'].'">
						</div>


						<div class="block">
							<label for="profile">プロフィール</label>
							<textarea id="profile" placeholder="プロフィールを入力" name="profile">'.$profile_user_data_array['profile'].'</textarea>
						</div>


						<div class="block">
							<label for="profile">メールアドレス</label>
							<input id="email" maxlength="64" name="email" type="email" placeholder="メールアドレスを入力" value="'.$profile_user_data_array['email'].'">
						</div>


						<div class="block">
							<label for="icon">アイコン</label>
							'.$icon_html.'
							<div class="upload_button">
								<input id="icon" type="file" name="icon" accept="image/*">
							</div>
						</div>


						'.$role_select_html.'


						<input type="submit" class="submit" value="変更" name="submit">
					</form>
				</div>
			</div>';
		return $profile_html;
	}
}