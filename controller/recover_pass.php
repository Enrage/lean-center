<?php
defined('LEAN') or die('Access Denied');
class recover_pass extends Core {
	public function get_content() {
		if(isset($_POST['recover'])) {
			$recovery = $this->m->recovery_pass();
			$this->met->redirect();
		}
	}
}
?>