
<head>
	<title><?php echo 'ファイル一覧｜アドミン｜ログイン'.'｜'.TITLE; ?></title>
	<!-- meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
	<!-- canonical -->
	<link rel="canonical" href="<?php echo HTTP.$controller_query; ?>/">
	<!-- icon -->
	<link rel="icon" href="<?php echo HTTP;?>app/theme/admin/assets/img/icon/basic_icon_1.svg">
	<link rel="apple-touch-icon" href="<?php echo HTTP;?>app/theme/admin/assets/img/icon/apple_touch_icon_1.png">
	<!-- css -->
	<link rel="stylesheet" href="<?php echo HTTP;?>app/assets/css/core.css" type="text/css">
	<link rel="stylesheet" href="<?php echo HTTP;?>app/theme/admin/assets/css/common/common.css" type="text/css">
	<link rel="stylesheet" href="<?php echo HTTP;?>app/theme/admin/assets/css/login/admin/common.css" type="text/css">
	<?php /*admin_theme_color設定*/ if(!($site_data_array['admin_theme_color'] === 'default')) { echo '<link rel="stylesheet" href="'.HTTP.'app/theme/admin/assets/css/admin_theme_color/'.$site_data_array['admin_theme_color'].'.css" type="text/css">'; } ?>
	<link rel="stylesheet" href="<?php echo HTTP;?>app/theme/admin/assets/css/login/admin/filelist/common.css" type="text/css">
</head>
