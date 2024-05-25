<!DOCTYPE html>
<html>
<?php require_once(PATH . 'app/plugin/' . $plugin_name . '/view/' . $controller_query . '/head.php'); /* head読み込み*/ ?>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<?php require_once(PATH . 'app/plugin/' . $plugin_name . '/view/common/header.php'); /* header読み込み*/ ?>
		<!-- main -->
		<div class="main clearfix">
			<!-- main_inner -->
			<div class="main_inner clearfix">
				<?php require_once(PATH . 'app/plugin/' . $plugin_name . '/view/' . $controller_query . '/content.php'); /* content読み込み*/ ?>
			</div>
		</div> <!-- main -->
		<?php require_once(PATH . 'app/plugin/' . $plugin_name . '/view/common/footer.php'); /* footer読み込み*/ ?>
	</div> <!-- wrapper -->
	<?php require_once(PATH . 'app/plugin/' . $plugin_name . '/view/common/head_footer.php'); /* head_footer読み込み*/ ?>
</body>

</html>