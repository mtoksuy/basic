
		<nav class="admin_left_drawer">
			<div class="admin_left_drawer_inner">
				<ul class="border">
					<span>基本</span>
					<li<?php if($now == '') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/">ホーム</a>
					</li>
					<li<?php if($now == 'writer') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>"  target="_blank">サイトを表示</a>
					</li>
				</ul>
				<ul class="border">
					<span>ブログ機能</span>
					<li<?php if($now == 'php_reference') {echo ' class="now"';}?>>
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
					<li<?php if($now == 'images_add') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/fileupload/" target="_blank">ファイルアップロード</a>
					</li>

					<li<?php if($now == 'images_add') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/filelist/" target="_blank">ファイル一覧</a>
					</li>
				</ul>


				<ul class="border">
					<span>テーマ機能</span>
					<li<?php if($now == 'images_add') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/themeswitching/" target="_blank">テーマ切り替え</a>
					</li>
				</ul>




				<ul class="border">
					<span>サイト設定</span>
					<li<?php if($now == 'draft') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/template/">テンプレート設定</a>
					</li>

					<li<?php if($now == 'draft') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/page/">ページ作成</a>
					</li>

					<li<?php if($now == 'draft') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/pagelist/">ページ一覧</a>
					</li>

					<li<?php if($now == 'draft') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/hashtag/">#タグ一覧</a>
					</li>
				</ul>

				<ul class="border">
					<span>アカウント設定</span>
					<li<?php if($now == 'profile_edit') {echo ' class="now"';}?>>
						<a class="o_8" href="<?php echo HTTP;?>login/admin/profile_edit/">プロフィール設定</a>
					</li>
				</ul>
			</div>
		</nav>