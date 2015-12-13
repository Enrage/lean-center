<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<section id="settings">
		<?php if(isset($_SESSION['auth']['user'])): ?>
		<h2>Настройки пользователя</h2>
		<?php if(isset($_SESSION['res']) && $content[0]['user_img'] != 'no_image.png') {
			echo $_SESSION['res'];
			unset($_SESSION['res']);}?>
		<form method="post" action="" enctype="multipart/form-data">
			<table class="profile_data">
				<tr>
					<td>Фотография:</td>
					<?php if($content[0]['user_img'] == 'no_image.png'): ?>
					<td class="img_profile"><input type="file" name="profile_img" class="add_img_profile"></td>
					<?php else: ?>
					<td class="img_profile"><img src="userfiles/profile_img/<?=$content[0]['user_img']?>" alt="<?=$content[0]['user_img']?>" class="user_img"><br>
					<span>Чтобы удалить картинку, кликните по ней</span></td>
					<?php endif; ?>
				</tr>
				<tr>
					<td>Имя, под которым Вы будете на сайте:</td>
					<td><input type="text" name="name" value="<?=$content[0]['name']?>"></td>
				</tr>
				<tr>
					<td>Название Вашей компании:</td>
					<td><input type="text" name="company_name" value="<?=$content[0]['company']?>"></td>
				</tr>
				<tr>
					<td>Прочая информация о себе:</td>
					<td><textarea name="about" id="settings_about" cols="25" rows="3"><?=$content[0]['about']?></textarea></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="settings_submit" value="Сохранить настройки"></td>
				</tr>
			</table>
		</form>
		<?php else: ?>
		<div class="error">Вы не вошли на сайт!</div>
		<?php endif; ?>
	</section>
</div> <!-- #content -->