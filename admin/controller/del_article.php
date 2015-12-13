<?php
defined('LEAN') or die('Access Denied');
class del_article extends Core_Admin {
	public function get_content() {
		if(isset($_GET['id'])) $id = (int)$_GET['id'];
		if($this->m->del_article($id)) $this->met->redirect("?view=articles");
	}
}