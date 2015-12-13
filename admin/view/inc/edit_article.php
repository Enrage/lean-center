<?php defined('LEAN') or die('Access Denied'); ?>
<div id="content">
  <h3>Редактирование статьи</h3>
  <?php if(isset($_SESSION['answer'])) {
    echo $_SESSION['answer'];
    unset($_SESSION['answer']); } ?>
  <form action="" method="post" enctype="multipart/form-data">
    <p>Введите название статьи:<br>
    <input type="text" name="title" placeholder="Название статьи" value="<?=$content[0]['title']?>"></p>

    <p>Укажите категорию:<br>
    <input type="text" name="category" placeholder="Категория статьи" value="<?=$content[0]['category']?>"></p>

    <p>Выберите к каким разделам относится публикация:<br>
    <input type="checkbox" name="articles" value="1" <?php if($content[0]['articles']) echo 'checked' ?> id="part1"><label for="part1">Статьи</label><br>
    <input type="checkbox" name="news" value="1" <?php if($content[0]['news']) echo 'checked' ?> id="part2"><label for="part2">Новости LEAN</label><br>
    <input type="checkbox" name="history" value="1" <?php if($content[0]['history']) echo 'checked' ?> id="part3"><label for="part3">История проектов</label><br>
    <input type="checkbox" name="video" value="1" <?php if($content[0]['video']) echo 'checked' ?>
     id="part4"><label for="part4">Видео</label><br>
    <input type="checkbox" name="sertificatsia" value="1" <?php if($content[0]['sertificatsia']) echo 'checked' ?> id="part5"><label for="part5">Сертификация оптимизаторов</label></p>

    <p>Укажите первого автора (если есть):<br>
    <input type="text" name="author1" placeholder="Первый автор" value="<?=$content[0]['author1']?>"></p>

    <p>Выберите фотографию автора 1:<br>
    <input type="file" name="img_author1" value="<?=$content[0]['img_author1']?>"><br>
    <?php if (!empty($content[0]['img_author1'])): ?>
    <img src="<?=config::PATH?>images/<?=$content[0]['img_author1']?>" alt="<?=$content[0]['author1']?>">
    <?php endif; ?>
    </p>

    <p>Укажите второго автора (если есть):<br>
    <input type="text" name="author2" placeholder="Второй автор" value="<?=$content[0]['author2']?>"></p>

    <p>Выберите фотографию автора 2:<br>
    <input type="file" name="img_author2" value="<?=$content[0]['img_author2']?>"><br>
    <?php if (!empty($content[0]['img_author2'])): ?>
    <img src="<?=config::PATH?>images/<?=$content[0]['img_author2']?>" alt="<?=$content[0]['author2']?>">
    <?php endif; ?>
    </p>

    <p>Укажите ключевые слова (meta keywords):<br>
    <input type="text" name="keywords" placeholder="Ключевые слова" value="<?=$content[0]['keywords']?>"></p>

    <p>Укажите описание (meta description):<br>
    <input type="text" name="description" placeholder="Описание" value="<?=$content[0]['description']?>"></p>

    <p>Введите анонс публикации:<br>
    <textarea name="anons" id="editor1"><?=$content[0]['anons']?></textarea></p>

    <p>Введите полный текст публикации:<br>
    <textarea name="text" id="editor2"><?=$content[0]['text']?></textarea></p>

    <p>Введите дату добавления публикации:<br>
    <input type="text" name="add_date" placeholder="Дата добавления" value="<?=$content[0]['add_date']?>"></p>

    <p>Введите дату написания публикации:<br>
    <input type="text" name="date" placeholder="Дата написания" value="<?=$content[0]['date']?>"></p>

    <p>Выберите картинку для публикации:<br>
    <input type="file" name="img_src" value="<?=$content[0]['img_src']?>"><br>
    <img src="<?=config::PATH?>images/<?=$content[0]['img_src']?>" alt="<?=$content[0]['title']?>"></p>

    <p>Укажите источник публикации:<br>
    <input type="text" name="source" placeholder="Источник публикации" value="<?=$content[0]['source']?>"></p>

    <p>Укажите источник картинки:<br>
    <input type="text" name="img_source" placeholder="Источник картинки" value="<?=$content[0]['img_source']?>"></p>

    <p>Укажите тэги публикации:<br>
    <input type="text" name="tags" placeholder="Тэги" value="<?=$content[0]['tags']?>"></p>

    <p>Показывать публикацию:<br>
    <input type="radio" name="visible" id="visible1" <?php if($content[0]['visible']) echo 'checked' ?> value="1"><label for="visible1">Показывать</label><br>
    <input type="radio" name="visible" id="visible2" <?php if(!$content[0]['visible']) echo 'checked' ?> value="0"><label for="visible2">Скрывать</label></p>

    <p><input type="submit" name="save_article" value="Сохранить"></p>
  </form>
</div>
