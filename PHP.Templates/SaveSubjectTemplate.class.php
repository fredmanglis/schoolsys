<?php
require_once("BaseTemplate.class.php");
require_once("BaseTemplateWithNav.class.php");

class SaveSubjectTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();
		$domDocument->removeClass($domDocument->getElementById("save_subject_success"), "removable");
	}

}