<?php
defined('LEAN') or die('Access Denied');
class reg_business extends Core {
	public function get_content() {
		if(isset($_POST['reg_business'])) {
			$this->m->business_reg();
			$this->met->redirect('?view=main');
		}
	}

	protected function session_reg_business() {
		$reg_name = isset($_SESSION['reg']['reg_name']) ? htmlspecialchars($_SESSION['reg']['reg_name']) : NULL;
		$reg_company = isset($_SESSION['reg']['reg_company']) ? htmlspecialchars($_SESSION['reg']['reg_company']) : NULL;
		$reg_phone = isset($_SESSION['reg']['reg_phone']) ? htmlspecialchars($_SESSION['reg']['reg_phone']) : NULL;
		$reg_email = isset($_SESSION['reg']['reg_email']) ? htmlspecialchars($_SESSION['reg']['reg_email']) : NULL;
		$product['reg_name'] = $reg_name;
		$product['reg_company'] = $reg_company;
		$product['reg_phone'] = $reg_phone;
		$product['reg_email'] = $reg_email;
		return $product;
	}
}
?>