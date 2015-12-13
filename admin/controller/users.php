<?php
defined('LEAN') or die('Access Denied');
class users extends Core_Admin {
  public function get_content() {
  	$all_users = $this->m->get_all_users();
  	for($i = 0; $i < count($all_users); $i++) {
			$all_users[$i]['reg_date'] = date('H:i:s d.m.Y', $all_users[$i]['reg_date']);
		}
    return $all_users;
  }
}
?>