<?php defined('LEAN') or die('Access Denied'); ?>
<div id="content">
	<h3>Добавление нового события</h3>
	<?php if(isset($_SESSION['add_event']['res'])) {
		echo $_SESSION['add_event']['res']; } ?>
	<form action="" method="post" enctype="multipart/form-data">
		<p>Введите название события:<br>
		<input type="text" name="title" placeholder="Название события"></p>

		<p>Введите дату добавления события:<br>
		<input type="text" name="date" placeholder="Дата добавления" value="<?=$content['date']?>"></p>

		<p>Введите ссылку события:<br>
		<input type="text" name="link" placeholder="Ссылка на событие" value="<?=$content['link']?>"></p>

		<p>Введите анонс события:<br>
		<textarea name="anons" id="editor1"><?=$content['anons']?></textarea></p>

		<p><input type="submit" name="save_event" value="Добавить событие"></p>
	</form>
	<?php unset($_SESSION['add_event']); ?>
</div>