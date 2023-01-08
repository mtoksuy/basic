
<?php
if(preg_match('/localhost/',$_SERVER["HTTP_HOST"])) {
//	echo 'アナリティクス';
}
	// 本番環境
	else {
		echo '';
	}
?>
