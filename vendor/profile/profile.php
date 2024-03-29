<?php
namespace vendor\profile;

class profile
{

	public function codPass($pass)
	{
		$pass = md5(md5($pass).'cod'.md5($pass));
		return $pass;
	}

	public function Hash($length)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  
		while (strlen($code) < $length) {
			$code .= $chars[mt_rand(0, $clen)];  
		}
		return $code;
	}

	public function PageControll($p1) 
	{
		if(!isset($_SESSION['USER_LOGIN'])) {
			$_SESSION['USER_LOGIN'] = 0;
		}
		if($_SESSION['USER_LOGIN'] != $p1) exit(header("Location: /"));
	}

	public function Session($Row = "") {
		if(!empty($Row)) {
			$_SESSION['USER_LOGIN'] = '1';
			$_SESSION['USER_INFO'] = $Row;
		} else {
			unset($_SESSION['USER_LOGIN']);
			unset($_SESSION['USER_INFO']);
		}
	}

	public function cookie($Row = "", $hash = ""){
		if(!empty($Row) && !empty($hash)) {
			setcookie('hash', $hash, strtotime('+30 days'), '/');
			setcookie('user', $Row['id'], strtotime('+30 days'), '/');
		} else {
			setcookie('hash', '', strtotime('-30 days'), '/');
			setcookie('user', '', strtotime('-30 days'), '/');
			unset($_COOKIE['hash']);
			unset($_COOKIE['user']);
		}
	}


	public function logout()
	{
		if(isset($_GET['logout'])){
			$this->cookie();
			$this->Session();
			header("Location: /");
		}
	}
	

	public function CheckRegData($captcha, $login, $password, $email)
	{
		if(isset($_SESSION['captcha']) && isset($captcha) && isset($login) && isset($password) && isset($email)){
			if (($_SESSION['captcha'] != $this->codPass($captcha)) or !preg_match('/^[0-9]{1,5}$/', $captcha)) exit('Каптча введена неверно.');
			if((strlen($login) < 3) or (strlen($login) > 24)) exit('Длинна логина от 3 до 24 символов.');	
			if(!preg_match("/^[a-zA-Z0-9]+$/", $login)) exit('Логин может состоять из букв английского алфавита и цифр.');
			if((strlen($password) < 6) or (strlen($password) > 32)) exit('Длинна пароля от 6 до 32 символов.');
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) exit('Адрес электронной почты некорректен.');
			return 1;
		} else return 0;
	}


	public function CheckLogData($captcha, $login, $password)
	{
		if(isset($_SESSION['captcha']) && isset($captcha) && isset($login) && isset($password)){
			if (($_SESSION['captcha'] != $this->codPass($captcha)) or !preg_match('/^[0-9]{1,5}$/', $captcha)) exit('Каптча введена неверно.');
			if((strlen($login) < 3) or (strlen($login) > 24)) exit('Длинна логина от 3 до 24 символов.');
			if((strlen($password) < 6) or (strlen($password) > 32)) exit('Длинна пароля от 6 до 32 символов.');
			return 1;
		} else return 0;
	}
}
?>