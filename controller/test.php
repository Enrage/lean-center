<?php
defined('LEAN') or die('Access Denied');
class test extends Core {
	public function get_content() {
		return $this->t->get_tests();
	}

	protected function get_test() {
		if($_GET['view'] == 'test' && isset($_GET['test_id'])) {
			$test_id = (int)$_GET['test_id'];
			return $this->t->get_test_data($test_id);
		}
	}

	protected function nav() {
		if(isset($_GET['test_id'])) $test_id = (int)$_GET['test_id'];
		else $test_id = 1;
		$res = $this->t->get_test_data($test_id);
		if(is_array($res)) $count_questions = count($res);
		$pagination = $this->t->pagination($count_questions, $res);
		return $pagination;
	}

	protected function get_post() {
		if(isset($_POST['test'])) {
			$test = (int)$_POST['test'];
			unset($_POST['test']);
			$res = $this->t->get_correct_answers($test);
			if(!is_array($res)) die('Ошибка');
			// данные теста
			$test_all_data = $this->t->get_test_data($test);
			$test_all_data_result = $this->t->get_test_data_result($test_all_data, $res, $_POST);
			// $this->met->p_r($test_all_data_result);
			foreach ($test_all_data_result as $key => $item) {
				if(!isset($item['incorrect_answer'])) {
					$value = $value + $item['value'];
				}
			}
			if($value > 3) {
				$this->t->create_sert();
			}
			echo $this->t->print_result($test_all_data_result);
			// $this->met->p_r($value);
			die;
		}
	}
}
?>