<?php defined('LEAN') or die('Access Denied'); ?>
<div id="content">
  <h3>Список событий</h3>
  <?php if(isset($_SESSION['answer'])) {
    echo $_SESSION['answer'];
    unset($_SESSION['answer']); } ?>
  <a href="?view=add_event" class="add_article">Добавить событие</a>
  <?php if (isset($content)): ?>
  <table id="articles">
    <tr>
      <th class="id_article">ID</th>
      <th class="title_article">Название события</th>
      <th class="add_date">Дата</th>
      <th class="link">Ссылка</th>
      <th class="del_article">del</th>
    </tr>
    <?php foreach ($content as $item): ?>
    <tr>
      <td class="id_article"><?=$item['id']?></td>
      <td class="title_article"><a href="?view=edit_event&amp;id=<?=$item['id']?>"><?=$item['title']?></a></td>
      <td><?=$item['date']?></td>
      <td class="link"><?=$item['link']?></td>
      <td class="del_article"><a href="?view=del_event&amp;id=<?=$item['id']?>"><img src="<?=config::ADMIN_TPL?>img/del.png" alt="Удалить событие"></a></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php endif; ?>
</div>