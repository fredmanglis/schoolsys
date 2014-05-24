<?php
require_once("BaseTemplate.class.php");
require_once("NavigationTemplate.class.php");
require_once("BaseTemplateWithNav.class.php");

class AddStudentTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();

		$domDocument->getElementById("add_student_form")->setAttribute("action", "?section=students&action=add");
	}

}