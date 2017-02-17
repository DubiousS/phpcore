<?php
use vendor\profile\profile as profile;


if(!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['captcha'])) {
	require '/../xamp/htdocs/blog.local/vendor/profile/profile.php';
	require '/../xamp/htdocs/blog.local/vendor/core/DataBase.php';
	
	session_start();

	$reg = new profile();
	$bd = new DataBase();
	if($bd->connect()) {
		if($reg->CheckLogData($_POST['captcha'], $_POST['login'], $_POST['password'])) {
			$Row = $bd->Query("SELECT `login`, `password`, `id` FROM `user` WHERE `login`=:login", ['login'=> $_POST['login']]);
			if(!empty($Row)) {
				if($Row['password'] != $reg->codPass($_POST['password'])) exit($Row['password'].'='.$reg->codPass($_POST['password']).'Неверный логин или пароль.');
				$bd->Query("SELECT `login`, `email`, `id`, `active` FROM `user` WHERE `login`=:login", ['login'=> $_POST['login']]);
				$bd->IDU("UPDATE user SET hash=:hash WHERE login=:login", ['login'=> $_POST['login'], 'hash'=>$reg->Hash(32)]);

				$_SESSION['USER_LOGIN'] = '1';
				$_SESSION['USER_INFO'] = $Row;
				setcookie('hash', $reg->Hash(32), strtotime('+30 days'), '/');
				setcookie('user', $Row['id'], strtotime('+30 days'), '/');
				unset($Result);
				exit('good');
			} else exit('Неверный логин или пароль.');
		} else exit('00001');
	} else exit('Попробуйте позже. Приносим извинения.'); 
} else exit ('Поля не заполнены!');
?>