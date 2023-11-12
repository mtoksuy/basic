
	/************
	クリップ機能
	************/
	$('.clip').on( {
		'click': function() {
			// フォーカスを瞬時に戻す
			$('#content').focus();
			// 選択中のテキスト取得
			var selected_text = window.getSelection().toString();
			// クリップネーム取得
			clip_name = ($(this).attr('data-clip_name'));
			if(clip_name == 'headline_1') {
				clip_content = '# '+selected_text;
			}
				else if(clip_name == 'headline_2') {
					clip_content = '## '+selected_text;
				}
				else if(clip_name == 'headline_3') {
					clip_content = '### '+selected_text;
				}
				else if(clip_name == 'hashtag') {
					clip_content = '#'+selected_text;
				}
				else if(clip_name == 'code') {
					clip_content = '```'+selected_text+'```';
				}
				else if(clip_name == 'strong') {
					clip_content = '*'+selected_text+'*';
				}
				else if(clip_name == 'link') {
					clip_content = '['+selected_text+']('+selected_text+')';
				}
				else if(clip_name == 'card_link') {
					clip_content = '[card_link:\n	url:""\n]';
				}
				else if(clip_name == 'list') {
					// リスト形式に変換する
					const listItems = selected_text.split('\n').map(text => `* ${text}\n`).join('');
					clip_content = listItems;
				}
				else if(clip_name == 'table') {
					// リスト形式に変換する
					clip_content = '|'+selected_text+'|';
				}
				else if(clip_name == 'image') {
					clip_content = '('+selected_text+')';
				}
				else if(clip_name == 'checkpoint') {
					// リスト形式に変換する
					const listItems = selected_text.split('\n').map(text => `	* ${text}\n`).join('');
					clip_content = '[checkpoint:\n	title:""\n'+listItems+']\n';
				}
				else if(clip_name == 'amazon') {
					clip_content = '[amazon:\n	brand:""\n	title:""\n	price:""\n	rating:""\n	review:""\n	image:""\n	link:""\n]\n';
				}
				else if(clip_name == 'quote') {
					clip_content = '[quote:\n	quote:"'+selected_text+'"\n	link_text:""\n	link:""\n]\n';
				}
				else if(clip_name == 'box') {
					clip_content = '[box:\n	text:"'+selected_text+'"\n]\n';
				}
				else if(clip_name == 'blowing') {
					clip_content = '[blowing:\n	text:"'+selected_text+'"\n]\n';
				}
				else if(clip_name == 'marker') {
					clip_content = '__'+selected_text+'__';
				}
				else if(clip_name == 'separator') {
					clip_content = '---';
				}
				else if(clip_name == 'index') {
					clip_content = '##index##';
				}
				else if(clip_name == 'thumbnail') {
					let stringWithoutParentheses = selected_text;
					if (selected_text.startsWith("(") && selected_text.endsWith(")")) {
						stringWithoutParentheses = selected_text.slice(1, -1);
					}
					clip_content = '[thumbnail:\n	image:"'+stringWithoutParentheses+'"\n]';
				}
			// テキスト挿入
			document.execCommand('insertText', false, clip_content);
			if(navigator.clipboard){
//				p(clip_content);
//			    navigator.clipboard.writeText('fffffffffffff');
			}
				else {
//					document.execCommand('insertText', false, clip_content);
				}
//			event.stopPropagation();
//			return false;
		}
	}, 'li');

	/**********
	下書き保存
	**********/
	$('.post_form').on( {
		'click': function() {
			title = $('#title').val();
			content = $('#content').val();
			draft_id = $('#draft_id').val();
			basic_id = $('#basic_id').val();
			// Ajaxで送信
			$.ajax({
				url: '../../../ajax/login/admin/post/draft/',
				type : "POST",
				data : {
					title: title,
					content: content,
					hathtag: '',
					draft_id: draft_id,
					basic_id: basic_id,
				},
			     success: function(data) {
				 	// 変更
				 	$('#draft_id').attr('value', data['primary_id']);
				 	$('#basic_id').attr('value', data['basic_id']);
				 	alert('下書きを保存しました');
			     },
			    complete: function (data) {
	
			     }
			});
			return false;
		}
	}, '.draft');
	/**********
	プレビュー
	**********/
	$('.post_form').on( {
		'click': function() {
			title = $('#title').val();
			content = $('#content').val();
			draft_id = $('#draft_id').val();
			basic_id = $('#basic_id').val();
		// draft_idがある場合
		if(draft_id) {
			// Ajaxで送信
			$.ajax({
				url: '../../../ajax/login/admin/post/draft/',
				type : "POST",
				data : {
					title: title,
					content: content,
					hashtag: '',
					draft_id: draft_id,
					basic_id: basic_id,
				},
			     success: function(data) {
				 	// 変更
				 	$('#draft_id').attr('value', data['primary_id']);
				 	$('#basic_id').attr('value', data['basic_id']);
					if(confirm('プレビューを表示しますか？')) {
				 		window.open('../../../login/admin/post/?draft_id='+data['primary_id']);
					}
						else {
							return false;
						}
			     },
			    complete: function (data) {
	
			     }
			});
		}
			// draft_idがない場合
			else {
				// Ajaxで送信
				$.ajax({
					url: '../../../ajax/login/admin/post/draft/',
					type : "POST",
					data : {
						title: title,
						content: content,
						hashtag: '',
						draft_id: draft_id,
						basic_id: basic_id,
					},
				     success: function(data) {
					 	// 変更
					 	$('#draft_id').attr('value', data['primary_id']);
					 	$('#basic_id').attr('value', data['basic_id']);
						if(confirm('プレビューを表示しますか？')) {
					 		window.open('../../../login/admin/post/?draft_id='+data['primary_id']);
						}
							else {

								return false;
							}
				     },
				    complete: function (data) {
		
				     }
				});



			}



			return false;
		}
	}, '.preview');
	/********
	編集保存
	********/
	$('.post_form').on( {
		'click': function() {
			title = $('#title').val();
			content = $('#content').val();
			article_id = $('#article_id').val();
			basic_id = $('#basic_id').val();
			// Ajaxで送信
			$.ajax({
				url: '../../../ajax/login/admin/post/edit/',
				type : "POST",
				data : {
					title: title,
					content: content,
					hashtag: '',
					article_id: article_id,
					basic_id: basic_id,
				},
			     success: function(data) {
				 	// 変更
//				 	$('#draft_id').attr('value', data['primary_id']);
//				 	$('#basic_id').attr('value', data['basic_id']);
				 	alert('編集しました');
			     },
			    complete: function (data) {

			     }
			});
			return false;
		}
	}, '.edit');
	/************************
	タイトル欄でエンター禁止
	************************/
	$('.post_form').on( {
		'keypress': function(e) {
			if(e.which == 13){
				// フォーカスを瞬時に戻す
				$('#content').focus();
				return false;	
			}
		}
	}, '#title');

	/********************************
	option＋command+sで下書き保存
	********************************/
	document.onkeydown = function(e) {
/*
キーボードの押されたキーを取得する
https://gray-code.com/javascript/get-the-key-pressed-on-the-key/
*/
	var keyCode = false; 
	if (e) event = e;
	
	if (event) {
	if (event.keyCode) {
	keyCode = event.keyCode;
	} else if (event.which) {
	keyCode = event.which;
	}
	}
	if(e.metaKey && e.altKey| e.metaKey) {
		if(keyCode == 83) {


/////////////////////////////////

			title = $('#title').val();
			content = $('#content').val();
			draft_id = $('#draft_id').val();
			article_id = $('#article_id').val();
			basic_id = $('#basic_id').val();
			// 記事編集の場合
			if(article_id) {
				// Ajaxで送信
				$.ajax({
				url: '../../../ajax/login/admin/post/edit/',
					type : "POST",
					data : {
						title: title,
						content: content,
						category: 'blog',
						hashtag: '',
						article_id: article_id,
						basic_id: basic_id,
					},
				     success: function(data) {
					 	// 変更
					 	$('#draft_id').attr('value', data['primary_id']);
					 	$('#basic_id').attr('value', data['basic_id']);
						$('.shortcut_notice').html('編集しました。');
						$('.shortcut_notice').css( {
							'display': 'block',
						});
						//一秒後に実行
						setTimeout(function(){
							$('.shortcut_notice').css( {
								'display': 'none',
							});
						},600);
				     },
				    complete: function (data) {
		
				     }
				});
			}
				// それ以外
				else {
					// Ajaxで送信
					$.ajax({
						url: '../../../ajax/login/admin/post/draft/',
						type : "POST",
						data : {
							title: title,
							content: content,
							category: 'blog',
							hashtag: '',
							draft_id: draft_id,
							basic_id: basic_id,
						},
					     success: function(data) {
						 	// 変更
						 	$('#draft_id').attr('value', data['primary_id']);
						 	$('#basic_id').attr('value', data['basic_id']);
							$('.shortcut_notice').html('下書きを保存しました。');
							$('.shortcut_notice').css( {
								'display': 'block',
							});
							//一秒後に実行
							setTimeout(function(){
								$('.shortcut_notice').css( {
									'display': 'none',
								});
							},600);
					     },
					    complete: function (data) {
			
					     }
					});
				}

///////////////////////////////////









		}
}
	};

	/********************
	現在の記事文字数取得
	********************/
	function text_count_check_num_get(contents) {
		// 画像、リンク
		contents = contents.replace(/\(https:\/\/(.*?)\)/g, '');
		contents = contents.replace(/\(http:\/\/(.*?)\)/g, '');

		//url:系
		contents = contents.replace(/url:"https:\/\/(.*?)"/g, '');
		contents = contents.replace(/url:"http:\/\/(.*?)"/g, '')
//		contents = contents.replace(/quote:"(.*?)"/g, '');
		let regexp2 = new RegExp(/quote:"(.*?)"/gs);
		contents = contents.replace(regexp2, '');
		contents = contents.replace(/ASIN:"(.*?)"/g, '');
		contents = contents.replace(/link:"https:\/\/(.*?)"/g, '');
		contents = contents.replace(/link:"http:\/\/(.*?)"/g, '');
		contents = contents.replace(/image:"http:\/\/(.*?)"/g, '');
		contents = contents.replace(/image:"https:\/\/(.*?)"/g, '');

		// 独自マークダウン系
		contents = contents.replace(/card_link:/g, '');
		contents = contents.replace(/link_text:/g, '');
		contents = contents.replace(/box:/g, '');
		contents = contents.replace(/text:/g, '');
		contents = contents.replace(/url:/g, '');
		contents = contents.replace(/blowing:/g, '');
		contents = contents.replace(/quote:/g, '');
		contents = contents.replace(/link:/g, '');
		contents = contents.replace(/amazon:/g, '');
		contents = contents.replace(/amazon_v2:/g, '');
		contents = contents.replace(/brand:/g, '');
		contents = contents.replace(/title:/g, '');
		contents = contents.replace(/price:/g, '');
		contents = contents.replace(/rating:/g, '');
		contents = contents.replace(/review:/g, '');
		contents = contents.replace(/image:/g, '');
		contents = contents.replace(/checkpoint:/g, '');
		contents = contents.replace(/ASIN:/g, '');




		// 色々
		contents = contents.replace(/\"/g, '');
		contents = contents.replace(/\'/g, '');
		contents = contents.replace(/\n/g, '');
		contents = contents.replace(/#/g, '');
		contents = contents.replace(/ /g, '');
		contents = contents.replace(/　/g, '');
		contents = contents.replace(/-/g, '');
		contents = contents.replace(/\*/g, '');
		contents = contents.replace(/_/g, '');
		contents = contents.replace(/\[/g, '');
		contents = contents.replace(/\]/g, '');
		contents = contents.replace(/\(/g, '');
		contents = contents.replace(/\)/g, '');
		contents = contents.replace(/\t/g, '');
		contents = contents.replace(/\*/g, '');
		count = contents.length;
//		p($(this).val());
//		p(count);
		// 文字数表示
		$('.text_count_check_num').html(count+'文字');
	}

	/************************
	現在の記事文字数チェック
	************************/
	$('.post_form').on('keydown', '#content', function(event) {
		contents = $(this).val();
		text_count_check_num_get(contents);
	});
	/*******************************************
	ページ読み込み時に記事文字数をチェックする
	*******************************************/
	$('html').ready(function() {
		contents = $('.post_form #content').val();
		text_count_check_num_get(contents);
	});


	/***************************************************************
	ドラッグ&ドロップでファイルアップロード：マークダウン自動出力
	****************************************************************/
	$(function() {
		var dropArea = $('#content');
		
		// ドラッグ&ドロップイベントを処理する関数
		function handleDragOver(event) {
			event.stopPropagation();
			event.preventDefault();
//			dropArea.css('background-color', '#EFEFEF');
			dropArea.css('filter', 'brightness(95%)');
			dropArea.css('cursor', 'copy');
		}
		
		// ファイルをドロップした時に呼び出される関数
		function handleFileSelect(event) {
			event.stopPropagation();
			event.preventDefault();
//			dropArea.css('background-color', '#FFFFFF');
			dropArea.css('filter', 'brightness(100%)');
			dropArea.css('cursor', 'auto');
			
			// ドロップされたファイルを取得
			var files = event.originalEvent.dataTransfer.files;
			// ファイルをアップロードする
			for(var i = 0; i < files.length; i++) {
				uploadFile(files[i]);
			}
		}
		
		// ドロップエリアのイベントを設定する
		dropArea.on('dragover', handleDragOver);
		dropArea.on('dragleave', function() {
			dropArea.css('filter', 'brightness(100%)');
			dropArea.css('cursor', 'auto');
//			dropArea.css('background-color', '#FFFFFF');
		});
		dropArea.on('drop', handleFileSelect);
		
		// ファイルをアップロードする関数
		function uploadFile(file) {
			var formData = new FormData();
			formData.append('uploadFile', file);
			
			$.ajax({
				url: '../../../ajax/login/admin/post/image_upload/',
				type : "POST",
				data : formData,
				cache       : false,
				contentType : false,
				processData : false,
				//			dataType    : "html", // jsonではなくhtmlらしい
				dataType    : "json", // あれ？ひとまずこれで
				success: function(data) {
					// フォーカスを瞬時に戻す
					$('#content').focus();
					// 選択中のテキスト取得
					var selected_text = window.getSelection().toString();
					// テキスト挿入
					document.execCommand('insertText', false, '('+data['image_http']+')\n');
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error('アップロードエラー: ' + textStatus, errorThrown);
				}
			});
		}
	});

