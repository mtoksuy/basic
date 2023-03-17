
		<nav class="admin_left_drawer">
			<div class="admin_left_drawer_inner">
				<ul class="border">
					<span>基本</span>
					<li<?php if($now == '') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/">ホーム</a>
					</li>
					<li>
						<a class="o_8" href="<?php echo HTTP;?>" target="_blank">サイトを表示</a>
					</li>
				</ul>

				<?php $update_unread_count_html = ''; $response = file_get_contents('https://basic.dance/api/?basic_version_get=true'); $json_decode_response = json_decode($response , true); if($site_data_array['basic_version'] < $json_decode_response['latest_basic_version']) { $update_unread_count_html = '<span class="contact_unread_count"> </span>'; } ?>
				<ul class="border">
					<span>アップデート機能</span>
					<li<?php if($now == 'coreupdate') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/coreupdate/">更新</a><?php echo $update_unread_count_html; ?>
					</li>
				</ul>


				<ul class="border">
					<span>ブログ機能</span>
					<li<?php if($now == 'post') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/post/" target="_blank">ブログを書く</a>
					</li>
					<li<?php if($now == 'list') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/list/">投稿一覧</a>
					</li>
					<li<?php if($now == 'draft') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/draft/">下書き一覧</a>
					</li>
				</ul>












				<ul class="border">
					<span>ファイル機能</span>
					<li<?php if($now == 'fileupload') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/fileupload/">ファイルアップロード</a>
					</li>

					<li<?php if($now == 'filelist') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/filelist/">ファイル一覧</a>
					</li>
				</ul>

				<?php if((int)$site_data_array['contact_unread_count'] > 0) { $contact_unread_count_html = '<span class="contact_unread_count"> </span>'; } ?>
				<ul class="border">
					<span>お問い合わせ機能</span>
					<li<?php if($now == 'contactlist') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/contactlist/">お問い合わせ一覧</a><?php echo $contact_unread_count_html; ?>
					</li>
				</ul>


				<ul class="border">
					<span>テーマ機能</span>
					<li<?php if($now == 'themeswitching') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/themeswitching/">テーマ切り替え</a>
					</li>
				</ul>


				<ul class="border">
					<span>ページ機能</span>
					<li<?php if($now == 'page') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/page/" target="_blank">ページ作成</a>
					</li>
					<li<?php if($now == 'pagelist') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/pagelist/">ページ一覧</a>
					</li>
					<li<?php if($now == 'pagedraft') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/pagedraft/">下書き一覧</a>
					</li>
				</ul>

				<ul class="border">
					<span>トップページ編集</span>
					<li<?php if($now == 'template') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/rootedit/" target="_blank">トップページ編集</a>
					</li>
				</ul>

				<ul class="border">
					<span>テンプレート編集</span>
					<li<?php if($now == 'template') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/template/" target="_blank">テンプレート編集</a>
					</li>
				</ul>


				<ul class="border">
					<span>サイト設定</span>
					<li<?php if($now == 'general') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/general/">一般設定</a>
					</li>
<!--
					<li<?php if($now == 'draft') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/hashtag/">#タグ一覧</a>
					</li>
-->
				</ul>


				<ul class="border">
					<span>アカウント設定</span>
					<li<?php if($now == 'profile') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/profile/">プロフィール設定</a>
					</li>
				</ul>


				<ul class="border">
					<span>ツール設定</span>
					<li<?php if($now == 'import') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/import/">インポート</a>
					</li>
				</ul>


			</div>
		</nav>
