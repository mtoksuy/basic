

<div class="signup">
	<div class="signup_inner clearfix">
		<h1 style="margin:0 0 30px 0;">新規登録</h1>
	<form method="post" id="signup_form" class="signup_form" action="">
		<div class="box">
			<input type="text" class="signup_form_amatem_id" placeholder="あまてむ ID(半角英数字)" value="<?php echo $post['amatem_id']; ?>" maxlength="30" name="amatem_id" autocomplete="off" required="required">
			<?php
			if($_POST) {
				if($user_amatem_id_check) {
					echo '<p class="check_green">使用できます</p>';
				}
					else {
						echo '<p class="red">既に登録されているidか登録できない文字列が含まれています</p>';
					}
			}
			?>
		</div>
		<div class="box">
			<input type="email" class="signup_form_email" placeholder="メールアドレス" value="<?php echo $post['email']; ?>" name="email" autocomplete="off" required="required">
			<?php
			if($_POST) {
				if($user_email_check) {
					echo '<p class="check_green">使用できます</p>';
				}
					else {
						echo '<p class="red">使用できません</p>';
					}
			}
			?>
		</div>
		<div class="box">
			<input type="password" class="signup_form_password" placeholder="パスワード(英数字のみ4文字以上)" name="password" autocomplete="off" required="required">
			<?php
			if($_POST) {
				if($user_password_check) {
					echo '<p class="check_green">使用できます</p>';
				}
					else {
						echo '<p class="red">使用できません</p>';
					}
			}
			?>
		</div>
		<button class="signup_form_button o_8" type="submit">
		アカウント作成
		</button>
	</form>
<!--
	  <p>アカウントを作成すると、<a href="rule/rule/" target="_blank">利用規約</a>に同意したことになります。健全な行動を行ない、誰にも迷惑をかける事のないようよろしくお願い致します。</p>
-->
	</div>
</div>
