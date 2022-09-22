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
			$('.select_number').html(select);
			$('.action_inner').css( {
				'visibility' : 'visible',
			});
		}
			else {
				$('.action_inner').css( {
					'visibility' : 'hidden',
				});
			}
    });
	//-----------------------------
	// action_deleteクリック挙動
	//-----------------------------
    $('.action_delete').on({
		'click': function() {
			$('.picture').each(function(key, value) {
				$(value).find('svg').css( {
					'fill': '#7e847c',
					'opacity': 0,
				});
				$(value).css( {
					'background-color' : 'transparent',
					'padding' : '5px',
				})
				$(value).removeAttr('check');
			});
			$('.action_inner').css( {
				'visibility' : 'hidden',
			});
		},
    });
	//-----------------------------
	// select_moveクリック挙動
	//-----------------------------
    $('.select_move').on({
		'click': function() {
			// Ajaxで送信
			$.ajax({
				url: http+'ajax/login/admin/picture_center/folder_list_data_get.php',
				type : "POST",
				data : {
	
				},
			// 成功
			}).done(function(data) {
				$(data['folder_list_data_array']).each(function(key, value){
					$('.ul_title').after('<li class="folder_move"><div class="li_title" folder_primary_id="'+value['primary_id']+'">'+value['folder_name']+'</div></li>');
				});
			// 失敗
			}).fail(function(jqXHR, textStatus, errorThrown) {
	
			});
			$('.select_move_overlay').css( {
				'visibility' : 'visible',
			});
		},
    });
	//----------------------------
	// select_trashクリック挙動
	//----------------------------
    $('.select_trash').on({
		'click': function() {

		},
    });
	//-------------------------------------------------
	// select_move_overlay_inner_boxクリック挙動
	//-------------------------------------------------
    $('.select_move_overlay_inner_box').on({
		'click': function(event) {
			event.stopPropagation();
		},
    });
	//-----------------------------
	// select_move_overlay_innerクリック挙動
	//-----------------------------
    $('.select_move_overlay_inner').on({
		'click': function(event) {
			$('.select_move_overlay').css( {
				'visibility' : 'hidden',
			});
			event.stopPropagation();
		},
    });
	//---------------------------------------------------
	// select_move_overlay_inner_deleteクリック挙動
	//---------------------------------------------------
    $('.select_move_overlay_inner_delete').on({
		'click': function(event) {
			$('.select_move_overlay').css( {
				'visibility' : 'hidden',
			});
		},
    });
	//---------------------------
	// new_folderクリック挙動
	//---------------------------
    $('.new_folder').on({
		'click': function(event) {
			$('.picture_center_inner_box').prepend('<textarea class="folder_name" placeholder="タイトルを追加" autocomplete="off"></textarea>');

			$('.picture').each(function(key, value) {
				if($(value).attr('check')) {}
					else {
						$(value).remove();
					}
			});
			$('.select_move_overlay').css( {
				'visibility' : 'hidden',
			});
			$('.chameleon_word').html('<button aria-label="完了" title="完了"><span class="action_submit"><svg><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path></svg></span></button>フォルダーを編集');
			$('.right_word_1').css( {
				'visibility' : 'hidden',
			});
			$('.right_word_2').css( {
				'visibility' : 'hidden',
			});
			$('.right_word_3').css( {
				'visibility' : 'hidden',
			});
			$('.folder_name').select();
		},
    });
	//----------------------------
	// folder_moveクリック挙動
	//----------------------------
	folder_move_click_check = 0;
    $('.select_move_overlay_inner_box').on('click', '.folder_move' , function(event) {
		folder_primary_id = $(this).find('.li_title').attr('folder_primary_id');
			if(folder_move_click_check == 0) {
				folder_move_click_check = 0;
				folder_primary_id_array = [];
				$('.picture').each(function(key, value) {
					if($(value).attr('check')) {
						folder_primary_id_array[key] = $(value).find('picture').attr('primary-id');
					}
				});
				// Ajaxで送信
				$.ajax({
					url: http+'ajax/login/admin/picture_center/folder_move.php',
					type : "POST",
					data : {
						'folder_primary_id' : folder_primary_id, 
						'folder_primary_id_array' : folder_primary_id_array, 
					},
				// 成功
				}).done(function(data) {
					var pattern = /folders/;
					var result = location.href.match(pattern);
					if(result) {
							window.location.href = http+"login/admin/folders/";
					}
						else {
							window.location.href = http+"login/admin/picture_center/";
						}
				// 失敗
				}).fail(function(jqXHR, textStatus, errorThrown) {
		
				});
			} // if(folder_move_click_check == 0) {
    });
	//---------------------------
	// folder_nameクリック挙動
	//---------------------------
    $('body').on('keypress', '.folder_name' , function(event) {
	    var keycode = (event.keyCode ? event.keyCode : event.which);
	    if(keycode == '13') {
			$('.folder_name').blur();
			return false;
	    }
    });
	//------------------------------
	// action_submitクリック挙動
	//------------------------------
	new_folder_click_check = 0;
    $('body').on('click', '.action_submit' , function(event) {
		if($('.folder_name').val()) {
			if(new_folder_click_check == 0) {
				new_folder_click_check = 1;
				primary_id_array = [];
				$('.picture').each(function(key, value) {
					if($(value).attr('check')) {
						primary_id_array[key] = $(value).find('picture').attr('primary-id');
					}
				});
				folder_name = $('.folder_name').val();
				// Ajaxで送信
				$.ajax({
					url: http+'ajax/login/admin/picture_center/new_folder.php',
					type : "POST",
					data : {
						'folder_name' : folder_name, 
						'primary_id_array' : primary_id_array, 
					},
				// 成功
				}).done(function(data) {
					var pattern = /folders/;
					var result = location.href.match(pattern);
					if(result) {
							window.location.href = http+"login/admin/folders/";
					}
						else {
							window.location.href = http+"login/admin/picture_center/";
						}
				// 失敗
				}).fail(function(jqXHR, textStatus, errorThrown) {
	
				});
			}
		}
			else {
				$('.warning').html('タイトルを挿入して下さい');
			}	   
    });

