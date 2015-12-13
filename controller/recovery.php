<?php
defined('LEAN') or die('Access Denied');
class recovery extends Core {
	public function get_content() {
		if(isset($_POST['recover_submit'])) {
			$this->m->recovery();
			$this->met->redirect('?view=main');
		}
	}
}
?>