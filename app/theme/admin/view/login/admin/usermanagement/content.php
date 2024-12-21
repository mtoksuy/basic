<div class="admin">
	<div class="admin_inner">
		<div class="admin_left">
			<?php require_once(PATH . 'app/theme/admin/view/login/admin/admin_left_drawer.php'); /* admin_left_drawer読み込み*/ ?>
		</div>
		<div class="admin_right">
			<div class="summary">
				<div class="summary_inner">
					<?php echo $user_add_html; ?>
					<!-- summary_box -->
					<div class="summary_box">
						<?php echo $content_html; ?>
					</div> <!-- summary_box -->
				</div> <!-- summary_inner -->
			</div> <!-- summary -->
		</div> <!-- admin_right -->
	</div> <!-- admin_inner -->
</div> <!-- admin -->