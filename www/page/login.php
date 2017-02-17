<?php
global $s;
$s->theme_head('Вход');

?>
<div class="container">
	<div class="registration">
		<form name="login" method="POST">
			<input type="login"  name="login" class="inp_reg" placeholder="Логин">
			<input type="password" name="password" class="inp_reg" placeholder="Пароль">
			<input type="captcha" name="captcha" class="inp_reg" placeholder="Каптча">
			<img src="../resource/script/captcha.php" alt="" class="captcha"><br>
			<input type="submit" name="enter" value="Войти" class="butt_l">
			<input type="button"  value="Зарегистрироваться" class="butt_r">
		</form>
	</div>
</div>

<?php
$s->theme_footer();
?>