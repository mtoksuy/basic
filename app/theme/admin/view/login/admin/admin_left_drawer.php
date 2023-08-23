<?php
	// アドミン_ドロワーHTML生成
	$admin_left_drawer_html = model_login_admin_html::admin_left_drawer_html_create($site_data_array, $now);
?>
		<nav class="admin_left_drawer">
			<div class="admin_left_drawer_inner">
				<?php echo $admin_left_drawer_html; ?>
			</div>
		</nav>
