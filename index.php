<?php
define('LEAN', true);
session_start();
header("Content-Type:text/html;charset=UTF-8");
ini_set('max_execution_time', 250);


function __autoload($c) {
	if(file_exists("controller/".$c.".php")) {
		require_once 'controller/'.$c.'.php';
	} elseif(file_exists("model/".$c.".php")) {
		require_once 'model/'.$c.'.php';
	}
}

$met = new method();
$model = new model();
if(isset($_POST['enter'])) {
  $model->authorization();
}

if(isset($_GET['view'])) {
  if($_GET['view'] == 'logout') {
    $met->logout();
    $met->redirect('?view=main');
  }
}

$class = isset($_GET['view']) ? trim(strip_tags($_GET['view'])) : 'main';
if(class_exists($class)) {
	$obj = new $class;
	$obj->get_body($class);
}
?>