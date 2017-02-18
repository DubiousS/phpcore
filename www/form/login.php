<?php
use vendor\profile\profile as profile;


if(!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['captcha'])) {
	require '/../xamp/htdocs/blog.local/vendor/profile/profile.php';
	require '/../xamp/htdocs/blog.local/vendor/core/DataBase.php';
	
	session_start();

	$log = new profile();
	$bd = new DataBase();
	if($bd->connect()) {
		if($log->CheckLogData($_POST['captcha'], $_POST['login'], $_POST['password'])) {
			$Row = $bd->Query("SELECT `login`, `password`, `id` FROM `user` WHERE `login`=:login", ['login'=> $_POST['login']]);
			if(!empty($Row)) {
				if($Row['password'] != $log->codPass($_POST['password'])) exit('Неверный логин или пароль.');
				$Row = $bd->Query("SELECT `login`, `email`, `id`, `active` FROM `user` WHERE `login`=:login", ['login'=> $_POST['login']], PDO::FETCH_ASSOC);
				$bd->IDU("UPDATE user SET hash=:hash WHERE login=:login", ['login'=> $_POST['login'], 'hash'=>$log->Hash(32)]);
				$log->cookie($Row);
				$log->Session($Row);
				exit('good');
			} else exit('Неверный логин или пароль.');
		} else exit;
	} else exit('Попробуйте позже. Приносим извинения.'); 
} else exit ('Поля не заполнены!');
?>