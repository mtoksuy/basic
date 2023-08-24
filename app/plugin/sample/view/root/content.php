
<div class="admin">
	<div class="admin_inner">
		<div class="admin_left">
			<?php require_once(PATH.'app/theme/admin/view/login/admin/admin_left_drawer.php'); /* admin_left_drawer読み込み*/ ?>
		</div>
		<div class="admin_right">
			<div class="summary">
				<div class="summary_inner">
					<!-- summary_box -->
					<div class="summary_box">
						<h1>プラグイン：sampleの画面です。</h1>
						<p>Basic version .<?php echo $site_data_array['basic_version']; ?></p>
						<p style="border-bottom:1px solid var(--theme-border-color2);"> </p>
						<p>公開している記事数の合計数を表示するsampleプラグインです。</p>
						<p>記事合計数：<b><?php echo $article_res[0]['COUNT(*)'] ?></b></p>


						<p class="m_0">プラグインを作成する際のポイント</p>
						<p>Basicなど全てのクラス、関数は利用できます。</p>
					</div> <!-- summary_box -->
				</div> <!-- summary_inner -->
			</div> <!-- summary -->
		</div> <!-- admin_right -->
	</div> <!-- admin_inner -->
</div> <!-- admin -->
