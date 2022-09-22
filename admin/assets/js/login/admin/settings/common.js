	//-----------------
	// クリックで登録
	//-----------------
    $('.domain_restriction').on('click', '.domain_restriction_inner_add_submit' , function(event) {
		if(!$('.domain_restriction_inner_input').val().match('http')) {
			 $('.domain_restriction_inner_add_submit_notice').html('正しいURLを入力して下さい。');
		    window.setTimeout(function(){
		 		$('.domain_restriction_inner_add_submit_notice').html('');
		    }, 3000);
			return false;
		}
		domain_restriction_val = $('.domain_restriction_inner_input').val();
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/settings/domain_restriction_submit.php',
			type : "POST",
			data : {
				domain_restriction_val : domain_restriction_val,
			},
		     success: function(data) {
			 	p(data);
			 	if(data['domain_check'] == true) {
			 		$('.domain_restriction_inner_add_submit_notice').html('既に登録済みのドメインです。');
				    window.setTimeout(function(){
				 		$('.domain_restriction_inner_add_submit_notice').html('');
				    }, 3000);
				} // if(data['domain_check'] == true) {
					else {
						window.location.href = http+"login/admin/settings/";
					}
		     },
		    complete: function (data) {

		     }
		});
	});
	//-----------------
	// エンターで登録
	//-----------------
    $('.domain_restriction').on('keypress', '.domain_restriction_inner_input' , function(event) {
		if(event.which == 13) {
			if(!$('.domain_restriction_inner_input').val().match('http')) {
				 $('.domain_restriction_inner_add_submit_notice').html('正しいURLを入力して下さい。');
			    window.setTimeout(function(){
			 		$('.domain_restriction_inner_add_submit_notice').html('');
			    }, 3000);
				return false;
			}
			domain_restriction_val = $('.domain_restriction_inner_input').val();
			// Ajaxで送信
			$.ajax({
				url: http+'ajax/login/admin/settings/domain_restriction_submit.php',
				type : "POST",
				data : {
					domain_restriction_val : domain_restriction_val,
				},
			     success: function(data) {
				 	if(data['domain_check'] == true) {
				 		$('.domain_restriction_inner_add_submit_notice').html('既に登録済みのドメインです。');
					    window.setTimeout(function(){
					 		$('.domain_restriction_inner_add_submit_notice').html('');
					    }, 3000);
					} // if(data['domain_check'] == true) {
						else {
							window.location.href = http+"login/admin/settings/";
						}
			     },
			    complete: function (data) {
	
			     }
			}); // ajax
		}
	});
	//-----------------
	// ゴミ箱クリック
	//-----------------
    $('.domain_restriction').on('click', '.domain_restriction_inner_data_list_delete' , function(event) {
		$(this).css( {
			'visibility' : 'hidden',
		});
		$(this).nextAll('.domain_restriction_notice').css( {
			'visibility' : 'visible',
		});
	});
	//------------------------------
	// ゴミ箱- キャンセルクリック
	//------------------------------
    $('.domain_restriction').on('click', '.domain_restriction_notice_cancel' , function(event) {
		$(this).parents('li').find('.domain_restriction_inner_data_list_delete').css( {
			'visibility' : 'visible',
		});
		$(this).parents('.domain_restriction_notice').css( {
			'visibility' : 'hidden',
		});
	});
	//----------------------------
	// ゴミ箱- 削除するクリック
	//----------------------------
    $('.domain_restriction').on('click', '.domain_restriction_notice_delete' , function(event) {
		domain = $(this).parents('li').find('.domain_restriction_inner_data_list_domain').html();
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/settings/domain_restriction_delete.php',
			type : "POST",
			data : {
				domain : domain,
			},
		     success: function(data) {
				window.location.href = http+"login/admin/settings/";
		     },
		    complete: function (data) {

		     }
		});
	});






