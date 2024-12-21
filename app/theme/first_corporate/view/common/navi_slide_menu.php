<div class="navi_slide_menu">
	<ul>
		<li<?php if (preg_match('/about/', $_SERVER['REQUEST_URI'], $array)) {
					echo ' class="now"';
				} ?>>
			<a href="<?php echo HTTP; ?>about/">About</a>
			</li>

			<li>
				<a href="<?php echo HTTP; ?>#mission">Mission</a>
			</li>

			<li>
				<a href="<?php echo HTTP; ?>#service">Service</a>
			</li>

			<li<?php if (preg_match('/newarticle/', $_SERVER['REQUEST_URI'], $array)) {
						echo ' class="now"';
					} ?>>
				<a href="<?php echo HTTP; ?>newarticle/">Information</a>
				</li>

				<li>
					<a href="<?php echo HTTP; ?>#careers">Careers</a>
				</li>

				<li<?php if (preg_match('/contact/', $_SERVER['REQUEST_URI'], $array)) {
							echo ' class="now"';
						} ?>>
					<a href="<?php echo HTTP; ?>contact/">Contact</a>
					</li>
	</ul>
</div>