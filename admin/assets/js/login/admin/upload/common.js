

// ドラッグ&ドロップエリアの取得
var fileArea = document.getElementById('dropArea');
// input[type=file]の取得
var fileInput = document.getElementById('uploadFile');

// ドラッグオーバー時の処理
fileArea.addEventListener('dragover', function(e) {
	e.preventDefault();
	fileArea.classList.add('dragover');
});

// ドラッグアウト時の処理
fileArea.addEventListener('dragleave', function(e) {
	e.preventDefault();
	fileArea.classList.remove('dragover');
});

// ドロップ時の処理
fileArea.addEventListener('drop', function(e) {
	e.preventDefault();
	fileArea.classList.remove('dragover');
	// ドロップしたファイルの取得
	var files = e.dataTransfer.files;
	// 取得したファイルをinput[type=file]へ
	fileInput.files = files;

	//ファイルが正常に受け取れた際の処理
	if(typeof files[0] !== 'undefined') {
	}

		//ファイルが受け取れなかった際の処理
		else {
		
		}
});

// input[type=file]に変更があれば実行
// もちろんドロップ以外でも発火します
fileInput.addEventListener('change', function(e) {
	var file = e.target.files[0];
	// ファイルが正常に受け取れた際の処理
	if(typeof e.target.files[0] !== 'undefined') {
		// ローディング表示
		$('.loding').html('<span class="timer-loader"></span>');
		var upload_form = $('#upload_form').get()[0];
		// FormData オブジェクトを作成
//		var formData = new FormData(upload_form);
		var formdata = new FormData($('#upload_form').get(0));
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/upload/upload.php',
			type : "POST",
			data : formdata,
			cache       : false,
			contentType : false,
			processData : false,
//			dataType    : "html", // jsonではなくhtmlらしい
			dataType    : "json", // あれ？ひとまずこれで
		// 成功
		}).done(function(data) {
//			p(data);
			// ローディング削除
			$('.loding').html('<p class="text">圧縮・CDN化された画像枚数：<b>'+data['image_num']+'枚</b></p><p class="text">圧縮したデータ容量：<b>'+data['diff_size']+'</b></p><p class="text">圧縮したデータ%：<b>'+data['diff_ratio']+'</b></p><p class="text">---------------------</p><p class="text">圧縮前データ容量：<b>'+data['before_size']+'</b></p><p class="text">↓↓↓↓↓</p><p class="text">圧縮後データ容量：<b>'+data['after_size']+'</b></p>');

			// CDN化された画像表示
			$('.upload_cdn_view').html('<h2>圧縮・CDN化された画像表示</h2>'+data['cdn_html']);
			// コピペ用HTML表示
			$('.upload_inner_html_create').val(data['cdn_html']);
			var pattern = /folders/;
			var result = location.href.match(pattern);
			// フォルダ階層の場合
			if(result) {
				// Ajaxで送信
				$.ajax({
					url: http+'ajax/login/admin/folders/folder_list_data_get.php',
					type : "POST",
					data : {
						'folder_id' : data['folder_id'], 
					},
				     success: function(data) {
					 	$('.picture').remove();
					 	$('.picture_center_inner_box').prepend(data['folders_html']);
				     },
				    complete: function (data) {
		
				     }
				});




























			}
		// 失敗
		}).fail(function(jqXHR, textStatus, errorThrown) {
			// ローディング削除
			$('.loding').html('<span style="color: red;">エラー</span>');
			console.log( 'ERROR', jqXHR, textStatus, errorThrown);
		});
	}
		else {

		}
}, false);

/***************************************************************/

  /// コピーテキストボタンを実装
  $('.cdn_html_copy_btn').on('click',function() {
    /// テキスト要素を選択＆クリップボードにコピー
    var textElem = $('.upload_inner_html_create').val();
	  // コピーするテキストを選択
	  $(".upload_inner_html_create").select();
	  // 選択したテキストをクリップボードにコピーする
	  document.execCommand("Copy");
	  window.getSelection().removeAllRanges();
	  $('.torst').html('HTMLをコピーしました。');
	//一秒後に実行
	setTimeout(function() {
	  $('.torst').html('　');
	},1000);


      });










