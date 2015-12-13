<?php defined('LEAN') or die('Access Denied'); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Panel Lean-center</title>
	<link rel="stylesheet" href="<?=config::ADMIN_TPL?>css/main.css">
	<link href="<?=config::TEMPLATE?>img/lean-center-icon.png" rel="icon" type="image/png">
	<script type="text/javascript" src="<?=config::PATH?>view/lean-center/js/jquery.js"></script>
	<script type="text/javascript" src="<?=config::ADMIN_TPL?>js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?=config::ADMIN_TPL?>js/common.js"></script>
</head>
<body>
<div id="wrapper" class="clearfix">
	<header>
		<div id="logo">
			<a href="?view=main"><img src="<?=config::ADMIN_TPL?>img/admin_icon.png" alt="Логотип"></a>
		</div>
		<div id="site">
			<a href="<?=config::PATH?>" title="Перейти на сайт" target="_blank">Перейти на сайт</a>
		</div>
		<div id="admin">
			<p>Администратор: <span><?=$_SESSION['auth']['name']?></span></p>
			<a href="?view=logout" class="exit">Выход</a>
		</div>
	</header>
