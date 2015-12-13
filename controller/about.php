<?php
defined('LEAN') or die('Access Denied');
class about extends Core {
	public function get_content() {
		ini_set('max_execution_time', 250);
		if(isset($_POST['send_mail'])) {
			$this->m->send_mail();
		}
	}
}
?>