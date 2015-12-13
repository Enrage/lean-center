<?php defined('LEAN') or die('Access Denied')?>
<div id="content">
	<section>
		<?php if(isset($_SESSION['reg']['res'])) {
			echo $_SESSION['reg']['res'];
			unset($_SESSION['reg']['res']);} ?>
	</section>
</div> <!-- #content -->