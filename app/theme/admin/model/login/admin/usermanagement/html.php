<?php
class model_login_admin_usermanagement_html {
	//--------------------------
	// ユーザー追加HTML生成
	//--------------------------
	public static function user_add_html_create() {
		$user_add_html = 
			'<!-- user_add -->
					<div class="user_add">
						<div class="user_add_inner">
						<div class="add_button"><a href="'.HTTP.'login/admin/usermanagement/?add=true">新規追加</a></div>
						</div>
					</div>
			</div>';
		return $user_add_html;
	}
	//-------------------------
	// ユーザー管理HTML生成
	//-------------------------
	public static function usermanagement_html_create($all_user_data_array) {
//		pre_var_dump($all_user_data_array);
		$usermanagement_html = '';
		$delete_li = '';
		foreach($all_user_data_array as $key => $value) {
		// アイコンHTML
		$icon_html = ($value['icon']) ? '<img width="32" height="32" src="'.HTTP.'app/assets/img/user/'.$value['icon'].'">':'';
		// ユーザー記事投稿カウント取得
		$user_article_post_count_res = model_login_admin_usermanagement_basis::user_article_post_count_get($value['basic_id']);
		// genisys_primary_idは削除禁止
		if($value['primary_id'] == 1) {
			$delete_li = '';
		}
		else {
			$delete_li = '<li><a class="delete" href="'.HTTP.'login/admin/usermanagement/?basic_id='.$value['basic_id'].'&delete=true">削除する</a></li>';
		}
		$usermanagement_html .= 
			'<div class="draft_list_content">
				<p>NO.：'.$value['primary_id'].'</p>
				<p class="m_b_0">'.$icon_html.'</p>
				<p class="m_b_0">basic_id：'.$value['basic_id'].'</p>
				<p class="m_b_0">ユーザー名：'.$value['name'].'</p>
				<p class="m_b_0">権限グループ：'.$value['role'].'</p>
				<p>投稿数：'.$user_article_post_count_res[0]['COUNT(basic_id)'].'</p>
				<div class="draft_list_content_edit">
					<ul class="clearfix">
						<li><a target="_blank" href="'.HTTP.'login/admin/profile?basic_id='.$value['basic_id'].'&edit=true">編集する</a></li>
						<li><a href="'.HTTP.'writer/'.$value['basic_id'].'/" target="_blank">確認する</a></li>
						'.$delete_li.'
					</ul>
				</div>
			</div>';
		}
		return $usermanagement_html;
	}
	//-----------------------------------
	// ユーザー新規追加画面HTML生成
	//-----------------------------------
	public static function usermanagement_useradd_html_create() {
//		pre_var_dump($profile_data_array);


		$profile_html = '
			<div class="profile">
				<div class="profile_inner">
					<form method="post" action="" class="profile_form" enctype="multipart/form-data">

						<div class="block">
							<label for="basic_id">basic_id(必須)</label>
							<input id="basic_id" maxlength="64" name="basic_id" type="text" placeholder="半角英数字1文字以上" value="">
						</div>

						<div class="block">
							<label for="profile">パスワード(必須)</label>
							<input id="password" maxlength="64" name="password" type="text" placeholder="半角英数字 4文字以上" value="">
						</div>


						<div class="block">
							<label for="icon">権限</label>
							<select name="role">
								<option value="admin">管理者</option>
								<option value="editor">編集者</option>
								<option value="postor">投稿者</option>
							</select>
						</div>


						<input type="submit" class="submit" value="新規追加" name="submit">
					</form>
				</div>
			</div>';
		return $profile_html;
	}








}