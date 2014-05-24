<?php
require_once("BaseTemplate.class.php");
require_once("NavigationTemplate.class.php");
require_once("BaseTemplateWithNav.class.php");

class AddTestEntryTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();

		$domDocument->getElementById("bulk_entry_form")->setAttribute("action", "?section=tests&action=entry&mode=bulk");
	}

}