<?php
require_once("BaseTemplate.class.php");
require_once("BaseTemplateWithNav.class.php");

class IndexTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();
		$loginDialog = $domDocument->getElementById("index");
		$domDocument->removeClass($loginDialog, "removable");
	}

}