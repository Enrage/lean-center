<?php
defined('LEAN') or die('Access Denied');
class anons extends Core {
	public function get_content() {
		if(isset($_GET['id'])) $id = abs((int)$_GET['id']);
		$res = $this->m->get_new($id);
		$res[0]['date'] = date('d.m.Y', $res[0]['date']);
		return $res;
	}
}
?>