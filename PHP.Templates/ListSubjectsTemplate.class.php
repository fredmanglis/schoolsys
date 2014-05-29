<?php
require_once("BaseTemplate.class.php");
require_once("BaseTemplateWithNav.class.php");

class ListSubjectsTemplate extends BaseTemplateWithNav {
	private $subjects;

	public function __construct($filename, $subjects) {
		$this->check_not_null($subjects, "You must provide subjects to list");
		$this->subjects = $subjects;
		parent::__construct($filename);
	}

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();
		$domDocument->removeClass($domDocument->getElementById("list_subjects"), "removable");

		$temp = $domDocument->getElementsByClass("subject_row")->item(0);
		$count = 1;
		foreach($this->subjects as $subjectID) {
			$subject = new Subject($subjectID);
			$row = $this->create_subject_row($temp, $subject, $count);
			$temp->parentNode->appendChild($row);
			$count++;
		}
		$domDocument->addClass($temp, "removable");
	}

	private function create_subject_row($clonableRow, $subject, $count) {
		$domDocument = $this->get_dom_document();
		$row = clone $clonableRow;
		$row->setAttribute("class", "student_row");

		$newDoc = new SSDOMDocument();
		$newDoc->loadXML('<?xml version="1.0"?><row></row>');
		$temp = $newDoc->importNode($row, true);
		$newDoc->appendChild($temp);

		$countElt = $newDoc->getElementsByClass('count')->item(0);
		$countElt->nodeValue = $count;

		$schIDElt = $newDoc->getElementsByClass('knec_code')->item(0);
		$schIDElt->nodeValue = $subject->getCode();

		$classElt = $newDoc->getElementsByClass('subject')->item(0);
		$classElt->nodeValue = $subject->getName();

		$nameElt = $newDoc->getElementsByClass('startYr')->item(0);
		$nameElt->nodeValue = "Form ".$subject->getStartYear();

		$nameElt = $newDoc->getElementsByClass('stopYr')->item(0);
		$nameElt->nodeValue = "Form ".$subject->getStopYear();

		$viewElt = $newDoc->getElementsByClass('view_subject')->item(0);
		$viewElt->setAttribute("href", "?section=subjects&action=view&target=".$subject->getUniqueID());

		$editElt = $newDoc->getElementsByClass('edit_subject')->item(0);
		$editElt->setAttribute("href", "?section=subjects&action=edit&target=".$subject->getUniqueID());

		$newRow = $domDocument->importNode($temp, true);
		return $newRow;
	}

}