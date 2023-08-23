
	/***********************
	目次から見出しh2にジャンプ
	***********************/
	$('html').on( {
		'click': function() {
			// 768以下の場合
			if($(window).width() <= 768) {
				header_height = 59;
			}
				// pcの場合
				else {
					header_height = 0;
				}
			this_wording = $(this).html();
			p(this_wording);
			$('h2').each(function(i, e) {
				if(this_wording == $(this).html()) {
					cotents_offset_top = $(this).offset().top;
					$('html,body').animate({scrollTop: ((cotents_offset_top - 15) - header_height)  },100);
				}
			});
		}
	}, '.index li');
	/***********************
	目次から見出しh3にジャンプ
	***********************/
	$('html').on( {
		'click': function() {
			// 768以下の場合
			if($(window).width() <= 768) {
				header_height = 59;
			}
				// pcの場合
				else {
					header_height = 0;
				}
			this_wording = $(this).html();
			p(this_wording);
			$('h3').each(function(i, e) {
				if(this_wording == $(this).html()) {
					cotents_offset_top = $(this).offset().top;
					$('html,body').animate({scrollTop: ((cotents_offset_top - 15) - header_height)  },100);
				}
			});
		}
	}, '.index_2 li');
	/**************************
	目次から見出しh4にジャンプ
	**************************/
	$('html').on( {
		'click': function() {
			// 768以下の場合
			if($(window).width() <= 768) {
				header_height = 59;
			}
				// pcの場合
				else {
					header_height = 0;
				}
			this_wording = $(this).html();
			p(this_wording);
			$('h4').each(function(i, e) {
				if(this_wording == $(this).html()) {
					cotents_offset_top = $(this).offset().top;
					$('html,body').animate({scrollTop: ((cotents_offset_top - 15) - header_height)  },100);
				}
			});
		}
	}, '.index_3 li');

	/********************************
	記事URLをクリップボードにコピー
	********************************/
	$('html').on( {
		'click': function() {
		// コピーするテキストを選択
		  $(".clipboard_copy_textarea").select();
			document.execCommand('copy');
		  $(".clipboard_copy_textarea").blur();
			alert("記事URLをコピーしました。");
		}
	}, '.clipboard_copy');