/*****************************************************************************************/

	//---------------------------
	// select_htmlクリック挙動
	//---------------------------
    $('.action').on('click', '.select_html' , function(event) {
		select_html_primary_id_array =[];
		$('.picture').each(function(key, value) {
			if($(value).attr('check')) {
				select_html_primary_id_array[key] = $(value).find('picture').attr('primary-id');
			}
		});
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/picture_center/cdn_html_create.php',
			type : "POST",
			data : {
				'select_html_primary_id_array' : select_html_primary_id_array, 
			},
		     success: function(data) {

		     },
		    complete: function (data) {
				$('.cdn_list_html_textarea').val(data['responseJSON']['cdn_list_html']);
				$('.select_html_overlay').css( {
					'visibility' : 'visible',
				});
		     }
		});
    });
	//-----------------------------------
	// cdn_html_copy_btnクリック挙動
	//------------------------------------
/// コピーテキストボタンを実装
    $('.select_html_overlay_inner_box').on('click', '.cdn_html_copy_btn' , function(event) {
		p('dfsdf');
		// コピーするテキストを選択
		$(".cdn_list_html_textarea").select();
		// 選択したテキストをクリップボードにコピーする
		document.execCommand("Copy");
		$(".cdn_list_html_textarea").blur();
		$('.torst').html('HTMLをコピーしました。');
		//一秒後に実行
		setTimeout(function() {
			$('.torst').html('　');
		},1000);
});
	//-------------------------------------------------
	// select_html_overlay_inner_boxクリック挙動
	//-------------------------------------------------
    $('.select_html_overlay_inner_box').on({
		'click': function(event) {
			event.stopPropagation();
		},
    });
	//------------------------------------------
	// select_html_overlay_innerクリック挙動
	//-------------------------------------------
    $('.select_html_overlay_inner').on({
		'click': function(event) {
			$('.select_html_overlay').css( {
				'visibility' : 'hidden',
			});
			event.stopPropagation();
		},
    });
	//---------------------------------------------------
	// select_html_overlay_inner_deleteクリック挙動
	//---------------------------------------------------
    $('.select_html_overlay_inner_delete').on({
		'click': function(event) {
			$('.select_html_overlay').css( {
				'visibility' : 'hidden',
			});
		},
    });
