<?php
require_once("BaseTemplate.class.php");
require_once("BaseTemplateWithNav.class.php");

class AddStudentTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();

		$domDocument->removeClass($domDocument->getElementById("add_edit_student"), "removable");
		$domDocument->getElementById("add_edit_student_form")->setAttribute("action", "?section=students&action=add");
	}

}
