<?php
defined('LEAN') or die('Access Denied');
class edit_user extends Core_Admin {
	public function get_content() {
		if(isset($_GET['user_id'])) $user_id = (int)$_GET['user_id'];
		if(isset($_POST['save_user'])) {
			if($this->m->edit_user($user_id)) $this->met->redirect("?view=users");
		}
		$get_user = $this->m->get_user($user_id);
		$get_user[0]['reg_date'] = date('H:i:s d.m.Y', $get_user[0]['reg_date']);
		return $get_user;
	}
}