<?php defined('LEAN') or die('Access Denied');
require_once 'top_head.php'; ?>
<?php if(isset($_GET['view']) && ($_GET['view'] == 'reg' || $_GET['view'] == 'recover_pass' || $_GET['view'] == 'recovery')): ?>
	<div id="wrapper_reg">
	<?php else: ?>
	<div id="wrapper">
	<?php endif; ?>
<?php
require_once 'header.php';
require_once 'top_block.php';
if(!isset($_GET['view']) || (isset($_GET['view']) && $_GET['view'] != 'reg')) {
	if(!isset($_GET['view']) || isset($_GET['view']) && $_GET['view'] != 'recover_pass') {
		if(!isset($_GET['view']) || isset($_GET['view']) && $_GET['view'] != 'recovery') {
			require_once 'second_top_menu.php';
		}
	}
} ?>
<div class="clr"></div>
	<?php if((isset($_GET['view']) && $_GET['view'] == 'reg') || (isset($_GET['view']) && ($_GET['view'] == 'recover_pass' || $_GET['view'] == 'recovery'))): ?>
	<div id="main_reg">
	<?php else: ?>
	<div id="main">
	<?php endif; ?>

	<?php require_once $inc.'.php'; ?>

	<?php if(!isset($_GET['view']) || isset($_GET['view']) && $_GET['view'] != 'reg') {
		if(!isset($_GET['view']) || isset($_GET['view']) && $_GET['view'] != 'recover_pass') {
			if(!isset($_GET['view']) || isset($_GET['view']) && $_GET['view'] != 'recovery') {
				require_once 'rightbar.php';
			}
		}
	} ?>
	</div> <!-- #main -->
</div> <!-- #wrapper -->
<div class="clr"></div>
<?php if(!isset($_GET['view']) || isset($_GET['view']) && $_GET['view'] != 'reg') {
	if(!isset($_GET['view']) || isset($_GET['view']) && $_GET['view'] != 'recover_pass') {
		if(!isset($_GET['view']) || isset($_GET['view']) && $_GET['view'] != 'recovery') {
			require_once 'footer.php';
		}
	}
} ?>
</body>
</html>