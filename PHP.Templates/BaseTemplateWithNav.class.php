<?php
require_once("BaseTemplate.class.php");
require_once("NavigationTemplate.class.php");

abstract class BaseTemplateWithNav {
	private function $navTemplate;

	public function __construct($fileName, $navTemplate) {
		$this->check_valid($navTemplate);
		parent::__construct($fileName);
		$this->navTemplate = $navTemplate;
		$this->add_navigation();
	}

	private function add_navigation() {
		// TODO: copy navigation links from nav file to domDocument
	}

	private function check_valid($navTemplate) {
		$this->check_not_null($navFile, "You MUST provide a non-null object of NavigationTemplate class");
		if(!($nav instanceof NavigationTemplate)) {
			throw new Exception("You MUST provide an object of NavigationTemplate class");
		}
	}

}

?>