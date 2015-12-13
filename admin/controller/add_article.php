<?php
defined('LEAN') or die('Access Denied');
class add_article extends Core_Admin {
  public function get_content() {
    if($_POST) {
    	if($this->m->add_article()) $this->met->redirect("?view=articles");
    	else $this->met->redirect();
    }

    $category = isset($_SESSION['add_article']['category']) ? htmlspecialchars($_SESSION['add_article']['category']) : null;
    $author1 = isset($_SESSION['add_article']['author1']) ? htmlspecialchars($_SESSION['add_article']['author1']) : null;
    $author2 = isset($_SESSION['add_article']['author2']) ? htmlspecialchars($_SESSION['add_article']['author2']) : null;
    $anons = isset($_SESSION['add_article']['anons']) ? htmlspecialchars($_SESSION['add_article']['anons']) : null;
    $text = isset($_SESSION['add_article']['text']) ? htmlspecialchars($_SESSION['add_article']['text']) : null;
    $keywords = isset($_SESSION['add_article']['keywords']) ? htmlspecialchars($_SESSION['add_article']['keywords']) : null;
    $description = isset($_SESSION['add_article']['description']) ? htmlspecialchars($_SESSION['add_article']['description']) : null;
    $add_date = isset($_SESSION['add_article']['add_date']) ? htmlspecialchars($_SESSION['add_article']['add_date']) : null;
    $date = isset($_SESSION['add_article']['date']) ? htmlspecialchars($_SESSION['add_article']['date']) : null;
    $source = isset($_SESSION['add_article']['source']) ? htmlspecialchars($_SESSION['add_article']['source']) : null;
    $img_source = isset($_SESSION['add_article']['img_source']) ? htmlspecialchars($_SESSION['add_article']['img_source']) : null;
    $tags = isset($_SESSION['add_article']['tags']) ? htmlspecialchars($_SESSION['add_article']['tags']) : null;
    $add_article['category'] = $category;
    $add_article['author1'] = $author1;
    $add_article['author2'] = $author2;
    $add_article['anons'] = $anons;
    $add_article['text'] = $text;
    $add_article['keywords'] = $keywords;
    $add_article['description'] = $description;
    $add_article['add_date'] = $add_date;
    $add_article['date'] = $date;
    $add_article['source'] = $source;
    $add_article['img_source'] = $img_source;
    $add_article['tags'] = $tags;
    return $add_article;
  }
}
?>