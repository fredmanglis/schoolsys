<?php
require_once("BaseTemplate.class.php");
require_once("BaseTemplateWithNav.class.php");

class AddSubjectTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();
		$domDocument->removeClass($domDocument->getElementById("add_edit_subject"), "removable");

		$form = $domDocument->getElementById("add_edit_subject_form");
		$form->setAttribute("action", "?section=subjects&action=add");
	}

}