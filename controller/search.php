<?php
defined('LEAN') or die('Access Denied');
class search extends Core {
	private $perpage;
	public function get_content() {
		$this->perpage = config::PERPAGE_ARTICLES;
		$search = $this->m->search();
		return $search;
	}

	protected function pos() {
		$result_search = $this->m->search();
		if(isset($_GET['page'])) {
			$page = (int)$_GET['page'];
			if($page < 1) $page = 1;
		} else $page = 1;
		$count_rows = count($result_search);
		$pages_count = ceil($count_rows / $this->perpage);
		if(empty($pages_count)) $pages_count = 1;
		if($page > $pages_count) $page = $pages_count;
		$start_pos = ($page - 1) * $this->perpage;
		$end_pos = $start_pos + $this->perpage;
		if($end_pos > $count_rows) $end_pos = $count_rows;
		$res['start_pos'] = $start_pos;
		$res['end_pos'] = $end_pos;
		$res['page'] = $page;
		$res['pages_count'] = $pages_count;
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