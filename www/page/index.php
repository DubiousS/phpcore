<?php
global $s;
$s->theme_head('Сайт');

$bd = new DataBase();
$bd->Connect();
$result = $bd->Query('SELECT * FROM `people`');
if(!empty($result)) {
	var_dump($result);
}
$bd->Db_Q("DELETE FROM `people` WHERE `id` = :id", ['id'=> 2]);


?>
<a href="/index">Главная</a>
<a href="/crop">Фотография</a>

<?php
$s->theme_footer();
?>
