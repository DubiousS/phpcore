class main
	theme_header('title');
	Query('SELECT * FROM `people` WHERE id=:id AND `active` = 0', ['id' => 1556567]);
	Insert('SELECT * FROM `people` WHERE id=:id AND `active` = 0', ['id' => 1556567]);
class file
	UploadImages($size = 2097152)
	SaveImage($dir, $name)
	toHeight($height)
	toWidth($width)
	Vod($img, $h_r, $left = 0, $top = 0) 
	ResizeImagesScale($value = "100")
	ResizeImages($width, $height)
	CropImages($width, $height, $top = 0, $left = 0)
	DeleteImage($image)
