$('document').ready(function(){
	$('.button').on('click', function(){
		var login = $('.log').val();
		var password = $('.pass').val();
		var email = $('.email').val();
		var captcha = $('.cap').val();
		var str = 'login=' + login + '&password=' + password + '&email=' + email + '&captcha=' + captcha;
		$.ajax({
			url: '/form/reg.php',
			type: 'POST',
			data: str,
			dataType: 'html',
			cache: 'false',
			success: function(data){
				document.getElementById('capimg').src = 'resource/captcha.php';
				$('.cap').val('');
				if(data == 'correct') {
					$('.register').remove();
					$('.result').text('Регистрация прощла успешно.');
					$('.result').css({display: 'block', backgroundColor: 'green'})
					window.location.assign("../login");
				} else {
					$('.result').text(data);
					$('.result').css({display: 'block'})
				}
			}
		})
	})
	$('.login').on('click', function(){
		var login = $('.log').val();
		var password = $('.pass').val();
		var captcha = $('.cap').val();
		var str = 'login=' + login + '&password=' + password + '&captcha=' + captcha;
		$.ajax({
			url: '/form/login.php',
			type: 'POST',
			data: str,
			dataType: 'html',
			cache: 'false',
			success: function(data){
				document.getElementById('capimg').src = 'resource/captcha.php';
				$('.cap').val('');
				$('.pass').val('');
				if(data == 'correct') {
					$('.login_div').remove();
					$('.result').text('Вход выполнен успешно.');
					$('.result').css({display: 'block', backgroundColor: 'green'})
					window.location.assign("../profile");
				} else {
					$('.result').text(data);
					$('.result').css({display: 'block'})
				}
			}
		})
	})
	
});