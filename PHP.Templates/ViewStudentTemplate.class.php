<?php
require_once("BaseTemplate.class.php");
require_once("NavigationTemplate.class.php");
require_once("BaseTemplateWithNav.class.php");

class ViewStudentTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();

		$studentID = $_REQUEST['target'];
		$student = new Student($studentID);

		$domDocument->getElementById('school_id')->nodeValue = $student->getSchoolID();
		$domDocument->getElementById('student_name')->nodeValue = $student->getSurName()." ".$student->getOtherNames();
		$domDocument->getElementById('marks')->nodeValue = $student->getKCPEScore();
		$domDocument->getElementById('admission_date')->nodeValue = $student->getDateOfAdmission();
	}

}