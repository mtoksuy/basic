
<script   src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
  	/**********************
	  uxseo_idチェック
	 **********************/
	$('.signup_form_uxseo_id').on('keyup', function(){
		// 必要変数
		var signup_form_uxseo_id_element = $(this);
		// 2文字列以上から
		if($(this).val().length > 1) {
			// Ajax通信を開始
			$.ajax({
				url: 'https://uxseo.jp/ajax/seo-tool/analytics/signup/uxseo_id_check.php',
				type: 'POST',
				dataType: 'json',
				data: {
					uxseo_id : $(this).val(),
				},
				cache: false,
			})
			// 通信成功時の処理を記述
			.done(function(data) {
				// 使用できるidであれば
				if(data['uxseo_id_check']) {
					var add_element =             '<span class="real_time_check check_green">使用できます</span>';
					var rewrite_add_element = '<span class="check_green">使用できます</span>';
				}
				// 使用できないidであれば
				else {
					var add_element = '<span class="real_time_check red">すでに使用されています</span>';
					var rewrite_add_element = '<span class="red">すでに使用されています</span>';
				}
				// 書き換え
				if(signup_form_uxseo_id_element.next('.real_time_check')[0]) {
					signup_form_uxseo_id_element.next('.real_time_check').html(rewrite_add_element);
				}
				// 書き込み
				else {
					signup_form_uxseo_id_element.after(add_element);
				}
			})
			// 通信失敗時の処理を記述
			.fail(function() {
			
			})
		}
	}); // $('.signup_form_uxseo_id').on('keyup', function(){

  	/***************************
	  メールアドレスチェック
	 ***************************/
	$('.signup_form_email').on('keyup', function(){
		// 必要変数
		var signup_form_email_element = $(this);
		// 2文字列以上から
		if($(this).val().length > 1) {
			// Ajax通信を開始
			$.ajax({
				url: 'https://uxseo.jp/ajax/seo-tool/analytics/signup/email_check.php',
				type: 'POST',
				dataType: 'json',
				data: {
					email : $(this).val(),
				},
				cache: false,
			})
			// 通信成功時の処理を記述
			.done(function(data) {
				// 使用できるidであれば
				if(data['email_check']) {
					var add_element =             '<span class="real_time_check check_green">使用できます</span>';
					var rewrite_add_element = '<span class="check_green">使用できます</span>';
				}
				// 使用できないidであれば
				else {
					var add_element = '<span class="real_time_check red">使用できません</span>';
					var rewrite_add_element = '<span class="red">使用できません</span>';
				}
				// 書き換え
				if(signup_form_email_element.next('.real_time_check')[0]) {
					signup_form_email_element.next('.real_time_check').html(rewrite_add_element);
				}
				// 書き込み
				else {
					signup_form_email_element.after(add_element);
				}
			})
			// 通信失敗時の処理を記述
			.fail(function() {
			
			})
		}
	}); // $('.signup_form_email').on('keyup', function(){

  	/***********************
	  パスワードチェック
	 **********************/
	$('.signup_form_password').on('keyup', function(){
		// 必要変数
		var signup_form_password_element = $(this);
		// 2文字列以上から
		if($(this).val().length > 1) {
			// Ajax通信を開始
			$.ajax({
				url: 'https://uxseo.jp/ajax/seo-tool/analytics/signup/password_check.php',
				type: 'POST',
				dataType: 'json',
				data: {
					password : $(this).val(),
				},
				cache: false,
			})
			// 通信成功時の処理を記述
			.done(function(data) {
				// 使用できるパスワードであれば
				if(data['password_check']) {
					var add_element =             '<span class="real_time_check check_green">使用できます</span>';
					var rewrite_add_element = '<span class="check_green">使用できます</span>';
				}
				// 使用できないパスワードであれば
				else {
					var add_element = '<span class="real_time_check red">使用できません</span>';
					var rewrite_add_element = '<span class="red">使用できません</span>';
				}
				// 書き換え
				if(signup_form_password_element.next('.real_time_check')[0]) {
					signup_form_password_element.next('.real_time_check').html(rewrite_add_element);
				}
				// 書き込み
				else {
					signup_form_password_element.after(add_element);
				}
			})
			// 通信失敗時の処理を記述
			.fail(function() {
			
			})
		}
	}); // $('.signup_form_password').on('keyup', function(){















  </script>