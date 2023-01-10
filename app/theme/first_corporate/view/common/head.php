
<head>
	<title><?php echo $site_data_array['title']; ?></title>
	<!-- meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<!-- canonical -->
	<link rel="canonical" href="<?php echo HTTP.$controller_query; ?>/">
	<!-- icon -->
	<link rel="shortcut icon" href="<?php echo HTTP;?>app/assets/img/icon/<?php echo $site_data_array['icon']; ?>" type="image/vnd.microsoft.icon">
	<link rel="apple-touch-icon" href="<?php echo HTTP;?>app/assets/img/icon/<?php echo $site_data_array['apple_touch_icon']; ?>" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo HTTP;?>app/assets/img/icon/<?php echo $site_data_array['apple_touch_icon_precomposed']; ?>" />
	<!-- css -->
	<link rel="stylesheet" href="<?php echo HTTP;?>app/assets/css/core.css" type="text/css">
	<link rel="stylesheet" href="<?php echo HTTP;?>app/theme/<?php echo $site_data_array['theme']; ?>/assets/css/common/common.css" type="text/css">
	<link rel="stylesheet" href="<?php echo HTTP;?>app/theme/<?php echo $site_data_array['theme']; ?>/assets/css/<?php echo $controller_query; ?>/common.css" type="text/css">
	<?php  require_once(PATH.'app/theme/'.$site_data_array['theme'].'/view/common/google_analytics.php'); /* google_analytics読み込み*/ ?>
</head>
