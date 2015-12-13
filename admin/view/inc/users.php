<?php defined('LEAN') or die('Access Denied'); ?>
<div id="content">
	<h3>Список зарегистрированных пользователей</h3>
	<?php if(isset($_SESSION['answer'])) {
		echo $_SESSION['answer'];
		unset($_SESSION['answer']); } ?>
	<a href="?view=add_user" class="add_user">Создать нового пользователя</a>
	<?php if (isset($content)): ?>
	<table id="articles">
		<tr>
			<th class="id_article">ID</th>
			<th class="title_article">Имя</th>
			<th class="link">Email</th>
			<th>Company</th>
			<th>Status</th>
			<th class="add_date">Дата</th>
			<th class="del_article">del</th>
		</tr>
		<?php foreach ($content as $item): ?>
		<tr>
			<td class="id_article"><?=$item['user_id']?></td>
			<td class="title_article"><a href="?view=edit_user&amp;user_id=<?=$item['user_id']?>"><?=$item['name']?></a></td>
			<td class="link"><?=$item['email']?></td>
			<td><?=$item['company']?></td>
			<td><?=$item['status']?></td>
			<td><?=$item['reg_date']?></td>
			<td class="del_article"><a href="?view=del_user&amp;user_id=<?=$item['user_id']?>"><img src="<?=config::ADMIN_TPL?>img/del.png" alt="Удалить пользователя"></a></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>