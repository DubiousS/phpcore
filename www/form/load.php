<?php
require '/../xamp/htdocs/blog.local/vendor/core/file.php';
print_r($_GET);
if(isset($_FILES['userfile'])) {
	$file = new FileControll();
	$file->image = $_FILES['userfile'];
	if($file->uploadImages()) {
		$wImg = $_GET['widthIm'];
		$k = $file->getWidth();
		$left = $_GET['left'] * 1;
		$top = $_GET['top'] * 1;
		$width = $_GET['width'];
		$height = $_GET['height'];
		$name = '123';

		echo $top. ' ';
		echo $left;
		
		if($file->toWidth($wImg)) echo "Ширина уменьшена уменьшена до $wImg пикселей.<br>";
		if($file->CropImages($width, $height, $top, $left)) echo 'Фотография обрезана.<br>';
		//if($file->toHeight(500)) echo 'Высота уменьшена до 500 пикселей.<br>';
		//if($file->Vod("../www/resource/pTVlnsfP8e.jpeg", 100, 100, 100)) echo 'Водяной знак добавлен.<br>';
		//if($file->ResizeImagesScale(50)) echo 'Уменьшена на 50%.<br>';
		if($file->SaveImage('../resource/', $name)) echo 'Фотография сохранена.<br>';
		//$file->Output();
	} else echo "Ошибка при загрузке файла.";
}
?>