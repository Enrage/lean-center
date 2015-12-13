<?php
defined('LEAN') or die('Access Denied');
class settings extends Core {
	public function get_content() {
		$profile = $this->m->get_data_profile();
		$profile[0]['date'] = date('d.m.Y H:i:s', $profile[0]['reg_date']);
		if(isset($_POST['settings_submit'])) {
			$this->m->edit_profile();
			if(isset($_FILES['profile_img'])) {
				$this->m->edit_img_profile();
			}
			$this->met->redirect('?view=profile');
		}
		if(isset($_GET['img'])) {
			$res = $this->m->del_img_profile();
			exit($res);
		}
		return $profile;
	}
}
?>