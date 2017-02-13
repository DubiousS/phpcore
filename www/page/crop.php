<?php
global $s;
$s->theme_head('Сайт');

?>

 <div class="photo"><div id="crop"></div><img src="" width="100%" class="img"></div>


<form name="upload" method="POST" ENCTYPE="multipart/form-data" class="form">
	<input type="file" name="userfile" class="file button_file"><input type="submit" name="upload" value="Загрузить" class="button_file">
</form>

<?php
$s->theme_footer();
?>
