<?php
defined('LEAN') or die('Access Denied');
abstract class Core {
	protected $m;
	protected $f;
	public function __construct() {
		$this->m = new model();
		$this->met = new method();
	}
	public function get_body($inc) {
		$content = $this->get_content();
		include config::TEMPLATE.'inc/index.php';
	}
	abstract function get_content();
}
?>