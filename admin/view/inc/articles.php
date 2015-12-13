<?php defined('LEAN') or die('Access Denied'); ?>
<div id="content">
  <h3>Список статей</h3>
  <?php if(isset($_SESSION['answer'])) {
    echo $_SESSION['answer'];
    unset($_SESSION['answer']); } ?>
  <a href="?view=add_article" class="add_article">Добавить статью</a>
  <?php if (isset($content)): ?>
  <table id="articles">
    <tr>
      <th class="id_article">ID</th>
      <th class="title_article">Название статьи</th>
      <th>Автор1</th>
      <th>Автор2</th>
      <th class="add_date">Дата</th>
      <th class="visible">Vis</th>
      <th class="del_article">del</th>
    </tr>
    <?php foreach ($content as $item): ?>
    <tr>
      <td class="id_article"><?=$item['id']?></td>
      <td class="title_article"><a href="?view=edit_article&amp;id=<?=$item['id']?>"><?=$item['title']?></a></td>
      <td class="author_article"><?=$item['author1']?></td>
      <td class="author_article"><?=$item['author2']?></td>
      <td><?=$item['add_date']?></td>
      <?php if ($item['visible']): ?>
        <?php echo '<td>Yes</td>'; ?>
      <?php else: ?>
        <?php echo "<td>No</td>"; ?>
      <?php endif; ?>
      <td class="del_article"><a href="?view=del_article&amp;id=<?=$item['id']?>"><img src="<?=config::ADMIN_TPL?>img/del.png" alt="Удалить статью"></a></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php endif; ?>
</div>