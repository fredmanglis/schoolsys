<?php
require_once("BaseTemplate.class.php");

class LoginTemplate extends BaseTemplate {

	protected function update_dom_document() {
		$domDocument = $this->get_dom_document();
		$form = $domDocument->getElementById('login_form');
		$form->setAttribute("action", "?section=access&action=toggle");
		$loginDialog = $domDocument->getElementById("login_dialog");
		$domDocument->removeClass($loginDialog, "removable");

		$domDocument->addClass($domDocument->getElementsByClass("header")->item(0), "removable");
	}

}
?>