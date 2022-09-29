<?php













/***********
DBコンフィグ
***********/
require_once(PATH.'classes/config/db.php');
/*******
モデルDB
*******/
require_once(PATH.'classes/model/db/basis.php');
$model_db = new model_db();

/**************
モデルDir
**************/
require_once(PATH.'classes/library/dir/basis.php');
$Library_Dir_Basis = new Library_Dir_Basis();

/**************
モデルsignup
**************/
require_once(PATH.'classes/model/signup/basis.php');
$model_signup_basis = new model_signup_basis();

/****************************
メールチェックライブラリ
****************************/
require_once(PATH.'classes/library/validateemail/basis.php');
$library_validateemail_basis = new library_validateemail_basis();


/****************************
UXSEO_Search_Analytics
****************************/
//require_once(PATH.'classes/model/uxseo_search_analytics/basis.php');
//$model_uxseo_search_analytics_basis = new model_uxseo_search_analytics_basis();
/************
モデルarticle
************/
require_once(PATH.'classes/model/article/basis.php');
require_once(PATH.'classes/model/article/html.php');
$model_article_basis = new model_article_basis();
$model_article_html = new model_article_html();
/********************
モデルmedia_post
*********************/
require_once(PATH.'classes/model/media/post/basis.php');
$model_media_post_basis = new model_media_post_basis();

/*********
モデルinfo
*********/
require_once(PATH.'classes/model/info/basis.php');
$model_info_basis = new model_info_basis();
/**********
モデルlogin
**********/
require_once(PATH.'classes/model/login/basis.php');
$model_login_basis = new model_login_basis();
/**************
モデルlogout
**************/
require_once(PATH.'classes/model/logout/basis.php');
$model_logout_basis = new model_logout_basis();
/*************
モデルsecurity
*************/
require_once(PATH.'classes/library/security/basis.php');
$library_security_basis = new library_security_basis();
/*****************
モデルanalytics
******************/
//require_once(PATH.'classes/model/analytics/basis.php');
//$model_analytics_basis = new model_analytics_basis();
//require_once(PATH.'classes/model/analytics/html.php');
//$model_analytics_html = new model_analytics_html();

/*********
モデルgzip
*********/
require_once(PATH.'classes/model/gzip/basis.php');
require_once(PATH.'classes/model/gzip/html.php');
$model_gzip_basis = new model_gzip_basis();
$model_gzip_html = new model_gzip_html();

/*********
モデルmail
*********/
require_once(PATH.'classes/model/mail/basis.php');
$model_mail_basis = new model_mail_basis();
/*************
モデルsecurity
*************/
require_once(PATH.'classes/library/security/basis.php');
$library_security_basis = new library_security_basis();
/*************
モデルsitemap
*************/
require_once(PATH.'classes/model/sitemap/basis.php');
require_once(PATH.'classes/model/sitemap/html.php');
$model_sitemap_basis = new model_sitemap_basis();
$model_sitemap_html = new model_sitemap_html();



/**************
モデルsummary
**************/
require_once(PATH.'classes/model/summary/basis.php');
require_once(PATH.'classes/model/summary/html.php');
$model_summary_basis = new model_summary_basis();
$model_summary_html = new model_summary_html();

/*********
モデルtrial
*********/
require_once(PATH.'classes/model/trial/basis.php');
require_once(PATH.'classes/model/trial/html.php');
$model_trial_basis = new model_trial_basis();
$model_trial_html = new model_trial_html();
/************
モデルupload
************/
require_once(PATH.'classes/model/upload/basis.php');
require_once(PATH.'classes/model/upload/html.php');
$model_upload_basis = new model_upload_basis();
$model_upload_html = new model_upload_html();

/*******************
モデルpicture_center
*******************/
require_once(PATH.'classes/model/picture_center/basis.php');
require_once(PATH.'classes/model/picture_center/html.php');
$model_picture_center_basis = new model_picture_center_basis();
$model_picture_center_html = new model_picture_center_html();

/************
モデルfolders
************/
require_once(PATH.'classes/model/folders/basis.php');
require_once(PATH.'classes/model/folders/html.php');
$model_folders_basis = new model_folders_basis();
$model_folders_html = new model_folders_html();

/**********
モデルtrash
**********/
require_once(PATH.'classes/model/trash/basis.php');
require_once(PATH.'classes/model/trash/html.php');
$model_trash_basis = new model_trash_basis();
$model_trash_html = new model_trash_html();


/************
モデルcharge
************/
require_once(PATH.'classes/model/pay/charge/basis.php');
require_once(PATH.'classes/model/pay/charge/html.php');
$model_pay_charge_basis = new model_pay_charge_basis();
$model_pay_charge_html = new model_pay_charge_html();

