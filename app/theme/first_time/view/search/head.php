
<head>
	<title><?php echo $page_data_array['title'].TITLE; ?></title>
	<!-- meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<!-- canonical -->
	<link rel="canonical" href="<?php echo HTTP.$controller_query; ?>/">
	<!-- icon -->
	<link rel="shortcut icon" href="<?php echo HTTP;?>app/theme/<?php echo $site_data_array['theme']; ?>/assets/img/icon/<?php echo $site_data_array['icon']; ?>" type="image/vnd.microsoft.icon">
	<link rel="apple-touch-icon" href="<?php echo HTTP;?>app/theme/<?php echo $site_data_array['theme']; ?>/assets/img/icon/<?php echo $site_data_array['apple_touch_icon']; ?>" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo HTTP;?>app/theme/<?php echo $site_data_array['theme']; ?>/assets/img/icon/<?php echo $site_data_array['apple_touch_icon_precomposed']; ?>" />
	<!-- css -->
	<link rel="stylesheet" href="<?php echo HTTP;?>app/assets/css/core.css" type="text/css">
	<link rel="stylesheet" href="<?php echo HTTP;?>app/theme/<?php echo $site_data_array['theme']; ?>/assets/css/root/common.css" type="text/css">
	<link rel="stylesheet" href="<?php echo HTTP;?>app/theme/<?php echo $site_data_array['theme']; ?>/assets/css/common/common.css" type="text/css">
</head>
