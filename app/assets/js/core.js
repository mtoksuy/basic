/*************************
デバッグ変数コンストラクタ
*************************/
var p        = console.log;
var print    = console.log;
var var_dump = console.dir;
var trace    = console.trace;
var time     = console.time;
var count    = console.count;
/***********
http切り替え
***********/
if (location.host == 'localhost') {
	var http = 'http://localhost/amatem/';
}
	else if (location.host == 'amatem.jp') {
		var http = 'https://amatem.jp/';
	}
		else if (location.host == 'www.amatem.jp') {
			var http = 'https://amatem.jp/';
		}
