<?php

class SSDOMDocument extends DOMDocument {

	public function getElementsByClass($class) {
		$finder = new DOMXpath($this);
		return $finder->query("//*[contains(normalize-space(@class), '$class')]");
	}

}

?>