<?php defined('LEAN') or die('Access Denied')?>
<div id="content_reg">
	<section id="recover_pass">
		<p class="result"><?php if(isset($_SESSION['res'])) {
				echo $_SESSION['res'];
				unset($_SESSION['res']);} ?></p>
		<section class="recover">
		<form action="" method="post">
			<p>Введите Ваш E-mail для восстановления пароля:</p>
			<p><input type="text" id="recover_email" name="recover_email" placeholder="E-mail"></p>
			<p><input type="submit" id="recover" name="recover" value="Восстановить"></p>
		</form>
		</section> <!-- .enter -->
	</section> <!-- #reg -->
</div> <!-- #content_reg -->