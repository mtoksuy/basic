<?php 
class model_setup_html {
	//----------------------------
	//セットアップのHTML生成
	//----------------------------
	static function setup_html_create() {
		$setup_step_1_html = '
			<!-- contact -->
			<div class="setup">
				<div class="setup_inner">
					<h2 class="setup_title">Basicへようこそ。始める前に、以下の項目を知っておく必要があります。</h2>
					<ol>
						<li>データベース名</li>
						<li>データベースのユーザー名</li>
						<li>データベースのパスワード</li>
						<li>データベースホスト</li>
					</ol>
					<p>この情報は config.php ファイルの作成に使用されます。もし何かが原因で自動ファイル生成が動作しなくても心配しないでください。テキストエディターで 直接作成も可能です。</p>
					
					<p>1〜４の項目はホスティング先から提供されています。この情報がわからない場合は作業を続行する前にホスティング先と連絡を取ってください。準備ができているなら…</p>
					<a href="<?php echo HTTP; ?>setup?step=1">さあ、始めましょう!</a>
				</div> <!-- contact_inner -->
			</div> <!-- contact -->';

		$setup_step_2_html = '
			<!-- contact -->
			<div class="setup">
				<div class="setup_inner">
					<h2 class="setup_title">Basicへようこそ。始める前に、以下の項目を知っておく必要があります。</h2>
					<ol>
						<li>データベース名</li>
						<li>データベースのユーザー名</li>
						<li>データベースのパスワード</li>
						<li>データベースホスト</li>
					</ol>
					<p>この情報は config.php ファイルの作成に使用されます。もし何かが原因で自動ファイル生成が動作しなくても心配しないでください。テキストエディターで 直接作成も可能です。</p>
					
					<p>1〜４の項目はホスティング先から提供されています。この情報がわからない場合は作業を続行する前にホスティング先と連絡を取ってください。準備ができているなら…</p>
					<a href="<?php echo HTTP; ?>setup?step=1">さあ、始めましょう!</a>
				</div> <!-- contact_inner -->
			</div> <!-- contact -->';



			// setup_data_array
			$setup_data_array = array(
				'setup_step_1_html' => $setup_step_1_html,
				'setup_step_2_html'  => $setup_step_2_html, 
			);
		return $setup_data_array;
	}
}