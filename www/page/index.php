<?php
global $s;
$s->theme_head('Сайт');

$bd = new DataBase();
$bd->Connect();
//$Result = $bd->Query("SELECT `login`, `email` FROM `user` WHERE `login`=:login OR `email`=:email", 
//			['login'=> $_POST['login'], 'email' => $_POST['email']]);
//var_dump($Result);
?>
<a href="/index">Главная</a>
<a href="/crop">Фотография</a>

<?php
$s->theme_footer();
?>
