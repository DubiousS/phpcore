<?php
global $s;
$s->theme_head('Сайт');

?>

 <div class="photo"><div id="crop"></div><img src="" alt="" width="100%" class="img"></div>


<form name="upload" method="POST" ENCTYPE="multipart/form-data">
 Select the file to upload:<br><br><input type="file" name="userfile" class="file"><br><br>
 <input type="submit" name="upload" value="upload">
</form>

<?php
$s->theme_footer();
?>
