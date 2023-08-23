	/*******************
	ファイルモーダル表示
	*******************/
	$('.filelist').on( {
		'click': function() {
			file_id = $(this).attr('file_id');
			// Ajaxで送信
			$.ajax({
				url: '../../../ajax/login/admin/filelist/',
				type : "POST",
				data : {
				file_id: file_id,
				},
				success: function(data) {
					$('.summary_box').append(data['file_modal_html']);
				},
				complete: function (data) {
				
				}
			});
			return false;
		}
	}, '.img');
	/*******************
	ファイルモーダル削除
	*******************/
$('body').on('click', '.file_modal_inner_top .delete', function() {
	$('.file_modal').remove();
	$('.file_modal_overlay').remove();
});
	/*******************
	ファイルモーダル削除
	*******************/
$('body').on('click', '.file_modal_overlay', function() {
	$('.file_modal').remove();
	$('.file_modal_overlay').remove();
});
	/*******************
	ファイルモーダルnext
	*******************/
	$('body').on('click', '.file_modal_inner_top .next', function() {
		file_id = $(this).attr('file_id');
		// Ajaxで送信
		$.ajax({
			url: '../../../ajax/login/admin/filelist/',
			type : "POST",
			data : {
			file_id: file_id,
			is_type: 'next',
			},
			success: function(data) {
				$('.file_data .full_name .data').html(data['file_modal_data_array']['full_name']);
				$('.file_data .byte .data').html(data['file_modal_data_array']['byte']);
				$('.file_data .size .data').html(data['file_modal_data_array']['size']);
				$('.file_data .type .data').html(data['file_modal_data_array']['type']);
				$('.file_data .create_time .data').html(data['file_modal_data_array']['create_time']);
				$('.file_data .hidden_url').html(data['file_modal_data_array']['img_src']);
				$('.next').attr('file_id', data['file_modal_data_array']['next_file_id']);
				$('.prev').attr('file_id', data['file_modal_data_array']['prev_file_id']);
				$('.image_box').html( data['file_modal_data_array']['image_box_html']);
				$('.image_box img').attr('class', data['file_modal_data_array']['img_class']);
			},
			complete: function (data) {
			
			}
		});
	});
	/*******************
	ファイルモーダルprev
	*******************/
	$('body').on('click', '.file_modal_inner_top .prev', function() {
		file_id = $(this).attr('file_id');
		// Ajaxで送信
		$.ajax({
			url: '../../../ajax/login/admin/filelist/',
			type : "POST",
			data : {
			file_id: file_id,
			is_type: 'next',
			},
			success: function(data) {
				$('.file_data .full_name .data').html(data['file_modal_data_array']['full_name']);
				$('.file_data .byte .data').html(data['file_modal_data_array']['byte']);
				$('.file_data .size .data').html(data['file_modal_data_array']['size']);
				$('.file_data .type .data').html(data['file_modal_data_array']['type']);
				$('.file_data .create_time .data').html(data['file_modal_data_array']['create_time']);
				$('.file_data .hidden_url').html(data['file_modal_data_array']['img_src']);
				$('.next').attr('file_id', data['file_modal_data_array']['next_file_id']);
				$('.prev').attr('file_id', data['file_modal_data_array']['prev_file_id']);
				$('.image_box').html( data['file_modal_data_array']['image_box_html']);
				$('.image_box img').attr('class', data['file_modal_data_array']['img_class']);
			},
			complete: function (data) {
			
			}
		});
	});
	/****************************
	URLをクリップボードにコピー
	****************************/
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



	/***********************************
	←→押された時 ファイルモーダル更新
	***********************************/
	$('html').on('keydown', 'body' , function(e) {
		var keyCode = false; 
		if (e) event = e;
			if (event) {
				if (event.keyCode) {
					keyCode = event.keyCode;
			} else if (event.which) {
				keyCode = event.which;
			}
		}

		if(keyCode === 37) {
			file_id = $('.next').attr('file_id');
		}
		else if( keyCode === 39) {
			file_id = $('.prev').attr('file_id');
		}
		if(keyCode === 37 || keyCode === 39) {
		// Ajaxで送信
		$.ajax({
			url: '../../../ajax/login/admin/filelist/',
			type : "POST",
			data : {
			file_id: file_id,
			is_type: 'next',
			},
			success: function(data) {
				$('.file_data .full_name .data').html(data['file_modal_data_array']['full_name']);
				$('.file_data .byte .data').html(data['file_modal_data_array']['byte']);
				$('.file_data .size .data').html(data['file_modal_data_array']['size']);
				$('.file_data .type .data').html(data['file_modal_data_array']['type']);
				$('.file_data .create_time .data').html(data['file_modal_data_array']['create_time']);
				$('.file_data .hidden_url').html(data['file_modal_data_array']['img_src']);
				$('.next').attr('file_id', data['file_modal_data_array']['next_file_id']);
				$('.prev').attr('file_id', data['file_modal_data_array']['prev_file_id']);
				$('.image_box').html( data['file_modal_data_array']['image_box_html']);
				$('.image_box img').attr('class', data['file_modal_data_array']['img_class']);
			},
			complete: function (data) {
			
			}
		});
		}
	});




