<div class="login">
	<div class="login_inner">
		<h1 class="login_title">パスワード再発行</h1>
		<form class="login_form" name="login_form" action="" method="post">
			<!-- block -->
			<div class="block">
				<p class="m_0">
					<label for="confirmation">basic_idまたはメールアドレス</label>
				</p>
				<input type="text" class="input" id="confirmation" name="confirmation" value="<?php echo $post['confirmation']; ?>">
			</div>
			<!-- submit -->
			<p class="submit clearfix">
				<input type="submit" class="login_form_button" name="login_submit" value="パスワードを再発行する">
			</p>
			<?php echo '<p>' . $lohin_message . '</p>'; ?>
		</form>
	</div> <!-- contact_inner -->
</div>