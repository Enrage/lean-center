<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<section id="profile">
		<?php if(isset($_SESSION['auth']['user'])): ?>
		<h2>Личный кабинет</h2>
		<?php if(isset($_SESSION['res'])) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);}?>
		<table class="profile_data">
			<tr>
				<td>Фотография:</td>
				<td><img src="userfiles/profile_img/<?=$content[0]['user_img']?>" alt="<?=$content[0]['name']?>" class="img_user"></td>
			</tr>
			<tr>
				<td>Имя, под которым Вы будете на сайте:</td>
				<td><?=$content[0]['name']?></td>
			</tr>
			<tr>
				<td>Ваш Email:</td>
				<td><?=$content[0]['email']?></td>
			</tr>
			<tr>
				<td>Название Вашей компании:</td>
				<td><?=$content[0]['company']?></td>
			</tr>
			<tr>
				<td>Прочая информация о себе:</td>
				<td><?=$content[0]['about']?></td>
			</tr>
			<tr>
				<td>Присвоенный статус:</td>
				<td><?=$content[0]['status']?></td>
			</tr>
			<tr>
				<td>Список тем с Вашим участием:</td>
				<td></td>
			</tr>
			<tr>
				<td>Дата регистрации:</td>
				<td><?=$content[0]['date']?></td>
			</tr>
			<tr>
				<td>Загрузить свою статью<br><br>
					<form action="" method="post" enctype="multipart/form-data">
						<input type="file" name="add_article"><br><br>
						<input type="submit" name="submit_article" value="Подтвердить загрузку" class="">
					</form>
				</td>
			</tr>
		</table>
		<?php else: ?>
		<div class="error">Вы не вошли на сайт!</div>
		<?php endif; ?>
	</section>
</div> <!-- #content -->