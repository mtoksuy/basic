<?php
// テスト
//var_dump($method);
//	var_dump($_SERVER['REQUEST_URI']);
//if(preg_match('/\//', $_SERVER['REQUEST_URI'], $array)) {echo ' class="now"';} 
//pre_var_dump($_SERVER['PHP_SELF']);
//pre_var_dump($_SERVER['REQUEST_URI']);

/*
	string(21) "/products/B07SR8KKMK/"
*/
?>
		<div class="navi_slide_menu">
			<ul>
				<li<?php if(preg_match('/^\/amatem\/index.php$|^\/index.php$/', $_SERVER['PHP_SELF'], $array)) {echo ' class="now"';} ?>>
					<a href="<?php echo HTTP; ?>">ホーム</a>
				</li>
				<li<?php if(preg_match('/category|^\/products|^\/amatem\/products/', $_SERVER['REQUEST_URI'], $array)) {echo ' class="now"';} ?>>
					<a href="<?php echo HTTP; ?>category/">カテゴリー</a>
				</li>
				<li<?php if(preg_match('/cut_in_price_products/', $_SERVER['REQUEST_URI'], $array)) {echo ' class="now"';} ?>>
					<a href="<?php echo HTTP; ?>cut_in_price_products/">値下げプロダクト</a>
				</li>
<!--
				<li>
					<a href="">定期購入</a>
				</li>
-->
				<li<?php if(preg_match('/newarticle|article/', $_SERVER['REQUEST_URI'], $array)) {echo ' class="now"';} ?>>
					<a href="<?php echo HTTP; ?>newarticle/">記事</a>
				</li>
<!--
				<li>
					<a href="">あまてむの歩き方</a>
				</li>
-->
			</ul>
		</div>
