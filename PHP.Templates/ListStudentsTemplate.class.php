<?php
require_once("BaseTemplate.class.php");
require_once("BaseTemplateWithNav.class.php");

class ListStudentsTemplate extends BaseTemplateWithNav {
	private $students;

	public function __construct($filename, $students) {
		$this->students = $students;
		parent::__construct($filename);
	}

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();
		$domDocument->removeClass($domDocument->getElementById("list_students"), "removable");
		$finder = new DOMXpath($domDocument);
		$temp = $domDocument->getElementsByClass('student_row')->item(0);

		if($this->students) {
			$count = 1;
			foreach($this->students as $studentID) {
				$student = new Student($studentID);
				$newRow = $this->create_student_row($temp, $student, $count);
				$temp->parentNode->appendChild($newRow);
				$count++;
			}
		}
	}

	private function create_student_row($clonableRow, $student, $count) {
		$domDocument = $this->get_dom_document();
		$row = clone $clonableRow;
		$row->setAttribute("class", "student_row");

		$newDoc = new SSDOMDocument();
		$newDoc->loadXML('<?xml version="1.0"?><row></row>');
		$temp = $newDoc->importNode($row, true);
		$newDoc->appendChild($temp);

		$countElt = $newDoc->getElementsByClass('count')->item(0);
		$countElt->nodeValue = $count;

		$schIDElt = $newDoc->getElementsByClass('school_id')->item(0);
		$schIDElt->nodeValue = $student->getSchoolID();

		$classElt = $newDoc->getElementsByClass('class')->item(0);
		$classElt->nodeValue = "FORM ".$student->getYearOfStudy();

		$nameElt = $newDoc->getElementsByClass('name')->item(0);
		$nameElt->nodeValue = $student->getSurName()." ".$student->getOtherNames();

		$viewElt = $newDoc->getElementsByClass('view_student')->item(0);
		$viewElt->setAttribute("href", "?section=students&action=view&target=".$student->getUniqueID());

		$editElt = $newDoc->getElementsByClass('edit_student')->item(0);
		$editElt->setAttribute("href", "?section=students&action=edit&target=".$student->getUniqueID());

		$newRow = $domDocument->importNode($temp, true);
		return $newRow;
	}

}