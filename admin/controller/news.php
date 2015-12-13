<?php
defined('LEAN') or die('Access Denied');
class news extends Core_Admin {
  public function get_content() {
  	$all_news = $this->m->get_all_news();
  	for($i = 0; $i < count($all_news); $i++) {
			$all_news[$i]['date'] = date('d.m.Y', $all_news[$i]['date']);
		}
    return $all_news;
  }
}
?>