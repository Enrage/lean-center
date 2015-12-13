<?php defined('LEAN') or die('Access Denied'); ?>
<div id="content">
	<h3>Редактирование новости</h3>
	<?php if(isset($_SESSION['answer'])) {
		echo $_SESSION['answer'];
		unset($_SESSION['answer']); } ?>
	<form action="" method="post" enctype="multipart/form-data">
		<p>Введите название новости:<br>
		<input type="text" name="title" placeholder="Название новости" value="<?=$content[0]['title']?>"></p>

		<p>Введите дату добавления новости:<br>
		<input type="text" name="date" placeholder="Дата добавления" value="<?=$content[0]['date']?>"></p>

		<p>Введите ссылку новости:<br>
		<input type="text" name="link" placeholder="Ссылка на новость" value="<?=$content[0]['link']?>"></p>

		<p>Укажите ключевые слова (meta keywords):<br>
		<input type="text" name="keywords" placeholder="Ключевые слова" value="<?=$content[0]['keywords']?>"></p>

		<p>Укажите описание (meta description):<br>
		<input type="text" name="description" placeholder="Описание" value="<?=$content[0]['description']?>"></p>

		<p>Введите анонс публикации:<br>
		<textarea name="anons" id="editor1"><?=$content[0]['anons']?></textarea></p>

		<p>Введите полный текст публикации:<br>
		<textarea name="text" id="editor2"><?=$content[0]['full_text']?></textarea></p>

		<p>Показывать новость:<br>
		<input type="radio" name="visible" id="visible1" <?php if($content[0]['visible']) echo 'checked' ?> value="1"><label for="visible1">Показывать</label><br>
		<input type="radio" name="visible" id="visible2" <?php if(!$content[0]['visible']) echo 'checked' ?> value="0"><label for="visible2">Скрывать</label></p>

		<p><input type="submit" name="save_new" value="Сохранить"></p>
	</form>
</div>