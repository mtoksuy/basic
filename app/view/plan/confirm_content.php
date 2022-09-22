
					<!-- contact -->
					<div class="contact">
						<div class="contact_inner">
							<p class="contact_title_top">Plan-Contact</p>
							<h2 class="contact_title">内容確認</h2>
							<div class="confirm">
								<div class="confirm_block">
									<p class="confirm_title">プラン名</p>
									<p class="confirm_content"><?php echo $_POST['plan']; ?></p>
								</div>
								<div class="confirm_block">
									<p class="confirm_title">貴社名</p>
									<p class="confirm_content"><?php echo $_POST['company_name']; ?></p>
								</div>
								<div class="confirm_block">
									<p class="confirm_title">担当者名</p>
									<p class="confirm_content"><?php echo $_POST['name']; ?></p>
								</div>
								<div class="confirm_block">
									<p class="confirm_title">メールアドレス</p>
									<p class="confirm_content"><?php echo $_POST['email_2']; ?></p>
								</div>
								<div class="confirm_block">
									<p class="confirm_title">対象サイトURL</p>
									<p class="confirm_content"><?php echo $_POST['url']; ?></p>
								</div>
								<div class="confirm_block">
									<p class="confirm_title">お問い合わせ詳細</p>
									<pre class="confirm_content"><?php echo $_POST['summary']; ?></pre>
								</div>
								<form method="post" action="" class="confirm_form">
									<input type="hidden" value="<?php echo $_POST['plan']; ?>" name="plan">
									<input type="hidden" value="<?php echo $_POST['company_name']; ?>" name="company_name">
									<input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
									<input type="hidden" value="<?php echo $_POST['email_2']; ?>" name="email">
									<input type="hidden" value="<?php echo $_POST['url']; ?>" name="url">
									<input type="hidden" value="<?php echo $_POST['summary']; ?>" name="summary">
									<input class="left_button" type="submit" value="修正する" name="submit">
									<input class="right_button" type="submit" value="送信" name="submit">
								</form>
								<p class="contact_title_bottom">間違いがなければ送信お願いいたします</p>
							</div>
						</div> <!-- contact_inner -->
					</div> <!-- contact -->

