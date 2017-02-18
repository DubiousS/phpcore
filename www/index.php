<?php
require_once __DIR__ . '/../vendor/core/main.php';
require_once __DIR__ . '/../vendor/core/DataBase.php';
require_once __DIR__ . '/../vendor/profile/profile.php';
use vendor\profile\profile as profile;
use vendore\core\main as main;

$bd = new DataBase();
$profile = new profile();
$s = new main();


if(!isset($_SESSION['USER_LOGIN']) && isset($_COOKIE['user']) && isset($_COOKIE['hash'])) {
	if($db->Connect()){
		$Row = $bd->Query("SELECT `login`, `email`, `id`, `active` FROM `user` WHERE `hash`=:hash AND `id`=:id", ['hash'=> $_COOKIE['hash'], 'id' => $_COOKIE['user']], PDO::FETCH_ASSOC);
		if(empty($Row)) {
			$profile->cookie();
		} else {
			$profile->Session($Row);
		}
	}
}
$profile->logout();
$s->Page();
?>