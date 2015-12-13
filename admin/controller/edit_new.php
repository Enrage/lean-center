<?php
defined('LEAN') or die('Access Denied');
class edit_new extends Core_Admin {
	public function get_content() {
		if(isset($_GET['id'])) $id = (int)$_GET['id'];
		if(isset($_POST['save_new'])) {
			if($this->m->edit_new($id)) $this->met->redirect("?view=news");
		}
		$get_new = $this->m->get_new($id);
		$get_new[0]['date'] = date('d.m.Y', $get_new[0]['date']);
		return $get_new;
	}
}