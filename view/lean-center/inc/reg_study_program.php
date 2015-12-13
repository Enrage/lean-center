<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<section id="business_reg">
		<?php if(isset($_SESSION['reg']['res'])) {
			echo $_SESSION['reg']['res'];
			unset($_SESSION['reg']['res']);} ?>

		<?php if(isset($_SESSION['auth']) && !isset($_SESSION['auth']['user'])) {
			echo $_SESSION['auth']['error'];
			unset($_SESSION['auth']);} ?>
		<h3>Регистрация участников для ознакомления с программой обучения</h3>
		<form method="post" action="" id="reg_form">
			<table class="zavtrak">
				<tr>
					<td><span style="color:#c00; font-size:20px;">*</span></td>
					<td><input type="text" name="reg_name" id="reg_name" value="<?=$content['reg_name']?>" placeholder="Ваше имя"></td>
				</tr>
				<tr>
					<td><span style="color:#c00; font-size:20px;">*</span></td>
					<td><input type="text" name="reg_company" id="reg_company" value="<?=$content['reg_company']?>" placeholder="Название Вашей организации"></td>
				</tr>
				<tr>
					<td><span style="color:#c00; font-size:20px;">*</span></td>
					<td><input type="text" name="reg_phone" id="reg_phone" value="<?=$content['reg_phone']?>" placeholder="Ваш телефон"></td>
				</tr>
				<tr>
					<td><span style="color:#c00; font-size:20px;">*</span></td>
					<td><input type="text" name="reg_email" id="reg_email" value="<?=$content['reg_email']?>" placeholder="Ваш E-mail"></td>
				</tr>
			</table>
			<p class="small" style="color:#f77; font-size:12px;">Поля, помеченные * являются обязательными к заполнению.</p>
			<p class="small">Указанные вами реквизиты будут использованы исключительно для информирования Вас о программе обучения, но не для рассылки спама!!!</p>
			<input type="submit" name="reg_study_program" id="reg_business" value="Запросить программу обучения">
		</form>
	</section> <!-- #reg -->
</div> <!-- #content_reg -->