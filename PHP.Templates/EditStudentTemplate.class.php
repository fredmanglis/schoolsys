<?php
require_once("BaseTemplate.class.php");
require_once("NavigationTemplate.class.php");
require_once("BaseTemplateWithNav.class.php");

class EditStudentTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();

		$student = new Student( $_REQUEST['target'] );
		if($student) {
			$domDocument->getElementById("edit_student_form")->setAttribute("action", "?section=students&action=edit&target=".$student->getUniqueID());
			$domDocument->getElementById("schoolID")->setAttribute("value", $student->getSchoolID());
			$domDocument->getElementById("surname")->setAttribute("value", $student->getSurName());
			$domDocument->getElementById("otherNames")->setAttribute("value", $student->getOtherNames());
			$this->select_option_by_id("gender", $student->getGender());
			$this->select_option_by_id("stream", $student->getStream());
			$this->select_option_by_id("yearOfStudyAtAdmission", $student->getYearOfStudyAtAdmission());
			$domDocument->getElementById("KCPEScore")->setAttribute("value", $student->getKCPEScore());
			$domDocument->getElementById("dateOfAdmission")->setAttribute("value", $student->getDateOfAdmission());
		}
	}

	private function select_option_by_id($eltId, $val) {
		$domDocument = $this->get_dom_document();
		$selectElt = $domDocument->getElementById($eltId);
		foreach($selectElt->childNodes as $option) {
			if($option->getAttribute("value") == $val) {
				$option->setAttribute("selected", "selected");
				break;
			}
		}
	}

}