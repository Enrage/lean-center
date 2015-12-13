<?php defined('LEAN') or die('Access Denied'); ?>
<div id="content">
	<h3>Добавление новой статьи</h3>
	<?php if(isset($_SESSION['add_article']['res'])) {
		echo $_SESSION['add_article']['res'];
		} ?>
	<form action="" method="post" enctype="multipart/form-data">
		<p>Введите название статьи:<br>
		<input type="text" name="title" placeholder="Название статьи"></p>

		<p>Укажите категорию:<br>
		<input type="text" name="category" placeholder="Название статьи" value="<?=$content['category']?>"></p>

		<p>Выберите к каким разделам относится публикация:<br>
		<input type="checkbox" name="articles" value="1" id="part1"><label for="part1">Статьи</label><br>
		<input type="checkbox" name="news" value="1" id="part2"><label for="part2">Новости LEAN</label><br>
		<input type="checkbox" name="history" value="1" id="part3"><label for="part3">История проектов</label><br>
		<input type="checkbox" name="video" value="1" id="part4"><label for="part4">Видео</label><br>
		<input type="checkbox" name="sertificatsia" value="1" id="part5"><label for="part5">Сертификация оптимизаторов</label></p>

		<p>Укажите первого автора (если есть):<br>
		<input type="text" name="author1" placeholder="Первый автор" value="<?=$content['author1']?>"></p>

		<p>Выберите фотографию автора 1:<br>
		<input type="file" name="img_author1"><br></p>

		<p>Укажите второго автора (если есть):<br>
		<input type="text" name="author2" placeholder="Второй автор" value="<?=$content['author2']?>"></p>

		<p>Выберите фотографию автора 2:<br>
		<input type="file" name="img_author2"><br></p>

		<p>Укажите ключевые слова (meta keywords):<br>
		<input type="text" name="keywords" placeholder="Ключевые слова" value="<?=$content['keywords']?>"></p>

		<p>Укажите описание (meta description):<br>
		<input type="text" name="description" placeholder="Описание" value="<?=$content['description']?>"></p>

		<p>Введите анонс публикации:<br>
		<textarea name="anons" id="editor1"><?=$content['anons']?></textarea></p>

		<p>Введите полный текст публикации:<br>
		<textarea name="text" id="editor2"><?=$content['text']?></textarea></p>

		<p>Введите дату добавления публикации:<br>
		<input type="text" name="add_date" placeholder="Дата добавления" value="<?=$content['add_date']?>"></p>

		<p>Введите дату написания публикации:<br>
		<input type="text" name="date" placeholder="Дата написания" value="<?=$content['date']?>"></p>

		<p>Выберите картинку для публикации:<br>
		<input type="file" name="img_src"><br></p>

		<p>Укажите источник публикации:<br>
		<input type="text" name="source" placeholder="Источник публикации" value="<?=$content['source']?>"></p>

		<p>Укажите источник картинки:<br>
		<input type="text" name="img_source" placeholder="Источник картинки" value="<?=$content['img_source']?>"></p>

		<p>Укажите тэги публикации:<br>
		<input type="text" name="tags" placeholder="Тэги" value="<?=$content['tags']?>"></p>

		<p>Показывать публикацию:<br>
		<input type="radio" name="visible" id="visible1" value="1" checked><label for="visible1">Показывать</label><br>
		<input type="radio" name="visible" id="visible2" value="0"><label for="visible2">Скрывать</label></p>

		<p><input type="submit" name="add_article" value="Добавить статью"></p>
	</form>
	<?php unset($_SESSION['add_article']); ?>
</div>