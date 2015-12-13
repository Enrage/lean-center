<?php
defined('LEAN') or die('Access Denied');
class archive_news extends Core {
	public function get_content() {
		$news = $this->m->get_all_news();
		for($i = 0; $i < count($news); $i++) {
			$news[$i]['date'] = date('d.m.Y', $news[$i]['date']);
		}
		return $news;
	}
}
?>