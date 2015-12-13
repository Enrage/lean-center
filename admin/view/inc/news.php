<?php defined('LEAN') or die('Access Denied'); ?>
<div id="content">
  <h3>Список новостей</h3>
  <?php if(isset($_SESSION['answer'])) {
    echo $_SESSION['answer'];
    unset($_SESSION['answer']); } ?>
  <a href="?view=add_new" class="add_article">Добавить новость</a>
  <?php if (isset($content)): ?>
  <table id="articles">
    <tr>
      <th class="id_article">ID</th>
      <th class="title_article">Название новости</th>
      <th class="add_date">Дата</th>
      <th class="link">Ссылка</th>
      <th class="del_article">del</th>
    </tr>
    <?php foreach ($content as $item): ?>
    <tr>
      <td class="id_article"><?=$item['id']?></td>
      <td class="title_article"><a href="?view=edit_new&amp;id=<?=$item['id']?>"><?=$item['title']?></a></td>
      <td><?=$item['date']?></td>
      <td class="link"><?=$item['link']?></td>
      <td class="del_article"><a href="?view=del_new&amp;id=<?=$item['id']?>"><img src="<?=config::ADMIN_TPL?>img/del.png" alt="Удалить новость"></a></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php endif; ?>
</div>