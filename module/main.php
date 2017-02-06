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
	
	public function Connect()
	{

		require  'setting.php';
		$host = HOST;
		$db = DB;
		try{
			$DBH = new PDO("mysql:host=$host;dbname=$db", USER, PASS);
			$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$DBH->exec('SET CHARACTER SET utf8');
			return $DBH;
		} 
		catch(PDOException $e) {  
			echo "Произошла ошибка.";  
    		//file_put_contents('log/error.log', $e->getMessage(), FILE_APPEND); 
		}
	}
	public function Query($dbh)
	{
		if (!empty($dbh)) {
			$query=$dbh->prepare("SELECT * FROM `people` WHERE `id`=:id");
			$param = ['id'=> $id];
			$query->execute($param);
			$Result = $query->fetchAll();
			foreach($Result as $row) {
			}
			return $row;
		}
	}
}


?>