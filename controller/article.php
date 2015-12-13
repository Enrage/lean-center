<?php
defined('LEAN') or die('Access Denied');
class article extends Core {
	private $article_id;
	public function get_content() {
		$this->article_id = isset($_GET['id']) ? (int)$_GET['id'] : null;
		$res = $this->m->get_article($this->article_id);

		if(isset($_POST['reg_tour'])) {
			$this->m->reg_japan_tour();
			$this->met->redirect();
		}

		if(isset($_POST['reg_business_seminar'])) {
			$this->m->business_reg();
			$this->met->redirect();
		}

		if(isset($_POST['submit_comment'])) {
			$this->m->add_comment($this->article_id);
			$this->met->redirect();
		}

		if($res[0]['active_src_link'] == 1) {
			$res[0]['source'] = "<a href='{$res[0]['source']}' target='_blank'>{$res[0]['source']}</a>";
		}
		$res[0]['add_date'] = date('d.m.Y', $res[0]['add_date']);
		return $res;
	}

	public function comments() {
		$comments = $this->m->get_comments($this->article_id);
		return $comments;
	}

	protected function session_article() {
		$name = isset($_SESSION['reg']['reg_name']) ? htmlspecialchars($_SESSION['reg']['reg_name']) : null;
		$company = isset($_SESSION['reg']['reg_company']) ? htmlspecialchars($_SESSION['reg']['reg_company']) : null;
		$phone = isset($_SESSION['reg']['reg_phone']) ? htmlspecialchars($_SESSION['reg']['reg_phone']) : null;
		$email = isset($_SESSION['reg']['reg_email']) ? htmlspecialchars($_SESSION['reg']['reg_email']) : null;
		$res['reg_name'] = $name;
		$res['reg_company'] = $company;
		$res['reg_phone'] = $phone;
		$res['reg_email'] = $email;
		return $res;
	}
}
?>