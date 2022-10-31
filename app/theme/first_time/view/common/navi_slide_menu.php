<?php
// テスト
/*
if(preg_match('/\//', $_SERVER['REQUEST_URI'], $array)) {echo ' class="now"';} 

pre_var_dump($_SERVER['PHP_SELF']);
pre_var_dump($_SERVER['REQUEST_URI']);
pre_var_dump(HTTP);
pre_var_dump($_SERVER);
*/

?>
		<div class="navi_slide_menu">
			<ul>
				<li<?php if(preg_match('/^\/amatem\/index.php$|^\/index.php$/', $_SERVER['PHP_SELF'], $array)) {echo ' class="now"';} ?>>
					<a href="<?php echo HTTP; ?>">ホーム</a>
				</li>
				<li<?php if(preg_match('/category|^\/products|^\/amatem\/products/', $_SERVER['REQUEST_URI'], $array)) {echo ' class="now"';} ?>>
					<a href="<?php echo HTTP; ?>category/">私たちについて</a>
				</li>
				<li<?php if(preg_match('/newarticle|article/', $_SERVER['REQUEST_URI'], $array)) {echo ' class="now"';} ?>>
					<a href="<?php echo HTTP; ?>newarticle/">記事</a>
				</li>
			</ul>
		</div>
