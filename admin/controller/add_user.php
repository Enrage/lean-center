<?php
defined('LEAN') or die('Access Denied');
class add_user extends Core_Admin {
  public function get_content() {
		if($_POST) {
			if($this->m->add_user()) $this->met->redirect("?view=users");
			else $this->met->redirect();
		}

		$email = isset($_SESSION['add_user']['email']) ? htmlspecialchars($_SESSION['add_user']['email']) : null;
		$pass = isset($_SESSION['add_user']['pass']) ? htmlspecialchars($_SESSION['add_user']['pass']) : null;
		$status = isset($_SESSION['add_user']['status']) ? htmlspecialchars($_SESSION['add_user']['status']) : null;
		$company = isset($_SESSION['add_user']['company']) ? htmlspecialchars($_SESSION['add_user']['company']) : null;
		$about = isset($_SESSION['add_user']['about']) ? htmlspecialchars($_SESSION['add_user']['about']) : null;
		$reg_date = isset($_SESSION['add_user']['reg_date']) ? htmlspecialchars($_SESSION['add_user']['reg_date']) : null;
		$add_user['email'] = $email;
		$add_user['pass'] = $pass;
		$add_user['status'] = $status;
		$add_user['company'] = $company;
		$add_user['about'] = $about;
		$add_user['reg_date'] = $reg_date;
		return $add_user;
  }
}
?>