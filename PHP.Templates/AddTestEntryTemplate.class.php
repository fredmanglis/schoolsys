<?php
require_once("BaseTemplateWithNav.class.php");

class AddTestEntryTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();
		$domDocument->removeClass($domDocument->getElementById("add_edit_test_bulk"), "removable");

		$domDocument->getElementById("bulk_entry_form")->setAttribute("action", "?section=tests&action=entry&mode=bulk");
	}

}