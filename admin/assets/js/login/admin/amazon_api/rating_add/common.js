
	//----------
	// 評価登録
	//----------
    $('.product_li').on('click', '.submit' , function(event) {
		p($(this));
		submit_this = $(this);
		primary_id = $(this).attr('data-primary_id');
		review         = $(this).prev().val();
		rating        = $(this).prev().prev().val();
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/amazon_api/rating_add.php',
			type : "POST",
			data : {
				'primary_id': primary_id,
				'rating': rating,
				'review': review,
			},
		     success: function(data) {
			 	submit_this.parents('.product_li').remove();
		     },
		    complete: function (data) {

		     }
		});
    });
	//---------------
	// ゼロ評価登録
	//---------------
    $('.product_li').on('click', '.zero_submit' , function(event) {
		p($(this));
		submit_this = $(this);
		primary_id = $(this).attr('data-primary_id');
		review         = $(this).prev().val();
		rating        = $(this).prev().prev().val();
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/amazon_api/rating_add.php',
			type : "POST",
			data : {
				'primary_id': primary_id,
				'rating': '3.0',
				'review': '0',
			},
		     success: function(data) {
			 	submit_this.parents('.product_li').remove();
		     },
		    complete: function (data) {

		     }
		});
    });







	//--------------------------
	// 評価登録ショートカット
	//---------------------------
    $('.product_li').on('keydown', '#review' , function(event) {
		if(event.key == 'Enter') {
			review_this = $(this);
			primary_id = $(this).next().attr('data-primary_id');
			rating         = $(this).prev().val();
			review        = $(this).val();
			// Ajaxで送信
			$.ajax({
				url: http+'ajax/login/admin/amazon_api/rating_add.php',
				type : "POST",
				data : {
					'primary_id': primary_id,
					'rating': rating,
					'review': review,
				},
			     success: function(data) {
				 	review_this.parents('.product_li').remove();
			     },
			    complete: function (data) {
	
			     }
			});
		}
    });








	//-----------------
	// 画像ホバー挙動
	//-----------------
    $('.picture_center_inner_box').on('mouseenter', '.picture img' , function(event) {
		if(!$(this).parents('.picture').attr('check')) {
			$(this).parents('.picture').find('svg').css( {
				'opacity': 1,
			});
		}
	});
    $('.picture_center_inner_box').on('mouseleave', '.picture img' , function(event) {
		if(!$(this).parents('.picture').attr('check')) {
			$(this).parents('.picture').find('svg').css( {
				'opacity': 0,
			});
		}
	});
	//-------------------
	// 画像クリック挙動
	//-------------------
    $('.picture_center_inner_box').on('click', '.picture img' , function(event) {
			last_key_id = false;
			if(event.shiftKey) {
				$('.picture').each(function(key, value) {
					if($(value).attr('check')) {
						last_key_id = key;
					}
				});
				// 基本ルール(最後にチェックしてある画像より後ろでクリックされた場合)
				if(last_key_id < $('.picture').index($(this).parents('.picture'))) {
					this_id = $('.picture').index($(this).parents('.picture'));
					$('.picture').each(function(key, value) {
						if(last_key_id < key) {
							if(key <= this_id) {
								$(this).find('svg').css( {
									'fill': '#58e481',
									'opacity': 1,
								});
								$(this).attr('check', '1');
								$(this).css( {
									'background-color' : '#E9F0FD',
									'padding' : '15px',
								})
							}
						}
					});
				} // if(last_key_id < $('.picture').index($(this).parents('.picture'))) {
			} // if(event.shiftKey) {
				else {
					if($(this).parents('.picture').attr('check')) {
						$(this).parents('.picture').find('svg').css( {
							'fill': '#7e847c',
							'opacity': 0,
						});
						$(this).parents('.picture').removeAttr('check');
						$(this).parents('.picture').css( {
							'background-color' : 'transparent',
							'padding' : '5px',
						})

					}
						else {
							$(this).parents('.picture').find('svg').css( {
								'fill': '#58e481',
								'opacity': 1,
							});
							$(this).parents('.picture').attr('check', '1');
							$(this).parents('.picture').css( {
								'background-color' : '#E9F0FD',
								'padding' : '15px',
							})
					}
				} // else {
    });

	//----------------------------
	// 画像クリック挙動(action)
	//----------------------------
    $('.picture_center_inner_box').on('click', '.picture img' , function(event) {
		select = 0;
		$('.picture').each(function(key, value) {
			if($(value).attr('check')) {
				select++;
			}
		});
		if(select) {
			$('.trash_action').css( {
				'visibility' : 'hidden',
			});

			$('.trash_action_type_2').css( {
				'visibility' : 'visible',
			});
		}
			else {
				$('.trash_action_type_2').css( {
					'visibility' : 'hidden',
				});
				$('.trash_action').css( {
					'visibility' : 'visible',
				});
			}
    });












	//---------------------------
	// action_backクリック挙動
	//---------------------------
    $('.picture_center_inner_box').on('click', '.action_back' , function(event) {
		window.location.href = http+"login/admin/";
    });
	//------------------------------------------------
	// right_word_6クリック挙動(ゴミ箱を空にする
	//------------------------------------------------
    $('.picture_center_inner_box').on('click', '.right_word_6' , function(event) {
		$('.select_trash_delete_overlay').css( {
			'visibility' : 'visible',
		});
	});
	//------------------------------------------------
	// select_trash_delete_overlay_inner_boxクリック挙動
	//------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_trash_delete_overlay_inner_box' , function(event) {
		event.stopPropagation();
    });
	//------------------------------------------------
	// select_trash_delete_overlayクリック挙動
	//------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_trash_delete_overlay' , function(event) {
		$('.select_trash_delete_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//------------------------------------------------
	// select_trash_delete_overlay_inner_deleteクリック挙動
	//------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_trash_delete_overlay_inner_delete' , function(event) {
		$('.select_trash_delete_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//------------------------------------------------
	// trash_delete_cancelクリック挙動
	//------------------------------------------------
    $('.picture_center_inner_box').on('click', '.trash_delete_cancel' , function(event) {
		$('.select_trash_delete_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//--------------------------------------
	// trash_delete_submitクリック挙動
	//--------------------------------------
    $('.picture_center_inner_box').on('click', '.trash_delete_submit' , function(event) {
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/trash/trash_delete.php',
			type : "POST",
			data : {

			},
		     success: function(data) {
				$('.select_trash_delete_overlay').css( {
					'visibility' : 'hidden',
				});
				$('.picture').remove();
		     },
		    complete: function (data) {

		     }
		});
		event.stopPropagation();
    });
/******************************************/
	//--------------------------------------
	// selecte_trasha_deleteクリック挙動
	//--------------------------------------
    $('.picture_center_inner_box').on('click', '.selecte_trasha_delete' , function(event) {
		$('.select_trash_select_delete_overlay').css( {
			'visibility' : 'visible',
		});
    });
	//------------------------------------------------
	// select_trash_select_delete_overlay_inner_boxクリック挙動
	//------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_trash_select_delete_overlay_inner_box' , function(event) {
		event.stopPropagation();
    });
	//------------------------------------------------
	// select_trash_select_delete_overlay_inner_deleteクリック挙動
	//------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_trash_select_delete_overlay_inner_delete' , function(event) {
		$('.select_trash_select_delete_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//------------------------------------------------
	// select_trash_select_delete_overlayクリック挙動
	//------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_trash_select_delete_overlay' , function(event) {
		$('.select_trash_select_delete_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//--------------------------------------------
	// trash_select_delete_cancelクリック挙動
	//--------------------------------------------
    $('.picture_center_inner_box').on('click', '.trash_select_delete_cancel' , function(event) {
		$('.select_trash_select_delete_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//--------------------------------------------
	// trash_select_delete_submitクリック挙動
	//--------------------------------------------
    $('.picture_center_inner_box').on('click', '.trash_select_delete_submit' , function(event) {
		folder_primary_id_array = [];
		$('.picture').each(function(key, value) {
			if($(value).attr('check')) {
				folder_primary_id_array[key] = $(value).find('picture').attr('primary-id');
			}
		});
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/trash/trash_selecte_delete.php',
			type : "POST",
			data : {
				'folder_primary_id_array' : folder_primary_id_array, 
			},
		     success: function(data) {
				folder_primary_id_array = [];
				$('.picture').each(function(key, value) {
					if($(value).attr('check')) {
						$(value).remove();
					}
				});
				$('.trash_action_type_2').css( {
					'visibility' : 'hidden',
				});
				$('.trash_action').css( {
					'visibility' : 'visible',
				});
				$('.select_trash_select_delete_overlay').css( {
					'visibility' : 'hidden',
				});
		     },
		    complete: function (data) {

		     }
		});
		event.stopPropagation();
    });
/*************************************************/
	//-----------------------------
	// trash_restoreクリック挙動
	//-----------------------------
    $('.picture_center_inner_box').on('click', '.trash_restore' , function(event) {
		$('.select_trash_restore_overlay').css( {
			'visibility' : 'visible',
		});
    });
	//------------------------------------------------
	// select_trash_restore_overlayクリック挙動
	//------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_trash_restore_overlay' , function(event) {
		$('.select_trash_restore_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//------------------------------------------------
	// select_trash_restore_overlay_inner_boxクリック挙動
	//------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_trash_restore_overlay_inner_box' , function(event) {
		event.stopPropagation();
    });
	//------------------------------------------------
	// select_trash_restore_overlay_inner_deleteクリック挙動
	//------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_trash_restore_overlay_inner_delete' , function(event) {
		$('.select_trash_restore_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//--------------------------------------------
	// trash_select_delete_cancelクリック挙動
	//--------------------------------------------
    $('.picture_center_inner_box').on('click', '.trasht_restore_cancel' , function(event) {
		$('.select_trash_restore_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//--------------------------------------
	// trash_restore_submitクリック挙動
	//--------------------------------------
    $('.picture_center_inner_box').on('click', '.trash_restore_submit' , function(event) {
		folder_primary_id_array = [];
		$('.picture').each(function(key, value) {
			if($(value).attr('check')) {
				folder_primary_id_array[key] = $(value).find('picture').attr('primary-id');
			}
		});
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/trash/trash_restore.php',
			type : "POST",
			data : {
				'folder_primary_id_array' : folder_primary_id_array, 
			},
		     success: function(data) {
				folder_primary_id_array = [];
				$('.picture').each(function(key, value) {
					if($(value).attr('check')) {
						$(value).remove();
					}
				});
				$('.select_trash_restore_overlay').css( {
					'visibility' : 'hidden',
				});
		     },
		    complete: function (data) {

		     }
		});
		event.stopPropagation();
    });






/*
				<div class="select_trash_restore_overlay_inner_title">選択した画像を復元しますか？</div>
				<div class="select_trash_restore_overlay_inner_delete">×</div>
			</div>
			<div class="trash_restore_box">
				<p>復元すると画像は元にあった場所に戻ります。</p>
				<div class="trasht_restore_cancel">キャンセル</div>
					<button class="trash_restore_submit"><span>復元する</span>
*/
































