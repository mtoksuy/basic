
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
			<!-- パスワードをお忘れですか？ -->
			<div class="password_reissue">
				<a href="<?php echo HTTP; ?>login/password_reissue/">パスワードをお忘れですか ?</a>	
			</div>
<?php
/*
メール送信画面
http://localhost/basic/login/password_reissue/
トークン確認URL&パスワード再設定画面
http://localhost/basic/login/password_reissue/?token_check=xxx
パスワード再設定完了画面
http://localhost/basic/login/password_reissue/?token_check=xxx&password=xxx
*/
?>
			<?php echo '<p>'.$lohin_message.'</p>'; ?>
		</form>
	</div> <!-- contact_inner -->
</div>
