<?php
require '/../xamp/htdocs/blog.local/vendor/profile/profile.php';
require '/../xamp/htdocs/blog.local/vendor/core/DataBase.php';
use vendor\profile\profile as profile;
session_start();

$reg = new profile();
$bd = new DataBase();
if($bd->connect()) {
	if($reg->CheckRegData($_POST['captcha'], $_POST['login'], $_POST['password'], $_POST['email'])) {
		$Row = $bd->Query("SELECT `login`, `email` FROM `user` WHERE login = :login OR email = :email", ['login' => $_POST['login'], 'email' =>$_POST['email']]);
		if($Row['login'] == $_POST['login']) exit('Пользователь с таким именем уже существует.');
		if($Row['email'] == $_POST['email']) exit('Email занят.');
		$param = ['login'=> $_POST['login'], 'password'=> $reg->codPass($_POST['password']), 'email'=> $_POST['email'], 'hash'=> $reg->Hash(32)];
		$bd->IDU('INSERT INTO user SET login=:login, password=:password, email=:email, hash=:hash, active=0', $param);
		exit('good');
	}
}

?>