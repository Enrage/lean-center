<?php defined('LEAN') or die('Access Denied')?>
<div id="content_reg">
	<section id="recover_pass">
		<?php if(isset($_SESSION['res'])) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);} ?>
		<section class="recover">
			<form action="" method="post">
				<p>Введите Ваш новый пароль:</p>
				<p><input type="password" id="recover_pass" name="recover_pass" placeholder="Новый пароль"></p>
				<p><input type="submit" id="recover" name="recover_submit" value="Восстановить"></p>
			</form>
		</section> <!-- .enter -->
	</section> <!-- #reg -->
</div> <!-- #content_reg -->