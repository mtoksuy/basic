	//----------------------
	// 検索switchクリック
	//----------------------
	$('.header_inner').on('click', '.search_switch', function(event) {
		// 表示
		$('.search_window').css( {
			'display' : 'block'
		});
		// フォーカスする
		$('.search_window form input[type="search"]').focus();
		// サイトロゴ非表示
		$('.logo').css( {
			'display' : 'none'
		});
		$('.sub_headline').css( {
			'display' : 'none'
		});
	});
	//--------------------
	// 検索logoクリック
	//--------------------
	$('.search_window').on('click', '.search_logo', function(event) {
//		window.location.href = http+'search/?q='+$('.search_window_form #q').val()+'&context=products';
	});
	//------------------------------
	// 検索窓フォーカスが外れた時
	//------------------------------
	$('.header_inner').on('blur', '.search_window form input[type="search"]', function(event) {
		// 1024以下であれば検索窓も非表示
		if($('body').width() < 1023) {
			$('.search_window').css( {
				'display' : 'none'
			});
		}
		// サイトロゴ表示
		$('.logo').css( {
			'display' : 'block'
		});
		$('.sub_headline').css( {
			'display' : 'block'
		});
	});
	//----------------------------------------------------------------
	//上下スクロール検知 ヘッダー上部を隠す・表示する スマホ用
	//----------------------------------------------------------------
	var scroll = 0;
	var diff_start_scroll = 0;
	var switch_check = true;
	$(window).on('scroll', function() {
		//上スクロールの時の処理
		if($(this).scrollTop() < scroll) {
			if(switch_check) {
//				p($(this).scrollTop());
				diff_start_scroll = $(this).scrollTop();
				switch_check = false;
			}
				else {
/*
					p('--------------------------------');
					p(diff_start_scroll);
					p($(this).scrollTop());
					p(diff_start_scroll - $(this).scrollTop());
*/
					// 切り返してから100を超えたら or スクロールが0になったら
					if((diff_start_scroll - $(this).scrollTop()) >= 100 || $(this).scrollTop() == 0) {
						$('.header').css( {
							'top' : '0px'
						});
					}
				}
		}
			//下スクロールの時の処理
			else {
				if(switch_check) {
/*
					p('--------------------------------');
					p(diff_start_scroll);
					p($(this).scrollTop());
					p(diff_start_scroll - $(this).scrollTop());
*/
					// 切り返してから-100を超えたら
					if((diff_start_scroll - $(this).scrollTop()) <= -100) {
						// 0以下の場合は何もしない
						if($(this).scrollTop() <= 0) {
		
						}
							// 1以上であれば非表示にする
							else {
		//						p($(this).scrollTop());
								$('.header').css( {
									'top' : '-80px'
								});
							}
					}
				}
					else {
						diff_start_scroll = $(this).scrollTop();
						switch_check = true;
					}
			}
		// スクロール位置取得
		scroll = $(this).scrollTop();
	});