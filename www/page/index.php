<?php
global $s;
$s->theme_head('Сайт');
$file = new FileControll();

/*$bd = new DataBase();
$bd->Connect();
$result = $bd->Query('SELECT * FROM `people` WHERE id=:id AND `active` = 0', ['id' => 1]);
if(!empty($result)) {
	var_dump($result);
}
$bd->InsUpdDel("DELETE FROM `people` WHERE `id` = :id", ['id'=> 2]);
*/

?>
<img src="resource/<?php echo $name.''.$file->type;?>" width="500" alt="">
<form name="upload" action="" method="POST" ENCTYPE="multipart/form-data">
 Select the file to upload:<br><br><input type="file" name="userfile"><br><br>
 <input type="submit" name="upload" value="upload">
</form>

<?php
$s->theme_footer();
?>
