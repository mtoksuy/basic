		&lt;!-- ハンバーガーメニュー --&gt;
		&lt;div id=&quot;nav-drawer&quot;&gt;
			&lt;input id=&quot;nav-input&quot; type=&quot;checkbox&quot; class=&quot;nav-unshown&quot;&gt;
			&lt;label id=&quot;nav-open&quot; for=&quot;nav-input&quot;&gt;&lt;span&gt; &lt;/span&gt;&lt;/label&gt;
			&lt;label class=&quot;nav-unshown&quot; id=&quot;nav-close&quot; for=&quot;nav-input&quot;&gt;&lt;/label&gt;
			&lt;div id=&quot;nav-content&quot;&gt;
				&lt;ul&gt;
					&lt;li&gt;&lt;a  class=&quot;o_8&quot; href=&quot;&lt;?php echo HTTP;?&gt;aboutus/&quot;&gt;私たちについて&lt;/a&gt;&lt;/li&gt;
					&lt;li&gt;&lt;a class=&quot;o_8&quot; href=&quot;&lt;?php echo HTTP;?&gt;contact/&quot;&gt;お問い合わせ&lt;/a&gt;&lt;/li&gt;
				&lt;/ul&gt;
			&lt;/div&gt;
		&lt;/div&gt; &lt;!-- ハンバーガーメニュー --&gt;
		&lt;!-- 検索窓 --&gt;
		&lt;div class=&quot;search_window&quot;&gt;
			&lt;div class=&quot;search_window_inner&quot;&gt;
				&lt;form class=&quot;search_window_form&quot; method=&quot;get&quot; action=&quot;&lt;?php echo HTTP; ?&gt;search/&quot; autocomplete=&quot;off&quot;&gt;
					&lt;input placeholder=&quot;なにをお探しですか？&quot; type=&quot;search&quot; name=&quot;q&quot; id=&quot;q&quot; value=&quot;&lt;?php if($_GET[&#039;q&#039;]) {echo $_GET[&#039;q&#039;]; }?&gt;&quot; autocomplete=&quot;off&quot;&gt;
					&lt;div class=&quot;search_logo&quot;&gt;
						&lt;img width=&quot;16&quot; height=&quot;17&quot; title=&quot;検索&quot; alt=&quot;検索&quot; src=&quot;&lt;?php echo HTTP; ?&gt;app/assets/svg/common/search_logo_1.svg&quot;&gt;
						&lt;input type=&quot;submit&quot; value=&quot;検索&quot;&gt;
					&lt;/div&gt;
				&lt;/form&gt;
			&lt;/div&gt;
		&lt;/div&gt;
		&lt;div class=&quot;search_switch&quot;&gt;
			&lt;img width=&quot;16&quot; height=&quot;17&quot; title=&quot;検索&quot; alt=&quot;検索&quot; src=&quot;&lt;?php echo HTTP; ?&gt;app/assets/svg/common/search_logo_1.svg&quot;&gt;
		&lt;/div&gt;

		&lt;nav class=&quot;drawer&quot;&gt;
			&lt;div class=&quot;drawer_inner&quot;&gt;
				&lt;ul style=&quot;top: -2px; position: relative;&quot;&gt;

				&lt;/ul&gt;
			&lt;/div&gt;
		&lt;/nav&gt;
