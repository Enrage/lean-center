<?php
defined('LEAN') or die('Access Denied');
class add_new extends Core_Admin {
  public function get_content() {
		if($_POST) {
			if($this->m->add_new()) $this->met->redirect("?view=news");
			else $this->met->redirect();
		}

		$anons = isset($_SESSION['add_new']['anons']) ? htmlspecialchars($_SESSION['add_new']['anons']) : null;
		$full_text = isset($_SESSION['add_new']['full_text']) ? htmlspecialchars($_SESSION['add_new']['full_text']) : null;
		$keywords = isset($_SESSION['add_new']['keywords']) ? htmlspecialchars($_SESSION['add_new']['keywords']) : null;
		$description = isset($_SESSION['add_new']['description']) ? htmlspecialchars($_SESSION['add_new']['description']) : null;
		$link = isset($_SESSION['add_new']['link']) ? htmlspecialchars($_SESSION['add_new']['link']) : null;
		$date = isset($_SESSION['add_new']['date']) ? htmlspecialchars($_SESSION['add_new']['date']) : null;
		$add_new['anons'] = $anons;
		$add_new['full_text'] = $full_text;
		$add_new['keywords'] = $keywords;
		$add_new['description'] = $description;
		$add_new['link'] = $link;
		$add_new['date'] = $date;
		return $add_new;
  }
}
?>