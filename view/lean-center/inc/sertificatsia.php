<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<section id="sertificatsia">
		<h2>Про сертификацию оптимизаторов</h2>

		<p>Одной из задач нашего портала является разработка и внедрение системы сертификации профессиональных оптимизаторов в России.</p>

		<p>Это позволит упорядочить требования к LEAN-специалистам на проектах, облегчить организациям набор, оценку работы и администрирование таких работников, а также <b>повысить стоимость</b> оптимизаторов на рынке труда по сравнению с другими специалистами.</p>

		<p>В этой связи мы рады обсудить с LEAN-специалистами, как построить такую систему в России. Ваше мнение будет учтено при реализации и внедрении этого нововведения. Все, что Вам нужно сделать – это <a href="?view=reg">зарегистрироваться на портале</a> и из личного кабинета написать Администратору портала свои предложения по теме.</p>

		<p>Помимо оптимизаторов, приглашаем к участию в этом проекте другие организации, которые заинтересованы в структурировании этой темы. Вы можете получить статус <a href="?view=partneram">«Партнер проекта»</a> (информационное и другое сотрудничество) и <a href="?view=sponsoram">«Спонсор»</a> (поддержка портала, реклама на портале и в журнале <a href="?view=journal_lean">«Lean-center.ru»</a>). Хотите получить такие статусы – напишите нам на <a href="mailto:info@lean-center.ru">info@lean-center.ru</a></p>

		<p>С публикациями по данной теме можно ознакомиться <b>ниже</b>.</p>

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