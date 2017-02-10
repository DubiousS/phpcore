<?php
global $s;
$s->theme_head('Сайт');
$file = new FileControll();
if(isset($_FILES['userfile'])) {
	$file->image = $_FILES['userfile'];
	if($file->uploadImages()) {
		$name = $s->RandCode(10);
		//if($file->CropImages(400, 400, 300, 0)) echo 'Фотография обрезана.<br>';
		if($file->ResizeImagesScale(50)) echo 'Уменьшена на 50%.<br>';
		if($file->toHeight(500)) echo 'Высота уменьшена до 500 пикселей.<br>';
		if($file->toWidth(800)) echo 'Ширина уменьшена уменьшена до 800 пикселей.<br>';
		//if($file->Vod("../www/resource/5Hsp40ZGjU.jpeg", 100)) echo 'Водяной знак добавлен.<br>';
		if($file->SaveImage('resource/', $name)) echo 'Фотография сохранена.<br>';
	} else echo "Ошибка при загрузке файла.";
}
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
