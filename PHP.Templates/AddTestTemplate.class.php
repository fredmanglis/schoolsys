<?php
require_once("BaseTemplateWithNav.class.php");

class AddTestTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();
		$domDocument->removeClass($domDocument->getElementById("add_edit_test"), "removable");
	}

}