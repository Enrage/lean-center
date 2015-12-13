<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<section id="author">
		<h2>Авторы</h2>
		<?php if(!empty($content)): ?>
		<table class="authors">
			<?php foreach($content as $item): ?>
			<?php if(!empty($item['author1'])): ?>
			<tr>
				<?php if(!empty($item['img_author1'])): ?>
				<td width="100"><img src="images/<?=$item['img_author1']?>" alt="<?=$item['author1']?>" width="80"></td>
				<?php else: ?>
				<td width="100"><img src="images/user.png" alt="<?=$item['author1']?>" width="80"></td>
				<?php endif; ?>
				<td><a href="?view=author&amp;author=<?=$item['author1']?>"><?=$item['author1']?></a></td>
			</tr>
			<?php endif; ?>
			<?php endforeach; ?>
		</table>
		<?php endif; ?>
	</section>
</div> <!-- #content -->