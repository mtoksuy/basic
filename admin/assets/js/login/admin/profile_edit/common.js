

	/************************
	
	************************/
	$('.account_form').on('change', '#user_icon', function(event) {
		var formdata = new FormData($('.account_form').get(0));
//		p(formdata);

		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/profile_edit/edit.php',
			type : "POST",
			data : formdata,
			cache       : false,
			contentType : false,
			processData : false,
//			dataType    : "html", // jsonではなくhtmlらしい
			dataType    : "json", // あれ？ひとまずこれで
		// 成功
		}).done(function(data) {
			// すぐに書き換え
			$('.now_user_icon').attr('src', http+'assets/img/user_icon/'+data['icon_path']+'?timestamp='+data['timestamp']);
		// 失敗
		}).fail(function(jqXHR, textStatus, errorThrown) {

		});
	});




/*
$('#file').change(function(){
 // ・・・
 $(this).val('');
});
*/