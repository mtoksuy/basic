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
				$('.next').attr('file_id', data['file_modal_data_array']['next_file_id']);
				$('.prev').attr('file_id', data['file_modal_data_array']['prev_file_id']);
				$('.image_box img').attr('src', data['file_modal_data_array']['img_src']);
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
				$('.next').attr('file_id', data['file_modal_data_array']['next_file_id']);
				$('.prev').attr('file_id', data['file_modal_data_array']['prev_file_id']);
				$('.image_box img').attr('src', data['file_modal_data_array']['img_src']);
			},
			complete: function (data) {
			
			}
		});
	});





