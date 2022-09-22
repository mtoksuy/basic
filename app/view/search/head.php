	
	<head>
<?php if($get['context'] == 'products') {$context_word = 'プロダクト';}if($get['context'] == 'article') {$context_word = '記事';}?>
		<title><?php echo '「'.$get['q'].'」の'.$context_word.'一覧｜'.TITLE; ?></title>
		<!-- meta -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
		<!-- canonical -->
		<link rel="canonical" href="<?php echo HTTP.'search/?q='.$get['q'].'&context='.$get['context'].''; ?>">
		<!-- icon -->
		<link rel="shortcut icon" href="<?php echo HTTP;?>assets/img/icon/amatem_icon_1.ico" type="image/vnd.microsoft.icon">
		<link rel="apple-touch-icon" href="<?php echo HTTP;?>assets/img/icon/apple_touch_icon_1.png" />
		<link rel="apple-touch-icon-precomposed" href="<?php echo HTTP;?>assets/img/icon/apple_touch_icon_1.png" />
		<!-- css -->
		<link rel="stylesheet" href="<?php echo HTTP;?>assets/css/core.css" type="text/css">
		<link rel="stylesheet" href="<?php echo HTTP;?>assets/css/common/common.css" type="text/css">
		<link rel="stylesheet" href="<?php echo HTTP;?>assets/css/root/common.css" type="text/css">
		<link rel="stylesheet" href="<?php echo HTTP;?>assets/css/search/common.css" type="text/css">
		<link rel="stylesheet" href="<?php echo HTTP;?>assets/css/media/common.css" type="text/css">
		<link rel="stylesheet" href="<?php echo HTTP;?>assets/css/category/common.css" type="text/css">
		
		<?php  require_once(PATH.'view/basic/google_analytics.php'); /* google_analytics読み込み*/ ?>
	</head>
