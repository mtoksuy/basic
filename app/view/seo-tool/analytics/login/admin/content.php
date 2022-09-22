
<div class="admin">
	<div class="admin_inner">
		<div class="admin_left">
			<?php require_once(PATH.'view/seo-tool/analytics/login/admin/admin_left_drawer.php'); /* admin_left_drawer読み込み*/ ?>
		</div>
		<div class="admin_right">
			<div class="summary">
				<div class="summary_inner">
					<!-- content_box -->
					<div class="content_box">
						<div class="trun_change o_8">
							<h1><?php echo $analytics_graph_url_data; ?></h1><div class="triangle"></div>
						</div>
						<div class="trun_change_box">
							<ul>
								<li>プロパディ選択</li>
									<?php echo $analytics_propaddy_list_html; ?>
							</ul>
						</div>
						<div class="date_select o_8">
							<span>日付：<?php echo $term_title_name; ?></span><div class="triangle"></div>
							<div class="date_select_box">
								<ul>
									<li>期間</li>
									<li>
										<a href="<?php echo HTTP.'seo-tool/analytics/login/admin/?turn_id='.$ticket_turn_id.'&term=7'; ?>">過去7日間</a>
									</li>
									<li>
										<a href="<?php echo HTTP.'seo-tool/analytics/login/admin/?turn_id='.$ticket_turn_id.'&term=30'; ?>">過去1ヶ月間</a>
									</li>
									<li>
										<a href="<?php echo HTTP.'seo-tool/analytics/login/admin/?turn_id='.$ticket_turn_id.'&term=90'; ?>">過去3ヶ月間</a>
									</li>
									<li>
										<a href="<?php echo HTTP.'seo-tool/analytics/login/admin/?turn_id='.$ticket_turn_id.'&term=180'; ?>">過去半年間</a>
									</li>
									<li>
										<a href="<?php echo HTTP.'seo-tool/analytics/login/admin/?turn_id='.$ticket_turn_id.'&term=365'; ?>">過去1年間</a>
									</li>
								</ul>
							</div>
						</div>
						<canvas id="myChart" width="400" height="150"></canvas>
					</div> <!-- content_box -->
					<!-- content_box -->
					<div class="content_box">
						<h1>レポート</h1>
						<p>最新順位</p>
						<p>直近1週間平均順位</p>
						<p>直近1ヶ月平均順位</p>
						<p>直近3ヶ月平均順位</p>
						<p>直近半年平均順位</p>
						<p>直近1年平均順位</p>
					</div> <!-- content_box -->
				</div>
			</div> <!-- summary -->
		</div>
	</div>
</div>
