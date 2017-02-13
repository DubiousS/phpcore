<?php
use vendore\core\FileControll as FileC;

require '/../xamp/htdocs/blog.local/vendor/core/file.php';

if(isset($_FILES['userfile'])) {
	$file = new FileC();
	$file->image = $_FILES['userfile'];
	if($file->uploadImages()) {
		$wImg = $_GET['widthIm'];
		$k = $file->getWidth() / $wImg;
		$left = $_GET['left'] * 1 * $k;
		$top = $_GET['top'] * 1 * $k;
		$width = $_GET['width'] * $k;
		$height = $_GET['height'] * $k;
		$name = '123';
		
		//if($file->toWidth($wImg)) echo "Ширина уменьшена уменьшена до $wImg пикселей.<br>";
		if($file->CropImages($width, $height, $top, $left)) echo "Фотография обрезана.\n";
		//if($file->toHeight(500)) echo 'Высота уменьшена до 500 пикселей.<br>';
		//if($file->Vod("../www/resource/pTVlnsfP8e.jpeg", 100, 100, 100)) echo 'Водяной знак добавлен.<br>';
		if($file->ResizeImagesScale(50)) echo "Уменьшена на 50%.\n";
		if($file->SaveImage('../resource/', $name)) echo "Фотография сохранена.\n";
		//$file->Output();
	} else echo "Ошибка при загрузке файла.";
}
?>