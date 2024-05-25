<?php
if ($_SESSION['basic_id']) {
	$now = 'hashtag';
	$content_html = '
						<h1>ハッシュタグ一覧 実装中</h1>
						<p>Basic version .0.2</p>
						<p style="border-bottom:1px solid #2D2E32;"> </p>';
	// テンプレート読み込み
	require_once(PATH . 'app/theme/admin/view/' . $controller_query . '/template.php');
} else {
	// クッキーログイン
	model_login_basis::cookie_login();
}
