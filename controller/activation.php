<?php
defined('LEAN') or die('Access Denied');
class activation extends Core {
	public function get_content() {
		$activate = $this->m->activate();
		if($activate) {
			$this->met->redirect('?view=main');
		}
	}
}
?>