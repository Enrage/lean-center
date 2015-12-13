<?php
defined('LEAN') or die('Access Denied');
class business_zavtrak_users extends Core_Admin {
  public function get_content() {
  	$business_users = $this->m->get_all_business_zavtrak_users();
  // 	for($i = 0; $i < count($business_users); $i++) {
		// 	$business_users[$i]['date'] = date('d.m.Y', $business_users[$i]['date']);
		// }
    return $business_users;
  }
}
?>