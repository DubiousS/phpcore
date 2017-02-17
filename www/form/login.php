<?php

	if(!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['captcha'])) {
		
		$DBH = Connect();
		if(!empty($DBH)) {
			$query=$DBH->prepare("SELECT `login`, `password`, `id` FROM `user` WHERE `login`=:login");
			$param = ['login'=> $_POST['login']];
			$query->execute($param);
			$Result = $query->fetchAll();
			if(!empty($Result)) {
				foreach($Result as $Row) {}
				if($Row['password'] != codPass($_POST['password'])) exit('Неверный логин или пароль.');
				$query=$DBH->prepare("SELECT `login`, `email`, `id`, `active` FROM `user` WHERE `login`=:login");
				$param = ['login'=> $_POST['login']];
				$query->execute($param);
				$Result = $query->fetchAll(PDO::FETCH_ASSOC);
				foreach($Result as $Row) {}
				$hash = GHash(32);
				$query = $DBH->prepare("UPDATE user SET hash=:hash WHERE login=:login");
				$param = ['login'=> $_POST['login'], 'hash'=> $hash];
				$query->execute($param);
				$_SESSION['USER_LOGIN'] = '1';
				$_SESSION['USER_INFO'] = $Result;
				setcookie('hash', $hash, strtotime('+30 days'), '/');
				setcookie('user', $Row['id'], strtotime('+30 days'), '/');
				unset($Result);
				exit('correct');
			} else exit('Неверный логин или пароль.');
		} else exit('Произошла ошибка. Попробуйте позже.');

	} else {
		exit('Поля не заполнены');
	}	
	
?>