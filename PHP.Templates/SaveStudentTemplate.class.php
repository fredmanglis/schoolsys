<?php
require_once("BaseTemplateWithNav.class.php");

class SaveStudentTemplate extends BaseTemplateWithNav {
	private $student;

	public function __construct($filename, $student) {
		$this->check_not_null($student, "Student MUST NOT be null");
		$this->student = $student;
		parent::__construct($filename);
	}

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();

		$domDocument->removeClass($domDocument->getElementById("save_student_success"), "removable");
		$domDocument->getElementById("schoolID_save")->nodeValue = $this->student->getSchoolID();
		$domDocument->getElementById("name")->nodeValue = $this->student->getSurName()." ".$this->student->getOtherNames();
		$domDocument->getElementById("marks")->nodeValue = $this->student->getKCPEScore();
		$domDocument->getElementById("admittedOn")->nodeValue = $this->student->getDateOfAdmission();
	}

}