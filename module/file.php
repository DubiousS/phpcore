<?php 

class FileControll
{

	public $image;

	public function UploadImages($dir = "", $size = 2097152) {

		$blacklist = array(".php", ".phtml", ".php3", ".php4", ".js", ".exe");
		foreach ($blacklist as $item) {
			if(preg_match("/$item\$/i", $this->image['name'])) {
				echo "Ошибка при загрузки файла.\n";
				exit;
			}
		}
		if($this->image['size'] > $size) {
			echo "Файл слишком большого размера.";
			exit;
		}

		$temp = $this->getWidth() / $this->getHeight();
		if($temp > 5 || $temp < 0.2) {
			echo "Некорректная ширина или высота.";
			exit;
		}

		$this->ResizeImagesScale('50');
		$uploaddir = '../www/'.$dir;
		$uploadfile = $uploaddir . basename($this->image['name']);


		if (move_uploaded_file($this->image['tmp_name'], $uploadfile)) {
			echo "Файл успешно загружен.\n";
		} else {
			echo "Ошибка при загрузки файла.\n";
		}

	}
	public function getWidth() {
		return getimagesize($this->image['tmp_name'])[0];
	}
	public function getHeight() {
		return getimagesize($this->image['tmp_name'])[1];
	}


	public function ResizeImagesScale($value = "100") {
		$width = $this->getWidth() * $value/100;
		$height = $this->getHeight() * $value/100;
		$new_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_image, $this->image['tmp_name'], 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		
	}
}

?>