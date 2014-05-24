<?php
require_once("BaseTemplate.class.php");

class NavigationTemplate extends BaseTemplate {

	protected function update_dom_document() {
		$domDocument = $this->get_dom_document();

		$domDocument->getElementById("add_student_link")->setAttribute("href", "?section=students&action=add");
		$domDocument->getElementById("list_students_link")->setAttribute("href", "?section=students&action=list");

		$domDocument->getElementById("add_subject_link")->setAttribute("href", "?section=subjects&action=add");
		$domDocument->getElementById("list_subjects_link")->setAttribute("href", "?section=subjects&action=list");

		$domDocument->getElementById("add_stream_link")->setAttribute("href", "?section=streams&action=add");
		$domDocument->getElementById("list_streams_link")->setAttribute("href", "?section=streams&action=list");

		$domDocument->getElementById("add_test_link")->setAttribute("href", "?section=tests&action=add");
		$domDocument->getElementById("list_tests_link")->setAttribute("href", "?section=tests&action=list");
		$domDocument->getElementById("entry_bulk_link")->setAttribute("href", "?section=tests&action=entry&mode=bulk");
		$domDocument->getElementById("entry_indiv_link")->setAttribute("href", "?section=tests&action=entry&mode=individual");

		$domDocument->getElementById("username_link")->nodeValue = $_SESSION[ "user" ][ "loggedIn" ]["screenName"];
		$domDocument->getElementById("logout_link")->setAttribute("href", "?section=logout");

	}

}
?>