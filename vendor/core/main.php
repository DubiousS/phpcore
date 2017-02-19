<?php
namespace vendore\core;

class main
{

	public function theme_head($title)
	{
		include_once("theme/head.php");
	}

	public function theme_footer()
	{
		include_once("theme/footer.php");
	}

	public function RandCode($length)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  
		while (strlen($code) < $length) {
			$code .= $chars[mt_rand(0,$clen)];  
		}
		return $code;
	}

	

	public function NotFound()
	{
		header('HTTP/1.0 404 Not Found');
		exit('ERROR');
	}


	public function Page()
	{
		if($_SERVER['REQUEST_URI'] == '/') $Page = 'index';
		else{
			$Page = substr($_SERVER['REQUEST_URI'], 1);
			$get = stristr($Page, '?');
			if($get) {
				$Page = stristr($Page, $get, true);
			}
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



?>