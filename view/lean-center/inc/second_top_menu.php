<?php defined('LEAN') or die('Access Denied')?>
<nav id="second_top_menu">
	<!-- <a href="#" class="lines"><img src="<?=config::TEMPLATE?>img/lines_icon.png" width="20" alt="Lines"></a> -->
	<ul>
		<li><a href="?view=news">Новости Lean</a></li>
		<li><a href="?view=history">История проектов</a></li>
		<li><a href="?view=sertificatsia">Сертификация оптимизаторов</a></li>
		<li><a href="?view=articles">Статьи</a></li>
		<li><a href="?view=authors">Авторы</a></li>
		<li><a href="?view=journal_lean">Журнал «lean-center.ru»</a></li>
		<li><a href="?view=cpobp">ЦПОБП</a></li>
		<li><a href="?view=videos">Видео</a></li>
	</ul>
	<p class="search"><img src="<?=config::TEMPLATE?>img/search_icon.png" width="26" alt="Поиск по сайту" title="Поиск по сайту"></p>
	<div class="search_block form_search">
		<form method="get" action="">
			<input type="hidden" name="view" value="search">
			<input type="text" name="search" placeholder="Поиск" id="search">
			<input type="submit" name="" id="search_submit" value="Поиск">
		</form>
	</div>
</nav> <!-- #second_top_menu -->