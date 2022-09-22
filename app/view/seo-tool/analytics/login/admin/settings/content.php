
<div class="admin">
	<div class="admin_inner">
		<div class="admin_left">
			<?php require_once(PATH.'view/seo-tool/analytics/login/admin/admin_left_drawer.php'); /* admin_left_drawer読み込み*/ ?>
		</div>
		<div class="admin_right">
			 <!-- settings -->
			<div class="settings">
				<div class="settings_inner">
					<!-- content_box -->
					<div class="content_box">
						<h1>プロパディ管理</h1>

					<div class="propaddy_box">
						<ul>
							<li>プロパディ</li>
								<?php echo $analytics_propaddy_list_html; ?>
						</ul>
					</div>
					</div> <!-- content_box -->
				</div> <!-- settings_inner -->
			</div> <!-- settings -->
			<div class="delete_box">
				<div class="delete_box_inner">
					<p>プロパディ：<span class="propaddy_target"></span> を本当に削除しますか？</p>
					<div class="button_box">
						<div class="ok_button">削除する</div>
						<div class="ng_button">キャンセル</div>
					</div>
				</div>
			</div>
			<div class="black_box"> </div>
		</div>
	</div>
</div>
