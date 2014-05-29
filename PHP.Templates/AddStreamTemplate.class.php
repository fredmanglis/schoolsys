<?php
require_once("BaseTemplateWithNav.class.php");

class AddStreamTemplate extends BaseTemplateWithNav {

	public function update_dom_document() {
		$domDocument = $this->get_dom_document();
		$domDocument->removeClass($domDocument->getElementById("add_edit_stream"), "removable");

		$form = $domDocument->getElementById("add_edit_stream_form");
		$form->setAttribute("action", "?section=streams&action=add");
	}

}