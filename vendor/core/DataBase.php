<?php
class DataBase
{
	private $DBH;

	public function Connect()
	{
		if(empty($this->DBH)) {
			require  'setting.php';
			$host = HOST;
			$db = DB;
			try{
				$DBH = new PDO("mysql:host=$host;dbname=$db", USER, PASS);
				$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$DBH->exec('SET CHARACTER SET utf8');
				$this->DBH = $DBH;
				return $this->DBH;
			} 
			catch(PDOException $e) {    
    		//file_put_contents('log/error.log', $e->getMessage(), FILE_APPEND); 
			}
		} else {
			return $this->DBH;

		}
	}
	public function Query($param = "", $param2 = "")
	{
		if (!empty($this->DBH) && !empty($param) && !empty($param2)) {
			$query=($this->DBH)->prepare("$param");
			$query->execute($param2);
			$Result = $query->fetchAll();
			if(!empty($Result)) {
				foreach($Result as $row) {
				}
				return $row;
			} else return 0;
		}
	}

	public function Db_Q($param, $param2)
	{
		if (!empty($this->DBH)) {
			$query = ($this->DBH)->prepare("$param");
			$query->execute($param2);
		}
	}


	public function Like()
	{
		$query=$DBH->prepare("SELECT `FIO`, `id`, `info_one` FROM `people` WHERE `FIO` LIKE :input OR `info_one` LIKE :input AND `active`='1'");
		$param = ['input'=> "%$input%"];
		$query->execute($param);
		$Result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $Result;
	}

	public function CheckRegData()
	{
		if (($_SESSION['captcha'] != codPass($_POST['captcha'])) or !preg_match('/^[0-9]{1,5}$/', $_POST['captcha'])) exit('Каптча введена неверно.');
		if((strlen($_POST['login']) < 3) or (strlen($_POST['login']) > 24)) exit('Длинна логина от 3 до 24 символов.');	
		if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login'])) exit('Логин может состоять из букв английского алфавита и цифр.');
		if((strlen($_POST['password']) < 6) or (strlen($_POST['password']) > 32)) exit('Длинна пароля от 6 до 32 символов.');
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) exit('Адрес электронной почты некорректен.');
	}

}
?>