<?php
require_once("BaseTemplate.class.php");
require_once("NavigationTemplate.class.php");
require_once("BaseTemplateWithNav.class.php");

class SaveStudentTemplate extends BaseTemplateWithNav {
	private $student;

	public function __construct($filename, $navFile, $student) {
		$this->check_not_null($student, "Student MUST NOT be null");
		$this->student = $student;
		parent::__construct($filename, $navFile);
	}

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();

		$domDocument->getElementById("schoolID")->nodeValue = $this->student->getSchoolID();
		$domDocument->getElementById("name")->nodeValue = $this->student->getSurName()." ".$this->student->getOtherNames();
		$domDocument->getElementById("marks")->nodeValue = $this->student->getKCPEScore();
		$domDocument->getElementById("admittedOn")->nodeValue = $this->student->getDateOfAdmission();
	}

}