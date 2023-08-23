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



/*
<div class="draft_list_content">
				<p><b>No：</b>70</p>
				<p><b>タイトル：おはよう〜〜〜〜〜〜〜〜〜〜〜〜です</b></p>
				<div class="draft_list_content_edit">
					<ul class="clearfix">
						<li><a target="_blank" href="http://localhost/basic/login/admin/post?article_id=70&amp;edit=true">編集する</a></li>
						<li><a href="http://localhost/basic/article/70/" target="_blank">確認する</a></li>
						<li><a href="http://localhost/basic/login/admin/post?article_id=70&amp;delete=true" target="_blank">削除する</a></li>
					</ul>
				</div>
			</div>

*/