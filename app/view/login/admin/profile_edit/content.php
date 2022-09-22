
<div class="admin">
	<div class="admin_inner">
		<div class="admin_left">
			<?php require_once(PATH.'view/login/admin/admin_left_drawer.php'); /* admin_left_drawer読み込み*/ ?>
		</div>
		<div class="admin_right">
			<div class="profile_edit">
				<div class="profile_edit_inner">
					<!-- account_form -->
					<form class="account_form" enctype="multipart/form-data" method="post" action="<?php echo HTTP; ?>login/admin/profile_edit/">
						<div class="control_group">
						  <label for="user_sharetube_id">amatem_id名</label>
						  <div class="controls">
						    <input id="user_sharetube_id" maxlength="15" name="sharetube_id" type="text" value="<?php echo $amatem_id_data_array['amatem_id'];?>" disabled="disabled">
						  </div>
						</div> <!-- control_group -->
					
						<div class="control_group">
						  <label for="user_name">ユーザー名</label>
						  <div class="controls">
						    <input id="user_name" maxlength="64" name="name" type="text" placeholder="好きな名前を付けれます" value="<?php echo $amatem_id_data_array['name'];?>">
						  </div>
						</div> <!-- control_group -->
										
						<div class="control_group">
						  <label for="user_profile">プロフィール</label>
						  <div class="controls">
								<textarea id="user_profile" placeholder="プロフィールを入力" name="profile_contents"><?php echo $amatem_id_data_array['profile'];?></textarea>
						  </div>
						</div> <!-- control_group -->
					
						<div class="control_group">
						  <label for="user_icon">アイコン</label>
						  <div class="controls">
								<img class="now_user_icon" width="128" height="128" title="" alt="" src="<?php echo HTTP.'assets/img/user_icon/'.$amatem_id_data_array['icon'];?>">
								<div class="upload_button">
									<input id="user_icon" type="file" name="profile_icon"  accept="image/*" multiple="">
								</div>
						  </div>
						</div> <!-- control_group -->
					
						<div class="control_group">
						  <label for="user_twitter">Twitter</label>
						  <div class="controls">
						    @<input id="user_twitter" name="twitter_id" type="text" placeholder="Twitterアカウントを表示できます" value="<?php echo $amatem_id_data_array['twitter'];?>">
						  </div>
						</div> <!-- control_group -->

					  <button type="submit" id="submit" class="submit">変更を保存</button>
					</form>

				</div> <!-- profile_edit_inner -->
			</div> <!-- profile_edit -->


		</div> <!-- admin_right -->
	</div> <!-- admin_inner -->
</div> <!-- admin -->
