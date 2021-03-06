<?php
defined('LEAN') or die('Access Denied');
class config {
	const HOST = 'localhost';
	// Username
	const USER = '*';
	// Password
	const PASS = '*';
	// Database
	const DB = '*';
	// Полный путь
	const PATH = 'http://localhost/lean-center.ru/';
	// Активный шаблон
	const TEMPLATE = 'view/lean-center/';
	// Путь до файлов
	const FILES = '/userfiles/files/';
	// Модель
	const MODEL = 'model/model.php';
	// Функции
	const FUNC = 'model/method.php';
	// Количество статей на странице
	const PERPAGE_ARTICLES = 12;
	// Кол-во архивных новостей
	const LIMIT_ARCHIVE_NEWS = 10;
	// Максимальный размер файла
	const SIZE = 3145728;
	// Кол-во выводимых событий в сайдбаре
	const LIMIT_EVENTS = 7;
	const LIMIT_NEWS = 5;
	const ADMIN_TPL = 'view/';
}
