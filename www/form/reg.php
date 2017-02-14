<?php
		
	if(!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['email']) and !empty($_POST['captcha'])) {
		if(!empty($DBH)) {
			if(!empty($Result)) {
				
			} else {
				$hash = GHash(32);

				//mail($_POST['email'], ',', 'email', 'From: admin@admin.com');
				exit('correct');	
			}
		} else exit('Произошла ошибка. Попробуйте позже.');

	} else {
		exit('Поля не заполнены');
	}	
	
?>