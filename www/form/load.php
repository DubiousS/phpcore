<?php
require '/../xamp/htdocs/blog.local/vendor/core/file.php';
if(isset($_POST["send"])) echo $_POST["send"];
var_dump($_POST);

$file = new FileControll();
if(isset($_FILES['userfile'])) {
	$file->image = $_FILES['userfile'];
	if($file->uploadImages()) {
		$name = '123';
		//if($file->CropImages(594, 704, 170, 8)) echo 'Фотография обрезана.<br>';
		//if($file->ResizeImagesScale(50)) echo 'Уменьшена на 50%.<br>';
		if($file->toHeight(500)) echo 'Высота уменьшена до 500 пикселей.<br>';
		//if($file->toWidth(800)) echo 'Ширина уменьшена уменьшена до 800 пикселей.<br>';
		//if($file->Vod("../www/resource/pTVlnsfP8e.jpeg", 100, 100, 100)) echo 'Водяной знак добавлен.<br>';
		if($file->SaveImage('../resource/', $name)) echo 'Фотография сохранена.<br>';
		//$file->Output();
	} else echo "Ошибка при загрузке файла.";
}
?>