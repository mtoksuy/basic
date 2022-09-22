	//-----------------
	// チャージボタン
	//-----------------
    $('.charge_inner_box').on('click', '.action_charge' , function(event) {
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/pay/charge/credit_card_check.php',
			type : "POST",
			data : {

			},
		     success: function(data) {
			 	if(data['credit_card_check']) {
			 		$('.charge_submit_box').css( {
			 			'visibility': 'visible', 
					});
			 		$('.first button').css( {
			 			'visibility': 'hidden', 
					});
			 		$('.first .charge_notice').css( {
			 			'visibility': 'hidden', 
					});
				}
					else {
						$('.charge_notice').html('クレジットカードを登録して下さい。');
					}
		     },
		    complete: function (data) {

		     }
		});
	});
	//--------------------------
	// クレジットカードボタン
	//--------------------------
    $('.charge_inner_box').on('click', '.action_credit_card_add' , function(event) {
		$('#payment-form').css( {
			'display' : 'block', 
			'visibility': 'visible',
		});
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/pay/charge/credit_card_check.php',
			type : "POST",
			data : {

			},
		     success: function(data) {
			 	if(data['credit_card_check']) {

				}
					else {
						$('.pay_type_switch_notice').html('クレジットカードを登録して下さい。');
					}
		     },
		    complete: function (data) {

		     }
		});
	});
	//----------------------------------------------
	// クレジットカードボタン キャンセルボタン
	//----------------------------------------------
    $('.charge_inner_box').on('click', '.form-row_button_chancel' , function(event) {
		$('#payment-form').css( {
			'display' : 'none', 
			'visibility': 'hidden',
		});
	});
	//------------------------------
	// クレジットカードごみボタン
	//------------------------------
    $('.charge_inner_box').on('click', '.action_credit_card_delete' , function(event) {
		$('.credit_card_notice').css( {
			'visibility': 'visible',
		});
	});
	//-------------------------------------------
	// クレジットカードごみボタン キャンセル
	//-------------------------------------------
    $('.charge_inner_box').on('click', '.credit_card_notice_cancel' , function(event) {
		$('.credit_card_notice').css( {
			'visibility': 'hidden',
		});
	});
	//-----------------------------------------
	// クレジットカードごみボタン 削除する
	//-----------------------------------------
    $('.charge_inner_box').on('click', '.credit_card_notice_delete' , function(event) {
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/pay/charge/credit_card_notice_delete.php',
			type : "POST",
			data : {

			},
		     success: function(data) {
				window.location.href = http+"login/admin/pay/charge/";
		     },
		    complete: function (data) {

		     }
		});
	});
	//------------------------------------
	// クレジットカード 決済キャンセル
	//------------------------------------
    $('.charge_inner_box').on('click', '.charge_submit_box_notice_cancel' , function(event) {
		if($('.charge_submit_box_notice_cancel svg').attr('svg_check') === "true") {

		}
			else {
				$('.charge_submit_box').css( {
					'visibility': 'hidden', 
				});
				$('.first button').css( {
					'visibility': 'visible', 
				});
				$('.first .charge_notice').css( {
					'visibility': 'visible', 
				});
			}
	});
	//-------------------------
	// クレジットカード 決済
	//-------------------------
	credit_card_charge_payment_check = 0;
    $('.charge_inner_box').on('click', '.charge_submit_box_notice_payment' , function(event) {
		if(credit_card_charge_payment_check == 0) {
			$('.charge_submit_box_notice_cancel').html( '<svg style="margin: auto; background-color: rgba(255, 255, 255, 0.00784314); display: block; shape-rendering: auto; background-position: initial initial; background-repeat: initial initial;" width="48px" height="48px" viewBox="0 0 100 100" svg_check="true"><circle cx="50" cy="50" r="0" fill="none" stroke="#1ebc4d" stroke-width="2"><animate attributeName="r" repeatCount="indefinite" dur="1.25s" values="0;40" keyTimes="0;1" keySplines="0 0.2 0.8 1" calcMode="spline" begin="-0.625s"></animate><animate attributeName="opacity" repeatCount="indefinite" dur="1.25s" values="1;0" keyTimes="0;1" keySplines="0.2 0 0.8 1" calcMode="spline" begin="-0.625s"></animate></circle><circle cx="50" cy="50" r="0" fill="none" stroke="#e63870" stroke-width="2"><animate attributeName="r" repeatCount="indefinite" dur="1.25s" values="0;40" keyTimes="0;1" keySplines="0 0.2 0.8 1" calcMode="spline"></animate><animate attributeName="opacity" repeatCount="indefinite" dur="1.25s" values="1;0" keyTimes="0;1" keySplines="0.2 0 0.8 1" calcMode="spline"></animate></circle></svg>');

			credit_card_charge_payment_check = 1;
			charge_amount = $('.charge_submit_box_input').val();
			// Ajaxで送信
			$.ajax({
				url: http+'ajax/login/admin/pay/charge/credit_card_charge_payment.php',
				type : "POST",
				data : {
					'charge_amount': charge_amount,
				},
			     success: function(data) {
				 	if(data['success_check'] === 'success') {
						window.location.href = http+"login/admin/pay/charge/";
					}
			     },
			    complete: function (data) {
	
			     }
			});
		} // if(credit_card_charge_payment_check == 0) {
	});
	//--------------------------
	// ユーザー支払い方法変更
	//--------------------------
	now_now_check = 0;
	credit_card_check = 0;
    $('.charge_inner_box').on('click', '.action_pay_type_switch_on' , function(event) {
		now_check = $(this).attr('class').match('now');

		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/pay/charge/credit_card_check.php',
			type : "POST",
			data : {

			},
		     success: function(data) {
			 	if(data['credit_card_check']) {
			 		credit_card_check = 1;
				}
					else {
						$('.pay_type_switch_notice').html('クレジットカードを登録して下さい。');
					}
		     },
		    complete: function (data) {
				if(now_now_check == 0 && credit_card_check == 1) {
					if(now_check) {
			
					}
						else {
							now_now_check = 1;
							// Ajaxで送信
							$.ajax({
								url: http+'ajax/login/admin/pay/charge/action_pay_type_switch.php',
								type : "POST",
								data : {
					
								},
							     success: function(data) {
									window.location.href = http+"login/admin/pay/charge/";
							     },
							    complete: function (data) {
						
							     }
							});
						}
				} // if(now_now_check == 0 && credit_card_check == 1) {
		     } // complete: function (data) {
		});
	});
	//--------------------------
	// ユーザー支払い方法変更
	//--------------------------
	now_now_check = 0;
    $('.charge_inner_box').on('click', '.action_pay_type_switch_off' , function(event) {
		if(now_now_check == 0) {
			now_check = $(this).attr('class').match('now');
			if(now_check) {
	
			}
				else {
						now_now_check = 1;
					// Ajaxで送信
					$.ajax({
						url: http+'ajax/login/admin/pay/charge/action_pay_type_switch.php',
						type : "POST",
						data : {
			
						},
					     success: function(data) {
							window.location.href = http+"login/admin/pay/charge/";
					     },
					    complete: function (data) {
				
					     }
					});
				}
		}
	});



