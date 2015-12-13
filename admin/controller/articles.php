<?php
defined('LEAN') or die('Access Denied');
class articles extends Core_Admin {
  public function get_content() {
    return $this->m->get_all_articles();
  }
}
?>