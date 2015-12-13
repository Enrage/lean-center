<?php
defined('LEAN') or die('Access Denied');
class reg extends Core {
	public function get_content() {
		if(isset($_POST['reg'])) {
			$this->m->registration();
			$this->met->redirect('?view=main');
		}
	}
}
?>