
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
			// HTMLタグを取り除く正規表現を使用して置換
			this_wording = this_wording.replace(/<ol>(.*?)<\/ol>/g, '');
			$('h2').each(function(i, e) {
				if(this_wording == $(this).html()) {
					cotents_offset_top = $(this).offset().top;
					$('html,body').animate({scrollTop: ((cotents_offset_top - 15) - header_height)  },100);
				}
			});
		}
	}, '.index ol li .h2_scroll_btn');
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
			// HTMLタグを取り除く正規表現を使用して置換
			this_wording = this_wording.replace(/<ol class="sub">(.*?)<\/ol>/g, '');
			$('h3').each(function(i, e) {
				if(this_wording == $(this).html()) {
					cotents_offset_top = $(this).offset().top;
					$('html,body').animate({scrollTop: ((cotents_offset_top - 15) - header_height)  },100);
				}
			});
		}
	}, '.index ol li .nest li .h3_scroll_btn');
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


