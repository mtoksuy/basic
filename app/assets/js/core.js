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
	var http = 'http://localhost/xxx/';
}
	else if (location.host == 'xxx.com') {
		var http = 'https://xxx.com/';
	}
		else if (location.host == 'www.xxx.com') {
			var http = 'https://xxx.com/';
		}
