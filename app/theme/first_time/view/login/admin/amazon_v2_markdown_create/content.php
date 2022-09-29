
<div class="amazon_v2_markdown_create">
	<div class="amazon_v2_markdown_create_inner">
		<form id="upload_form" name="upload_form" method="post" action="">
			<textarea placeholder="あまてむ内プロダクトURLを貼り付け(複数可能)" name="products_url" id="products_url" height="400" width="400" rows="24" cols="80"><?php echo $_POST['products_url']; ?></textarea>
			<input type="submit" value="マークダウン生成" name="submit">
		</form>
<?php
		if($_POST) {
			echo '
<style>

</style>
<textarea placeholder="" name="summary" id="summary" height="" width="400" rows="24" cols="80">'.$amazon_v2_markdown.'</textarea>';
		} // if($_POST) {
?>
	</div>
</div>