/************
モデルcoupon
************/
require_once(PATH.'classes/model/coupon/basis.php');
require_once(PATH.'classes/model/coupon/html.php');
$model_coupon_basis = new model_coupon_basis();
$model_coupon_html = new model_coupon_html();
/************
モデルurl_upload
************/
require_once(PATH.'classes/model/url_upload/basis.php');
require_once(PATH.'classes/model/url_upload/html.php');
$model_url_upload_basis = new model_url_upload_basis();
$model_url_upload_html = new model_url_upload_html();

/********
モデルftp
********/
require_once(PATH.'classes/model/ftp/basis.php');
require_once(PATH.'classes/model/ftp/html.php');
$model_ftp_basis = new model_ftp_basis();
$model_ftp_html = new model_ftp_html();


/************
モデルsettings
************/
require_once(PATH.'classes/model/settings/basis.php');
require_once(PATH.'classes/model/settings/html.php');
$model_settings_basis = new model_settings_basis();
$model_settings_html = new model_settings_html();


/************
モデルdirect
************/
require_once(PATH.'classes/model/direct/basis.php');
require_once(PATH.'classes/model/direct/html.php');
$model_direct_basis = new model_direct_basis();
$model_direct_html = new model_direct_html();

/**************
モデルcategory
**************/
require_once(PATH.'classes/model/category/basis.php');
require_once(PATH.'classes/model/category/html.php');
$model_category_basis = new model_category_basis();
$model_category_html = new model_category_html();

/**********************
モデルamazon_scraping
**********************/
require_once(PATH.'classes/model/login/amazon_scraping/basis.php');
require_once(PATH.'classes/model/login/amazon_scraping/html.php');
$model_login_amazon_scraping_basis = new model_login_amazon_scraping_basis();
$model_login_amazon_scraping_html = new model_login_amazon_scraping_html();

/*****************
モデルproduct_add
******************/
require_once(PATH.'classes/model/login/product_add/basis.php');
require_once(PATH.'classes/model/login/product_add/html.php');
$model_login_product_add_basis = new model_login_product_add_basis();
$model_login_product_add_html = new model_login_product_add_html();


/*****************
モデルmarkdown_post
******************/
require_once(PATH.'classes/model/login/markdown_post/basis.php');
require_once(PATH.'classes/model/login/markdown_post/html.php');
$model_login_markdown_post_basis = new model_login_markdown_post_basis();
$model_login_markdown_post_html = new model_login_markdown_post_html();


/*****************
モデルarticle_draft
******************/
require_once(PATH.'classes/model/login/article_draft/basis.php');
require_once(PATH.'classes/model/login/article_draft/html.php');
$model_login_article_draft_basis = new model_login_article_draft_basis();
$model_login_article_draft_html = new model_login_article_draft_html();


/**********
モデルdraft
***********/
require_once(PATH.'classes/model/login/draft/basis.php');
require_once(PATH.'classes/model/login/draft/html.php');
$model_login_draft_basis = new model_login_draft_basis();
$model_login_draft_html = new model_login_draft_html();


/********
モデルlist
********/
require_once(PATH.'classes/model/login/list/basis.php');
require_once(PATH.'classes/model/login/list/html.php');
$model_login_list_basis = new model_login_list_basis();
$model_login_list_html = new model_login_list_html();


/**********
モデルamazon_api
***********/
require_once(PATH.'classes/model/login/amazon_api/api.php');
require_once(PATH.'classes/model/login/amazon_api/basis.php');
require_once(PATH.'classes/model/login/amazon_api/html.php');
$model_login_amazon_api_basis = new model_login_amazon_api_basis();
$model_login_amazon_api_html = new model_login_amazon_api_html();


/**************
モデルproducts
**************/
require_once(PATH.'classes/model/products/basis.php');
require_once(PATH.'classes/model/products/html.php');
$model_products_basis = new model_products_basis();
$model_products_html = new model_products_html();

/**************
モデルproducts
**************/
require_once(PATH.'classes/model/search/basis.php');
require_once(PATH.'classes/model/search/html.php');
$model_search_basis = new model_search_basis();
$model_search_html = new model_search_html();

/**************
モデルad
**************/
require_once(PATH.'classes/model/ad/basis.php');
require_once(PATH.'classes/model/ad/html.php');
$model_ad_basis = new model_ad_basis();
$model_ad_html = new model_ad_html();



/****************
モデルprofile_edit
****************/
require_once(PATH.'classes/model/login/profile_edit/basis.php');
require_once(PATH.'classes/model/login/profile_edit/html.php');
$model_login_profile_edit_basis = new model_login_profile_edit_basis();
$model_login_profile_edit_html = new model_login_profile_edit_html();
