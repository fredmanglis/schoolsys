<?php
require_once("BaseTemplate.class.php");

class LoginErrorTemplate extends BaseTemplate {

	protected function update_dom_document() {
		$domDocument = $this->get_dom_document();
		$loginDialog = $domDocument->getElementById("login_error_dialog");
		$domDocument->removeClass($loginDialog, "removable");

		$domDocument->addClass($domDocument->getElementsByClass("header")->item(0), "removable");
	}

}
?>