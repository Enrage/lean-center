<?php
defined('LEAN') or die('Access Denied');
require_once '../db.php';
class model {
	private $db;
	private $met;
  private $user_id;
	public function __construct() {
		$this->db = db::getInstance();
		$this->met = new method();
		if(isset($_SESSION['auth']['user'])) $this->user_id = $_SESSION['auth']['user_id'];
	}

	// Универсальный метод получения данных
	private function get_data($query, $data = []) {
		$stmt = $this->db->prepare($query);
		$stmt->execute([$data]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	// Вывод списка всех статей
	public function get_all_articles() {
		$query = "SELECT id, category, author1, author2, title, add_date, visible FROM articles ORDER BY id DESC";
		return $this->get_data($query, null);
	}

	// Получение данных конкретной статьи
	public function get_article($id) {
		$query = "SELECT * FROM articles WHERE id = ?";
		return $this->get_data($query, $id);
	}

	// Добавление новой статьи
	public function add_article() {
		$title = trim($_POST['title']);
		$category = trim($_POST['category']);
		$author1 = trim($_POST['author1']);
		$author2 = trim($_POST['author2']);
		$keywords = trim($_POST['keywords']);
		$description = trim($_POST['description']);
		$anons = trim($_POST['anons']);
		$text = trim($_POST['text']);
		$add_date = trim($_POST['add_date']);
		$date = trim($_POST['date']);
		$source = trim($_POST['source']);
		$img_source = trim($_POST['img_source']);
		$tags = trim($_POST['tags']);
		$visible = isset($_POST['visible']) ? (int)$_POST['visible'] : '0';
		$articles = isset($_POST['articles']) ? (int)$_POST['articles'] : '0';
		$news = isset($_POST['news']) ? (int)$_POST['news'] : '0';
		$history = isset($_POST['history']) ? (int)$_POST['history'] : '0';
		$video = isset($_POST['video']) ? (int)$_POST['video'] : '0';
		$sertificatsia = isset($_POST['sertificatsia']) ? (int)$_POST['sertificatsia'] : '0';

		if(empty($title)) {
			$_SESSION['add_article']['res'] = "<div class='error'>Должно быть название статьи!</div>";
			$_SESSION['add_article']['category'] = $category;
			$_SESSION['add_article']['author1'] = $author1;
			$_SESSION['add_article']['author2'] = $author2;
			$_SESSION['add_article']['anons'] = $anons;
			$_SESSION['add_article']['text'] = $text;
			$_SESSION['add_article']['keywords'] = $keywords;
			$_SESSION['add_article']['description'] = $description;
			$_SESSION['add_article']['add_date'] = $add_date;
			$_SESSION['add_article']['date'] = $date;
			$_SESSION['add_article']['source'] = $source;
			$_SESSION['add_article']['img_source'] = $img_source;
			$_SESSION['add_article']['tags'] = $tags;
			return false;
		} else {
			$query = "INSERT INTO articles (category, articles, news, history, video, sertificatsia, author1, author2, title, anons, text, keywords, description, add_date, date, source, img_source, tags, visible) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $this->db->prepare($query);
			$stmt->execute([$category, $articles, $news, $history, $video, $sertificatsia, $author1, $author2, $title, $anons, $text, $keywords, $description, $add_date, $date, $source, $img_source, $tags, $visible]);
			if($stmt->rowCount() > 0) {
				$_SESSION['answer'] = "<div class='success'>Вы успешно добавили статью!</div>";
				return true;
			}
		}
	}

	// Редактирование статьи
	public function edit_article($id) {
		$title = isset($_POST['title']) ? trim($_POST['title']) : '';
		$category = isset($_POST['category']) ? trim($_POST['category']) : '';
		$author1 = isset($_POST['author1']) ? trim($_POST['author1']) : '';
		$author2 = isset($_POST['author2']) ? trim($_POST['author2']) : '';
		$keywords = isset($_POST['keywords']) ? trim($_POST['keywords']) : '';
		$description = isset($_POST['description']) ? trim($_POST['description']) : '';
		$anons = isset($_POST['anons']) ? trim($_POST['anons']) : '';
		$text = isset($_POST['text']) ? trim($_POST['text']) : '';
		$add_date = isset($_POST['add_date']) ? trim($_POST['add_date']) : '';
		$date = isset($_POST['date']) ? trim($_POST['date']) : '';
		$source = isset($_POST['source']) ? trim($_POST['source']) : '';
		$img_source = isset($_POST['img_source']) ? trim($_POST['img_source']) : '';
		$tags = isset($_POST['tags']) ? trim($_POST['tags']) : '';
		$visible = isset($_POST['visible']) ? (int)$_POST['visible'] : '0';
		$articles = isset($_POST['articles']) ? (int)$_POST['articles'] : '0';
		$news = isset($_POST['news']) ? (int)$_POST['news'] : '0';
		$history = isset($_POST['history']) ? (int)$_POST['history'] : '0';
		$video = isset($_POST['video']) ? (int)$_POST['video'] : '0';
		$sertificatsia = isset($_POST['sertificatsia']) ? (int)$_POST['sertificatsia'] : '0';

		if(empty($title)) {
			$_SESSION['answer'] = 'Введите название статьи!';
			return false;
		} else {
			$query = "UPDATE articles SET title = ?, category = ?, author1 = ?, author2 = ?, keywords = ?, description = ?, anons = ?, text = ?, add_date = ?, date = ?, source = ?, img_source = ?, tags = ?, visible = ?, articles = ?, news = ?, history = ?, video = ?, sertificatsia = ? WHERE id = ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute([$title, $category, $author1, $author2, $keywords, $description, $anons, $text, $add_date, $date, $source, $img_source, $tags, $visible, $articles, $news, $history, $video, $sertificatsia, $id]);
			if($stmt->rowCount() > 0) {
				$_SESSION['answer'] = "<div class='success'>Вы успешно обновили статью!</div>";
				return true;
			} else {
				$_SESSION['answer'] = "<div class='error'>Ошибка обновления статьи!</div>";
				return false;
			}
		}
	}

	public function del_article($id) {
		$query = "DELETE FROM articles WHERE id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$id]);
		if($stmt->rowCount() > 0) {
			$_SESSION['answer'] = "<div class='success'>Вы успешно удалили статью!</div>";
			return true;
		} else {
			$_SESSION['answer'] = "<div class='error'>Ошибка удаления статьи!</div>";
			return false;
		}
	}

	// Вывод списка новостей
	public function get_all_news() {
		$query = "SELECT id, title, date, link FROM news";
		return $this->get_data($query, null);
	}

	// Данные отдельной новости
	public function get_new($id) {
		$query = "SELECT * FROM news WHERE id = ?";
		return $this->get_data($query, $id);
	}

	// Добавление новости
	public function add_new() {
		$title = trim($_POST['title']);
		$keywords = trim($_POST['keywords']);
		$description = trim($_POST['description']);
		$anons = trim($_POST['anons']);
		$full_text = trim($_POST['full_text']);
		$date = trim($_POST['date']);
		$link = trim($_POST['link']);
		$visible = isset($_POST['visible']) ? (int)$_POST['visible'] : '0';

		if(empty($title)) {
			$_SESSION['add_new']['res'] = "<div class='error'>Должно быть название новости!</div>";
			$_SESSION['add_new']['anons'] = $anons;
			$_SESSION['add_new']['full_text'] = $full_text;
			$_SESSION['add_new']['keywords'] = $keywords;
			$_SESSION['add_new']['description'] = $description;
			$_SESSION['add_new']['date'] = $date;
			$_SESSION['add_new']['link'] = $link;
			return false;
		} else {
			$date = strtotime($date);
			$query = "INSERT INTO news (title, anons, full_text, keywords, description, date, link) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$stmt = $this->db->prepare($query);
			$stmt->execute([$title, $anons, $full_text, $keywords, $description, $date, $link]);
			if($stmt->rowCount() > 0) {
				$_SESSION['answer'] = "<div class='success'>Вы успешно добавили новость!</div>";
				return true;
			} else {
				$_SESSION['answer'] = "<div class='error'>Ошибка добавления новости!</div>";
				return false;
			}
		}
	}

	// Редактирование новости
	public function edit_new($id) {
		$title = isset($_POST['title']) ? trim($_POST['title']) : '';
		$keywords = isset($_POST['keywords']) ? trim($_POST['keywords']) : '';
		$description = isset($_POST['description']) ? trim($_POST['description']) : '';
		$anons = isset($_POST['anons']) ? trim($_POST['anons']) : '';
		$full_text = isset($_POST['full_text']) ? trim($_POST['full_text']) : '';
		$date = isset($_POST['date']) ? trim($_POST['date']) : '';
		$link = isset($_POST['link']) ? trim($_POST['link']) : '';
		$visible = isset($_POST['visible']) ? (int)$_POST['visible'] : '0';

		if(empty($title)) {
			$_SESSION['answer'] = '<div class="error">Введите название новости!</div>';
			return false;
		} else {
			$date = strtotime($date);
			$query = "UPDATE news SET title = ?, keywords = ?, description = ?, anons = ?, full_text = ?, date = ?, link = ?, visible = ? WHERE id = ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute([$title, $keywords, $description, $anons, $full_text, $date, $link, $visible, $id]);
			if($stmt->rowCount() > 0) {
				$_SESSION['answer'] = "<div class='success'>Вы успешно обновили новость!</div>";
				return true;
			} else {
				$_SESSION['answer'] = "<div class='error'>Ошибка обновления новости!</div>";
				return false;
			}
		}
	}

	// Удаление новости
	public function del_new($id) {
		$query = "DELETE FROM news WHERE id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$id]);
		if($stmt->rowCount() > 0) {
			$_SESSION['answer'] = "<div class='success'>Вы успешно удалили новость!</div>";
			return true;
		} else {
			$_SESSION['answer'] = "<div class='error'>Ошибка удаления новости!</div>";
			return false;
		}
	}

	// Вывод списка событий
	public function get_all_events() {
		$query = "SELECT id, title, date, link FROM events";
		return $this->get_data($query, null);
	}

	// Данные отдельного события
	public function get_event($id) {
		$query = "SELECT * FROM events WHERE id = ?";
		return $this->get_data($query, $id);
	}

	// Добавление события
	public function add_event() {
		$title = trim($_POST['title']);
		$link = trim($_POST['link']);
		$date = trim($_POST['date']);
		$anons = trim($_POST['anons']);
		$visible = isset($_POST['visible']) ? (int)$_POST['visible'] : '1';

		if(empty($title)) {
			$_SESSION['add_event']['res'] = "<div class='error'>Должно быть название события!</div>";
			$_SESSION['add_event']['link'] = $link;
			$_SESSION['add_event']['date'] = $date;
			$_SESSION['add_event']['anons'] = $anons;
			return false;
		} else {
			$date = strtotime($date);
			$query = "INSERT INTO events (title, link, date, anons) VALUES (?, ?, ?, ?)";
			$stmt = $this->db->prepare($query);
			$stmt->execute([$title, $link, $date, $anons]);
			if($stmt->rowCount() > 0) {
				$_SESSION['answer'] = "<div class='success'>Вы успешно добавили событие!</div>";
				return true;
			} else {
				$_SESSION['answer'] = "<div class='error'>Ошибка добавления события!</div>";
				return false;
			}
		}
	}

	// Редактирование события
	public function edit_event($id) {
		$title = isset($_POST['title']) ? trim($_POST['title']) : '';
		$link = isset($_POST['link']) ? trim($_POST['link']) : '';
		$date = isset($_POST['date']) ? trim($_POST['date']) : '';
		$anons = isset($_POST['anons']) ? trim($_POST['anons']) : '';
		$visible = isset($_POST['visible']) ? (int)$_POST['visible'] : '1';

		if(empty($title)) {
			$_SESSION['answer'] = '<div class="error">Введите название события!</div>';
			return false;
		} else {
			$date = strtotime($date);
			$query = "UPDATE events SET title = ?, link = ?, date = ?, anons = ?, visible = ? WHERE id = ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute([$title, $link, $date, $anons, $visible, $id]);
			if($stmt->rowCount() > 0) {
				$_SESSION['answer'] = "<div class='success'>Вы успешно обновили событие!</div>";
				return true;
			} else {
				$_SESSION['answer'] = "<div class='error'>Ошибка обновления события!</div>";
				return false;
			}
		}
	}

	// Удаление события
	public function del_event($id) {
		$query = "DELETE FROM events WHERE id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$id]);
		if($stmt->rowCount() > 0) {
			$_SESSION['answer'] = "<div class='success'>Вы успешно удалили событие!</div>";
			return true;
		} else {
			$_SESSION['answer'] = "<div class='error'>Ошибка удаления события!</div>";
			return false;
		}
	}

	// Вывод списка пользователей
	public function get_all_users() {
		$query = "SELECT user_id, name, email, status, company, reg_date FROM users";
		return $this->get_data($query, null);
	}

	// Данные отдельного пользователя
	public function get_user($user_id) {
		$query = "SELECT user_id, name, email, pass, user_img, status, company, about, reg_date FROM users WHERE user_id = ?";
		return $this->get_data($query, $user_id);
	}

	// Добавление пользователя
	public function add_user() {
		$name = trim($_POST['name']);
		$email = trim($_POST['email']);
		$pass = trim($_POST['pass']);
		$status = trim($_POST['status']);
		$company = trim($_POST['company']);
		$about = trim($_POST['about']);
		$reg_date = time();

		if(empty($name)) {
			$_SESSION['add_user']['res'] = "<div class='error'>Введите имя пользователя!</div>";
			$_SESSION['add_user']['email'] = $email;
			$_SESSION['add_user']['status'] = $status;
			$_SESSION['add_user']['company'] = $company;
			$_SESSION['add_user']['about'] = $about;
			return false;
		} else {
			$pass = md5($pass);
			$query = "INSERT INTO users (name, email, pass, status, company, about, reg_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$stmt = $this->db->prepare($query);
			$stmt->execute([$name, $email, $pass, $status, $company, $about, $reg_date]);
			if($stmt->rowCount() > 0) {
				$_SESSION['answer'] = "<div class='success'>Вы успешно добавили пользователя!</div>";
				return true;
			} else {
				$_SESSION['answer'] = "<div class='error'>Ошибка добавления пользователя!</div>";
				return false;
			}
		}
	}

	// Редактирование пользователя
	public function edit_user($user_id) {
		$name = isset($_POST['name']) ? trim($_POST['name']) : '';
		$email = isset($_POST['email']) ? trim($_POST['email']) : '';
		$pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';
		$status = isset($_POST['status']) ? trim($_POST['status']) : '';
		$company = isset($_POST['company']) ? trim($_POST['company']) : '';
		$about = isset($_POST['about']) ? trim($_POST['about']) : '';
		$reg_date = isset($_POST['reg_date']) ? trim($_POST['reg_date']) : '';

		if(empty($name)) {
			$_SESSION['answer'] = '<div class="error">Введите имя пользователя!</div>';
			return false;
		} else {
			$pass = md5($pass);
			$reg_date = strtotime($reg_date);
			$query = "UPDATE users SET name = ?, email = ?, pass = ?, status = ?, company = ?, about = ?, reg_date = ? WHERE user_id = ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute([$name, $email, $pass, $status, $company, $about, $reg_date, $user_id]);
			if($stmt->rowCount() > 0) {
				$_SESSION['answer'] = "<div class='success'>Вы успешно обновили пользователя!</div>";
				return true;
			} else {
				$_SESSION['answer'] = "<div class='error'>Ошибка обновления пользователя!</div>";
				return false;
			}
		}
	}

	// Удаление пользователя
	public function del_user($user_id) {
		$query = "DELETE FROM users WHERE user_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$user_id]);
		if($stmt->rowCount() > 0) {
			$_SESSION['answer'] = "<div class='success'>Вы успешно удалили пользователя!</div>";
			return true;
		} else {
			$_SESSION['answer'] = "<div class='error'>Ошибка удаления пользователя!</div>";
			return false;
		}
	}

	// Список зарегистрированных участников на бизнес-завтрак
	public function get_all_business_zavtrak_users() {
		$query = "SELECT id, name, company, phone, email, reg_date FROM business_zavtrak_users";
		return $this->get_data($query, null);
	}
}
?>