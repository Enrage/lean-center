<?php defined('LEAN') or die('Access Denied');
$meta = new meta()?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="<?=$meta->get_content()['keywords']?>">
	<meta name="description" content="<?=$meta->get_content()['description']?>">
	<title><?=$meta->get_content()['title']?></title>
	<link rel="stylesheet" href="<?=config::TEMPLATE?>css/main.css">
	<script src="<?=config::TEMPLATE?>js/jquery.js"></script>
	<script src="<?=config::TEMPLATE?>js/common.js"></script>
	<script src="<?=config::TEMPLATE?>js/responsiveslides.min.js"></script>
	<!-- <script type="text/javascript">
		imageDir = "http://mvcreative.ru/example/6/2/snow/";
		sflakesMax = 65;
		sflakesMaxActive = 65;
		svMaxX = 0.5;
		svMaxY = 0.5;
		ssnowStick = 1;
		ssnowCollect = 0;
		sfollowMouse = 1;
		sflakeBottom = 0;
		susePNG = 1;
		sflakeTypes = 5;
		sflakeWidth = 15;
		sflakeHeight = 15;
	</script> -->
	<!-- <script type="text/javascript" src="http://mvcreative.ru/example/6/2/snow.js"></script> -->
	<?php if (isset($_GET['view']) && $_GET['view'] == 'article'): ?>
		<link rel="stylesheet" href="<?=config::TEMPLATE?>js/jquery.fancybox.css">
		<script src="<?=config::TEMPLATE?>js/jquery.fancybox.js"></script>
	<?php endif ?>
	<!--[if IE]>
		<script src="<?=config::TEMPLATE?>js/html5shiv.js"></script>
	<![endif]-->
	<!--[if IE 6]>
		<link rel="stylesheet" href="<?=config::TEMPLATE?>css/ie6.css">
		<script src="<?=config::TEMPLATE?>js/DD_belatedPNG.js"></script>
		<script>
			DD_belatedPNG.fix('a, img');
		</script>
		<script src="<?=config::TEMPLATE?>js/script_ie6.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?=config::TEMPLATE?>css/ie7.css">
		<script src="<?=config::TEMPLATE?>js/script_ie7.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if IE 8]>
		<link rel="stylesheet" href="<?=config::TEMPLATE?>css/ie8.css">
		<script src="<?=config::TEMPLATE?>js/script_ie8.js" type="text/javascript"></script>
	<![endif]-->
  <link href="lean-center-icon.png" rel="icon" type="image/png">
</head>
<body>

<!--LiveInternet counter--><script type="text/javascript"><!--
new Image().src = "//counter.yadro.ru/hit?r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random();//--></script><!--/LiveInternet-->