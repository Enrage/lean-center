<?php defined('LEAN') or die('Access Denied'); ?>
<div id="content">
	<h3>Добавление новости</h3>
	<?php if(isset($_SESSION['add_user']['res'])) {
		echo $_SESSION['add_user']['res']; } ?>
	<form action="" method="post" enctype="multipart/form-data">
		<p>Введите имя пользователя:<br>
		<input type="text" name="name" placeholder="Имя пользователя"></p>

		<p>Введите email пользователя:<br>
		<input type="text" name="email" placeholder="Email пользователя" value="<?=$content['email']?>"></p>

		<p>Введите пароль пользователя:<br>
		<input type="password" name="pass" placeholder="Пароль" value="<?=$content['pass']?>"></p>

		<p>Укажите статус пользователя:<br>
		<input type="text" name="status" placeholder="Статус пользователя" value="<?=$content['status']?>"></p>

		<p>Название компании пользователя:<br>
		<input type="text" name="company" placeholder="Название компании пользователя" value="<?=$content['company']?>"></p>

		<p>Информация о пользователе:<br>
		<textarea name="about" id="editor1"><?=$content['about']?></textarea></p>

		<p>Дата регистрации:<br>
		<input type="text" name="reg_date" value="<?=$content['reg_date']?>" placeholder="Дата регистрации"></p>

		<p><input type="submit" name="save_user" value="Добавить пользователя"></p>
	</form>
	<?php unset($_SESSION['add_user']); ?>
</div>