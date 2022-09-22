	//-----------------
	// チャージボタン
	//-----------------
    $('.content_block_flex').on('keyup', '#before' , function(event) {
		// 初期化
		$('.before_after_notice').html('');
		$('.before_after_error_notice').html('');

		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/direct/html_conversion_tool/html_conversion_tool_action.php',
			type : "POST",
			data : {
				html : $('#before').val(),
			},
		     success: function(data) {
			 	$('#after').val(data['html']);
			 	$('.before_after_notice').html('成功');
			 	if(data['error_word']) {
				 	$('.before_after_notice').html('失敗');
				 	$('.before_after_error_notice').html(data['error_word']);
				}
		     },
		    complete: function (data) {

		     },
		    error: function (data) {
			 	$('.before_after_notice').html('失敗');
			 	$('.before_after_error_notice').html(data['error_word']);
		     }

		});
	});
