<?php defined('LEAN') or die('Access Denied');
$email = $_SESSION['auth']['email'] ?? null;
?>
<section id="top_block">
	<nav id="first_top_menu">
		<ul>
			<li><a href="?view=main">Главная</a></li>
			<li><a href="?view=about">О проекте</a></li>
			<li><a href="?view=azbuka_lean">Азбука LEAN</a></li>
		</ul>
	</nav>

	<a href="http://openadvisors.ru/" target="_blank"><img src="<?=config::TEMPLATE?>img/icon_oi.png" alt="">Обратиться к консультанту</a>

	<div id="logotip">
		<a href="?view=main">&nbsp;</a>
	</div>

	<nav id="right_top_menu">
		<ul>
			<li><a href="?view=authoram">Авторам</a></li>
			<li><a href="?view=partneram">Партнерам</a></li>
			<li><a href="?view=sponsoram">Спонсорам</a></li>
		</ul>
	</nav>

	<div id="enter">
		<?php if(isset($_SESSION['auth'])): ?>
			<?php if(!empty($_SESSION['auth']['user'])): ?>
			<p class="profile"><span><?=$_SESSION['auth']['user']?> <i>(Личный кабинет)</i></span></p>
			<?php elseif(!empty($_SESSION['auth']['email'])): ?>
			<p class="profile"><span><?=$_SESSION['auth']['email']?> <i>(Личный кабинет)</i></span></p>
			<?php endif; ?>
		<?php else: ?>
		<a href="?view=reg"><img src="<?=config::TEMPLATE?>img/enter.png" width="26" alt="Enter">Войти</a>
		<?php endif; ?>
		<div class="profile_blok">
			<ul>
				<li><a href="?view=profile"><img src="<?=config::TEMPLATE?>img/user_icon.png" alt="" width="18">Профиль</a></li>
				<li><a href="?view=settings"><img src="<?=config::TEMPLATE?>img/settings_icon.png" alt="" width="18">Настройки</a></li>
				<li><a href="?view=logout"><img src="<?=config::TEMPLATE?>img/exit_icon.png" alt="" width="18">Выйти</a></li>
			</ul>
		</div>
	</div>
</section> <!-- #top_block -->
