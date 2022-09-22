<!DOCTYPE html>
<html>
	<?php require_once(PATH.'view/root/head.php'); /* head読み込み*/ ?>
	<body>
		<!-- wrapper -->
		<div class="wrapper">
			<?php require_once(PATH.'view/root/header.php'); /* header読み込み*/ ?>
			<!-- navi_slide_menu -->
			<?php require_once(PATH.'view/basic/navi_slide_menu.php'); /* navi_slide_menu読み込み*/ ?>
			<!-- main -->
			<div class="main clearfix">
				<!-- main_inner -->
				<div class="main_inner clearfix">
					<?php require_once(PATH.'view/root/content.php'); /* content読み込み*/ ?>
				</div>
			</div> <!-- main -->
			<?php require_once(PATH.'view/basic/footer.php'); /* footer読み込み*/ ?>
		</div> <!-- wrapper -->
		<?php require_once(PATH.'view/basic/head_footer.php'); /* head_footer読み込み*/ ?>
	</body>
</html>