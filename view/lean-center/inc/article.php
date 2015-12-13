<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<section>
		<?php if(!empty($content)): ?>
			<?php if(isset($_SESSION['reg']['res'])) {
				echo $_SESSION['reg']['res'];
				unset($_SESSION['reg']['res']); } ?>
		<article class="article">
			<section class="author_date_block clearfix">
				<?php if(!empty($content[0]['author1'])): ?>
				<?php if(!empty($content[0]['img_author1'])): ?>
				<div class="author">
					<a href="?view=author&amp;author=<?=$content[0]['author1']?>" title="Статьи с автором"><img src="images/<?=$content[0]['img_author1']?>" alt="<?=$content[0]['author1']?>"><?=$content[0]['author1']?></a>
				</div>
				<?php else: ?>
				<div class="author">
					<a href="?view=author&amp;author=<?=$content[0]['author1']?>" title="Статьи с автором"><img src="images/user.png" width="80" alt="<?=$content[0]['author1']?>"><?=$content[0]['author1']?></a>
				</div>
				<?php endif; ?>

				<?php if(!empty($content[0]['author2'])): ?>
				<?php if(!empty($content[0]['img_author2'])): ?>
				<div class="author">
					<a href="?view=author&amp;author=<?=$content[0]['author2']?>" title="Статьи с автором"><img src="images/<?=$content[0]['img_author2']?>" alt="<?=$content[0]['author2']?>"><?=$content[0]['author2']?></a>
				</div>
				<?php else: ?>
				<div class="author">
					<a href="?view=author&amp;author=<?=$content[0]['author2']?>" title="Статьи с автором"><img src="images/user.png" width="80" alt="<?=$content[0]['author2']?>"><?=$content[0]['author2']?></a>
				</div>
				<?php endif; ?>
				<?php endif; ?>
				<?php endif; ?>

				<h3 class="date">Дата публикации на портале <a href="http://lean-center.ru">lean-center.ru</a>:</h3>
				<p class="add_date"><?=$content[0]['add_date']?></p>
			</section>

			<!-- Статья id 101 -->
			<?php if (isset($_GET['id']) && $_GET['id'] == 101): ?>
				<img src="articles_img/audit_zavoda_profitex.jpg" alt="Производственный аудит завода «ПРОФИТЭКС»" style="width:580px; margin:0;">
			<?php endif ?>

			<h1><?=$content[0]['title']?></h1>
			<?=$content[0]['text']?>
			<div class="source_tags_block clearfix">
				<div class="source_block clearfix">
					<?php if(!empty($content[0]['source'])): ?>
					<p class="source"><b>Источник:</b>&nbsp; <span><?=$content[0]['source']?></span></p>
					<?php endif; ?>

					<?php if(!empty($content[0]['img_source'])): ?>
					<p class="source"><b>Фотография взята:</b>&nbsp; <span><?=$content[0]['img_source']?></span></p>
					<?php endif; ?>

					<?php if(!empty($content[0]['date'])): ?>
					<p class="date"><b>Дата:</b>&nbsp; <span><?=$content[0]['date']?></span></p>
					<?php endif; ?>
				</div>
				<!-- <p class="tags"><b>Тэги:</b>&nbsp; <a href="?view=news">Новости</a>, <a href="?view=videos">Видео</a></p> -->
			</div>

			<div id="comments">
				<?php if(isset($_SESSION['auth']['user'])): ?>
				<form method="post" action="">
				<?php if(isset($_SESSION['answer'])) {
					echo $_SESSION['answer'];
					unset($_SESSION['answer']); } ?>
					<p>Оставить комментарий</p>
					<textarea name="comment" cols="73" rows="5" id="add_comment"></textarea>
					<input type="submit" name="submit_comment" id="submit_comment" class="<?=(int)$_GET['id']?>" data="<?=$_SESSION['auth']['user']?>" value="Отправить">
				</form>
				<?php else: ?>
				<p class="need_auth">Чтобы оставить комментарий войдите на сайт или зарегистрируйтесь</p>
				<?php endif; ?>

				<h5>Комментарии:</h5>
				<?php if(!empty($this->comments())): ?>
				<?php foreach($this->comments() as $item): ?>
				<div class="block_comment">
					<p class="comment_author"><img class="comment_avatar" src="<?=config::PATH?>userfiles/profile_img/<?=$item['user_img']?>" alt="<?=$item['name']?>"><span> <?php if(empty($item['name'])) echo $item['email']; else echo $item['name']?></span><span><?=$item['date']?></span></p>
					<div class="clr"></div>
					<p class="comment"><?=$item['comment']?></p>
				</div>
				<?php endforeach; ?>
				<?php else: ?>
				<p class="no_comments">Комментариев пока нет</p>
				<?php endif; ?>

			</div>
		</article>
		<?php endif; ?>
	</section>
</div> <!-- #content -->