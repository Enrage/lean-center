<?php
defined('LEAN') or die('Access Denied');
class events extends Core_Admin {
  public function get_content() {
  	$all_events = $this->m->get_all_events();
  	for($i = 0; $i < count($all_events); $i++) {
			$all_events[$i]['date'] = date('d.m.Y', $all_events[$i]['date']);
		}
    return $all_events;
  }
}
?>