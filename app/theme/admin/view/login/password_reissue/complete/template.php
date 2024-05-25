<!DOCTYPE html>
<html>
<?php require_once(PATH . 'app/theme/admin/view/' . $controller_query . '/head.php'); /* head読み込み*/ ?>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<?php require_once(PATH . 'app/theme/admin/view/common/header.php'); /* header読み込み*/ ?>
		<!-- main -->
		<div class="main clearfix">
			<!-- main_inner -->
			<div class="main_inner clearfix">
				<?php require_once(PATH . 'app/theme/admin/view/' . $controller_query . '/complete/content.php'); /* content読み込み*/ ?>
			</div>
		</div> <!-- main -->
		<?php require_once(PATH . 'app/theme/admin/view/common/footer.php'); /* footer読み込み*/ ?>
	</div> <!-- wrapper -->
	<?php require_once(PATH . 'app/theme/admin/view/common/head_footer.php'); /* head_footer読み込み*/ ?>
</body>

</html>