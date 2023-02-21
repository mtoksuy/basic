<?php 
class model_setup_html {
	//----------------------------
	//セットアップのHTML生成
	//----------------------------
	static function setup_html_create($step = NULL, $connect_check = NULL, $user_basic_id_check = NULL, $user_password_check = NULL) {
/*
		pre_var_dump('ステップ：'.$step);
		pre_var_dump('接続：'.$connect_check);
*/
		// 定義されていない変数を空定義
		if(empty($_POST['database_name'])) { $_POST['database_name'] = ''; }
		if(empty($_POST['database_user'])) { $_POST['database_user'] = ''; }
		if(empty($_POST['site_name'])) { $_POST['site_name'] = ''; }
		if(empty($_POST['basic_id'])) { $_POST['basic_id'] = ''; }
		if(empty($setup_step_2_html)) { $setup_step_2_html = ''; }
		if(empty($basic_id_submit_error_word)) { $basic_id_submit_error_word = ''; }
		if(empty($password_submit_error_word)) { $password_submit_error_word = ''; }


		$setup_step_0_html = '
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
					<p>この情報は db_config.php ファイルの作成に使用されます。もし何かが原因で自動ファイル生成が動作しなくても心配しないでください。テキストエディターで 直接作成も可能です。</p>
					
					<p>1〜４の項目はホスティング先から提供されています。この情報がわからない場合は作業を続行する前にホスティング先と連絡を取ってください。準備ができているなら…</p>
					<a href="'.HTTP.'setup?step=1">さあ、始めましょう!</a>
				</div> <!-- contact_inner -->
			</div> <!-- contact -->';

		$setup_step_1_html = '
			<!-- contact -->
			<div class="setup">
				<div class="setup_inner">
					<h2 class="setup_title">以下にデータベース接続のための詳細を入力してください。これらのデータについて分からない点があれば、ホストに連絡を取ってください。</h2>
					<form method="post" action="?step=2" class="setup_form">
						<label for="database_name">データベース名</label>
						<input type="text" placeholder="Basic で使用するデータベース名" value="" required="required" name="database_name" id="database_name">

						<label for="database_user">データベースのユーザー名</label>
						<input type="text" placeholder="データベースのユーザー名を記入して下さい" value="" required="required" name="database_user" id="database_user">
					
						<label for="database_password">データベースのパスワード</label>
						<input type="password" placeholder="データベースのパスワードを記入して下さい" value="" required="required" name="database_password" id="database_password">

						<label for="database_host">データベースホスト名</label>
						<input type="text" placeholder="データベースホスト名を記入して下さい" value="localhost" required="required" name="database_host" id="database_host">

						<input type="submit" value="送信" name="submit">
					</form>

				</div> <!-- contact_inner -->
			</div> <!-- contact -->';

		$setup_step_2_true_html = '
			<!-- contact -->
			<div class="setup">
				<div class="setup_inner">
					<h2 class="setup_title_deading_1">ようこそ！</h2>
					<p class="m_0">Basic の始まりの地へようこそ ! </p>
					<p>以下に情報を記入するだけで、世界一簡単なCMSを使い始めることができます。</p>

					<form method="post" action="?step=3" class="setup_form">
					<h2 class="setup_title_deading_1">サイト情報</h2>
						<label for="site_name">サイト名</label>
						<input type="text" placeholder="運営していくサイト名、ブログ名" value="" name="site_name" id="site_name">
					<p>今記入しなくても大丈夫です。いつでも更新できます。</p>

					<h2 class="setup_title_deading_1">管理者登録</h2>
						<label for="basic_id">ユーザー名</label>
						<input type="text" placeholder="ログインするユーザー名" value="" required="required" name="basic_id" id="basic_id">
						<p>ユーザー名には、半角英数字、下線、ハイフンのみが使用できます。</p>
						<label for="password">パスワード</label>
						<input type="password" placeholder="ログインするパスワード" value="" required="required" name="password" id="password">
						<p>重要: ログイン時にこのパスワードが必要になります。安全な場所に保管してください。</p>
						<input type="submit" value="Basicをインストール" name="submit">
					</form>

				</div> <!-- contact_inner -->
			</div> <!-- contact -->';

		$setup_step_2_false_html = '
			<!-- contact -->
			<div class="setup">
				<div class="setup_inner">
					<h2 class="setup_title">データベースを選択できません</h2>
					<p><b>'.$_POST['database_name'].'</b> データベースへ接続できませんでした。</p>

					<ol>
						<li><b>'.$_POST['database_name'].'</b> データベースは本当に存在していますか ?</li>
						<li>ユーザー <b>'.$_POST['database_user'].'</b> にはデータベース <b>'.$_POST['database_name'].'</b> を使用できる権限がありますか ?</li>
						<li>パスワードは間違っていませんか？</li>
					</ol>

					<p>データベースのセットアップ方法が分からない場合はホスティングサービスに連絡してください。それでもダメならBasic サポートフォーラムでヘルプを見つけられるかもしれません。</p>

					<a href="'.HTTP.'setup?step=1">再度、試してみましょう!</a>
				</div> <!-- contact_inner -->
			</div> <!-- contact -->';


		$setup_step_3_true_html = '
			<!-- contact -->
			<div class="setup">
				<div class="setup_inner">
					<h2 class="setup_title m_b_15">無事にBasicをインストールできました</h2>
					<p>サイトを運営する準備は整いましたので、あとはテーマを選んだりデザインを整えたりして素敵な記事を書きましょう。</p>
					<ol>
						<li>登録したユーザー名、パスワードでログイン</li>
						<li>素敵な記事を投稿する</li>
						<li>公開した記事を読んでもらう</li>
					</ol>

					<p>思い通りの表現でブログライフを始めましょう！</p>

					<a href="'.HTTP.'login/">ログイン</a>
				</div> <!-- contact_inner -->
			</div> <!-- contact -->';

		if(!$user_basic_id_check) {
			$basic_id_submit_error_word = '<p class="m_0 red">登録できないユーザー名です。</p>';
		}
		if(!$user_password_check) {
			$password_submit_error_word = '<p class="m_0 red">登録できないパスワードです。</p>';
		}
		$setup_step_3_false_html = '
			<!-- contact -->
			<div class="setup">
				<div class="setup_inner">
					<h2 class="setup_title_deading_1">ようこそ！</h2>
					<p class="m_0">Basic の始まりの地へようこそ ! </p>
					<p>以下に情報を記入するだけで、世界一簡単なCMSを使い始めることができます。</p>

					<form method="post" action="?step=3" class="setup_form">
					<h2 class="setup_title_deading_1">サイト情報</h2>
						<label for="site_name">サイト名</label>
						<input type="text" placeholder="運営していくサイト名、ブログ名" value="'.$_POST['site_name'].'" name="site_name" id="site_name">
					<p>今記入しなくても大丈夫です。いつでも更新できます。</p>

					<h2 class="setup_title_deading_1">ログイン情報</h2>
						<label for="basic_id">ユーザー名</label>
						<input type="text" placeholder="ログインするユーザー名" value="'.$_POST['basic_id'].'" required="required" name="basic_id" id="basic_id">
						'.$basic_id_submit_error_word.'
						<p>ユーザー名には、半角英数字、下線、ハイフンのみが使用できます。</p>


						<label for="password">パスワード</label>
						<input type="password" placeholder="ログインするパスワード" value="" required="required" name="password" id="password">
						'.$password_submit_error_word.'
						<p>重要: ログイン時にこのパスワードが必要になります。安全な場所に保管してください。</p>
						<input type="submit" value="Basicをインストール" name="submit">
					</form>

				</div> <!-- contact_inner -->
			</div> <!-- contact -->';

			// ステップ0
			if($step == 0) {
				$setup_step_html = $setup_step_0_html;
			}
			// ステップ1
			if($step == 1) {
				$setup_step_html = $setup_step_1_html;
			}
			// ステップ2
			if($step == 2) {
				if($connect_check) {
					$setup_step_html = $setup_step_2_true_html;
				}
					else {
						$setup_step_html = $setup_step_2_false_html;
					}
				}
			// ステップ3
			if($step == 3) {
				if(!$user_basic_id_check || !$user_password_check) {
					$setup_step_html = $setup_step_3_false_html;
				}
					else {
						$setup_step_html = $setup_step_3_true_html;
					}
			}
			// コンプリートステップ
			if($step === 'complete') {
				$setup_step_html = $setup_step_3_true_html;
			}
			// setup_data_array
			$setup_data_array = array(
				'setup_html'             => $setup_step_html,
				'setup_step_1_html' => $setup_step_1_html,
				'setup_step_2_html' => $setup_step_2_html, 
			);
		return $setup_data_array;
	}
}