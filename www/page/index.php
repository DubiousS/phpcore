<?php
global $s;
$s->theme_head('Сайт');
$file = new FileControll();
if(isset($_FILES['userfile'])) {
	$file->image = $_FILES['userfile'];
	if($file->uploadImages()) {
		$file->ResizeImagesScale('200');
		$file->SaveImage('resource/', $s->RandCode(10));
	}
}
?>

<form name="upload" action="" method="POST" ENCTYPE="multipart/form-data">
 Select the file to upload:<br><br><input type="file" name="userfile"><br><br>
 <input type="submit" name="upload" value="upload">
</form>

<?php
$s->theme_footer();
?>
