<?php
class main
{

	public function theme_head($title){
		include_once("theme/head.php");
	}

	public function RandCode($length) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  
		while (strlen($code) < $length) {
			$code .= $chars[mt_rand(0,$clen)];  
		}
		return $code;
	}

	public function theme_footer(){
		include_once("theme/footer.php");
	}

	public function NotFound() {
		header('HTTP/1.0 404 Not Found');
		exit('ERROR');
	}


	public function Page() {
		

		session_start();


		if($_SERVER['REQUEST_URI'] == '/') $Page = 'index';
		else{
			$Page = substr($_SERVER['REQUEST_URI'], 1);
			$get = stristr($Page, '?');
			if($get) {
				$Page = stristr($Page, $get, true);
			}
			unset($get);
			if(!preg_match('/^[A-z0-9]{3,15}$/', $Page)) $this->NotFound();
		}

		if (file_exists('page/'.$Page.'.php')) include("page/".$Page.".php");
			else if (file_exists('page/'.substr($Page, 0, 2).'.php')) {
			$id=substr($Page, 2);
			if(is_numeric($id)) include("page/".substr($Page, 0, 2).".php");
			else $this->NotFound();
		}
		else $this->NotFound();
	}
}
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
	public function Query($param, $param2) {
		if (!empty($this->DBH)) {
			$query=($this->DBH)->prepare("$param");
			$query->execute($param2);
			$Result = $query->fetchAll();
			if(!empty($Result)) {
				foreach($Result as $row) {
				}
				return $row;
			}
		}
	}

	public function InsUpdDel($param, $param2) {
		if (!empty($this->DBH)) {
			$query = ($this->DBH)->prepare("$param");
			$query->execute($param2);
		}
	}


	public function Like(){
		$query=$DBH->prepare("SELECT `FIO`, `id`, `info_one` FROM `people` WHERE `FIO` LIKE :input OR `info_one` LIKE :input AND `active`='1'");
		$param = ['input'=> "%$input%"];
		$query->execute($param);
		$Result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $Result;
	}
}


?>