<?php
defined('LEAN') or die('Access Denied');
class reg_study_price extends Core {
	public function get_content() {
		if(isset($_POST['reg_study_price'])) {
			$this->m->reg_study_price();
			$this->met->redirect('?view=main');
		}

		$name = isset($_SESSION['reg']['reg_name']) ? htmlspecialchars($_SESSION['reg']['reg_name']) : null;
		$company = isset($_SESSION['reg']['reg_company']) ? htmlspecialchars($_SESSION['reg']['reg_company']) : null;
		$phone = isset($_SESSION['reg']['reg_phone']) ? htmlspecialchars($_SESSION['reg']['reg_phone']) : null;
		$email = isset($_SESSION['reg']['reg_email']) ? htmlspecialchars($_SESSION['reg']['reg_email']) : null;
		$quantity = isset($_SESSION['reg']['reg_quantity']) ? htmlspecialchars($_SESSION['reg']['reg_quantity']) : null;
		$res['reg_name'] = $name;
		$res['reg_company'] = $company;
		$res['reg_phone'] = $phone;
		$res['reg_email'] = $email;
		$res['reg_quantity'] = $quantity;
		return $res;
	}
}
?>