<?php 
namespace vendore\file;

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
					
					return 0;
				}
				
				$this->type = $item;
				$i++;
				break;
			}
		}
		
		if($i == 0) {
			unset($this->image);
			
			return 0;
		}
		
		if($this->image['size'] > $size) {
			unset($this->image);

			return 0;
		}
		
		$temp = getimagesize($this->image['tmp_name'])[0] / getimagesize($this->image['tmp_name'])[1];
		
		if($temp > 5 || $temp < 0.2) {
			unset($this->image);

			return 0;
		}
		
		if($this->type == ".jpeg") $this->image = imagecreatefromjpeg($this->image['tmp_name']);
		else if($this->type == ".png") $this->image = imagecreatefrompng($this->image['tmp_name']);
		else if($this->type == ".gif") $this->image = imagecreatefromgif($this->image['tmp_name']);
		else return 0;

		return 1; 
	}

	public function SaveImage($dir, $name)
	{
		if(isset($this->image) && !empty($dir) && !empty($name)) {
			
			$uploaddir = '../www/'.$dir;
			$uploadfile = $uploaddir .''. $name .''.$this->type ;
			
			if($this->type = ".jpeg") $this->image = imagejpeg($this->image, $uploadfile);
			else if($this->type = ".png") $this->image = imagepng($this->image, $uploadfile);
			else if($this->type = ".gif") $this->image = imagegif($this->image, $uploadfile);
			else return 0;

			return 1;

		} else { 
			unset($this->image);
			return 0;
		}
	}

	public function getWidth() 
	{
		
		return imagesx($this->image);
	}

	public function getHeight() 
	{

		return imagesy($this->image);
	}

	public function toHeight($height)
	{
		if(isset($this->image) && $height < $this->getHeight() && $height > 0) {
			$k = $this->getHeight() / $height;
			$width = $this->getWidth() / $k;
			if($this->ResizeImages($width, $height)) return 1;
			else return 0;
		}
	}

	public function toWidth($width)
	{
		if(isset($this->image) && $width < $this->getWidth() && $width > 0) {
			$k = $this->getWidth() / $width;
			$height = $this->getHeight() / $k;
			if($this->ResizeImages($width, $height)) return 1;
			else return 0;
		}
	}

	public function Vod($img, $h_r, $left = 0, $top = 0) 
	{
		if(!empty($img) && ($left >= 0) && ($top >= 0) && ($h_r > 0)){
			if($img != $this->image) {

				if(!file_exists($img)) return 0;

				$type = getimagesize($img)['mime'];
				$w = getimagesize($img)[0];
				$h = getimagesize($img)[1];

				$w_r = $w / ($h / $h_r);

				
					if($type == 'image/png') {
						$img = imagecreatefrompng($img);
					} elseif($type == 'image/jpeg') {
						$img = imagecreatefromjpeg($img);
					} elseif($type == 'image/gif') {
						$img = imagecreatefromgif($img);
					} else return 0;;

			} else {

				$w = $this->getWidth();
				$h = $this->getHeight();

				$w_r = $w / ($h / $h_r);
			}
			if(($w_r + $left < $this->getWidth()) && ($h_r + $top < $this->getHeight())) {
				
				$new = imagecreatetruecolor($w, $h);

				$transparent = imagecolorallocatealpha($new, 0, 0, 0, 127);
				imagefill($new, 0, 0, $transparent);

				imagecopyresampled($new, $img, 0, 0, 0, 0, $w_r, $h_r, $w, $h);
				imagecopy($this->image, $new, $left, $top, 0, 0, $w_r, $h_r);
				return 1;
			} else  return 0;
		} else  return 0;
	}

	public function Output() 
	{
		if($this->type = ".jpeg") {
			header("Content-Type: images/jpeg");
			imagejpeg($this->image);
		}
		else if($this->type = ".png") {
			header("Content-Type: images/png");
			imagepng($this->image);
		}
			else if($this->type = ".gif") {
				header("Content-Type: images/gif");
				imagegif($this->image);
			}
			else return 0;
			
	}

	public function ResizeImagesScale($value = "100")
	{
		if($value != 100 && $value > 0 && $value < 200 && isset($this->image)) {

			$width = $this->getWidth() * $value/100;
			$height = $this->getHeight() * $value/100;

			if($this->ResizeImages($width, $height)) return 1;
			else  return 0;
		} else  return 0;
	}

	private function ResizeImages($width, $height)
	{	
		if(isset($this->image) && $width > 0 && $height > 0) {

			$new_image = imagecreatetruecolor($width, $height);
			
			imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
			
			$this->image = $new_image;
			return 1;	
		} else  return 0;
	}

	public function CropImages($width, $height, $top = 0, $left = 0)
	{	
		if(isset($this->image) && $width > 0 && $height > 0 && $top >= 0 && $left >= 0) {
			
			if(($width + $left < $this->getWidth()) && ($height + $top < $this->getHeight())) {
				
				$new_image = imagecreatetruecolor($width, $height);
				
				imagecopy($new_image, $this->image, 0, 0, $left, $top, $width, $height);
				
				$this->image = $new_image;

				return 1;

			} else return 0;
		} else  return 0;
	}

	public function DeleteImage($image) 
	{

		if(unlink("$image")) return 1;
		else return 0;
	}

}

?>