<?php
// 定義されていない変数を空定義
if (empty($_GET['q'])) {
	$_GET['q'] = '';
}
?>
<!-- ハンバーガーメニュー -->
<div id="nav-drawer">
	<input id="nav-input" type="checkbox" class="nav-unshown">
	<label id="nav-open" for="nav-input"><span> </span></label>
	<label class="nav-unshown" id="nav-close" for="nav-input"></label>
	<div id="nav-content">
		<ul>
			<li><a class="o_8" href="<?php echo HTTP; ?>about/">About</a></li>
			<li><a class="o_8" href="<?php echo HTTP; ?>#mission">Mission</a></li>
			<li><a class="o_8" href="<?php echo HTTP; ?>#service">Service</a></li>
			<li><a class="o_8" href="<?php echo HTTP; ?>newarticle/">Information</a></li>
			<li><a class="o_8" href="<?php echo HTTP; ?>#careers">Careers</a></li>
			<li><a class="o_8" href="<?php echo HTTP; ?>sitemap/">Sitemap</a></li>
			<li><a class="o_8" href="<?php echo HTTP; ?>contact/">Contact</a></li>
		</ul>
	</div>
</div> <!-- ハンバーガーメニュー -->
<!-- 検索窓 -->
<div class="search_window">
	<div class="search_window_inner">
		<form class="search_window_form" method="get" action="<?php echo HTTP; ?>search/" autocomplete="off">
			<input placeholder="キーワード検索" type="search" name="q" id="q" value="<?php if ($_GET['q']) {
																																					echo $_GET['q'];
																																				} ?>" autocomplete="off">
			<div class="search_logo">
				<img width="16" height="17" title="検索" alt="検索" src="<?php echo HTTP; ?>app/assets/svg/common/search_logo_1.svg">
				<input type="submit" value="検索">
			</div>
		</form>
	</div>
</div>
<div class="search_switch">
	<img width="16" height="17" title="検索" alt="検索" src="<?php echo HTTP; ?>app/assets/svg/common/search_logo_1.svg">
</div>

<nav class="drawer">
	<div class="drawer_inner">
		<ul style="top: -2px; position: relative;">

		</ul>
	</div>
</nav>