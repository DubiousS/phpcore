<?php
class DataBase
{
	private $DBH;

	public function Connect()
	{
		if(empty($this->DBH)) {
			require  "../setting.php";
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
	public function Query($param = "", $param2 = "", $param3 = "")
	{
		if (!empty($this->DBH) && !empty($param) && !empty($param2)) {
			$query=($this->DBH)->prepare("$param");
			$query->execute($param2);
			if(!empty($param3)) {
				$Result = $query->fetchAll($param3);
			} else {
				$Result = $query->fetchAll();	
			}
			if(!empty($Result)) {
				foreach($Result as $row) {
				}
				return $row;
			} else return 0;
		}
	}

	public function IDU($param, $param2)
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

}
?>