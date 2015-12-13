<?php
defined('LEAN') or die('Access Denied');
class menu {
	public $m;
	public function get_menu() {
		$this->m = new model();
		$menu = $this->m->get_all_menu();
		return $menu;
	}
}
?>