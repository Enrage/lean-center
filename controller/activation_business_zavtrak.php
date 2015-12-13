<?php
defined('LEAN') or die('Access Denied');
class activation_business_zavtrak extends Core {
	public function get_content() {
		$activate_business_zavtrak = $this->m->activate_business_zavtrak();
		if($activate_business_zavtrak) {
			$this->met->redirect('?view=main');
		}
	}
}
?>