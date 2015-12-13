<?php
defined('LEAN') or die("Access Denied");
abstract class Core_Admin {
	protected $m;
	protected $met;
	public function __construct() {
		$this->m = new model();
		$this->met = new method();
	}
	public function get_body($inc) {
		$content = $this->get_content();
		include config::ADMIN_TPL.'inc/index.php';
	}
	abstract function get_content();
}
?>
