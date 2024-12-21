<!-- ハンバーガーメニュー -->
<div id="nav-drawer">
	<input id="nav-input" type="checkbox" class="nav-unshown">
	<label id="nav-open" for="nav-input"><span> </span></label>
	<label class="nav-unshown" id="nav-close" for="nav-input"></label>
	<div id="nav-content">
		<ul>
			<p>カテゴリー</p>

		</ul>
		<ul>
			<p>私たちについて</p>
			<li><a class="o_8" href="<?php echo HTTP; ?>aboutus/">私たちについて</a></li>
			<li><a class="o_8" href="<?php echo HTTP; ?>rule/">利用規約</a></li>
			<li><a class="o_8" href="<?php echo HTTP; ?>privacy_policy/">プライバシーポリシー</a></li>
			<li><a class="o_8" href="<?php echo HTTP; ?>sct/">特定商取引法に基づく表記</a></li>
			<li><a class="o_8" href="https://spacenavi.jp/" target="_blank">運営会社</a></li>
			<li><a class="o_8" href="<?php echo HTTP; ?>sitemap/">サイトマップ</a></li>
			<li><a class="o_8" href="<?php echo HTTP; ?>contact/">お問い合わせ</a></li>
		</ul>

	</div>
</div> <!-- ハンバーガーメニュー -->
<!-- 検索窓 -->
<div class="search_window">
	<div class="search_window_inner">
		<form class="search_window_form" method="get" action="<?php echo HTTP; ?>search/" autocomplete="off">
			<input placeholder="なにをお探しですか？" type="search" name="q" id="q" value="<?php if ($_GET['q']) {
																																							echo $_GET['q'];
																																						} ?>" autocomplete="off">
			<input type="hidden" name="context" id="context" value="<?php if ($_GET['context']) {
																																echo $_GET['context'];
																															} else {
																																echo 'products';
																															} ?>">
			<div class="search_logo">
				<img width="16" height="17" title="検索" alt="検索" src="<?php echo HTTP; ?>assets/svg/common/search_logo_1.svg">
				<input type="submit" value="検索">
			</div>
		</form>
	</div>
</div>
<div class="search_switch">
	<img width="16" height="17" title="検索" alt="検索" src="<?php echo HTTP; ?>assets/svg/common/search_logo_1.svg">
</div>

<nav class="drawer">
	<div class="drawer_inner">
		<ul style="top: -2px; position: relative;">
			<?php
			if ($_COOKIE['amatem_id'] === 'mtoksuyy') {
				echo '
							<li>
								<a class="o_8" href="' . HTTP . 'signup/">新規登録</a>
							</li>
							<li>
								<a class="o_8" href="' . HTTP . 'login/">ログイン</a>
							</li>
					<li>
						<a class="o_8" href="' . HTTP . 'contact/">お問い合わせ</a>
					</li>
';
			} else {
			}
			?>
		</ul>
	</div>
</nav>