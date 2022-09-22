<!DOCTYPE html>
<html>
	<?php require_once(PATH.'view/plan/head.php'); /* head読み込み*/ ?>
	<body>
		<!-- wrapper -->
		<div class="wrapper">
			<?php require_once(PATH.'view/plan/header.php'); /* header読み込み*/ ?>
			<!-- main -->
			<div class="main clearfix">
				<!-- main_inner -->
				<div class="main_inner clearfix">
					<?php require_once(PATH.'view/plan/content.php'); /* content読み込み*/ ?>
				</div>
			</div> <!-- main -->
			<?php require_once(PATH.'view/plan/footer.php'); /* footer読み込み*/ ?>
		</div> <!-- wrapper -->
		<?php require_once(PATH.'view/basic/head_footer.php'); /* head_footer読み込み*/ ?>
	</body>
</html>