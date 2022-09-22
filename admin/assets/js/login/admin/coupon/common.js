	//--------------------------------------
	// 
	//--------------------------------------
    $('.coupon_inner_box').on('click', '.coupon_submit_box_use' , function(event) {
		coupon_id = $('.coupon_submit_input').val();
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/coupon/coupon_use.php',
			type : "POST",
			data : {
				coupon_id: coupon_id,
			},
		     success: function(data) {
				window.location.href = http+"login/admin/";
		     },
		    complete: function (data) {

		     }
		});
    });
