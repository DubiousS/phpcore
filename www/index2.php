<?php

							//COOKIE
if (!isset($_SESSION['USER_LOGIN']) and isset($_COOKIE['user']) and isset($_COOKIE['hash'])) {
	$query=$DBH->prepare("SELECT `login`, `email`, `id`, `active` FROM `user` WHERE `hash`=:hash AND `id`=:id");
	$param = ['hash'=> $_COOKIE['hash'], 'id' => $_COOKIE['user']];
	$query->execute($param);
	$Result = $query->fetchAll(PDO::FETCH_ASSOC);
	if (empty($Result)) {
		setcookie('hash', '', strtotime('-30 days'), '/');
		setcookie('user', '', strtotime('-30 days'), '/');
		unset($_COOKIE['hash']);
		unset($_COOKIE['user']);
	} else {
		$_SESSION['USER_LOGIN'] = '1';
		$_SESSION['USER_INFO'] = $Result;
	}
}
if (isset($_SESSION['USER_INFO'])) {
	foreach($_SESSION['USER_INFO'] as $user_info) {};
}
							//LOGOUT

							//Function
function PageControle($p1, $p2) {
	if(!isset($_SESSION['USER_LOGIN'])) {
		$_SESSION['USER_LOGIN'] = '0';
	}
	if ($p1 <= 0 and $_SESSION['USER_LOGIN'] != $p1) exit(header('Location: '.$p2));
		else if ($_SESSION['USER_LOGIN'] != $p1) exit(header('Location: '.$p2));
}
function Like($DBH, $input){//search bd
	$input = "%$input%";
	$query=$DBH->prepare("SELECT `FIO`, `id`, `info_one` FROM `people` WHERE `FIO` LIKE :input OR `info_one` LIKE :input AND `active`='1'");
	$param = ['input'=> $input];
	$query->execute($param);
	$Result = $query->fetchAll(PDO::FETCH_ASSOC);
	return $Result;
}
//Theme

?>
