<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<section id="journal">
		<h1>Журнал lean-center.ru</h1>
		<p>Коллеги!</p>
		<p>Мы начинаем издавать журнал "Lean-center.ru", в котором будут печататься самые интересные статьи авторов нашего портала, а также новости проектов с применением технологий Бережливого производства.</p>

		<p>Мы будем рады видеть Вас в авторах нашего журнала.</p>

		<p>Темы, которые будут наиболее востребованы в нашем журнале:</p>

		<ul>
			<li>Бережливое производством (LEAN)</li>
			<li>Технологии оптимизации процессов и рабочих мест</li>
			<li>Управление численностью персонала и нормирование труда</li>
			<li>Аутсорсинг</li>
			<li>Управление персоналом (HR)</li>
			<li>Развитие организаций</li>
			<li>Управление проектами</li>
			<li>Внедрение изменений</li>
		</ul><br>

		<p>Что нужно авторам для публикации статьи?</p>

		<ol>
			<li><a href="?view=reg">Войти</a> под своим логином (если Вы не зарегистрированы на портале - то сначала <a href="?view=reg">зарегистрироваться</a>)</li>
			<li>Из личного кабинета в разделе Профиль загрузить статью.</li>
			<li>После рассмотрения статьи, она будет опубликована на портале.</li>
		</ol><br>

		<p>Будем рады опубликовать Вашу статью в нашем журнале!</p>

		<p><b>Тэги:</b> <a href="?view=journal_lean">Журнал "lean-center.ru"</a></p>
	</section>

	<hr style="background:#777; height:1px; margin:0 30px 50px 0;">

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