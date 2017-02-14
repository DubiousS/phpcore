<?php
global $s;
$s->theme_head('Регистрация');

?>
<form name="registration" method="POST">
	<input type="login"  name="login"><br><br>
	<input type="password" name="password"><br><br>
	<input type="email" name="email"><br><br>
	<input type="captcha" name="captcha"><br><br>
	<img src="/resource/captcha.php" alt="" class="captcha"><br><br>
	<input type="submit" name="enter" value="Зарегистрироваться">
</form>

<?php
$s->theme_footer();
?>