
<div class="media">
	<div class="media_inner">
		<div class="writer">
			<div class="writer_inner">
				<div class="writer_inner_left">
					<img width="128" height="128" title="<?php echo $amatem_id_data_array['name']; ?>" alt="<?php echo $amatem_id_data_array['name']; ?>" src="<?php echo HTTP; ?>assets/img/user_icon/<?php echo $amatem_id_data_array['icon']; ?>">
					<div class="profile_card_content_name">
						<h1><?php echo $amatem_id_data_array['name']; ?></h1>
					</div>
					<div class="profile_card_content_summary">
						<p><?php echo $amatem_id_data_array['profile']; ?></p>
					</div>
					<div class="profile_card_content_sns">
						<?php echo $amatem_id_data_array['twitter_show_html']; ?>
					</div>
					<div class="profile_card_content_site">
					<?php
					if($amatem_id_data_array['amatem_id'] == 'mtoksuy') { ?>
						<p class="m_0">運営サイト一覧</p>
						<p class="m_0"><a target="_blank" href="https://spacenavi.jp/">スペースナビ株式会社 限界まで高速化するSEOでビジネスにブーストを。</a></p>
						<p class="m_0"><a target="_blank" href="https://resizecdn.com/">ResizeCDN - 画像特化型CDN</a></p>
						<p class="m_0"><a target="_blank" href="https://uxseo.jp/">UXSEO [1億PVから研究した2020年最新のSEO決定版サービス]</a></p>
						<p class="m_0"><a target="_blank" href="http://sharetube.jp/">Sharetube - シェアしたくなるコンテンツが集まる、集まる。</a></p>
						<p class="m_0"><a target="_blank" href="http://programmerbox.com/">ProgrammerBOX -プログラマーボックス-</a></p>
						<p class="m_0"><a target="_blank" href="http://zodiac.ninja/">-忍者でもわかる干支サービス-干支忍者[干支をもっと便利に]</a></p>
					<?php } ?>
					</div>
				</div>
				<div class="writer_inner_right">
					<div class="card_article">
						<div class="card_article_inner">
							<?php echo $article_list_html; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
