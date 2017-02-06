<?php
		
	if(!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['email']) and !empty($_POST['captcha'])) {
		if (($_SESSION['captcha'] != codPass($_POST['captcha'])) or !preg_match('/^[0-9]{1,5}$/', $_POST['captcha'])) exit('Каптча введена неверно.');
		if((strlen($_POST['login']) < 3) or (strlen($_POST['login']) > 24)) exit('Длинна логина от 3 до 24 символов.');		
		if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login'])) exit('Логин может состоять из букв английского алфавита и цифр.');
		if((strlen($_POST['password']) < 6) or (strlen($_POST['password']) > 32)) exit('Длинна пароля от 6 до 32 символов.');
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) exit('Адрес электронной почты некорректен.');
		$DBH = Connect();
		if(!empty($DBH)) {
			$query=$DBH->prepare("SELECT `login`, `email` FROM `user` WHERE `login`=:login OR `email`=:email");
			$param = ['login'=> $_POST['login'], 'email' => $_POST['email']];
			$query->execute($param);
			$Result = $query->fetchAll();
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