<?php
require_once 'model/method.php';
class tests extends model {
	private $db;
	private $id;
	private $date;
	private $name;
	private $email;
	protected $met;
	public function __construct() {
		$this->db = db::getInstance();
		$this->date = time();
		$this->met = new method();
		$this->id = $_SESSION['auth']['user_id'] ?? null;
		$this->name = $_SESSION['auth']['user'] ?? null;
		$this->email = $_SESSION['auth']['email'] ?? null;
	}

	public function get_tests() {
		$query = "SELECT * FROM tests";
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function get_test_data($test_id) {
		if(!$test_id) return;
		$query = "SELECT q.question, q.value, q.parent_test, a.id, a.answer, a.parent_question FROM questions q LEFT JOIN answers a ON q.id = a.parent_question WHERE q.parent_test = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$test_id]);
		$row = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			if(!$row['parent_question']) return false;
			$data[$row['parent_question']]['value'] = $row['value'];
			$data[$row['parent_question']][0] = $row['question'];
			$data[$row['parent_question']][$row['id']] = $row['answer'];
		}
		return $data;
	}

	// Навигация по вопросам из билета
	public function pagination($count_questions, $res) {
		$keys = array_keys($res);
		$pagination = '<div class="paginat">';
		for($i = 1; $i <= $count_questions; $i++) {
			$key = array_shift($keys);
			if($i == 1) {
				$pagination .= '<a class="nav-active" href="#question-'.$key.'">'.$i.'</a>';
			} else {
				$pagination .= '<a href="#question-'.$key.'">'.$i.'</a>';
			}
		}
		$pagination .= '</div>';
		return $pagination;
	}

