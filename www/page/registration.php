<?php
global $s;
$s->theme_head('Регистрация');

?>
<div class="container">
	<div class="registration">
		<form name="registration" method="POST">
			<input type="login"  name="login" class="inp_reg" placeholder="Логин">
			<input type="password" name="password" class="inp_reg" placeholder="Пароль">
			<input type="email" name="email" class="inp_reg" placeholder="E-Mail">
			<input type="captcha" name="captcha" class="inp_reg cap" placeholder="Каптча">
			<img src="/resource/captcha.php" alt="" class="captcha"><br>
			<input type="submit" name="enter" value="Зарегистрироваться" class="butt_l">
			<input type="button"  value="Войти" class="butt_r">
		</form>
	</div>
</div>

<?php
$s->theme_footer();
?>