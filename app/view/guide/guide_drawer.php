		<!-- guide_menu -->
		<div class="guide_menu">
			<ul>
				<li<?php if($now == 'guide') {echo ' class="now"';}?>>
					<a href="<?php echo HTTP;?>guide/">ホーム</a>
				</li>
				<li<?php if($now == 'php_reference') {echo ' class="now"';}?>>
					<a href="<?php echo HTTP;?>guide/php_reference/">ResizeCDNリファレンス</a>
				</li>
				<li<?php if($now == 'html_conversion_tool') {echo ' class="now"';}?>>
					<a href="<?php echo HTTP;?>guide/html_conversion_tool/">CDN自動変換ツール</a>
				</li>
				<li<?php if($now == 'direct_reference') {echo ' class="now"';}?>>
					<a href="<?php echo HTTP;?>guide/direct_reference/">ダイレクト型リファレンス</a>
				</li>
				<li<?php if($now == 'trial') {echo ' class="now"';}?>>
					<a href="<?php echo HTTP;?>guide/trial/">データ型お試し</a>
				</li>
			</ul>
		</div> <!-- guide_menu -->
