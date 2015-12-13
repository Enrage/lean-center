<?php
defined('LEAN') or die('Access Denied');
class meta extends Core {
	private $title;
	private $keywords;
	private $description;
	public function get_content() {
		$meta = $this->meta_words();
		return $meta;
	}
	private function meta_words() {
		$this->title = 'Портал Lean-center';
		$this->keywords = 'Портал Lean-center';
		$this->description = 'Портал Lean-center';
		if(isset($_GET['view'])) $view = $_GET['view'];
		if(!isset($_GET['view'])) $view = 'main';
		switch($view) {
			case 'news':
				$title = 'Новости LEAN';
				$keywords = 'Новости, 5S, TPM, SMED, Канбан';
				$description = 'Новости LEAN. Портал lean-center.ru';
			break;
			case 'history':
				$title = 'История проектов Lean-center';
				$keywords = 'история проектов lean-center, Кайдзен, практика, результаты проектов, LEAN';
				$description = 'История проектов lean-center, Кайдзен, практика, результаты проектов LEAN';
			break;
			case 'sertificatsia':
				$title = 'Сертификация оптимизаторов';
				$keywords = 'сертификация оптимизаторов, знания, умения, навыки';
				$description = 'Сертификация оптимизаторов lean-center';
			break;
			case 'main':
				$title = 'Портал Lean-center';
				$keywords = 'Портал lean-center.ru, сообщество оптимизаторов, LEAN-специалисты, lean';
				$description = 'Портал профессионального сообщества оптимизаторов и LEAN-специалистов';
			break;
			case 'articles':
				$title = "Статьи Lean-center";
				$keywords = "lean-center статьи, непрерывное совершенствование, LEAN";
				$description = "Статьи и публикации на портале lean-center.ru. Портал профессионального сообщества оптимизаторов и LEAN-специалистов.";
			break;
			case 'videos':
				$title = "Видео Lean-center";
				$keywords = "lean-center.ru, видео про LEAN";
				$description = "Видео про LEAN. Портал профессионального сообщества оптимизаторов и LEAN-специалистов.";
			break;
			case 'authors':
				$title = "Авторы Lean-center";
				$keywords = "авторы, lean-center.ru, портал LEAN";
				$description = "Авторы на портале lean-center.ru. Портал профессионального сообщества оптимизаторов и LEAN-специалистов.";
			break;
			case 'journal_lean':
				$title = 'Журнал "Lean-center"';
				$keywords = 'lean-center, журнал по оптимизации производства';
				$description = 'Lean-center.ru - портал профессионального сообщества оптимизаторов и LEAN-специалистов.';
				break;
			case 'search':
				$title = 'Поиск lean-center';
				$keywords = 'поиск, статьи, lean-center.ru';
				$description = 'Поиск lean-center. Портал профессионального сообщества оптимизаторов и LEAN-специалистов.';
			break;
			case 'about':
				$title = 'О проекте Lean-center';
				$keywords = 'о проекте lean center, 5S, TPM, SMED, Агенты изменений, оптимизаторы';
				$description = 'О проекте lean-center.ru. Портал профессионального сообщества оптимизаторов и LEAN-специалистов.';
			break;
			case 'azbuka_lean':
				$title = 'Азбука LEAN';
				$keywords = 'lean-center, азбука, термины, сокращения, инструменты LEAN';
				$description = 'Азбука lean-center.ru. Портал профессионального сообщества оптимизаторов и LEAN-специалистов.';
			break;
			case 'article':
				$article_id = isset($_GET['id']) ? abs((int)$_GET['id']) : null;
				$article = $this->m->get_all_articles_meta($article_id);
				foreach($article as $item) {
					$title = $item['title'];
					$keywords = $item['keywords'];
					$description = $item['description'];
				}
			break;
			case 'authoram':
				$title = 'Авторам Lean-center';
				$keywords = 'авторам lean center, правила публикации';
				$description = 'Авторам lean-center.ru. Правила публикации на портале lean-center.ru';
			break;
			case 'partneram':
				$title = 'Партнерам Lean-center';
				$keywords = 'партнерам lean center, информационное партнерство';
				$description = 'Партнерам lean-center.ru. Информационное партнерство портала lean-center.ru';
			break;
			case 'sponsoram':
				$title = 'Спонсорам Lean-center';
				$keywords = 'спонсорам lean center, LEAN реклама';
				$description = 'Спонсорам lean-center.ru. LEAN реклама на портале.';
			break;
			case 'archive_news':
				$title = 'Архив новостей Lean-center';
				$keywords = 'архив новостей, lean-center, семинары, нормирование труда, аутсорсинг СОП';
				$description = 'Архив новостей lean-center.ru. Семинары, нормирование труда, аутсорсинг СОП';
			break;
			case 'archive_events':
				$title = 'Архив событий Lean-center';
				$keywords = 'архив событий, lean-center.ru, прошедшие события LEAN';
				$description = 'Архив событий lean-center.ru. Портал профессионального сообщества оптимизаторов и LEAN-специалистов.';
			break;
			case 'reg':
				$title = 'Регистрация на портале Lean-center.ru';
				$keywords = 'регистрация на LEAN-center.ru';
				$description = 'Регистрация на портале Lean-center.ru. Портал профессионального сообщества оптимизаторов и LEAN-специалистов.';
			break;
			case 'reg_business':
				$title = 'Регистрация участников бизнес-завтрака 16.09.2015';
				$keywords = 'регистрация, бизнес-завтрак, lean-center.ru';
				$description = 'Регистрация участников бизнес-завтрака 16.09.2015';
			break;
			default:
				$title = 'Портал Lean-center';
				$keywords = 'Портал lean-center.ru, сообщество оптимизаторов, LEAN-специалисты, lean';
				$description = 'Портал профессионального сообщества оптимизаторов и LEAN-специалистов';
			break;
		}
		$meta['title'] = $title;
		$meta['keywords'] = $keywords;
		$meta['description'] = $description;
		return $meta;
	}
}
?>