/********************************************************/
	//----------------------------
	// select_trashクリック挙動
	//----------------------------
    $('.action').on('click', '.select_trash' , function(event) {
			$('.select_trash_overlay').css( {
				'visibility' : 'visible',
			});
    });
	//------------------------------------
	// select_trash_overlayクリック挙動
	//------------------------------------
    $('.picture_center_inner_box').on('click', '.select_trash_overlay' , function(event) {
		p('select_trash_overlay');
			$('.select_trash_overlay').css( {
				'visibility' : 'hidden',
			});
		event.stopPropagation();
    });
	//----------------------------
	// trash_noticeクリック挙動
	//----------------------------
    $('.picture_center_inner_box').on('click', '.trash_notice' , function(event) {
		p('trash_notice');
		event.stopPropagation();
    });
	//---------------------
	// cancelクリック挙動
	//----------------------
    $('.picture_center_inner_box').on('click', '.cancel' , function(event) {
		$('.select_trash_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//---------------------------
	// trash_moveクリック挙動
	//---------------------------
    $('.picture_center_inner_box').on('click', '.trash_move' , function(event) {
		select_trash_primary_id_array =[];
		$('.picture').each(function(key, value) {
			if($(value).attr('check')) {
				select_trash_primary_id_array[key] = $(value).find('picture').attr('primary-id');
				$(value).remove();
			}
		});
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/picture_center/select_trash.php',
			type : "POST",
			data : {
				'select_trash_primary_id_array' : select_trash_primary_id_array, 
			},
		     success: function(data) {
				$('.select_trash_overlay').css( {
					'visibility' : 'hidden',
				});
				$('.action_inner').css( {
					'visibility' : 'hidden',
				});
		     },
		    complete: function (data) {

		     }
		});
		event.stopPropagation();
    });



/**************************************************************/
	//---------------------------
	// action_backクリック挙動
	//---------------------------
    $('.picture_center_inner_box').on('click', '.action_back' , function(event) {
		window.location.href = http+"login/admin/folders/";
    });
	//---------------------------
	// select_addクリック挙動
	//---------------------------
    $('.picture_center_inner_box').on('click', '.select_add' , function(event) {
		$('.select_add_overlay').css( {
			'visibility' : 'visible',
		});
    });
	//-----------------------------------------------
	// select_add_overlay_inner_boxクリック挙動
	//-----------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_add_overlay_inner_box' , function(event) {
		event.stopPropagation();
    });
	//-----------------------------------
	// select_add_overlayクリック挙動
	//-----------------------------------
    $('.picture_center_inner_box').on('click', '.select_add_overlay' , function(event) {
		$('.select_add_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//-------------------------------------------------
	// select_add_overlay_inner_deleteクリック挙動
	//-------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_add_overlay_inner_delete' , function(event) {
		$('.select_add_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });


	//----------------------------
	// select_otherクリック挙動
	//----------------------------
    $('.picture_center_inner_box').on('click', '.select_other' , function(event) {
		$('.select_other_overlay').css( {
			'visibility' : 'visible',
		});
    });
	//-----------------------------------------------
	// select_other_overlay_inner_boxクリック挙動
	//-----------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_other_overlay_inner_box' , function(event) {
		event.stopPropagation();
    });
	//-----------------------------------
	// select_other_overlayクリック挙動
	//-----------------------------------
    $('.picture_center_inner_box').on('click', '.select_other_overlay' , function(event) {
		$('.select_other_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//-------------------------------------------------
	// select_other_overlay_inner_deleteクリック挙動
	//-------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_other_overlay_inner_delete' , function(event) {
		$('.select_other_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//-------------------------------
	// folder_renameクリック挙動
	//-------------------------------
    $('.picture_center_inner_box').on('click', '.folder_rename' , function(event) {
		folder_name = $('.folder_title_name').html();
		folder_id = $('.folder_title_name').attr('folder_id');

		$('.back_word').html('<button aria-label="完了" title="完了"><span class="action_folder_rename_submit"><svg><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path></svg></span></button><span class="folder_title_name">フォルダー名を編集中...</span>');

		$('.picture_center_inner_box').prepend('<textarea class="folder_name" folder_id="'+folder_id+'" placeholder="タイトルを編集" autocomplete="off">'+folder_name+'</textarea>');

		$('.select_other_overlay').css( {
			'visibility' : 'hidden',
		});
		$('.right_word_4').css( {
			'visibility' : 'hidden',
		});
		$('.right_word_5').css( {
			'visibility' : 'hidden',
		});
		$('.folder_name').select();
    });
	//----------------------------------------------
	// action_folder_rename_submitクリック挙動
	//----------------------------------------------
    $('.picture_center_inner_box').on('click', '.action_folder_rename_submit' , function(event) {
		folder_name = $('.folder_name').val();
		folder_id = $('.folder_name').attr('folder_id');
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/folders/folder_rename.php',
			type : "POST",
			data : {
				'folder_name' : folder_name, 
				'folder_id' : folder_id, 
			},
		     success: function(data) {
				$('.back_word').html('<li class="back_word"><button title="戻る"><span class="action_back"><svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"></path></svg></span></button><span class="folder_title_name" folder_id="'+data['folder_id']+'">'+data['folder_name']+'</span></li>');
				$('.folder_name').remove();
				$('.right_word_4').css( {
					'visibility' : 'visible',
				});
				$('.right_word_5').css( {
					'visibility' : 'visible',
				});
		     },
		    complete: function (data) {

		     }
		});
    });
	//-----------------------------
	// folder_deleteクリック挙動
	//-----------------------------
    $('.picture_center_inner_box').on('click', '.folder_delete' , function(event) {
		$('.select_other_overlay').css( {
			'visibility' : 'hidden',
		});
		$('.select_folder_delete_overlay').css( {
			'visibility' : 'visible',
		});
    });
	//-----------------------------------------------
	// select_folder_delete_overlay_inner_boxクリック挙動
	//-----------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_folder_delete_overlay_inner_box' , function(event) {
		event.stopPropagation();
    });
	//-----------------------------------
	// select_folder_delete_overlayクリック挙動
	//-----------------------------------
    $('.picture_center_inner_box').on('click', '.select_folder_delete_overlay' , function(event) {
		$('.select_folder_delete_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//-------------------------------------------------
	// select_folder_delete_overlay_inner_deleteクリック挙動
	//-------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_folder_delete_overlay_inner_delete' , function(event) {
		$('.select_folder_delete_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//-------------------------------------
	// folder_delete_cancelクリック挙動
	//-------------------------------------
    $('.picture_center_inner_box').on('click', '.folder_delete_cancel' , function(event) {
		$('.select_folder_delete_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//-------------------------------------
	// folder_delete_submitクリック挙動
	//-------------------------------------
    $('.picture_center_inner_box').on('click', '.folder_delete_submit' , function(event) {
		folder_id = $('.folder_title_name').attr('folder_id');
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/folders/folder_delete.php',
			type : "POST",
			data : {
				'folder_id' : folder_id, 
			},
		     success: function(data) {
				window.location.href = http+"login/admin/folders/";
		     },
		    complete: function (data) {

		     }
		});
		event.stopPropagation();
    });

/******************************************************************/
	//----------------------------
	// folder_retagクリック挙動
	//----------------------------
    $('.picture_center_inner_box').on('click', '.folder_retag' , function(event) {
		$('.select_other_overlay').css( {
			'visibility' : 'hidden',
		});

		$('.select_folder_tag_overlay').css( {
			'visibility' : 'visible',
		});
    });
	//-----------------------------------------------
	// select_folder_tag_overlay_inner_boxクリック挙動
	//-----------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_folder_tag_overlay_inner_box' , function(event) {
		event.stopPropagation();
    });
	//-----------------------------------
	// select_folder_tag_overlayクリック挙動
	//-----------------------------------
    $('.picture_center_inner_box').on('click', '.select_folder_tag_overlay' , function(event) {
		$('.select_folder_tag_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//-------------------------------------------------
	// select_folder_tag_overlay_inner_deleteクリック挙動
	//-------------------------------------------------
    $('.picture_center_inner_box').on('click', '.select_folder_tag_overlay_inner_delete' , function(event) {
		$('.select_folder_tag_overlay').css( {
			'visibility' : 'hidden',
		});
		event.stopPropagation();
    });
	//----------------------------------
	// folder_tag_submitクリック挙動
	//----------------------------------
    $('.picture_center_inner_box').on('click', '.folder_tag_submit' , function(event) {
		tag_name = $(this).find('path').attr('class');
		folder_id = $('.folder_title_name').attr('folder_id');
		// Ajaxで送信
		$.ajax({
			url: http+'ajax/login/admin/folders/folder_tag_change.php',
			type : "POST",
			data : {
				'tag_name' : tag_name, 
				'folder_id' : folder_id, 
			},
		     success: function(data) {
				window.location.href = http+"login/admin/folders/";
		     },
		    complete: function (data) {

		     }
		});
		event.stopPropagation();
    });
	//----------------------------------
	// action_folder_addクリック挙動
	//-----------------------------------
    $('.picture_center_inner_box').on('click', '.action_folder_add' , function(event) {
			$('.picture_center_inner_box').prepend('<textarea class="folder_name" placeholder="フォルダー名を入力" autocomplete="off"></textarea>');
			$('.folder_name').select();

			$('.folder_add_li').html('<button aria-label="完了" title="完了"><span class="action_folder_add_submit"><svg><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path></svg></span></button>フォルダーを作成');
    });
	//------------------------------------------
	// action_folder_add_submitクリック挙動
	//-------------------------------------------
	new_add_folder_click_check = 0;
    $('.picture_center_inner_box').on('click', '.action_folder_add_submit' , function(event) {
		if($('.folder_name').val()) {
			if(new_add_folder_click_check == 0) {
				new_add_folder_click_check = 1;
				folder_name = $('.folder_name').val();
				// Ajaxで送信
				$.ajax({
					url: http+'ajax/login/admin/folders/folder_add.php',
					type : "POST",
					data : {
						'folder_name' : folder_name, 
					},
				// 成功
				}).done(function(data) {
					window.location.href = http+"login/admin/folders/";
				// 失敗
				}).fail(function(jqXHR, textStatus, errorThrown) {
	
				});
			}
		}
    });






























