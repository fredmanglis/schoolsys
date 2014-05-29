<?php

class SSDOMDocument extends DOMDocument {

	public function getElementsByClass($class) {
		$finder = new DOMXpath($this);
		return $finder->query("//*[contains(normalize-space(@class), '$class')]");
	}

	public function addClass($element, $className) {
		$classes = trim($element->getAttribute("class"));
		$className = trim($className);
		if(!stristr($classes, $className)) {
			$element->setAttribute("class", $classes." ".$className);
		}
	}

	public function removeClass($element, $className) {
		$classes = trim($element->getAttribute("class"));
		$className = trim($className);
		if(stristr($classes, $className)) {
			$arr = explode($className, $classes);
			for($i = 0; $i < count($arr); $i++) {
				$arr[$i] = trim($arr[$i]);
			}
			$classes = implode(' ', $arr);
			$element->setAttribute("class", $classes);
		}
	}

}

?>