<?php
defined('LEAN') or die('Access Denied');
class authors extends Core {
	public function get_content() {
		$authors = $this->m->authors();
		return $authors;
	}
}
?>