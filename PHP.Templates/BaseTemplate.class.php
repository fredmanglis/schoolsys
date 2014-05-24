<?php
require_once("SSDOMDocument.class.php");

abstract class BaseTemplate {
	private $fileName = null;
	private $domDocument = null;

	public function __construct($fileName) {
		$this->check_not_null($fileName, 'File name cannot be null or empty');
		$this->fileName = $fileName;
		$this->init_dom_document();
		$this->update_dom_document();
		$this->remove_removables();
	}

	public function get_html_output() {
		return $this->domDocument->saveHTML();
	}

	public function get_ajax_output() {
		// TODO: FIX THIS FOR AJAX
		return $this->domDocument->saveHTML();
	}

	public function get_dom_document() {
		return $this->domDocument;
	}

	abstract protected function update_dom_document();

	private function init_dom_document() {
		$this->domDocument = new SSDOMDocument();
		$this->domDocument->loadHTML(file_get_contents($this->fileName));
	}

	private function remove_removables() {
		$doc = $this->get_dom_document();
		$finder = new DOMXpath($doc);
		$removables = $finder->query("//*[contains(concat(' ',normalize-space(@class),' '), ' removable ')]");
		foreach($removables as $removable) {
			$removable->parentNode->removeChild($removable);
		}
	}

	protected function check_not_null($val, $msg) {
		if(($val == null) || ($val == ''))
			throw new Exception($msg);
	}

}
?>