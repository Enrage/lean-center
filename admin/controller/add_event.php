<?php
defined('LEAN') or die('Access Denied');
class add_event extends Core_Admin {
  public function get_content() {
		if($_POST) {
			if($this->m->add_event()) $this->met->redirect("?view=events");
			else $this->met->redirect();
		}

		$link = isset($_SESSION['add_event']['link']) ? htmlspecialchars($_SESSION['add_event']['link']) : null;
		$date = isset($_SESSION['add_event']['date']) ? htmlspecialchars($_SESSION['add_event']['date']) : null;
		$anons = isset($_SESSION['add_event']['anons']) ? htmlspecialchars($_SESSION['add_event']['anons']) : null;
		$add_event['link'] = $link;
		$add_event['date'] = $date;
		$add_event['anons'] = $anons;
		return $add_event;
  }
}
?>