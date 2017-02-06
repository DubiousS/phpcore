<?php
	session_start();
	function GHash($length) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  
		while (strlen($code) < $length) {
			$code .= $chars[mt_rand(0,$clen)];  
		}
		return $code;
	}
	function codPass($pass){
		$pass = md5(md5($pass).'cod'.md5($pass));
		return $pass;
	}
	function Connect(){
		include_once '../setting.php';
		$host=HOST;
		$db=DB;
		$DBH = new PDO("mysql:host=$host;dbname=$db", USER, PASS);
		$DBH->exec('SET NAMES UTF8');
		return $DBH;
	}
	if(!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['captcha'])) {
		if (($_SESSION['captcha'] != codPass($_POST['captcha'])) or !preg_match('/^[0-9]{1,5}$/', $_POST['captcha'])) exit('Каптча введена неверно.');
		if((strlen($_POST['login']) < 3) or (strlen($_POST['login']) > 24)) exit('Длинна логина от 3 до 24 символов.');
		if((strlen($_POST['password']) < 6) or (strlen($_POST['password']) > 32)) exit('Длинна пароля от 6 до 32 символов.');
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