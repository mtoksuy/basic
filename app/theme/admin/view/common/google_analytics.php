
<?php
if(preg_match('/localhost/',$_SERVER["HTTP_HOST"])) {
//	echo 'アナリティクス';
}
	// 本番環境
	else {
		echo '<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-203703858-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag("js", new Date());

  gtag("config", "UA-203703858-1");
</script>';
	}
?>
