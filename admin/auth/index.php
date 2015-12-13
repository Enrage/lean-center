<?php
if(!isset($_SESSION)) session_start();
if(!$_SESSION['auth']['admin']) {
	header("Location: enter.php");
	die();
} else {
	header("Location: admin/");
	die();
}
?>
