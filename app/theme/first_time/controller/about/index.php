<?php
$method = preg_replace('/page\//', '', $controller_query);
//  ページデータ取得
$page_res = model_page_basis::page_get($method);
// ページのHTML生成
$page_data_array = model_page_html::page_html_create($page_res);
// 記事タイトル挿入
$page_data_array['title'] = $page_res[0]['title'];

// テンプレート読み込み
require_once(PATH . 'app/theme/' . $site_data_array['theme'] . '/view/page/template.php');
