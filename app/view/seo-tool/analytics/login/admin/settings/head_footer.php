
<script   src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<script>




$('html').on( {
	'click': function(event) {
//		console.log($('.trun_change_box').css('display'));
		// black_box非表示
		if($('.black_box').css('display') === 'block') {
			$('.black_box').css( {
				'display': 'none',
			});
			event.stopPropagation();
		}
		// delete_box非表示
		if($('.delete_box').css('display') === 'block') {
			$('.delete_box').css( {
				'display': 'none',
			});
			event.stopPropagation();
		}
	}
}, 'body');


/*******************
削除ボックス表示
*******************/
$('.delete').on( {
	'click': function(event) {
		$('.black_box').css( {
			'display': 'block',
		});
		$('.delete_box').css( {
			'display': 'block',
		});
		// プロパディ名出力
		$('.propaddy_target').html($(this).parent('.delete').attr('url-data'));
		// 削除するの改造
		$('.ok_button').html("<a href='https://uxseo.jp/seo-tool/analytics/login/admin/settings/?turn_id="+$(this).parent('.delete').attr('turn-data')+"&delete=1'>削除する</a>");
		event.stopPropagation();
		return false;
	}
}, 'a');
/*******************
ホバリングキャンセル
*******************/
$('.admin_right').on( {
	'click': function(event) {
		event.stopPropagation();
	}
}, '.delete_box');
/***********************
キャンセルボタン発火
************************/
$('.delete_box').on( {
	'click': function(event) {
		if($('.black_box').css('display') === 'block') {
			$('.black_box').css( {
				'display': 'none',
			});
			event.stopPropagation();
		}
		// delete_box非表示
		if($('.delete_box').css('display') === 'block') {
			$('.delete_box').css( {
				'display': 'none',
			});
			event.stopPropagation();
		}
	}
}, '.ng_button');















/**************************
プロパディ表示・非表示
**************************/
$('.summary_inner').on( {
	'click': function(event) {
		if($('.trun_change_box').css('display') === 'block') {
		$('.trun_change_box').css( {
			'display': 'none',
		});
		event.stopPropagation();
		}
			else {
				$('.trun_change_box').css( {
					'display': 'block',
				});
				event.stopPropagation();
			}
//console.log($('.trun_change_box').css('display'));
	}
}, '.trun_change');

/*******************
日付表示・非表示
*******************/
$('.summary_inner').on( {
	'click': function(event) {
		if($('.date_select_box').css('display') === 'block') {
		$('.date_select_box').css( {
			'display': 'none',
		});
		$('.date_select').addClass('o_8');
		event.stopPropagation();
		}
			else {
				$('.date_select_box').css( {
					'display': 'block',
				});
				$('.date_select').removeClass('o_8');
				event.stopPropagation();
			}
//console.log($('.trun_change_box').css('display'));
	}
}, '.date_select');


</script>
