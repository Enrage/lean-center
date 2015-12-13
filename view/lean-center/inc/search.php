<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<h3 class="search">Результаты поиска</h3>
	<?php if(isset($content['notfound'])): // Если ничего не найдено ?>
	<div class="notfound"><?php echo $content['notfound'];?></div>
	<?php else: ?>
	<?php for($i = $this->pos()['start_pos']; $i < $this->pos()['end_pos']; $i++): ?>
	<section class="block_news">
		<a href="?view=article&amp;id=<?=$content[$i]['id']?>" class="img_news"><img class="main_img" src="<?=config::PATH?>images/<?=$content[$i]['img_src']?>" alt="new1"></a>
		<article>
			<h3><?=$content[$i]['category']?></h3>
			<?php if(!empty($content[$i]['author1'])): ?>
			<h2><?=$content[$i]['author1']?></h2>
			<?php if(!empty($content[$i]['author2'])): ?>
			<h2><?=$content[$i]['author2']?></h2>
			<?php endif; ?>
			<?php endif; ?>
			<h1><a href="?view=article&amp;id=<?=$content[$i]['id']?>"><?=$content[$i]['title']?></a></h1>
			<p class="desc_news"><?=$content[$i]['anons']?></p>
			<p class="comments"><a href="?view=article&amp;id=<?=$item['id']?>" title="Комментарии"><img src="<?=config::TEMPLATE?>img/comment_icon.png" width="18" alt="Comments">&nbsp;<?=$this->count_comments()[$i]['count']?></a></p>
			<a href="?view=article&amp;id=<?=$content[$i]['id']?>" class="podrobnee">Читать далее</a>
		</article>
	</section> <!-- .block_news -->
	<?php endfor; ?>

	<div class="clr"></div>
	<div class="pagination">
		<?php if($this->pos()['pages_count'] > 1) $this->met->pagination($this->pos()['page'], $this->pos()['pages_count']); ?>
	</div>
	<?php endif; ?>
</div> <!-- #content -->