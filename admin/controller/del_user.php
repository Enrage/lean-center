<?php
defined('LEAN') or die('Access Denied');
class del_user extends Core_Admin {
	public function get_content() {
		if(isset($_GET['user_id'])) $user_id = (int)$_GET['user_id'];
		if($this->m->del_user($user_id)) $this->met->redirect("?view=users");
	}
}