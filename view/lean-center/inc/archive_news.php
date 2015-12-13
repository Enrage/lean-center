<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<section id="archive_news">
		<h3>Архив новостей</h3>
		<?php foreach($content as $item): ?>
		<div class="archive_news">
			<p class="date"><?=$item['date']?></p>
			<h2><a href="<?=$item['link']?>"><?=$item['title']?></a></h2>
			<p><?=$item['anons']?></p>
		</div>
		<?php endforeach; ?>
	</section>
</div> <!-- #content -->