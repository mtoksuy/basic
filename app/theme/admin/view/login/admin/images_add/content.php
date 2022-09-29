
<div class="product_add">
	<div class="product_add_inner">
		<form id="upload_form" name="upload_form" method="post" action="" enctype="multipart/form-data">
			<input type="file" name="uploadFile[]" id="uploadFile" accept="image/*" multiple="multiple" webkitdirectory="" directory="">
			<input type="hidden" name="folder_id" value="0">
			<input type="submit" value="アップロード" name="submit">
		</form>
<?php


		if($_POST) {
			echo '

<style>
#summary {
	width : 370px;
	height: 400px;
}
</style>
<textarea placeholder="" name="summary" id="summary" height="" width="400">'.$images_add_data_array['img_html'].'</textarea>';
		} // if($_POST) {
?>


	</div>
</div>
