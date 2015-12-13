<?php
defined('LEAN') or die('Access Denied');
class journal_lean extends Core {
	private $start_pos;
	private $perpage;
	public function get_content() {
		$this->start_pos = $this->pos()['start_pos'];
		$this->perpage = config::PERPAGE_ARTICLES;
		$res = $this->m->get_journal_lean($this->start_pos, $this->perpage);
		// $res = $this->m->get_articles('Сертификация', $this->start_pos, $this->perpage);
		return $res;
	}

	protected function count_comments() {
		$res = $this->get_content();
		for($i = 0; $i < count($res); $i++) {
			$count_comments[] = $this->m->get_count_comments($res[$i]['id']);
		}
		return $count_comments;
	}

	protected function pos() {
		$this->perpage = config::PERPAGE_ARTICLES;
		if(isset($_GET['page'])) {
			$page = abs((int)$_GET['page']);
			if($page < 1) $page = 1;
		} else $page = 1;
		$count_rows = $this->m->count_rows_journal();
		$pages_count = ceil($count_rows / $this->perpage);
		if(empty($pages_count)) $pages_count = 1;
		if($page > $pages_count) $page = $pages_count;
		$this->start_pos = ($page - 1) * $this->perpage;
		$res['start_pos'] = $this->start_pos;
		$res['page'] = $page;
		$res['pages_count'] = $pages_count;
		return $res;
	}
}
?>