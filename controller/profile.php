<?php
defined('LEAN') or die('Access Denied');
class profile extends Core {
	public function get_content() {
		if(isset($_POST['submit_article'])) {
			$this->m->upload_article();
			$this->met->redirect();
		}
		$profile = $this->m->get_data_profile();
		$profile[0]['date'] = date('d.m.Y H:i:s', $profile[0]['reg_date']);
		return $profile;
	}
}
?>