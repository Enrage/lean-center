<?php
defined('LEAN') or die('Access Denied');
class author extends Core {
	public function get_content() {
		$author = $_GET['author'];
		$res = $this->m->get_author_articles($author);
		return $res;
	}

	protected function count_comments() {
		$res = $this->get_content();
		for($i = 0; $i < count($res); $i++) {
			$count_comments[] = $this->m->get_count_comments($res[$i]['id']);
		}
		return $count_comments;
	}
}
?>