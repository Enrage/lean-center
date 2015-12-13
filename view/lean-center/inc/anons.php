<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<section>
		<article class="article">
			<h3 class="date"><?=$content[0]['date']?></h3>
			<h1><?=$content[0]['title']?></h1>
			<?=$content[0]['full_text']?>
			<p class="tags">Tags: <a href="?view=news">Новости</a>, <a href="?view=video">Видео</a></p>
		</article> <!-- .article -->
	</section>
</div> <!-- #content -->