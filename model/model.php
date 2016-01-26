<?php
defined('LEAN') or die('Access Denied');
require_once 'db.php';
require_once 'model/libmail.php';
require_once 'model/mailsend.php';
class model {
	private $db;
	private $visible;
	private $razdel;
	private $now_date;
	private $user_id;
	private $activation;
	private $met;
	private $mail;
	public function __construct() {
		$this->db = db::getInstance();
		$this->met = new method();
		$this->visible = '1';
		$this->razdel = '1';
		$this->now_date = time();
		$this->activation = '0';
		$this->mail = new Mail();
		$this->user_id = $_SESSION['auth']['user_id'] ?? null;
	}

	// Универсальный метод получения данных
	private function get_data($query, $data = null) {
		$stmt = $this->db->prepare($query);
		$stmt->execute([$data]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	// Получение списка всех записей
	public function get_all_articles($start_pos, $perpage) {
		$query = "SELECT id, category, author1, author2, title, anons, add_date, img_src FROM articles WHERE visible = ? ORDER BY add_date DESC, id DESC LIMIT $start_pos, $perpage";
		$res = $this->get_data($query, $this->visible);
		return $res;
	}

	// Получение списка постов по категориям
	public function get_articles($cat, $start_pos, $perpage) {
		$query = "SELECT * FROM articles WHERE category = ? AND visible = ? ORDER BY add_date DESC, id DESC LIMIT $start_pos, $perpage";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$cat, $this->visible]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function get_news_lean($start_pos, $perpage) {
		$query = "SELECT * FROM articles WHERE news = ? AND visible = ? ORDER BY add_date DESC, id DESC LIMIT $start_pos, $perpage";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->razdel, $this->visible]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function get_articles_lean($start_pos, $perpage) {
		$query = "SELECT * FROM articles WHERE articles = ? AND visible = ? ORDER BY add_date DESC, id DESC LIMIT $start_pos, $perpage";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->razdel, $this->visible]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function get_video_lean($start_pos, $perpage) {
		$query = "SELECT * FROM articles WHERE video = ? AND visible = ? ORDER BY add_date DESC, id DESC LIMIT $start_pos, $perpage";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->razdel, $this->visible]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function get_history_lean($start_pos, $perpage) {
		$query = "SELECT * FROM articles WHERE history = ? AND visible = ? ORDER BY add_date DESC, id DESC LIMIT $start_pos, $perpage";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->razdel, $this->visible]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function get_sertificatsia_lean($start_pos, $perpage) {
		$query = "SELECT * FROM articles WHERE sertificatsia = ? AND visible = ? ORDER BY add_date DESC, id DESC LIMIT $start_pos, $perpage";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->razdel, $this->visible]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function get_journal_lean($start_pos, $perpage) {
		$query = "SELECT * FROM articles WHERE journal = ? AND visible = ? ORDER BY add_date DESC, id DESC LIMIT $start_pos, $perpage";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->razdel, $this->visible]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	public function get_cpobp($start_pos, $perpage) {
		$query = "SELECT * FROM articles WHERE cpobp = ? AND visible = ? ORDER BY add_date DESC, id DESC LIMIT $start_pos, $perpage";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->razdel, $this->visible]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	// Метатэги для статей
	public function get_all_articles_meta($id) {
		$query = "SELECT id, category, title, anons, keywords, description FROM articles WHERE id = ?";
		$res = $this->get_data($query, $id);
		return $res;
	}

	// Получение данных статьи
	public function get_article($id) {
		$query = "SELECT category, author1, author2, img_author1, img_author2, title, text, keywords, description, add_date, date, source, active_src_link, img_source FROM articles WHERE id = ?";
		$res = $this->get_data($query, $id);
		if(!$res) {
			$this->met->redirect('?view=error404');
		}
		// $res['a']['author'] = explode('|', $res[0]['author']);
		// $res['a']['img_author'] = explode('|', $res[0]['img_author']);
		return $res;
	}

	// Получение общего кол-ва статей для навигации
	public function count_rows() {
		$query = "SELECT COUNT(id) as count_rows FROM articles WHERE visible = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->visible]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows[0]['count_rows'];
	}

	public function count_rows_articles() {
		$query = "SELECT COUNT(id) as count_rows FROM articles WHERE visible = ?";
		$query .= " AND articles = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->visible, $this->razdel]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows[0]['count_rows'];
	}

	public function count_rows_news() {
		$query = "SELECT COUNT(id) as count_rows FROM articles WHERE visible = ?";
		$query .= " AND news = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->visible, $this->razdel]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows[0]['count_rows'];
	}

	public function count_rows_video() {
		$query = "SELECT COUNT(id) as count_rows FROM articles WHERE visible = ?";
		$query .= " AND video = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->visible, $this->razdel]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows[0]['count_rows'];
	}

	public function count_rows_history() {
		$query = "SELECT COUNT(id) as count_rows FROM articles WHERE visible = ?";
		$query .= " AND history = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->visible, $this->razdel]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows[0]['count_rows'];
	}

	public function count_rows_sertificatsia() {
		$query = "SELECT COUNT(id) as count_rows FROM articles WHERE visible = ?";
		$query .= " AND sertificatsia = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->visible, $this->razdel]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows[0]['count_rows'];
	}

	public function count_rows_journal() {
		$query = "SELECT COUNT(id) as count_rows FROM articles WHERE visible = ?";
		$query .= " AND journal = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->visible, $this->razdel]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows[0]['count_rows'];
	}

	public function count_rows_cpobp() {
		$query = "SELECT COUNT(id) as count_rows FROM articles WHERE visible = ?";
		$query .= " AND cpobp = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->visible, $this->razdel]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows[0]['count_rows'];
	}

	// Получение списка последних новостей
	public function get_news($limit) {
		$query = "SELECT id, title, date, link, anons FROM news WHERE visible = ? ORDER BY date DESC LIMIT $limit";
		$res = $this->get_data($query, $this->visible);
		for($i = 0; $i < count($res); $i++) {
			$res[$i]['date'] = date('d.m.Y', $res[$i]['date']);
		}
		return $res;
	}

	// Получение списка всех новостей
	public function get_all_news() {
		$query = "SELECT id, title, link, date, anons FROM news ORDER BY date DESC";
		$res = $this->get_data($query);
		return $res;
	}

	// Получение списка анонса событий
	public function get_events($limit) {
		$query = "SELECT title, link, date, anons FROM events WHERE date >= ? ORDER BY date LIMIT $limit";
		$res = $this->get_data($query, $this->now_date);
		for($i = 0; $i < count($res); $i++) {
			$res[$i]['date'] = date('d.m.Y', $res[$i]['date']);
		}
		return $res;
	}

	// Получение списка всех анонсов
	public function get_all_events() {
		$query = "SELECT * FROM events WHERE date < ? ORDER BY date DESC";
		$res = $this->get_data($query, $this->now_date);
		return $res;
	}

	// Анонс конкретной новости
	public function get_new($id) {
		$query = "SELECT id, title, date, full_text, keywords, description FROM news WHERE id = ?";
		$res = $this->get_data($query, $id);
		return $res;
	}

	// Поиск по сайту
	public function search() {
		if(isset($_GET['search'])) $search = '%'.$this->met->clr($_GET['search']).'%';
		$result_search = [];
		if(empty($_GET['search'])) {
			$result_search['notfound'] = "<div class='error'>Поле поиск должно быть заполнено!</div>";
		} elseif(mb_strlen($search, 'UTF-8') < 6) {
			$result_search['notfound'] = "<div class='error'>Поисковый запрос должен содержать не менее 4-х символов!</div>";
		} else {
			$query = "SELECT id, category, author1, author2, title, anons, date, img_src FROM articles WHERE title LIKE ? OR text LIKE ? AND visible = ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute([$search, $search, $this->visible]);
			if($stmt->rowCount() > 0) {
				$result_search = [];
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$result_search[] = $row;
				}
			} else {
				$result_search['notfound'] = "<div class='error'>По вашему запросу ничего не найдено!</div>";
			}
		}
		return $result_search;
	}

	// Регистрация
	public function registration() {
		$error = '';
		$reg_email = trim($_POST['reg_email']);
		$reg_name = trim($_POST['reg_name']);
		$pass = trim($_POST['reg_pass']);
		if(empty($reg_email)) $error .= '<li>Не указан Email</li>';
		if(empty($reg_name)) $error .= '<li>Не указано имя</li>';
		if(empty($pass)) $error .= '<li>Не указан пароль</li>';
		if(empty($error)) {
			// Если все поля заполнены
			$query = "SELECT user_id FROM users WHERE email = ? LIMIT 1";
			try {
				if(!$stmt = $this->db->prepare($query)) throw new Exception("Error Prepare registration select");
				$stmt->execute([$reg_email]);

				if($stmt->rowCount() > 0) {
					$_SESSION['reg']['res'] = "<div class='error_reg'>Пользователь с таким E-mail уже существует!</div>";
					$_SESSION['reg']['reg_email'] = $reg_email;
					$_SESSION['reg']['reg_name'] = $reg_name;
					$this->met->redirect('?view=reg');
				} else {
					$reg_pass = md5($pass);
					$reg_date = time();
					$query = "INSERT INTO users (email, name, pass, reg_date) VALUES (?, ?, ?, ?)";
					if(!$stmt = $this->db->prepare($query)) throw new Exception("Error prepare registration insert");
					if(!$stmt->execute([$reg_email, $reg_name, $reg_pass, $reg_date])) throw new Exception("Error execute");
					if($stmt->rowCount() > 0) {
						$_SESSION['reg']['res'] = "<div class='success'>Регистрация прошла успешно! На Ваш E-mail было выслано письмо с подтверждением регистрации.</div>";
						$stmt = $this->db->prepare("SELECT user_id, email FROM users WHERE email = ?");
						$stmt->execute([$reg_email]);
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						$activation = md5($row['user_id']).md5($row['email']);
						$subject = "Подтверждение регистрации";
						$message = "Здравствуйте! Спасибо за регистрацию на Lean-center.ru"
							.PHP_EOL.PHP_EOL
							."Ваш логин: ".$row['email'].PHP_EOL
							."Ваш пароль: ".$pass.PHP_EOL.PHP_EOL
							."Перейдите по ссылке, чтобы активировать ваш аккаунт:".PHP_EOL
							.config::PATH."?view=activation&login=".$row['email']."&code=".$activation.PHP_EOL.PHP_EOL
							."С уважением,".PHP_EOL;
						$message .= "Администрация Lean-center.ru";
						$headers .= "Content-type: text/plain; charset=utf-8".PHP_EOL
						."From: Info@lean-center.ru";
            mail($row['email'], $subject, $message, $headers);
					} else {
						$_SESSION['reg']['res'] = "<div class='error_reg'>Ошибка!</div>";
						$_SESSION['reg']['reg_email'] = $reg_email;
						$_SESSION['reg']['reg_name'] = $reg_name;
					}
				}
			} catch(Exception $e) {
				echo 'Ошибка: '.$e->getMessage();
				die();
			}
		} else {
			// Если не заполнены обязательные поля
			$_SESSION['reg']['res'] = "<div class='error_reg'><b>Не заполнены обязательные поля:</b> <ul> $error </ul></div>";
			$_SESSION['reg']['reg_email'] = $reg_email;
			$_SESSION['reg']['reg_name'] = $reg_name;
			$this->met->redirect('?view=reg');
		}
	}

	// Активация
	public function activate() {
		$date_out = 3600;
		$query = "SELECT email FROM users WHERE activation = ? AND UNIX_TIMESTAMP() - reg_date > ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->activation, $date_out]);
		if($stmt->rowCount() > 0) {
			$stmt = $this->db->prepare("DELETE FROM users WHERE activation = ? AND UNIX_TIMESTAMP() - reg_date > ?");
			$stmt->execute([$this->activation, $date_out]);
		}
		if(isset($_GET['code'])) $code = $_GET['code'];
		else $_SESSION['reg']['res'] = "<div class='error'>Вы зашли на страницу без подтверждения!</div>";
		if(isset($_GET['login'])) $login = $_GET['login'];
		else {
			$_SESSION['reg']['res'] = "<div class='err'>Вы зашли на страницу без логина!</div>";
			$this->met->redirect('?view=main');
		}
		$query = "SELECT user_id FROM users WHERE email = ?";
		$res = $this->get_data($query, $login);
		$stmt = $this->db->prepare($query);
		$stmt->execute([$login]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$activation = md5($row['user_id']).md5($login);
		if($activation == $code) {
			$activate = '1';
			$query = "UPDATE users SET activation = ? WHERE email = ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute([$activate, $login]);
			if($stmt->rowCount() > 0) {
				$_SESSION['reg']['res'] = "<div class='success'>Ваш Email успешно подтвержден!</div>";
				$this->met->redirect('?view=main');
			} else {
				$_SESSION['reg']['res'] = "<div class='err'>Ваш Email не подтвержден!</div>";
				$this->met->redirect('?view=main');
			}
		} else {
			$_SESSION['reg']['res'] = "<div class='err'>Ваш Email не подтвержден!</div>";
			$this->met->redirect('?view=main');
		}
	}

	// Авторизация
	public function authorization() {
		$email = trim($_POST['email']);
		$pass = trim($_POST['pass']);
		$activation = '1';
		$remember = $_POST['remember'] ?? 0;
		// $remember = isset($_POST['remember']) ? $_POST['remember'] : 0;
		if(empty($email) OR empty($pass)) {
			$_SESSION['auth']['error'] = "<div class='error_reg'>Поля логин/пароль должны быть заполнены!</div>";
		} else {
			$pass = md5($pass);
			$query = "SELECT user_id, name, email, company, about FROM users WHERE email = ? AND pass = ? AND activation = ? LIMIT 1";
			try {
				if(!$stmt = $this->db->prepare($query)) throw new Exception("Error Prepare authorization");
				$stmt->execute([$email, $pass, $activation]);
				if($stmt->rowCount() == 1) {
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					$expire = $remember ? time()+60*60*24*30 : 0;
					setcookie('auth_cookie', $row['user_id'].':'.md5($row['email']), $expire, '/');
					$_SESSION['auth']['user_id'] = $row['user_id'];
					$_SESSION['auth']['user'] = $row['name'];
					$_SESSION['auth']['email'] = $row['email'];
					$_SESSION['auth']['company'] = $row['company'];
					$_SESSION['auth']['about'] = $row['about'];
					$this->met->redirect('?view=main');
				} else {
					$_SESSION['auth']['error'] = "<div class='error_reg'>Логин или пароль введены неверно или Вы не подтвердили регистрацию!</div>";
				}
			}
			catch(Exception $e) {
				print 'Ошибка: '. $e->getMessage();
				die();
			}
		}
	}

	// Вывод комментов
	public function get_comments($article_id) {
		$query = "SELECT comments.user_id, comments.comment, comments.date, users.name, users.email, users.user_img, articles.id FROM comments LEFT JOIN users ON users.user_id = comments.user_id LEFT JOIN articles ON articles.id = comments.article_id WHERE articles.id = ? ORDER BY comments.id DESC";
		$res = $this->get_data($query, $article_id);
		return $res;
	}

	// Получение кол-ва комментов для каждой статьи
	public function get_count_comments($article_id) {
		$query = "SELECT COUNT(id) as count FROM comments WHERE article_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$article_id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	// Добавление комментариев
	public function add_comment($article_id) {
		$user_id = (int)$_SESSION['auth']['user_id'];
		$comment = trim(htmlspecialchars($_POST['comment']));
		$date = date("d.m.Y H:i:s");
		$query = "INSERT INTO comments (article_id, user_id, comment, date) VALUES (?, ?, ?, ?)";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$article_id, $user_id, $comment, $date]);
		if($stmt->rowCount() > 0) {
			$_SESSION['answer'] = "<div class='success'>Вы добавили комментарий</div>";
		}
	}

	// Получение данных профиля
	public function get_data_profile() {
		$query = "SELECT name, email, user_img, status, company, about, reg_date FROM users WHERE user_id = ?";
		$res = $this->get_data($query, $this->user_id);
		return $res;
	}

	// Редактирование профиля
	public function edit_profile() {
		$name = isset($_POST['name']) ? trim($_POST['name']) : '';
		$company_name = isset($_POST['company_name']) ? trim($_POST['company_name']) : '';
		$about = isset($_POST['about']) ? trim($_POST['about']) : '';
		$query = "UPDATE users SET name = ?, company = ?, about = ? WHERE user_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$name, $company_name, $about, $this->user_id]);
		if($stmt->rowCount() > 0) {
			$_SESSION['auth']['user'] = $name;
			$_SESSION['auth']['company'] = $company_name;
			$_SESSION['auth']['about'] = $about;
			$_SESSION['res'] = "<div class='success'>Вы успешно обновили информацию!</div>";
		}
	}

	// Добавление картинки профиля
	public function edit_img_profile() {
		$types = array('image/gif', "image/png", 'image/jpeg', 'image/pjpeg', 'image/x-png');
		if(isset($_FILES['profile_img']['name'])) {
			$baseimgExt = strtolower(preg_replace('#.+\.([a-z]+)$#i', '$1', $_FILES['profile_img']['name'])); // Расширение картинки
			$baseimgName = "{$this->user_id}.{$baseimgExt}"; // Новое имя картинки
			$baseimgTmpName = $_FILES['profile_img']['tmp_name']; // Временное имя файла
			$baseimgSize = $_FILES['profile_img']['size']; // Вес файла
			$baseimgType = $_FILES['profile_img']['type']; // Тип файла
			$baseimgError = $_FILES['profile_img']['error']; // 0 - ok, иначе - ошибка
			$error = '';

			if(!in_array($baseimgType, $types)) $error .= 'Допустимые расширения - .gif, .png, .jpg<br>';
			if($baseimgSize > config::SIZE) $error .= 'Максимальный размер файла - 3 Мб!';
			if($baseimgError) $error .= 'Ошибка при загрузке картинки! Возможно файл слишком большой';
			if(!empty($error)) $_SESSION['res'] = "<div class='err'>Ошибка при загрузке картинки! <br> {$error}</div>";

			// Если нет ошибок
			if(empty($error)) {
				if(move_uploaded_file($baseimgTmpName, "userfiles/profile_img/{$baseimgName}")) {
					$query = "UPDATE users SET user_img = ? WHERE user_id = ?";
					$stmt = $this->db->prepare($query);
					$stmt->execute([$baseimgName, $this->user_id]);
				} else {
					$_SESSION['res'] .= "<div class='err'>Не удалось переместить загруженную картинку!</div>";
					return false;
				}
			}
		} else {
			echo "Картинка не загружена";
			return false;
		}
	}

	// Удаление картинки профиля
	public function del_img_profile() {
		$no_image = 'no_image.png';
		$query = "UPDATE users SET user_img = ? WHERE user_id = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$no_image, $this->user_id]);
		if($stmt->rowCount() > 0) {
			return '<input type="file" name="profile_img">';
		} else {
			$_SESSION['res'] .= "<div class='error'>Ошибка!</div>";
		}
	}

	// Вывод авторов
	public function authors() {
		$query = "SELECT DISTINCT author1, img_author1 FROM articles";
		$res = $this->get_data($query);
		return $res;
	}

	// Получение списка статей автора
	public function get_author_articles($author) {
		$query = "SELECT id, category, author1, author2, title, add_date, anons, img_src FROM articles WHERE author1 = ? OR author2 = ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$author, $author]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		return $rows;
	}

	// Восстановление пароля
	public function recovery_pass() {
		$email = trim($_POST['recover_email']);
		$activation = '1';
		$query = "SELECT user_id, email FROM users WHERE email = ? and activation = ? LIMIT 1";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$email, $activation]);
		if($stmt->rowCount() == 1) {
			$_SESSION['res'] = "<div class='success'>Вам на почту отправлено письмо с подтверждением восстановления пароля.</div>";
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$recover = md5($row['user_id']).md5($row['email']);
			$subject = "Восстановление пароля на Lean-center.ru";
			$message = "Здравствуйте! Вы запросили операцию на восстановление пароля на Lean-center.ru".PHP_EOL.PHP_EOL
			."Чтобы ввести новый пароль перейдите по ссылке:".PHP_EOL.config::PATH."?view=recovery&email=".$row['email']."&code=".$recover.PHP_EOL.PHP_EOL
			."С уважением,".PHP_EOL
			."Администрация Lean-center.ru";
			$headers .= "Content-type: text/plain; charset=utf-8".PHP_EOL
			."From: info@lean-center.ru";
      mail($row['email'], $subject, $message, $headers);
		} else {
			$_SESSION['res'] = "<div class='error'>Такого email не зарегистрировано!</div>";
		}
	}

	// Восстановление
	public function recovery() {
		$pass = trim($_POST['recover_pass']);
		if(isset($_GET['code'])) $code = trim($_GET['code']);
		else $_SESSION['reg']['res'] = "<div class='error'>Вы зашли на страницу без подтверждения!</div>";
		if(isset($_GET['email'])) $email = trim($_GET['email']);
		else {
			$_SESSION['reg']['res'] = "<div class='err'>Вы зашли на страницу без email!</div>";
			$this->met->redirect('?view=main');
		}
		$query = "SELECT user_id FROM users WHERE email = ?";
		$res = $this->get_data($query, $email);
		$stmt = $this->db->prepare($query);
		$stmt->execute([$email]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$recover = md5($row['user_id']).md5($email);
		if($recover == $code) {
			$query = "UPDATE users SET pass = ? WHERE email = ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute([md5($pass), $email]);
			if($stmt->rowCount() > 0) {
				$_SESSION['res'] = "<div class='success'>Вы успешно задали новый пароль!</div>";
				$this->met->redirect('?view=reg');
			} else {
				$_SESSION['res'] = "<div class='err'>Пароль не задан!</div>";
				$this->met->redirect('?view=main');
			}
		} else {
			$_SESSION['res'] = "<div class='err'>Проверочный код не совпадает!</div>";
			$this->met->redirect('?view=main');
		}
	}

	// Добавление статей пользователями
	public function upload_article() {
		$types = ['application/pdf', "application/msword", 'text/plain', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/rtf'];
		if(isset($_FILES['add_article'])) {
			$baseName = $_FILES['add_article']['name']; // Новое имя картинки
			$baseTmpName = $_FILES['add_article']['tmp_name']; // Временное имя файла
			$baseSize = $_FILES['add_article']['size']; // Вес файла
			$baseType = $_FILES['add_article']['type']; // Тип файла
			$baseError = $_FILES['add_article']['error']; // 0 - ok, иначе - ошибка
			$error = '';

			if(file_exists("userfiles/upload_articles/{$this->user_id}/{$_FILES['add_article']['name']}")) {
				$error .= 'Такой файл уже существует, выберите другое название!';
			}
			if(!in_array($baseType, $types)) $error .= 'Допустимые расширения - .pdf, .doc, .docx, .txt, .rtf<br>';
			if($baseSize > config::SIZE) $error .= 'Максимальный размер файла - 3 Мб!';
			if($baseError) $error .= 'Ошибка при загрузке файла! Возможно файл слишком большой';
			if(!empty($error)) $_SESSION['res'] = "<div class='err'>Ошибка при загрузке! <br> {$error}</div>";
			// Если нет ошибок
			if(empty($error)) {
				if(!is_dir("userfiles/upload_articles/{$this->user_id}")) {
					mkdir("userfiles/upload_articles/{$this->user_id}", 0755);
				}
				if(move_uploaded_file($baseTmpName, "userfiles/upload_articles/{$this->user_id}/{$baseName}")) {
					$_SESSION['res'] .= "<div class='success'>Файл успешно загружен!</div>";
					$subject = "Загрузили новую статью";
					$message = "Была загружена новая статья: {$baseName}".PHP_EOL.PHP_EOL
					."от пользователя с id: {$this->user_id}".PHP_EOL;
					$headers .= "Content-type: text/plain; charset=utf-8".PHP_EOL
					."From: info@lean-center.ru";
					$email = 'info@lean-center.ru';
			    mail($email, $subject, $message, $headers);
				} else {
					$_SESSION['res'] .= "<div class='err'>Не удалось переместить загруженный файл!</div>";
				}
			}
		} else {
			echo "Файл не загружен";
		}
	}

	// Регистрация на обучение в ЦПОБП
	public function business_reg() {
		$error = '';
		$reg_name = trim($_POST['reg_name']);
		$reg_company = trim($_POST['reg_company']);
		$reg_phone = trim($_POST['reg_phone']);
		$reg_email = trim($_POST['reg_email']);
		if(empty($reg_name)) $error .= '<li>Не указано имя</li>';
		if(empty($reg_company)) $error .= '<li>Не указано название организации</li>';
		if(empty($reg_phone)) $error .= '<li>Не указан Телефон</li>';
		if(empty($reg_email)) $error .= '<li>Не указан Email</li>';
		if(empty($error)) {
			// Если все поля заполнены
			$query = "SELECT id FROM cpobp_reg WHERE email = ? LIMIT 1";
			try {
				if(!$stmt = $this->db->prepare($query)) throw new Exception("Error Prepare registration select");
				$stmt->execute([$reg_email]);
				if($stmt->rowCount() > 0) {
					$_SESSION['reg']['res'] = "<div class='error'>Пользователь с таким E-mail уже оставлял заявку на обучение!</div>";
					$_SESSION['reg']['reg_name'] = $reg_name;
					$_SESSION['reg']['reg_company'] = $reg_company;
					$_SESSION['reg']['reg_phone'] = $reg_phone;
					$_SESSION['reg']['reg_email'] = $reg_email;
				} else {
					// $reg_name = $_POST['reg_name'];
					// $reg_company = $_POST['reg_company'];
					// $reg_phone = $_POST['reg_phone'];
					// $reg_email = $_POST['reg_email'];
					$reg_date = date('d.m.Y H:i:s', $this->now_date);
					$query = "INSERT INTO cpobp_reg (name, company, phone, email, reg_date) VALUES (?, ?, ?, ?, ?)";
					if(!$stmt = $this->db->prepare($query)) throw new Exception("Error prepare registration insert");
					$stmt->execute([$reg_name, $reg_company, $reg_phone, $reg_email, $reg_date]);
					$last_id = $this->db->lastInsertId();
					if($stmt->rowCount() > 0) {
						$_SESSION['reg']['res'] = "<div class='success'>Большое спасибо за Вашу заявку! В ближайшее время мы свяжемся с Вами для уточнения деталей обучения!</div>";
						$stmt = $this->db->prepare("SELECT * FROM cpobp_reg WHERE id = ?");
						$stmt->execute([$last_id]);
						$row = $stmt->fetch(PDO::FETCH_ASSOC);

						$to_order = $row['email'];
						$subject_order = "Заявка на обучение в ЦПОБП.";
						$message_order = "<p style='font-size:16px; color:green; margin-bottom:20px;'>Большое спасибо за Вашу заявку на обучение в Центре практического обучения Бережливому производству. В ближайшее время мы свяжемся с Вами.</p>
						<p><img src='".config::PATH.config::TEMPLATE."img/lean-center-icon.png' alt='Lean-center.ru'></p>
						<p style='font-size:14px;'><b>Ваше имя:</b> ".$row['name']
						."<br><b>Организация:</b> ".$row['company']
						."<br><b>Телефон:</b> ".$row['phone']
						."<br><b>Email:</b> ".$row['email']."</p><br><br>
						<p style='font-size:14px;'>Если Вы не оставляли заявку на обучение, просто проигнорируйте это письмо.<br><br>
						С уважением,<br>
						Администрация Lean-center.ru</p>";

						$this->mail->Subject($subject_order);
						$this->mail->From("Lean-center;cpobp@lean-center.ru");
						$this->mail->To($to_order);
						$this->mail->Body($message_order, "html");
						$this->mail->Send();

						usleep(500000);

						$to = "cpobp@lean-center.ru";
            $subject = "Регистрация нового участника на обучение в ЦПОБП";
						$message = "<p style='font-size:18px;color:blue;margin-bottom:20px;'>Регистрация нового участника на обучение в ЦПОБП:</p>
						<p style='font-size:15px;'><b>Имя участника:</b> ".$row['name']
						."<br><b>Компания:</b> ".$row['company']
						."<br><b>Телефон:</b> ".$row['phone']
						."<br><b>Email:</b> ".$row['email']
						."<br><b>Дата регистрации:</b> ".$row['reg_date']."</p><br><br>";

						mailsend::sendMail($to, $subject, $message, '', '', '', '', true);
							// $headers .= "Content-type: text/html; charset=utf-8".PHP_EOL
							// ."From: Info@lean-center.ru";
					  //   mail('cpobp@lean-center.ru', $subject, $message, $headers);
					  //   mail('enrajet@gmail.com', $subject, $message, $headers);

					} else {
						$_SESSION['reg']['res'] = "<div class='error'>Ошибка!</div>";
						$_SESSION['reg']['reg_name'] = $reg_name;
						$_SESSION['reg']['reg_company'] = $reg_company;
						$_SESSION['reg']['reg_phone'] = $reg_phone;
						$_SESSION['reg']['reg_email'] = $reg_email;
						$this->met->redirect('?view=article&id=151');
						return false;
					}
				}
			} catch(Exception $e) {
				echo 'Ошибка: '.$e->getMessage();
				die();
			}
		} else {
			// Если не заполнены обязательные поля
			$_SESSION['reg']['res'] = "<div class='error'><b>Не заполнены обязательные поля:</b> <ul> $error </ul></div>";
			$_SESSION['reg']['reg_name'] = $reg_name;
			$_SESSION['reg']['reg_company'] = $reg_company;
			$_SESSION['reg']['reg_phone'] = $reg_phone;
			$_SESSION['reg']['reg_email'] = $reg_email;
			$this->met->redirect('?view=article&id=151');
			return false;
		}
	}

	// Подтверждение регистрации на бизнес-завтрак
	/*public function activate_business_zavtrak() {
		$date_out = 3600;
		$query = "SELECT email FROM business_zavtrak_users WHERE activation = ? AND UNIX_TIMESTAMP() - reg_date_unix > ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$this->activation, $date_out]);
		if($stmt->rowCount() > 0) {
			$stmt = $this->db->prepare("DELETE FROM business_zavtrak_users WHERE activation = ? AND UNIX_TIMESTAMP() - reg_date_unix > ?");
			$stmt->execute([$this->activation, $date_out]);
		}
		if(isset($_GET['code'])) $code = $_GET['code'];
		else $_SESSION['reg']['res'] = "<div class='error'>Вы зашли на страницу без подтверждения!</div>";
		if(isset($_GET['email'])) $email = $_GET['email'];
		else {
			$_SESSION['reg']['res'] = "<div class='err'>Вы зашли на страницу без email!</div>";
			$this->met->redirect('?view=main');
		}
		$query = "SELECT name, company, phone, email, reg_date FROM business_zavtrak_users WHERE email = ?";
		$res = $this->get_data($query, $email);
		$stmt = $this->db->prepare($query);
		$stmt->execute([$email]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$activation = md5($row['name']).md5($row['email']);
		if($activation == $code) {
			$activate = '1';
			$query = "UPDATE business_zavtrak_users SET activation = ? WHERE email = ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute([$activate, $email]);
			if($stmt->rowCount() > 0) {
				$_SESSION['reg']['res'] = "<div class='success'>Ваш Email успешно подтвержден!</div>";
				$this->met->redirect('?view=main');
			} else {
				$_SESSION['reg']['res'] = "<div class='err'>Ваш Email не подтвержден!</div>";
				$this->met->redirect('?view=main');
			}
		} else {
			$_SESSION['reg']['res'] = "<div class='err'>Ваш Email не подтвержден!</div>";
			$this->met->redirect('?view=main');
		}
	}*/

	// Отправка письма с уведомлением, кто оставил заявку на ЦПОБП
	/*public function send_mail_business_zavtrak($name, $company, $phone, $email, $reg_date) {
		$subject = "Регистрация нового участника на обучение в ЦПОБП";
		$message .= "<p style='font-size:18px;color:blue;margin-bottom:20px;'>Регистрация нового участника на обучение в ЦПОБП:</p>
		<p style='font-size:15px;'><b>Имя участника:</b> ".$name
		."<br><b>Компания:</b> ".$company
		."<br><b>Телефон:</b> ".$phone
		."<br><b>Email:</b> ".$email
		."<br><b>Дата регистрации:</b> ".$reg_date."</p><br><br>";
		$headers .= "Content-type: text/html; charset=utf-8".PHP_EOL
		."From: Info@lean-center.ru";
		$mails = ['enrajet@gmail.com', 'remover88@mail.ru'];
    $this->mail->Subject($subject);
		$this->mail->From("Lean-center;cpobp@lean-center.ru");
		$this->mail->To($mails);
		$this->mail->Body($message, "html");
		$this->mail->Send();
	}*/

	// Регистрация для ознакомление с программой обучение
	public function reg_study_program() {
		$error = '';
		$reg_name = trim($_POST['reg_name']);
		$reg_company = trim($_POST['reg_company']);
		$reg_phone = trim($_POST['reg_phone']);
		$reg_email = trim($_POST['reg_email']);
		if(empty($reg_name)) $error .= '<li>Не указано ФИО</li>';
		if(empty($reg_company)) $error .= '<li>Не указана организация</li>';
		if(empty($reg_phone)) $error .= '<li>Не указан Телефон</li>';
		if(empty($reg_email)) $error .= '<li>Не указан Email</li>';
		if(empty($error)) {
			// Если все поля заполнены
			$query = "SELECT id FROM reg_study_program WHERE email = ? LIMIT 1";
			try {
				if(!$stmt = $this->db->prepare($query)) throw new Exception("Error Prepare registration select");
				$stmt->execute([$reg_email]);

				if($stmt->rowCount() > 0) {
					$_SESSION['reg']['res'] = "<div class='error'>Пользователь с таким E-mail уже существует!</div>";
					$_SESSION['reg']['reg_name'] = $reg_name;
					$_SESSION['reg']['reg_company'] = $reg_company;
					$_SESSION['reg']['reg_phone'] = $reg_phone;
					$_SESSION['reg']['reg_email'] = $reg_email;
					$this->met->redirect('?view=reg_study_program');
					return false;
				} else {
					$reg_name = $this->met->clr($_POST['reg_name']);
					$reg_company = $this->met->clr($_POST['reg_company']);
					$reg_phone = $this->met->clr($_POST['reg_phone']);
					$reg_email = $this->met->clr($_POST['reg_email']);
					$reg_date = date('H:i:s d.m.Y', $this->now_date);
					$query = "INSERT INTO reg_study_program (name, company, phone, email, reg_date) VALUES (?, ?, ?, ?, ?)";
					if(!$stmt = $this->db->prepare($query)) throw new Exception("Error prepare registration insert");
					$stmt->execute([$reg_name, $reg_company, $reg_phone, $reg_email, $reg_date]);
					if($stmt->rowCount() > 0) {
						$_SESSION['reg']['res'] = "<div class='success'>Большое спасибо за Вашу регистрацию! В ближайшее время мы свяжемся с Вами и вышлем программу обучения.</div>";
						$stmt = $this->db->prepare("SELECT id, name, company, phone, email, reg_date FROM reg_study_program WHERE email = ?");
						$stmt->execute([$reg_email]);
						$row = $stmt->fetch(PDO::FETCH_ASSOC);

						$subject = "Запрос программы обучения!";
						$message .= "<p style='font-size:16px;color:green;margin-bottom:20px;'>Большое спасибо за Вашу регистрацию! В ближайшее время мы свяжемся с Вами и направим Вам подробную программу обучения.</p>
						<p style='font-size:14px;'><b>Ваше имя:</b> ".$row['name']
						."<br><b>Организация:</b> ".$row['company']
						."<br><b>Телефон:</b> ".$row['phone']
						."<br><b>Email:</b> ".$row['email']."</p><br><br>
						<p style='font-size:14px;'>Если Вы не оставляли заявку на программу обучения, просто проигнорируйте это письмо.<br><br>
						С уважением,<br>
						Администрация Lean-center.ru</p>";
						$headers .= "Content-type: text/html; charset=utf-8".PHP_EOL
						."From: cpobp@lean-center.ru";
						mail($row['email'], $subject, $message, $headers);

						$this->send_mail_study_program($row['name'], $row['company'], $row['phone'], $row['email'], $row['reg_date']);
					} else {
						$_SESSION['reg']['res'] = "<div class='error'>Ошибка регистрации!</div>";
						$_SESSION['reg']['reg_name'] = $reg_name;
						$_SESSION['reg']['reg_company'] = $reg_company;
						$_SESSION['reg']['reg_phone'] = $reg_phone;
						$_SESSION['reg']['reg_email'] = $reg_email;
						return false;
					}
				}
			} catch(Exception $e) {
				echo 'Ошибка: '.$e->getMessage();
				die();
			}
		} else {
			// Если не заполнены обязательные поля
			$_SESSION['reg']['res'] = "<div class='error'><b>Не заполнены обязательные поля:</b> <ul> $error </ul></div>";
			$_SESSION['reg']['reg_name'] = $reg_name;
			$_SESSION['reg']['reg_company'] = $reg_company;
			$_SESSION['reg']['reg_phone'] = $reg_phone;
			$_SESSION['reg']['reg_email'] = $reg_email;
			$this->met->redirect('?view=reg_study_program');
			return false;
		}
	}

	// Отправка письма с уведомлением, кто запросил программу обучения
	public function send_mail_study_program($name, $company, $phone, $email, $reg_date) {
		$subject = "Новый участник запросил программу обучения!";
		$message .= "<p style='font-size:18px;color:blue;margin-bottom:20px;'>Участник запросил программу обучения:</p>
		<p style='font-size:15px;'><b>Имя участника:</b> ".$name
		."<br><b>Организация:</b> ".$company
		."<br><b>Телефон:</b> ".$phone
		."<br><b>Email:</b> ".$email
		."<br><b>Время запроса:</b> ".$reg_date."</p><br><br>";
		$headers .= "Content-type: text/html; charset=utf-8".PHP_EOL
		."From: cpobp@lean-center.ru";
    // mail('cpobp@lean-center.ru', $subject, $message, $headers);
    mail('andrey.p.kulikov@gmail.com', $subject, $message, $headers);
    mail('kuzin_ga@mail.ru', $subject, $message, $headers);
    mail('enrajet@gmail.com', $subject, $message, $headers);
	}

	// Регистрация для получения стоимости обучения
	public function reg_study_price() {
		$error = '';
		$reg_name = trim($_POST['reg_name']);
		$reg_company = trim($_POST['reg_company']);
		$reg_phone = trim($_POST['reg_phone']);
		$reg_email = trim($_POST['reg_email']);
		$reg_quantity = trim($_POST['reg_quantity']);
		if(empty($reg_name)) $error .= '<li>Не указано ФИО</li>';
		if(empty($reg_company)) $error .= '<li>Не указана организация</li>';
		if(empty($reg_phone)) $error .= '<li>Не указан Телефон</li>';
		if(empty($reg_email)) $error .= '<li>Не указан Email</li>';
		if(empty($reg_quantity)) $error .= '<li>Не указано количество слушателей</li>';
		if(empty($error)) {
			// Если все поля заполнены
			$query = "SELECT id FROM reg_study_price WHERE email = ? LIMIT 1";
			try {
				if(!$stmt = $this->db->prepare($query)) throw new Exception("Error Prepare registration select");
				$stmt->execute([$reg_email]);

				if($stmt->rowCount() > 0) {
					$_SESSION['reg']['res'] = "<div class='error'>Пользователь с таким E-mail уже существует!</div>";
					$_SESSION['reg']['reg_name'] = $reg_name;
					$_SESSION['reg']['reg_company'] = $reg_company;
					$_SESSION['reg']['reg_phone'] = $reg_phone;
					$_SESSION['reg']['reg_email'] = $reg_email;
					$_SESSION['reg']['reg_quantity'] = $reg_quantity;
					$this->met->redirect('?view=reg_study_price');
					return false;
				} else {
					$reg_name = $this->met->clr($_POST['reg_name']);
					$reg_company = $this->met->clr($_POST['reg_company']);
					$reg_phone = $this->met->clr($_POST['reg_phone']);
					$reg_email = $this->met->clr($_POST['reg_email']);
					$reg_quantity = (int)$_POST['reg_quantity'];
					$reg_date = date('H:i:s d.m.Y', $this->now_date);
					$query = "INSERT INTO reg_study_price (name, company, phone, email, quantity, reg_date) VALUES (?, ?, ?, ?, ?, ?)";
					if(!$stmt = $this->db->prepare($query)) throw new Exception("Error prepare registration insert");
					$stmt->execute([$reg_name, $reg_company, $reg_phone, $reg_email, $reg_quantity, $reg_date]);
					if($stmt->rowCount() > 0) {
						$_SESSION['reg']['res'] = "<div class='success'>Большое спасибо за Вашу регистрацию! В ближайшее время мы свяжемся с Вами и вышлем стоимость обучения.</div>";
						$stmt = $this->db->prepare("SELECT id, name, company, phone, email, quantity, reg_date FROM reg_study_price WHERE email = ?");
						$stmt->execute([$reg_email]);
						$row = $stmt->fetch(PDO::FETCH_ASSOC);

						$subject = "Запрос стоимости обучения!";
						$message .= "<p style='font-size:16px;color:green;margin-bottom:20px;'>Большое спасибо за Вашу регистрацию! В ближайшее время мы свяжемся с Вами и согласуем стоимость обучения.</p>
						<p style='font-size:14px;'><b>Ваше имя:</b> ".$row['name']
						."<br><b>Организация:</b> ".$row['company']
						."<br><b>Телефон:</b> ".$row['phone']
						."<br><b>Email:</b> ".$row['email']
						."<br><b>Количество слушателей:</b> ".$row['quantity']."</p><br><br>
						<p style='font-size:14px;'>Если Вы не оставляли заявку на получение стоимости обучения, просто проигнорируйте это письмо.<br><br>
						С уважением,<br>
						Администрация Lean-center.ru</p>";
						$headers .= "Content-type: text/html; charset=utf-8".PHP_EOL
						."From: cpobp@lean-center.ru";
						mail($row['email'], $subject, $message, $headers);

						$this->send_mail_study_price($row['name'], $row['company'], $row['phone'], $row['email'], $row['quantity'], $row['reg_date']);
					} else {
						$_SESSION['reg']['res'] = "<div class='error'>Ошибка регистрации!</div>";
						$_SESSION['reg']['reg_name'] = $reg_name;
						$_SESSION['reg']['reg_company'] = $reg_company;
						$_SESSION['reg']['reg_phone'] = $reg_phone;
						$_SESSION['reg']['reg_email'] = $reg_email;
						$_SESSION['reg']['reg_quantity'] = $reg_quantity;
						$this->met->redirect('?view=reg_study_price');
						return false;
					}
				}
			} catch(Exception $e) {
				echo 'Ошибка: '.$e->getMessage();
				die();
			}
		} else {
			// Если не заполнены обязательные поля
			$_SESSION['reg']['res'] = "<div class='error'><b>Не заполнены обязательные поля:</b> <ul> $error </ul></div>";
			$_SESSION['reg']['reg_name'] = $reg_name;
			$_SESSION['reg']['reg_company'] = $reg_company;
			$_SESSION['reg']['reg_phone'] = $reg_phone;
			$_SESSION['reg']['reg_email'] = $reg_email;
			$_SESSION['reg']['reg_quantity'] = $reg_quantity;
			$this->met->redirect('?view=reg_study_price');
			return false;
		}
	}

	// Отправка письма с уведомлением, кто запросил стоимость обучения
	public function send_mail_study_price($name, $company, $phone, $email, $quantity, $reg_date) {
		$subject = "Новый участник запросил стоимость обучения!";
		$message .= "<p style='font-size:18px;color:green;margin-bottom:20px;'>Участник запросил стоимость обучения:</p>
		<p style='font-size:15px;'><b>Имя участника:</b> ".$name
		."<br><b>Организация:</b> ".$company
		."<br><b>Телефон:</b> ".$phone
		."<br><b>Email:</b> ".$email
		."<br><b>Количество слушателей:</b> ".$quantity
		."<br><b>Время запроса:</b> ".$reg_date."</p><br><br>";
		$headers .= "Content-type: text/html; charset=utf-8".PHP_EOL
		."From: cpobp@lean-center.ru";
    // mail('cpobp@lean-center.ru', $subject, $message, $headers);
    mail('andrey.p.kulikov@gmail.com', $subject, $message, $headers);
    mail('kuzin_ga@mail.ru', $subject, $message, $headers);
    mail('enrajet@gmail.com', $subject, $message, $headers);
	}

	// Регистрация на обучение
	public function reg_study_zapis() {
		$error = '';
		$reg_name = trim($_POST['reg_name']);
		$reg_company = trim($_POST['reg_company']);
		$reg_phone = trim($_POST['reg_phone']);
		$reg_email = trim($_POST['reg_email']);
		if(empty($reg_name)) $error .= '<li>Не указано ФИО</li>';
		if(empty($reg_company)) $error .= '<li>Не указана организация</li>';
		if(empty($reg_phone)) $error .= '<li>Не указан Телефон</li>';
		if(empty($reg_email)) $error .= '<li>Не указан Email</li>';
		if(empty($error)) {
			// Если все поля заполнены
			$query = "SELECT id FROM reg_study_zapis WHERE email = ? LIMIT 1";
			try {
				if(!$stmt = $this->db->prepare($query)) throw new Exception("Error Prepare registration select");
				$stmt->execute([$reg_email]);

				if($stmt->rowCount() > 0) {
					$_SESSION['reg']['res'] = "<div class='error'>Пользователь с таким E-mail уже существует!</div>";
					$_SESSION['reg']['reg_name'] = $reg_name;
					$_SESSION['reg']['reg_company'] = $reg_company;
					$_SESSION['reg']['reg_phone'] = $reg_phone;
					$_SESSION['reg']['reg_email'] = $reg_email;
					$this->met->redirect('?view=reg_study_zapis');
					return false;
				} else {
					$reg_name = $this->met->clr($_POST['reg_name']);
					$reg_company = $this->met->clr($_POST['reg_company']);
					$reg_phone = $this->met->clr($_POST['reg_phone']);
					$reg_email = $this->met->clr($_POST['reg_email']);
					$reg_date = date('H:i:s d.m.Y', $this->now_date);
					$query = "INSERT INTO reg_study_zapis (name, company, phone, email, reg_date) VALUES (?, ?, ?, ?, ?)";
					if(!$stmt = $this->db->prepare($query)) throw new Exception("Error prepare registration insert");
					$stmt->execute([$reg_name, $reg_company, $reg_phone, $reg_email, $reg_date]);
					if($stmt->rowCount() > 0) {
						$_SESSION['reg']['res'] = "<div class='success'>Большое спасибо за Вашу регистрацию! В ближайшее время мы свяжемся с Вами.</div>";
						$stmt = $this->db->prepare("SELECT id, name, company, phone, email, reg_date FROM reg_study_zapis WHERE email = ?");
						$stmt->execute([$reg_email]);
						$row = $stmt->fetch(PDO::FETCH_ASSOC);

						$subject = "Запись на обучение!";
						$message .= "<p style='font-size:16px;color:green;margin-bottom:20px;'>Уважаемый клиент (или подписчик), благодарим Вас за вашу заявку (регистрацию)!</p>
						<p style='font-size:14px;'><b>Ваше имя:</b> ".$row['name']
						."<br><b>Организация:</b> ".$row['company']
						."<br><b>Телефон:</b> ".$row['phone']
						."<br><b>Email:</b> ".$row['email']."</p><br><br>
						<p style='font-size:14px;'>Вы прошли регистрацию (или подали заявку) на обучение в Центр практического обучения бережливому производству, которое будет проводиться с 30 ноября по 3 декабря 2015 г. по адресу: г. Москва, 1-й Угрешский пр., 26.<br><br>
						Мы свяжемся с Вами в течение 24 часов, но если это по какой-либо причине этого не произошло, пожалуйста, свяжитесь с нами по тел. 8 (495) 723-18-50 Кузин Геннадий Аскольдович и получите дополнительную персональную скидку на обучение.
						С уважением,<br>
						Администрация Lean-center.ru</p>";
						$headers .= "Content-type: text/html; charset=utf-8".PHP_EOL
						."From: cpobp@lean-center.ru";
						mail($row['email'], $subject, $message, $headers);

						$this->send_mail_study_zapis($row['name'], $row['company'], $row['phone'], $row['email'], $row['reg_date']);
					} else {
						$_SESSION['reg']['res'] = "<div class='error'>Ошибка регистрации!</div>";
						$_SESSION['reg']['reg_name'] = $reg_name;
						$_SESSION['reg']['reg_company'] = $reg_company;
						$_SESSION['reg']['reg_phone'] = $reg_phone;
						$_SESSION['reg']['reg_email'] = $reg_email;
						$this->met->redirect('?view=reg_study_zapis');
						return false;
					}
				}
			} catch(Exception $e) {
				echo 'Ошибка: '.$e->getMessage();
				die();
			}
		} else {
			// Если не заполнены обязательные поля
			$_SESSION['reg']['res'] = "<div class='error'><b>Не заполнены обязательные поля:</b> <ul> $error </ul></div>";
			$_SESSION['reg']['reg_name'] = $reg_name;
			$_SESSION['reg']['reg_company'] = $reg_company;
			$_SESSION['reg']['reg_phone'] = $reg_phone;
			$_SESSION['reg']['reg_email'] = $reg_email;
			$this->met->redirect('?view=reg_study_zapis');
			return false;
		}
	}

	// Отправка письма с уведомлением, кто зарегистрировался на обучение
	public function send_mail_study_zapis($name, $company, $phone, $email, $reg_date) {
		$subject = "Новый участник зарегистрировался на обучение!";
		$message .= "<p style='font-size:18px;color:red;margin-bottom:20px;'>Новый участник зарегистрировался на обучение:</p>
		<p style='font-size:15px;'><b>Имя участника:</b> ".$name
		."<br><b>Организация:</b> ".$company
		."<br><b>Телефон:</b> ".$phone
		."<br><b>Email:</b> ".$email
		."<br><b>Время регистрации:</b> ".$reg_date."</p><br><br>";
		$headers .= "Content-type: text/html; charset=utf-8".PHP_EOL
		."From: cpobp@lean-center.ru";
    // mail('cpobp@lean-center.ru', $subject, $message, $headers);
    mail('andrey.p.kulikov@gmail.com', $subject, $message, $headers);
    mail('kuzin_ga@mail.ru', $subject, $message, $headers);
    mail('enrajet@gmail.com', $subject, $message, $headers);
	}

	// Регистрация на обучение
	public function reg_japan_tour() {
		$error = '';
		$reg_name = trim($_POST['reg_name']);
		$reg_company = trim($_POST['reg_company']);
		$reg_phone = trim($_POST['reg_phone']);
		$reg_email = trim($_POST['reg_email']);
		if(empty($reg_name)) $error .= '<li>Не указано ФИО</li>';
		if(empty($reg_company)) $error .= '<li>Не указана организация</li>';
		if(empty($reg_phone)) $error .= '<li>Не указан Телефон</li>';
		if(empty($reg_email)) $error .= '<li>Не указан Email</li>';
		if(empty($error)) {
			// Если все поля заполнены
			$query = "SELECT id FROM reg_japan_tour WHERE email = ? LIMIT 1";
			try {
				if(!$stmt = $this->db->prepare($query)) throw new Exception("Error Prepare registration select");
				$stmt->execute([$reg_email]);

				if($stmt->rowCount() > 0) {
					$_SESSION['reg']['res'] = "<div class='error'>Пользователь с таким E-mail уже существует!</div>";
					$_SESSION['reg']['reg_name'] = $reg_name;
					$_SESSION['reg']['reg_company'] = $reg_company;
					$_SESSION['reg']['reg_phone'] = $reg_phone;
					$_SESSION['reg']['reg_email'] = $reg_email;
					$this->met->redirect();
					return false;
				} else {
					$reg_name = $this->met->clr($_POST['reg_name']);
					$reg_company = $this->met->clr($_POST['reg_company']);
					$reg_phone = $this->met->clr($_POST['reg_phone']);
					$reg_email = $this->met->clr($_POST['reg_email']);
					$reg_date = date('H:i:s d.m.Y', $this->now_date);
					$query = "INSERT INTO reg_japan_tour (name, company, phone, email, reg_date) VALUES (?, ?, ?, ?, ?)";
					if(!$stmt = $this->db->prepare($query)) throw new Exception("Error prepare registration insert");
					$stmt->execute([$reg_name, $reg_company, $reg_phone, $reg_email, $reg_date]);
					if($stmt->rowCount() > 0) {
						$_SESSION['reg']['res'] = "<div class='success'>Спасибо за запрос, в ближайшее время наш менеджер свяжется с Вами.</div>";
						$stmt = $this->db->prepare("SELECT id, name, company, phone, email, reg_date FROM reg_japan_tour WHERE email = ?");
						$stmt->execute([$reg_email]);
						$row = $stmt->fetch(PDO::FETCH_ASSOC);

						$subject = "Запрос информации о туре.";
						$message .= "<p style='font-size:16px;color:green;margin-bottom:20px;'>Спасибо за запрос, в ближайшее время наш менеджер свяжется с Вами.</p>
						<p style='font-size:14px;'>Вы указали:
						<br><br><b>Ваше имя:</b> ".$row['name']
						."<br><b>Организация:</b> ".$row['company']
						."<br><b>Телефон:</b> ".$row['phone']
						."<br><b>Email:</b> ".$row['email']."</p><br><br>
						<p style='font-size:14px;'>Если Вы не подавали запрос информации о туре, просто проигнорируйте это письмо.<br><br>
						С уважением,<br>
						Администрация Lean-center.ru</p>";
						$headers .= "Content-type: text/html; charset=utf-8".PHP_EOL
						."From: info@lean-center.ru";
						mail($row['email'], $subject, $message, $headers);

						$this->send_mail_japan_tour($row['name'], $row['company'], $row['phone'], $row['email'], $row['reg_date']);
					} else {
						$_SESSION['reg']['res'] = "<div class='error'>Ошибка регистрации!</div>";
						$_SESSION['reg']['reg_name'] = $reg_name;
						$_SESSION['reg']['reg_company'] = $reg_company;
						$_SESSION['reg']['reg_phone'] = $reg_phone;
						$_SESSION['reg']['reg_email'] = $reg_email;
						$this->met->redirect();
						return false;
					}
				}
			} catch(Exception $e) {
				echo 'Ошибка: '.$e->getMessage();
				die();
			}
		} else {
			// Если не заполнены обязательные поля
			$_SESSION['reg']['res'] = "<div class='error'><b>Не заполнены обязательные поля:</b> <ul> $error </ul></div>";
			$_SESSION['reg']['reg_name'] = $reg_name;
			$_SESSION['reg']['reg_company'] = $reg_company;
			$_SESSION['reg']['reg_phone'] = $reg_phone;
			$_SESSION['reg']['reg_email'] = $reg_email;
			$this->met->redirect();
			return false;
		}
	}

	// Отправка письма с уведомлением, кто зарегистрировался на обучение
	public function send_mail_japan_tour($name, $company, $phone, $email, $reg_date) {
		$subject = "Запрос информации о туре!";
		$message .= "<p style='font-size:18px;color:#333;margin-bottom:20px;'>Новый участник подал запрос информации о туре:</p>
		<p style='font-size:15px;'><b>Имя участника:</b> ".$name
		."<br><b>Организация:</b> ".$company
		."<br><b>Телефон:</b> ".$phone
		."<br><b>Email:</b> ".$email
		."<br><b>Время подачи:</b> ".$reg_date."</p><br><br>";
		$headers .= "Content-type: text/html; charset=utf-8".PHP_EOL
		."From: info@lean-center.ru";
    mail('andrey.p.kulikov@gmail.com', $subject, $message, $headers);
    usleep(500000);
    mail('kuzin_ga@mail.ru', $subject, $message, $headers);
    usleep(500000);
    mail('enrajet@gmail.com', $subject, $message, $headers);
	}

	public function send_mail() {
		set_time_limit(500);
		$query = "SELECT `name`, `email`, `employee` FROM `send_mail` WHERE id > 0 AND id < 50";
		$rows = $this->get_data($query);

		for($i = 0; $i < count($rows); $i++) {
			if(empty($rows[$i]['name'])) $rows[$i]['name'] = 'Участник портала';
			$subject = "Второй номер журнала LEAN-CENTER.RU";
			$message = "<p style='color:#000;'>Уважаемый(ая) <b>".$rows[$i]['name']."</b>!</p>
			<p style='margin:0; padding:0; color:#000;'>По просьбе <b>".$rows[$i]['employee']."</b> направляем Вам только что вышедший второй номер журнала <a href='http://lean-center.ru/' target='_blank'>LEAN-CENTER.RU</a> (в приложении).</p>
			<p style='font-size:17px; margin:0; padding:0; line-height:100%; color:#000;'>В нем Вы узнаете:</p>
			<ul style='margin:0; padding:0;'>
				<li style='margin:0; padding-left:15px; color:#000;'><b>-</b> Тема номера: Удаленный режим работы - преимущества и «подводные камни», как для работника, так и работодателя</li>
				<li style='margin:0; padding-left:15px; color:#000;'><b>-</b> Новости LEAN в России</li>
				<li style='margin:0; padding-left:15px; color:#000;'><b>-</b> Как бороться с перепроизводством</li>
				<li style='margin:0; padding-left:15px; color:#000;'><b>-</b> Опыт проектов: История компании Arvato</li>
				<li style='margin:0; padding-left:15px; color:#000;'><b>-</b> Влияние инцидентов на управление уровнем сервиса: опыт нефтегазовой компании</li>
				<li style='margin:0; padding-left:15px; color:#000;'><b>-</b> Интервью с Эльдаром Муратовым о собственном опыте участия в проекте «Команда для оптимизации»</li>
			</ul>
			<p style='margin:0; padding:0; color:#000;'>Приятного чтения!</p>
			<p style='margin:0; padding:0; color:#000;'>С уважением, редакция журнала <a href='http://lean-center.ru/' target='_blank'>LEAN-CENTER.RU</a></p>
			<p style='margin:0; padding:0; color:#000;'><b>+7 (495) 723-18-50</b>, <a href='mailto:info@lean-center.ru'>info@lean-center.ru</a></p>";
			$to = $rows[$i]['email'];
			mailsend::sendMail($to, $subject, $message, $_SERVER['DOCUMENT_ROOT'].config::FILES.'LEAN-CENTER.RU_N2.pdf', '', '', '', true);
			usleep(350000);
		}
	}

	public function new_year($first, $last) {
		set_time_limit(500);
		$query = "SELECT `name`, `email` FROM `send` WHERE id BETWEEN ? AND ?";
		$stmt = $this->db->prepare($query);
		$stmt->execute([$first, $last]);
		$rows = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rows[] = $row;
		}
		for($i = 0; $i < count($rows); $i++) {
			if(empty($rows[$i]['name'])) $rows[$i]['name'] = 'Участник портала';
			$subject = "Открытка С Новым годом!";
			$message = "<p style='color:#333; font-size:17px; font-weight:bold; margin-top:0;'>Уважаемый(ая, ые) ".$rows[$i]['name']."!</p>
			<p style='color:#333; font-size:17px;'>В наш дом приходит Новый год и Рождество!<br>
			Пусть новый год принесет Вам и Вашим родным и близким любви, мира и всех благ!<br>
			Здоровья Вам и счастья!</p>
			<p style='color:#333; font-size:15px; font-style:italic;'>Команда Консалтинговой лаборатории «Открытые инновации» и портала <a href='http://lean-center.ru/' target='_blank'>LEAN-CENTER.RU</a></p>
			<img src='".config::PATH."userfiles/files/new_year.jpg' alt='Открытка С Новым годом!' title='С Новым годом!'>";
			$to = $rows[$i]['email'];
			mailsend::sendMail($to, $subject, $message, '', '', '', '', true);
			usleep(310000);
		}
	}
}
?>
