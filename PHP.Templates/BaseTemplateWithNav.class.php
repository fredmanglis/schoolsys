<?php
require_once("BaseTemplate.class.php");
require_once("NavigationTemplate.class.php");

abstract class BaseTemplateWithNav extends BaseTemplate {
	private $navTemplate;

	public function __construct($fileName, $navTemplate) {
		$this->check_valid($navTemplate);
		parent::__construct($fileName);
		$this->navTemplate = $navTemplate;
		$this->add_navigation();
	}

	private function add_navigation() {
		// TODO: copy navigation links from nav file to domDocument
		$domDocument = $this->get_dom_document();
		$finder = new DomXPath($domDocument);
		$body = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' body ')]")->item(0);

		$navDocument = $this->navTemplate->get_dom_document();
		$finder2 = new DomXPath($navDocument);
		$nav = $finder2->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' header ')]")->item(0);
		$imported = $domDocument->importNode($nav, true);
		$body->parentNode->insertBefore($imported, $body);
	}

	protected function check_valid($navTemplate) {
		$this->check_not_null($navTemplate, "You MUST provide a non-null object of NavigationTemplate class");
		if(!($navTemplate instanceof NavigationTemplate)) {
			throw new Exception("You MUST provide an object of NavigationTemplate class");
		}
	}

}

?>