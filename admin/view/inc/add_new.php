<?php defined('LEAN') or die('Access Denied'); ?>
<div id="content">
	<h3>Добавление новости</h3>
	<?php if(isset($_SESSION['add_new']['res'])) {
		echo $_SESSION['add_new']['res']; } ?>
	<form action="" method="post" enctype="multipart/form-data">
		<p>Введите название новости:<br>
		<input type="text" name="title" placeholder="Название новости"></p>

		<p>Введите дату добавления новости:<br>
		<input type="text" name="date" placeholder="Дата добавления" value="<?=$content['date']?>"></p>

		<p>Введите ссылку новости:<br>
		<input type="text" name="link" placeholder="Ссылка на новость" value="<?=$content['link']?>"></p>

		<p>Укажите ключевые слова (meta keywords):<br>
		<input type="text" name="keywords" placeholder="Ключевые слова" value="<?=$content['keywords']?>"></p>

		<p>Укажите описание (meta description):<br>
		<input type="text" name="description" placeholder="Описание" value="<?=$content['description']?>"></p>

		<p>Введите анонс публикации:<br>
		<textarea name="anons" id="editor1"><?=$content['anons']?></textarea></p>

		<p>Введите полный текст публикации:<br>
		<textarea name="text" id="editor2"><?=$content['full_text']?></textarea></p>

		<p>Показывать новость:<br>
		<input type="radio" name="visible" id="visible1" value="1"><label for="visible1">Показывать</label><br>
		<input type="radio" name="visible" id="visible2" value="0"><label for="visible2">Скрывать</label></p>

		<p><input type="submit" name="save_new" value="Добавить новость"></p>
	</form>
	<?php unset($_SESSION['add_new']); ?>
</div>