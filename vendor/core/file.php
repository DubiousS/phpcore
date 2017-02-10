<?php 

class FileControll
{
	public $image;

	public $type;

	public function UploadImages($size = 2097152)
	{

		$whitelist = array(".jpeg", ".jpg", ".png", ".gif");
		
		$i = 0;
		
		foreach ($whitelist as $item) {
		
			if(preg_match("/$item\$/i", $this->image['name']) == 1) {
		
				if($item = '.jpg') $item = ".jpeg";
		
				$temp = getimagesize($this->image['tmp_name'])['mime'];
				$temp = stristr($temp, '/');
				$temp = '.'.substr($temp, 1);
		
				if($temp != $item) {
					unset($this->image);
					echo "Ошибка при загрузки файла.\n";
					exit;
				}
		
				$this->type = $item;
				$i++;
				break;
			}
		}
		
		if($i == 0) {
			unset($this->image);
			echo "Ошибка при загрузки файла.\n";
			exit;
		}
		
		if($this->image['size'] > $size) {
			unset($this->image);
			echo "Файл слишком большого размера.";
			exit;
		}
		
		$temp = getimagesize($this->image['tmp_name'])[0] / getimagesize($this->image['tmp_name'])[1];
		
		if($temp > 5 || $temp < 0.2) {
			unset($this->image);
			echo "Некорректная ширина или высота.";
			exit;
		}
		
		if($this->type == ".jpeg") $this->image = imagecreatefromjpeg($this->image['tmp_name']);
		else if($this->type == ".png") $this->image = imagecreatefrompng($this->image['tmp_name']);
		else if($this->type == ".gif") $this->image = imagecreatefromgif($this->image['tmp_name']);
		

		return 1; 
	}

	public function SaveImage($dir, $name)
	{
		if(isset($this->image)) {
			
			$uploaddir = '../www/'.$dir;
			$uploadfile = $uploaddir .''. $name .''.$this->type ;
			
			if($this->type = ".jpeg") $this->image = imagejpeg($this->image, $uploadfile);
			else if($this->type = ".png") $this->image = imagepng($this->image, $uploadfile);
			else if($this->type = ".gif") $this->image = imagegif($this->image, $uploadfile);
			
			echo "Файл успешно загружен.";
		} else { 
			
			echo 'Во время загрузки файла произошла ошибка.';
			unset($this->image);
		
		}
	}

	private function getWidth() 
	{
		
		return imagesx($this->image);
	}

	private function getHeight() 
	{

		return imagesy($this->image);
	}

	public function toHeight($height)
	{
		if(isset($this->image) && $height < $this->getHeight() && $height > 0) {
			$k = $this->getHeight() / $height;
			$width = $this->getHeight() / $k;
			$this->ResizeImages($width, $height);
		}
	}

	public function toWidth($width)
	{
		if(isset($this->image) && $width < $this->getWidth() && $width > 0) {
			$k = $this->getWidth() / $width;
			$height = $this->getHeight() / $k;
			$this->ResizeImages($width, $height);
		}
	}

	public function Vod($img, $h_r, $left = 0, $top = 0) 
	{
		if(!empty($img) && ($left > 0) && ($top > 0) && ($h_r > 0)){
			$type = getimagesize($img)['mime'];
			$w = getimagesize($img)[0];
			$h = getimagesize($img)[1];

			$w_r = $w / ($h / $h_r);

			if(($w_r + $left < $this->getWidth()) && ($h_r + $top < $this->getHeight())) {
				if($type == 'image/png') {
					$img = imagecreatefrompng($img);
				} elseif($type == 'image/jpeg') {
					$img = imagecreatefromjpeg($img);
				} elseif($type == 'image/gif') {
					$img = imagecreatefromgif($img);
				} else exit;

				$new = imagecreatetruecolor($w, $h);

				$transparent = imagecolorallocatealpha($new, 0, 0, 0, 127);
				imagefill($new, 0, 0, $transparent);

				imagecopyresampled($new, $img, 0, 0, 0, 0, $w_r, $h_r, $w, $h);
				imagecopy($this->image, $new, $left, $top, 0, 0, $w_r, $h_r);
			}
		}
	}

	public function Output() 
	{	
	}

	public function ResizeImagesScale($value = "100")
	{
		if($value != 100 && $value > 0 && $value < 200 && isset($this->image)) {

			$width = $this->getWidth() * $value/100;
			$height = $this->getHeight() * $value/100;
			$this->ResizeImages($width, $height);
		}
	}

	private function ResizeImages($width, $height)
	{	
		if(isset($this->image) && $width > 0 && $height > 0) {

			$new_image = imagecreatetruecolor($width, $height);
			
			imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
			
			$this->image = $new_image;	
		}
	}

	public function CropImages($width, $height, $top = 0, $left = 0)
	{	
		if(isset($this->image) && $width > 0 && $height > 0 && $top >= 0 && $left >= 0) {
			
			if(($width + $left < $this->getWidth()) && ($height + $top < $this->getHeight())) {
				
				$new_image = imagecreatetruecolor($width, $height);
				
				imagecopy($new_image, $this->image, 0, 0, $top, $left, $width, $height);
				
				$this->image = $new_image;
			
			} else {

				echo "Обрезка невозможна.\n";
				unset($this->image);
			}
		}
	}

	public function DeleteImage($image) 
	{
	
		unlink("$image");
	}

}

?>