<?php

/********************
 ** アナリティクス設定
 *********************/
// ローカル
if (preg_match('/localhost/', $_SERVER["HTTP_HOST"])) {
}
// 本番環境
else {
	echo '';
}
