<?php
switch($_GET['p']) {
	case '1':
		$select = '俊速';
		$li_html = '		<li>
			<div class="problem_solving_li_inner">
				<h4>俊速</h4>
				<p class="price">10万<span>/月</span></p>
				<div class="plan_box">
					<div class="plan_box_item">
						<div class="left">最新SEO</div><div class="right green">△</div>
					</div>
					<div class="plan_box_item">
						<div class="left">画像圧縮</div><div class="right red">×</div>
					</div>
					<div class="plan_box_item">
						<div class="left">JS最適化</div><div class="right red">×</div>
					</div>
					<div class="plan_box_item">
						<div class="left">画像配信(CDN)</div><div class="right red">×</div>
					</div>
					<div class="plan_box_item">
						<div class="left">対応サイト数</div><div class="right green">1</div>
					</div>
				</div> <!-- plan_box -->
			</div> <!-- problem_solving_li_inner -->
		</li>';
	break;
	case '2':
		$select = '爆速';
		$li_html = '		<li>
			<div class="problem_solving_li_inner">
			  <div class="ribbon19-content">
				  <span class="ribbon19">Best</span>
			  </div>
				<h4>爆速</h4>
				<p class="price">12万<span>/月</span></p>
				<div class="plan_box">
					<div class="plan_box_item">
						<div class="left">最新SEO</div><div class="right green">○</div>
					</div>
					<div class="plan_box_item">
						<div class="left">画像圧縮</div><div class="right green">○</div>
					</div>
					<div class="plan_box_item">
						<div class="left">JS最適化</div><div class="right red">×</div>
					</div>
					<div class="plan_box_item">
						<div class="left">画像配信(CDN)</div><div class="right red">×</div>
					</div>
					<div class="plan_box_item">
						<div class="left">対応サイト数</div><div class="right green">1</div>
					</div>
				</div> <!-- plan_box -->
			</div> <!-- problem_solving_li_inner -->
		</li>';
	break;
	case '3':
		$select = '超速';
		$li_html = '		<li>
			<div class="problem_solving_li_inner">
				<h4>超速</h4>
				<p class="price">20万<span>/月</span></p>
				<div class="plan_box">
					<div class="plan_box_item">
						<div class="left">最新SEO</div><div class="right green">◎</div>
					</div>
					<div class="plan_box_item">
						<div class="left">画像圧縮</div><div class="right green">○</div>
					</div>
					<div class="plan_box_item">
						<div class="left">JS最適化</div><div class="right green">○</div>
					</div>
					<div class="plan_box_item">
						<div class="left">画像配信(CDN)</div><div class="right green">○</div>
					</div>
					<div class="plan_box_item">
						<div class="left">対応サイト数</div><div class="right green">3</div>
					</div>
				</div> <!-- plan_box -->
			</div> <!-- problem_solving_li_inner -->
		</li>';
	break;
	case '4':
		$select = 'ビジネス';
		$li_html = '		<li>
			<div class="problem_solving_li_inner">
				<h4>ビジネス</h4>
				<p class="price">応相談<span>/月</span></p>
				<div class="plan_box">
					<div class="plan_box_item">
						<div class="left">最新SEO</div><div class="right green">◎</div>
					</div>
					<div class="plan_box_item">
						<div class="left">画像圧縮</div><div class="right green">◎</div>
					</div>
					<div class="plan_box_item">
						<div class="left">JS最適化</div><div class="right green">◎</div>
					</div>
					<div class="plan_box_item">
						<div class="left">画像配信(CDN)</div><div class="right green">◎</div>
					</div>
					<div class="plan_box_item">
						<div class="left">対応サイト数</div><div class="right green">∞</div>
					</div>
				</div> <!-- plan_box -->
			</div> <!-- problem_solving_li_inner -->
		</li>';
	break;
}
?>



<div class="progress_tracker">
	<div class="progress_tracker_inner">
		<div class="progress_tracker_point_start"> <img src="<?php echo HTTP; ?>assets/svg/common/check_w.svg"> </div>
		<div class="progress_tracker_bar"> </div>
		<div class="progress_tracker_point_end"> </div>
		<div class="progress_tracker_label">プランを選ぶ(<?php echo $select; ?>)</div>
		<div class="progress_tracker_label_current">情報送信</div>
	</div>
</div>

<div class="plan">
	<div class="plan_inner">
<?php 
// 魔境のやり方(ごめん、仕方なし
if ($_POST['submit'] != '修正する') {
?>
		<form method="post" action="slack/" class="contact_form">
			<h2>Slackで進める</h2>
			<input type="hidden" name="plan" value="<?php echo $select; ?>">
			<label for="email_1">メールアドレス</label>
			<input type="email" placeholder="e.g.) xxx@xxx.com" required="required" value="" name="email_1" id="email_1">
			<input type="submit" value="Slackの招待を送ってもらう" name="submit">
		</form>
		
		<div class="choose">
			<div class="choose_inner">
				<p class="choose_inner_text">or</p>
				<p class="choose_inner_border"></p>
			</div>
		</div>
<?php } ?>
		<form method="post" action="" class="contact_form">
			<h2>お問い合わせで進める</h2>
			<input type="hidden" name="plan" value="<?php echo $select; ?>">
			<label for="name">貴社名</label>
			<input type="text" placeholder="e.g.) 株式会社Spacenavi" value="<?php echo $_POST['company_name']; ?>"  name="company_name" id="company_name">
			<label for="name">担当者名</label>
			<input type="text" placeholder="e.g.) 山田太郎" value="<?php echo $_POST['name']; ?>" required="required" name="name" id="name">
			<label for="email_2">メールアドレス</label>
			<input type="email" placeholder="e.g.) xxx@xxx.com" required="required" value="<?php echo $_POST['email']; ?>" name="email_2" id="email_2">
			<label for="url">対象サイトのURL</label>
			<input type="text" placeholder="e.g.) https://uxseo.jp/" required="required" value="<?php echo $_POST['url']; ?>" name="url" id="url">
			<label for="text_area">お問い合わせ詳細</label>
			<textarea placeholder="お問い合わせ詳細を記入" name="summary" id="summary"><?php echo $_POST['summary']; ?></textarea>
			<input type="submit" value="確認" name="submit">
		</form>
	</div>
</div>


