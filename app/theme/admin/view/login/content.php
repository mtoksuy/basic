
<div class="login">
	<div class="login_inner">
		<h1 class="login_title">ログイン</h1>
		<form class="login_form" name="login_form" action="" method="post">
			<!-- block -->
			<div class="block">
				<p class="m_0">
					<label for="user_login">ユーザー名</label>
				</p>
				<input type="text" class="input" id="user_login" name="user_login" value="<?php echo $post['user_login']; ?>">
			</div>
			<!-- block -->
			<div class="block">
				<p class="m_0">
					<label for="user_password">パスワード</label>
				</p>
				<input type="password" class="input" id="user_password" name="user_password" value="" size="512">
			</div>
			<!-- submit -->
			<p class="submit clearfix">
				<input type="submit" class="login_form_button" name="login_submit" value="ログイン">
			</p>
			<?php echo '<p>'.$lohin_message.'</p>'; ?>
		</form>
	</div> <!-- contact_inner -->
</div>