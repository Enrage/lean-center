<?php
defined('LEAN') or die('Access Denied');
class archive_events extends Core {
	public function get_content() {
		$events = $this->m->get_all_events();
		for($i = 0; $i < count($events); $i++) {
			$events[$i]['date'] = date('d.m.Y', $events[$i]['date']);
		}
		return $events;
	}
}
?>