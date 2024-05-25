<!DOCTYPE html>
<html>
<?php require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/view/article/head.php'); /* head読み込み*/ ?>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<?php require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/view/common/header.php'); /* header読み込み*/ ?>
		<!-- navi_slide_menu -->
		<?php require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/view/common/navi_slide_menu.php'); /* navi_slide_menu読み込み*/ ?>
		<!-- main -->
		<div class="main clearfix">
			<!-- main_inner -->
			<div class="main_inner clearfix">
				<?php require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/view/article/content.php'); /* content読み込み*/ ?>
			</div>
		</div> <!-- main -->
		<?php require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/view/common/footer.php'); /* footer読み込み*/ ?>
	</div> <!-- wrapper -->
	<?php require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/view/article/head_footer.php'); /* head_footer読み込み*/ ?>
</body>

</html>