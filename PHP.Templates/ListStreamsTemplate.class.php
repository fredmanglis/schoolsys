<?php
require_once("BaseTemplateWithNav.class.php");

class ListStreamsTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();
		$domDocument->removeClass($domDocument->getElementById("list_streams"), "removable");
	}

}