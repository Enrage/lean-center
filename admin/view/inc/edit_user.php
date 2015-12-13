<?php defined('LEAN') or die('Access Denied'); ?>
<div id="content">
	<h3>Редактирование пользователя</h3>
	<?php if(isset($_SESSION['answer'])) {
		echo $_SESSION['answer'];
		unset($_SESSION['answer']); } ?>
	<form action="" method="post" enctype="multipart/form-data">
		<p>Имя пользователя:<br>
		<input type="text" name="name" placeholder="Имя пользователя" value="<?=$content[0]['name']?>"></p>

		<p>Email пользователя:<br>
		<input type="text" name="email" placeholder="Email пользователя" value="<?=$content[0]['email']?>"></p>

		<p>Пароль пользователя:<br>
		<input type="text" name="pass" placeholder="Пароль пользователя" value="<?=$content[0]['pass']?>"></p>

		<p>Статус пользователя:<br>
		<input type="text" name="status" placeholder="Статус пользователя" value="<?=$content[0]['status']?>"></p>

		<p>Компания:<br>
		<input type="text" name="company" placeholder="Компания" value="<?=$content[0]['company']?>"></p>

		<p>Дата регистрации:<br>
		<input type="text" name="reg_date" placeholder="Дата регистрации" value="<?=$content[0]['reg_date']?>" disabled></p>

		<p>Инофрмация о пользователе:<br>
		<textarea name="about" id="editor1"><?=$content[0]['about']?></textarea></p>

		<p>Аватар пользователя:<br>
		<img src="<?=config::PATH?>images/<?=$content[0]['user_img']?>" alt="<?=$content[0]['name']?>" width="300"></p>

		<p><input type="submit" name="save_user" value="Сохранить"></p>
	</form>
</div>