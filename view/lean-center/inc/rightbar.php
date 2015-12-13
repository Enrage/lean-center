<?php defined('LEAN') or die('Access Denied')?>
<aside id="rightbar">

	<section id="anons_news">
		<h3>Новости LEAN-CENTER</h3>
		<?php foreach($this->m->get_news(config::LIMIT_NEWS) as $value): ?>
		<article>
			<p><span><?=$value['date']?></span><a href="<?=$value['link']?>"><?=$value['title']?></a></p>
			<p class="anons_text_news"><?=$value['anons']?></p>
		</article>
		<?php endforeach; ?>

		<p class="archive"><a href="?view=archive_news">Архив новостей</a></p>
	</section> <!-- #side_top_block -->

	<section id="event">
		<a href="http://www.openadvisors.ru/our_software" target="_blank"><img src="<?=config::TEMPLATE?>img/banner_po.png" width="300" alt="Event"></a>
	</section> <!-- #event -->

	<section id="news">
		<h3>Календарь событий</h3>

		<?php foreach($this->m->get_events(config::LIMIT_EVENTS) as $item): ?>
		<article>
			<p><span><?=$item['date']?></span><a href="<?=$item['link']?>" target="_blank"><?=$item['title']?></a></p>
			<p class="anons_text_news"><?=$item['anons']?></p>
		</article>
		<?php endforeach; ?>

		<p class="archive"><a href="?view=archive_events">Архив событий</a></p>
	</section> <!-- #news -->

	<section id="sertificatsia">
		<a href="?view=sertificatsia" title="Сертификация оптимизаторов" target="_blank"><img src="<?=config::PATH?>images/sertificatsia.png" alt="Сертификация оптимизаторов"></a>
	</section>

	<section id="openadvisors">
		<a href="http://www.openadvisors.ru/" target="_blank" title="Openadvisors.ru"><img src="<?=config::PATH?>images/openadvisors.png" alt="Open Advisors"></a>
	</section> <!-- #openadvisors -->

	<!-- Наши партнеры -->
	<section id="our_partners">
		<h3>Наши партнеры</h3>
		<table class="partners" cellspacing="1" color="#ccc">
			<tr>
				<td><a href="http://tvema.ru/" target="_blank" title="Компания «Твема»"><img src="images/tvema.png" height="100" alt="Компания «Твема»"></a></td>
			</tr>
			<tr>
				<td><a href="http://enter-audit.ru/" target="_blank" title="ООО «Энтер Аудит»"><img src="images/enter_audit.png" alt="ООО «Энтер Аудит»"></a></td>
			</tr>
			<tr>
				<td><a href="http://rark-kazan.ru/" target="_blank" title="Региональное агенство развития квалификаций"><img src="images/rark_kazan.jpg" alt="Региональное агенство развития квалификаций"></a></td>
			</tr>
			<tr>
				<td><a href="http://www.ippk-vologda.ru/" target="_blank" title="Негосударственное частное образовательное учреждение дополнительного профессионального образования специалистов «Институт переподготовки и повышения квалификации»"><img src="images/ippk.jpg" alt="Негосударственное частное образовательное учреждение дополнительного профессионального образования специалистов «Институт переподготовки и повышения квалификации»"></a></td>
			</tr>
			<tr>
				<td><a href="http://goo.gl/te7lxQ" target="_blank" title="Fast Forward"><img src="images/fastforward.jpg" alt="Fast Forward"></a></td>
			</tr>
		</table>
	</section> <!-- #our_partners -->

	<div id="counts" align="right">
		<!-- Yandex.Metrika informer --><a href="https://metrika.yandex.ru/stat/?id=31707641&amp;from=informer"target="_blank" rel="nofollow"><img src="https://mc.yandex.ru/informer/31707641/3_0_FFFFFFFF_EFEFEFFF_0_pageviews"style="width:88px; height:31px; border:0; margin:0 10px 0 0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:31707641,lang:'ru'});return false}catch(e){}" /></a><!-- /Yandex.Metrika informer --> <!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter31707641 = new Ya.Metrika({ id:31707641, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/31707641" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->

		<!--LiveInternet logo--><a href="//www.liveinternet.ru/click" target="_blank"><img src="//counter.yadro.ru/logo?11.2" title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня" alt="" border="0" width="88" height="31"/></a><!--/LiveInternet-->
	</div>
</aside> <!-- #rightbar -->
