<?php
defined('LEAN') or die('Access Denied');
class article extends Core_Admin {
  public function get_content() {
    if(isset($_GET['id'])) $id = (int)$_GET['id'];
    return $this->m->get_article($id);
  }
}
?>