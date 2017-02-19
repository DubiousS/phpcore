<?php
global $s;
global $profile;
$profile->PageControll(1);
$s->theme_head('Профиль');

?>

<div class="left">
	<a href="#"><div class="l_button"><div class="l_icon"></div><p>Лента</p></div><a>
	<a href="#"><div class="l_button"><div class="l_icon"><div class="l_new">50</div></div><p>Сообщения</p></div><a>
	<a href="#"><div class="l_button"><div class="l_icon"><div class="l_new">3</div></div><p>Друзья</p></div><a>
	<a href="#"><div class="l_button"><div class="l_icon"></div><p>Настройка</p></div><a>
	<a href="?logout"><div class="l_button"><div class="l_icon"></div><p>Выход</p></div><a>
	<hr>

</div>
<div class="content">
<div class="row_info">
	<div class="info_one">

	</div>
	<div class="info_two">
		<div class="info_two_cont">
			<img src="../resource/images/0.jpg" alt="">
			<div class="info_two_but_con">
				<div class="name"><?php echo $_SESSION['USER_INFO']['login']?></div>
				<div class="info_two_but">add</div>
				<div class="info_two_but">mess</div>
			</div>
		</div>
	</div>
</div>
<div class="main">
	<div class="item_form">
	</div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="item"></div>
	<div class="more">Ешчо</div>
</div>

<div class="stats_con">
	<canvas id="stats" width="960px" height="400px"></canvas>
	<canvas id="stats_two" width="640px" height="400px"></canvas>
</div>
</div>


<div class="message">
	<div class="close"></div>
	<div class="m_name"><p>Название</p></div>
	<div class="m_content">
	Текст
	</div>
</div>
  	<script type="text/javascript" src="js/stats.js"></script>	


<?php
$s->theme_footer();
?>