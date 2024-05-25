<!-- header -->
<header class="header clearfix">
	<div class="header_inner clearfix">
		<!-- logo -->
		<div class="logo">
			<!--
				logo画像タグ テンプレート
				<h1>
					<a href="<?php echo HTTP; ?>">
						<img width="91" height="20" title="ベーシック" alt="ベーシック" src="<?php echo HTTP; ?>app/theme/admin/assets/img/logo/basic_logo_1.svg">
					</a>
				</h1>
			-->
			<a href="<?php echo HTTP; ?>">
				<h1><?php echo $site_data_array['title']; ?></h1>
			</a>
		</div> <!-- logo -->
		<?php require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/view/common/drawer.php'); /* drawer読み込み*/ ?>
		<!-- navi_slide_menu -->
		<?php require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/view/common/navi_slide_menu.php'); /* navi_slide_menu読み込み*/ ?>

	</div>
</header>