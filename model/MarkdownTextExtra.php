<?php
/**
 * Same as MarkdownText but Extra markup is enabled by default.
 */
class MarkdownTextExtra extends MarkdownText {


	public function forTemplate() {
		return $this->MarkdownExtraAsHTML();
	}

	public function scaffoldFormField($title = null, $params = null) {
		$field = new MarkdownTextareaField($this->name, $title);
		return $field->enableExtra();
	}
}