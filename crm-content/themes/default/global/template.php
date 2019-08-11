<?php 

class TemplateDefault extends TemplateBase {
	public function getSubscripts() {
		$this->includeFile('/global/subscripts.php');
	}
}