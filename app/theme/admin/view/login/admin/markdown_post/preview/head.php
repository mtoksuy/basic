
<head>
	<title><?php echo $article_data_array['article_title']; ?></title>
	<!-- meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta property="og:url" content="<?php echo HTTP; ?>article/<?php echo $method; ?>/" />
	<meta property="og:title" content="<?php echo $article_data_array['article_title']; ?>" />
	<meta property="og:image" content="<?php echo HTTP;?>assets/img/article_ogp/<?php echo $method; ?>.png" />
	<!-- author -->
	<meta name="author" content="<?php echo $amatem_id_data_array['name']; ?>">
	<!-- canonical -->
	<link rel="canonical" href="<?php echo HTTP; ?>article/<?php echo $method; ?>/">
	<!-- 記事JSON-LDリッチリザルト -->
	<?php echo $article_json_ld_rich_lizarto; ?>
	<!-- icon -->
	<link rel="shortcut icon" href="<?php echo HTTP;?>assets/img/icon/amatem_icon_1.ico" type="image/vnd.microsoft.icon">
	<link rel="apple-touch-icon" href="<?php echo HTTP;?>assets/img/icon/apple_touch_icon_1.png" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo HTTP;?>assets/img/icon/apple_touch_icon_1.png" />
	<!-- css -->
	<link rel="stylesheet" href="<?php echo HTTP;?>assets/css/core.css" type="text/css">
	<link rel="stylesheet" href="<?php echo HTTP;?>assets/css/common/common.css" type="text/css">
	<link rel="stylesheet" href="<?php echo HTTP;?>assets/css/media/common.css" type="text/css">
	<link rel="stylesheet" href="<?php echo HTTP;?>assets/css/media/article/common.css" type="text/css">
	<link rel="stylesheet" href="https://resizecdn.com/assets/css/library/highlight-10.7.1.min.css" type="text/css">

	<?php //require_once(PATH.'view/basic/google_analytics.php'); /* google_analytics読み込み*/ ?>
</head>



