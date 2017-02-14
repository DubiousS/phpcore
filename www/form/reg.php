<?php
		
	if(!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['email']) and !empty($_POST['captcha'])) {
		if(!empty($DBH)) {
			if(!empty($Result)) {
				foreach($Result as $Row) {}
				if($Row['login'] == $_POST['login']) exit('Пользователь с таким именем уже существует.');
				if($Row['email'] == $_POST['email']) exit('Email занят.');
			} else {
				$password = codPass($_POST['password']);
				$hash = GHash(32);
				$query = $DBH->prepare("INSERT INTO user SET login=:login, password=:password, email=:email, hash=:hash, active=0");
				$param = ['login'=> $_POST['login'], 'password'=> $password, 'email'=> $_POST['email'], 'hash'=> $hash];
				$query->execute($param);
				//mail($_POST['email'], ',', 'email', 'From: admin@admin.com');
				exit('correct');	
			}
		} else exit('Произошла ошибка. Попробуйте позже.');

	} else {
		exit('Поля не заполнены');
	}	
	
?>