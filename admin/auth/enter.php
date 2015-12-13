<?php
define('LEAN', true);
session_start();
class enter {
	public $db;
  public $admin;
	public function __construct() {
		$this->db = db::getInstance();
    $this->admin = '1';
	}
}
include_once '../../db.php';
include_once '../../config.php';
if(isset($_SESSION['auth']['admin'])) {
	if($_SESSION['auth']['admin']) {
		header("Location: admin/");
		exit();
	}
}
$link = new enter();
if($_POST) {
	$email_lean = trim($_POST['email_lean']);
	$pass_lean = trim($_POST['pass_lean']);
	$query = "SELECT name, email, pass FROM users WHERE email = ? AND admin = ? LIMIT 1";
  $stmt = $link->db->prepare($query);
  $stmt->execute([$email_lean, $link->admin]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row['pass'] == md5($pass_lean)) {
		$_SESSION['auth']['admin'] = htmlspecialchars($row['email']);
		$_SESSION['auth']['name'] = $row['name'];
		header("Location: ../");
		exit();
	} else {
		$_SESSION['res'] = 'Логин или пароль не совпадает!';
		header("Location: {$_SERVER['PHP_SELF']}");
		exit();
	}
	$stmt->close();
}?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Admin-panel Lean-center</title>
	<style media="screen">
		* {
			margin: 0;
			padding: 0;
			outline: none;
			border: 0;
		}
		body {
			background: url(../view/img/body_bg.jpg);
		}
		.form_login {
			background: #eee;
			border-radius: 6px;
			width: 270px;
			height: 150px;
			padding: 30px 0 0;
			position: absolute;
			top: 50%;
			left: 50%;
			margin-left: -135px;
			margin-top: -150px;
			text-align: center;
		}
		h2 {
			font: 22px Tahoma, Arial, Verdana;
			color: #fff;
			text-align: center;
			position: absolute;
			top: 50%;
			left: 50%;
			margin-top: -200px;
			margin-left: -170px;
			width: 340px;
		}
		input[type=text], input[type=password] {
			background: #fff;
			border: 1px solid #bbb;
			margin: 8px;
			padding: 5px;
			width: 200px;
		}
		input[type=submit] {
			color: #333;
			background: #e2e2e2;
			border: 1px solid #aaa;
			font: 15px sans-serif, Tahoma, Arial, Verdana;
			margin: 15px 0 0;
			width: 140px;
			height: 30px;
			transition: all .6s ease;
		}
		input[type=submit]:hover {
			color: #000;
			cursor: pointer;
			background: #fff;
		}
	</style>
</head>
<body>
<div class="main">
	<h2>Administration Panel Lean-center</h2>
	<div class="form_login">
	<p style="font:14px sans-serif, Tahoma, Arial; position:absolute; color:#c00; top:10px; width:270px;"><?php
		if(isset($_SESSION['res'])) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);}?></p>
		<form action="" method="post" autocomplete="off" id="login">
			<p><input type="text" name="email_lean" placeholder="Username"></p>
			<p><input type="password" name="pass_lean" placeholder="Password"></p>
			<p><input id="subm" type="submit" value="Login"></p>
		</form>
	</div>
</div>
</body>
</html>
