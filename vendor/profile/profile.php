<?php
namespace vendor\profile;

class profile
{

	public function codPass($pass){
		$pass = md5(md5($pass).'cod'.md5($pass));
		return $pass;
	}

	public function Hash($length)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  
		while (strlen($code) < $length) {
			$code .= $chars[mt_rand(0,$clen)];  
		}
		return $code;
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


}
?>