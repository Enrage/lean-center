<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<section id="archive_events">
		<h3>Архив событий</h3>
		<?php foreach($content as $item): ?>
		<div class="archive_news">
			<p class="date"><?=$item['date']?></p>
			<h2><a href="<?=$item['link']?>" target="_blank"><?=$item['title']?></a></h2>
			<?=$item['anons']?>
		</div>
		<?php endforeach; ?>
	</section>
</div> <!-- #content -->