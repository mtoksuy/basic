		<div class="navi_slide_menu">
			<ul>
				<li class="<?php if($get['context'] == 'products') {echo 'now';} ?>">
					<a href="<?php echo HTTP.'search/?q='.$get['q'].'&context=products'; ?>">プロダクト</a>
				</li>
				<li class="<?php if($get['context'] == 'article') {echo 'now';} ?>">
					<a href="<?php echo HTTP.'search/?q='.$get['q'].'&context=article'; ?>">記事</a>
				</li>
			</ul>
		</div>
