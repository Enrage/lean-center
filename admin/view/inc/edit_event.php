<?php defined('LEAN') or die('Access Denied'); ?>
<div id="content">
	<h3>Редактирование события</h3>
	<?php if(isset($_SESSION['answer'])) {
		echo $_SESSION['answer'];
		unset($_SESSION['answer']); } ?>
	<form action="" method="post" enctype="multipart/form-data">
		<p>Введите название события:<br>
		<input type="text" name="title" placeholder="Название новости" value="<?=$content[0]['title']?>"></p>

		<p>Введите дату добавления события:<br>
		<input type="text" name="date" placeholder="Дата добавления" value="<?=$content[0]['date']?>"></p>

		<p>Введите ссылку события:<br>
		<input type="text" name="link" placeholder="Ссылка на новость" value="<?=$content[0]['link']?>"></p>

		<p>Введите анонс события:<br>
		<textarea name="anons" id="editor1"><?=$content[0]['anons']?></textarea></p>

		<p><input type="submit" name="save_event" value="Сохранить"></p>
	</form>
</div>