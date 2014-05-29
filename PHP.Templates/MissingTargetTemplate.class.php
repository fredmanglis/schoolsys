<?php
require_once("BaseTemplate.class.php");
require_once("BaseTemplateWithNav.class.php");

class MissingTargetTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();
	}

}