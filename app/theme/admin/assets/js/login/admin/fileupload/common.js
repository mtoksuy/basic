
// ドラッグ&ドロップエリアの取得
var fileArea = document.getElementById('dropArea');
// input[type=file]の取得
var fileInput = document.getElementById('uploadFile');

// ドラッグオーバー時の処理
fileInput.addEventListener('dragover', function(e) {
//	$('#upload_form').html('<input type="file" name="uploadFile[]" id="uploadFile" accept="" multiple="multiple" webkitdirectory="" directory="">');
/*
	$('#upload_form #uploadFile').attr(
		{
			'directory': '',
		}
	);
*/









});

// ドラッグアウト時の処理
fileArea.addEventListener('dragleave', function(e) {



});

// ドロップ時の処理
fileInput.addEventListener('drop', function(e) {
//	$('#upload_form').html('<input type="file" name="uploadFile[]" id="uploadFile" accept="" multiple="multiple" webkitdirectory="" directory="">');
/*
	$('#upload_form #uploadFile').attr(
		{
			'directory': '',
		}
	);
*/

});

// input[type=file]に変更があれば実行
// もちろんドロップ以外でも発火します
fileInput.addEventListener('change', function(e) {

}, false);

$('body').on('change', '#uploadFile' , function(e) {
//	p('change');
	var file = e.target.files[0];
	// ファイルが正常に受け取れた際の処理
	if(typeof e.target.files[0] !== 'undefined') {
		// ローディング表示
		$('.loding').html('<span class="timer-loader"></span>');
		var upload_form = $('#upload_form').get()[0];
		// FormData オブジェクトを作成
		var formdata = new FormData($('#upload_form').get(0));
		// Ajaxで送信
		$.ajax({
			url: '../../../ajax/login/admin/fileupload/',
			type : "POST",
			data : formdata,
			cache       : false,
			contentType : false,
			processData : false,
//			dataType    : "html", // jsonではなくhtmlらしい
			dataType    : "json", // あれ？ひとまずこれで
		// 成功
		}).done(function(data) {
			// アップロードファイル表示
			$('#upFileWrap').after(data['ajax_fileupload_html']);
		// 失敗
		}).fail(function(jqXHR, textStatus, errorThrown) {
			// ローディング削除
			$('.loding').html('<span style="color: red;">エラー</span>');
			console.log( 'ERROR', jqXHR, textStatus, errorThrown);
		});
	}
		else {

		}
});

/***************************************************************/

// 動的でも動く書き方
$('body').on('click', '.url_copy_btn' , function() {
/*
	p($(this).prev('.hidden_url'));
	p($(this).prevAll('.hidden_url'));
	p($(this).prevAll('.hidden_url').html());
*/
	$(this).after('<textarea class="hidden_url_textarea">'+$(this).prevAll('.hidden_url').html()+'</textarea>');
	$('.hidden_url_textarea').select();
//	p($('.hidden_url_textarea'));
	document.execCommand("Copy");
	$('.hidden_url_textarea').remove();
	window.getSelection().removeAllRanges();
	$(this).nextAll('.torst').html('HTMLをコピーしました。');
	//一秒後に実行
	setTimeout(function() {
		$('.torst').html('　');
	},1000);
});