	// Получение правильных ответов
	public function get_correct_answers($test) {
		if(!$test) return false;
		$query = "SELECT q.id AS question_id, q.value AS value, a.id AS answer_id FROM questions q LEFT JOIN answers a ON q.id = a.parent_question WHERE q.parent_test = ? AND a.correct_answer = '1'";

		$stmt = $this->db->prepare($query);
		$stmt->execute([$test]);
		$data = [];
		while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[$rows['question_id']] = $rows['answer_id'];
		}
		return $data;
	}

	public function get_test_data_result($test_all_data, $result, $post) {
		$post = $_POST;
		$this->met->p_r($result);
		foreach($result as $q => $a) {
			$test_all_data[$q]['correct_answer'] = $a;

			if(!isset($_POST[$q])) {
				$test_all_data[$q]['incorrect_answer'] = 0;
			}
		}
		foreach($_POST as $q => $a) {

			if(!isset($test_all_data[$q])) {
				unset($_POST[$q]);
				continue;
			}
			if(!isset($test_all_data[$q][$a])) {
				$test_all_data[$q]['incorrect_answer'] = 0;
				continue;
			}
			if($test_all_data[$q]['correct_answer'] != $a) {
				$test_all_data[$q]['incorrect_answer'] = $a;
			} else {
				// Кол-во баллов
				$test_all_data['count_value'] += $test_all_data[$q]['value'];
			}
		}
		return $test_all_data;
	}

	// Вывод результатов теста
	public function print_result($test_all_data_result) {
		if(isset($test_all_data_result['count_value'])) $all_count = count($test_all_data_result) - 1;
		else $all_count = count($test_all_data_result); // Кол-во вопросов
		$correct_answer_count = 0; // Кол-во верных ответов
		$incorrect_answer_count = 0; // Кол-во неверных ответов
		$percent = 0; // Процент верных ответов
		$correct_value = 0; // Кол-во набранных баллов
		$print_res = "";
		foreach($test_all_data_result as $item) {
			if(isset($item['incorrect_answer'])) $incorrect_answer_count++;
			else $correct_value += $item['value'];
		}
		$correct_answer_count = $all_count - $incorrect_answer_count;
		$percent = round(($correct_answer_count / $all_count * 100), 2);
		$print_res .= '<div class="result_test">';
		// if($percent < 20) return '<p class="session false">Вы набрали менее 25% правильных ответов. Попробуйте еще раз.</p>';
		// if($correct_answer_count < 3) {
		// 	$print_res .= '<p class="session false">Извините, Вы не прошли тест!</p>';
		// }
		if($correct_value < 3) {
			$print_res .= '<p class="session false">Извините, Вы не прошли тест!</p>';
		}
		// if($correct_value < 30) {
		// 	$print_res .= '<p class="session false">Извините, Вы не прошли тест!</p>';
		// }
		elseif($correct_value > 2) {
			$print_res .= '<p class="session true">Поздравляем, Вы успешно сдали тестирование!</p>';
			$this->create_sert();
			$to = $_SESSION['auth']['email'];
			mailsend::sendMail($to, 'Успешное прохождение тестирования', 'Спасибо за прохождение тестирования', $_SERVER['DOCUMENT_ROOT']."/userfiles/tmp/cert_{$this->id}.png", '', '', '', true);
		}

		// Вывод результатов
		$print_res .= '<div class="questions">';
		$print_res .= '<div class="count-res">';
		$print_res .= "<p>Всего вопросов: <b>{$all_count}</b></p>";
		$print_res .= "<p><span style='color:green;'>Верно отвечено вопросов: </span><b>{$correct_answer_count}</b></p>";
		$print_res .= "<p><span style='color:red;'>Неверно отвечено вопросов: </span><b>{$incorrect_answer_count}</b></p>";
		$print_res .= "<p><span style='color:black;'>Набрано баллов: </span><b>{$correct_value}</b></p>";
		$print_res .= "<p>Процент верных ответов: <b>{$percent}%</b></p>";
		$print_res .= '</div>';
		// Вывод теста
		$print_res .= "<p class='n_question'>Ответы на вопросы:</p>";
		foreach($test_all_data_result as $id_question => $item) {
			$correct_answer = $item['correct_answer'];
			$incorrect_answer = null;
			if(isset($item['incorrect_answer'])) {
				$incorrect_answer = $item['incorrect_answer'];
				$class = 'question-res error';
			} else {
				$class = 'question-res ok';
			}
			$print_res .= "<div class='$class'>";
			foreach($item as $id_answer => $answer) { // массив ответов
				if(!$id_answer) {
					$print_res .= "<p class='q'>$answer</p>";
				} elseif(is_numeric($id_answer)) {
					// ответ
					if($id_answer == $correct_answer) {
						// если это верный ответ
						// $class = 'a ok2';
						$class = 'a';
					} elseif($id_answer == $incorrect_answer) {
						// если это неверный ответ
						$class = 'a error2';
					} else {
						$class = 'a';
					}
					$print_res .= "<p class='$class'>$answer</p>";
				}
			}
			$print_res .= "</div>"; // .question-res
		}
		$print_res .= '</div>'; // .questions
		$print_res .= '</div>'; // .result_test
		return $print_res;
	}

	/*private function load_png($img_name) {
		// $date = $this->date;
		// $email = $this->email;
		// $name = $this->name;
		$im = imagecreatefrompng($img_name);
		if (!$im) {
	    $im  = imagecreatetruecolor(150, 30);
	    $bgc = imagecolorallocate($im, 255, 255, 255);
	    $tc  = imagecolorallocate($im, 0, 0, 0);
	    imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
	    imagestring($im, 1, 5, 5, 'Error loading ' . $img_name, $tc);
		}
		$color = imagecolorallocate($im, 0, 180, 210);
		$font = $_SERVER['DOCUMENT_ROOT'].'/lean-center.ru/view/lean-center/fonts/pfagorasanspro-reg.ttf';
		$fs_date = 36;
		$fs_email = 30;
		$fs_name = 65;
		// imagestring($im, 35, 2500, 365, $date, $color);
		// putenv('GDFONTPATH=' . realpath('.'));
		imagettftext($im, $fs_date, 0, 2500, 365, $color, $font, $this->date);
		imagettftext($im, $fs_email, 0, 2500, 500, $color, $font, $this->email);
		imagettftext($im, $fs_name, 0, 1050, 980, $color, $font, $this->name);
		return $im;
	}*/

	private function create_sert() {
		$img = function($img_name) {
			$im = imagecreatefrompng($img_name);
			$color = imagecolorallocate($im, 0, 180, 210);
			$font = $_SERVER['DOCUMENT_ROOT'].'/view/lean-center/fonts/pfagorasanspro-reg.ttf';
			$fs_date = 36;
			$fs_email = 30;
			$fs_name = 65;
			$date = date('d.m.Y', $this->date);
			imagettftext($im, $fs_date, 0, 2500, 365, $color, $font, $date);
			imagettftext($im, $fs_email, 0, 2500, 500, $color, $font, $this->email);
			imagettftext($im, $fs_name, 0, 1050, 980, $color, $font, $this->name);
			return $im;
		};

		if(isset($_POST)) {
			header("Content-type: image/png");
			$i = $img($_SERVER['DOCUMENT_ROOT'].config::FILES.'cert.png');
			// $img = $this->load_png($_SERVER['DOCUMENT_ROOT'].'/lean-center.ru'.config::FILES.'cert.png');
			imagepng($i, $_SERVER['DOCUMENT_ROOT']."/userfiles/tmp/cert_{$this->id}.png");
			imagedestroy($i);
		}
	}
}
?>
