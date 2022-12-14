	/*********
	削除確認
	*********/
	$('.draft_list_content').on( {
		'click': function() {
			no_title_list = $(this).parents('.draft_list_content').find('p');
			no = no_title_list[0];
			title = no_title_list[1];
			no = $(no).html();
			title = $(title).html();
			no = no.replace(/<b>/g, '');
			no = no.replace(/<\/b>/g, '');
			no = no.replace(/<span class="time">.*?<\/span>/g, '');
			title = title.replace(/<b>/g, '');
			title = title.replace(/<\/b>/g, '');
			if(confirm(""+no+"\r\n"+title+"\r\nを削除してもよろしいでしょうか？")) {
				alert('削除致しました');
			}
				else {
					return false;
				}

		}
	}, '.delete');
