<?php
global $s;
$s->theme_head('Сайт');
$file = new FileControll();
if(isset($_FILES['userfile'])) {
	$file->image = $_FILES['userfile'];
	$file->uploadImages("resource/");
}
?>

<form name="upload" action="" method="POST" ENCTYPE="multipart/form-data">
 Select the file to upload: <input type="file" name="userfile">
 <input type="submit" name="upload" value="upload">
</form>

<?php
$s->theme_footer();
?>
