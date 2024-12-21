<head>
	<title><?php echo $page_data_array['title'] . '｜' . $site_data_array['title']; ?></title>
	<!-- meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta property="og:url" content="<?php echo HTTP . $controller_query; ?>/" />
	<meta property="og:title" content="<?php echo $page_data_array['title'] . '｜' . $site_data_array['title']; ?>" />
	<meta property="og:image" content="<?php echo HTTP; ?>app/assets/img/article_ogp/<?php echo $method; ?>.png" />
	<!-- canonical -->
	<link rel="canonical" href="<?php echo HTTP . $controller_query; ?>/" />
<?php 
/* 初期記事のみnoindexにする  */
if((int)$method === 1 || (int)$method === 2 || (int)$method === 3) { echo '	<!-- noindex -->
	<meta name="robots" content="noindex">
';} ?>
	<!-- 記事JSON-LDリッチリザルト -->
	<?php echo $article_json_ld_rich_lizarto; ?>
	<!-- icon -->
	<link rel="icon" href="<?php echo HTTP; ?>app/assets/img/icon/<?php echo $site_data_array['icon']; ?>">
	<link rel="apple-touch-icon" href="<?php echo HTTP; ?>app/assets/img/icon/<?php echo $site_data_array['apple_touch_icon']; ?>">
	<!-- css -->
	<link rel="stylesheet" href="<?php echo HTTP; ?>app/assets/css/core.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo HTTP; ?>app/theme/<?php echo $site_data_array['theme']; ?>/assets/css/common/common.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo HTTP; ?>app/theme/<?php echo $site_data_array['theme']; ?>/assets/css/article/common.css" type="text/css" />
	<?php require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/view/common/google_analytics.php'); /* google_analytics読み込み*/ ?>
</head>