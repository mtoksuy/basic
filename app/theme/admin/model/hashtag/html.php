<?php 
class model_hashtag_html {
	//-----------------------------------
	//さらに前の記事を見るHTML生成
	//-----------------------------------
	public static function next_article_html_create($hashtag, $next_hashtag_check, $paging_num) {
		$back_html = '';
		$next_article_html = '';
		$root_dir = 'hashtag';
/*
		pre_var_dump($hashtag);
		pre_var_dump($next_hashtag_check);
		pre_var_dump($paging_num);
*/
		// トップから1進んだurlの場合
		if($paging_num == 2) {
			$back_html = '
				<div class="back">
					<a href="'.HTTP.$root_dir.'/'.$hashtag.'/">
						新しいハッシュタグに戻る
					</a>
				</div>';
		}
			// トップページの場合
			else if($paging_num == 1) {

			}
				// それ以外
				else {
				$back_paging_num = $paging_num-2;
					$back_html = '
						<div class="back">
							<a href="'.HTTP.'hashtag/'.$hashtag.'/'.$back_paging_num.'/">
								新しいハッシュタグに戻る
							</a>
						</div>';
				}
/************************************************/
		// チェック
		if($next_hashtag_check) {
			$next_article_html = '
				<div class="next">
					<a href="'.HTTP.'hashtag/'.$hashtag.'/'.$paging_num.'/">
						さらに前のハッシュタグを見る
					</a>
				</div>';
		}
/************************************************/
		$next_hashtag_html = '
			<div class="article_new_back_list">
				'.$back_html.'
				'.$next_article_html.'
			</div>';
		return $next_hashtag_html;
	}


}