<?php
defined('LEAN') or die('Access Denied');
class edit_article extends Core_Admin {
	public function get_content() {
		if(isset($_GET['id'])) $id = (int)$_GET['id'];
		if(isset($_POST['save_article'])) {
			if($this->m->edit_article($id)) $this->met->redirect("?view=articles");
		}
		return $this->m->get_article($id);
	}
}