<?php
defined('LEAN') or die('Access Denied');
class edit_event extends Core_Admin {
	public function get_content() {
		if(isset($_GET['id'])) $id = (int)$_GET['id'];
		if(isset($_POST['save_event'])) {
			if($this->m->edit_event($id)) $this->met->redirect("?view=events");
		}
		$get_event = $this->m->get_event($id);
		$get_event[0]['date'] = date('d.m.Y', $get_event[0]['date']);
		return $get_event;
	}
}