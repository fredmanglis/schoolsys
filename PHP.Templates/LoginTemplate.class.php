<?php
require_once("BaseTemplate.class.php");

class LoginTemplate extends BaseTemplate {

	protected function update_dom_document() {
		$domDocument = $this->get_dom_document();
		$form = $domDocument->getElementsByTagName('form')->item(0);
		$form->setAttribute("action", "?section=access&action=toggle");
	}

}
?>