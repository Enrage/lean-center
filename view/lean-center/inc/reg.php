<?php defined('LEAN') or die('Access Denied')?>
<div id="content_reg">
	<section id="reg">
		<?php if(isset($_SESSION['reg']['res'])) {
			echo $_SESSION['reg']['res'];
			unset($_SESSION['reg']['res']);} ?>

		<?php if(isset($_SESSION['auth']) && !isset($_SESSION['auth']['user'])) {
			echo $_SESSION['auth']['error'];
			unset($_SESSION['auth']);} ?>
		<!-- Вход -->
		<section class="enter">
		<form action="" method="post">
			<input type="text" id="login" name="email" placeholder="E-mail">
			<input type="password" id="pass" name="pass" placeholder="Пароль">
			<input type="submit" id="submit_enter" name="enter" value="Войти">
			<div class="clr"></div>
			<label for="remember" class="remember">
				<input type="checkbox" name="remember" id="remember">Запомнить меня
			</label>
			<a href="?view=recover_pass" class="forget_pass">Забыли пароль?</a>
		</form>
		</section> <!-- .enter -->

		<section class="registration">
		<p><span>Впервые здесь?</span> Зарегистрироваться</p>
		<form method="post" action="" id="registr_form">
			<input type="text" name="reg_email" id="reg_email" placeholder="E-mail">
			<input type="password" name="reg_pass" id="reg_pass" placeholder="Пароль">
			<input type="submit" name="reg" id="submit_reg" value="Зарегистрироваться">
		</form>
		</section> <!-- .registration -->
	</section> <!-- #reg -->
</div> <!-- #content_reg -->