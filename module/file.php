<?php 

class FileControll
{
	public $image;
	public $type;
	public function UploadImages($size = 2097152) {

		$whitelist = array(".jpeg", ".jpg", ".png", ".gif");
		$i = 0;
		foreach ($whitelist as $item) {
			if(preg_match("/$item\$/i", $this->image['name']) == 1) {
				$this->type = $item;
				$i++;
				break;
			}
		}
		if($i == 0) {
			echo "Ошибка при загрузки файла.\n";
			exit;
		}
		if($this->image['size'] > $size) {
			echo "Файл слишком большого размера.";
			exit;
		}
		$temp = getimagesize($this->image['tmp_name'])[0] / getimagesize($this->image['tmp_name'])[1];
		if($temp > 5 || $temp < 0.2) {
			echo "Некорректная ширина или высота.";
			exit;
		}
		if($this->type == ".jpeg" || $this->type == ".jpg") $this->image = imagecreatefromjpeg($this->image['tmp_name']);
		else if($this->type == ".png") $this->image = imagecreatefrompng($this->image['tmp_name']);
		else if($this->type == ".gif") $this->image = imagecreatefromgif($this->image['tmp_name']);
		

		return 1; 
	}
	public function SaveImage($dir, $name) {
		$uploaddir = '../www/'.$dir;
		$uploadfile = $uploaddir .''. $name .''.$this->type ;
		if($this->type = ".jpeg" || $this->type = ".jpg") $this->image = imagejpeg($this->image, $uploadfile);
		else if($this->type = ".png") $this->image = imagepng($this->image, $uploadfile);
		else if($this->type = ".gif") $this->image = imagegif($this->image, $uploadfile);
		echo "Файл успешно загружен.";
	}
	private function getWidth() {
		return imagesx($this->image);
	}
	private function getHeight() {
		return imagesy($this->image);
	}
	public function ResizeImagesScale($value = "100") {
		if($value != 100){

			$width = $this->getWidth() * $value/100;
			$height = $this->getHeight() * $value/100;
			$new_image = imagecreatetruecolor($width, $height);
			imagecopyresampled($new_image, $this->image, 0, 100, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());	
			$this->image = $new_image;
		}
	}
}

?>