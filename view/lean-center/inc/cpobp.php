<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<?php if(!empty($content)): ?>
	<?php $i = 0; ?>
	<?php foreach($content as $item): ?>
	<section class="block_news">
		<a href="?view=article&amp;id=<?=$item['id']?>" class="img_news"><img class="main_img" src="<?=config::PATH?>images/<?=$item['img_src']?>" alt="<?=$item['title']?>"></a>
		<article>
			<h3><?=$item['category']?></h3>
			<?php if(!empty($item['author1'])): ?>
			<h2><?=$item['author1']?></h2>
			<?php if(!empty($item['author2'])): ?>
			<h2><?=$item['author2']?></h2>
			<?php endif; ?>
			<?php endif; ?>
			<h1><a href="?view=article&amp;id=<?=$item['id']?>"><?=$item['title']?></a></h1>
			<p class="desc_news"><?=$item['anons']?></p>
			<p class="comments"><a href="?view=article&amp;id=<?=$item['id']?>" title="Комментарии"><img src="<?=config::TEMPLATE?>img/comment_icon.png" width="18" alt="Comments">&nbsp;<?=$this->count_comments()[$i]['count']?></a></p>
			<a href="?view=article&amp;id=<?=$item['id']?>" class="podrobnee">Читать далее</a>
		</article>
	</section> <!-- .block_news -->
	<?php $i++; ?>
	<?php endforeach; ?>
	<div class="clr"></div>

	<!-- Постраничная навигация -->
	<div class="pagination">
		<?php if($this->pos()['pages_count'] > 1) $this->met->pagination($this->pos()['page'], $this->pos()['pages_count']); ?>
	</div> <!-- .pagination -->

	<?php else: ?>
	<p>Публикаций пока нет</p>
	<?php endif; ?>
</div> <!-- #content -->