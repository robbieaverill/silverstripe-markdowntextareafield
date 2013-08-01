<?php
/**
 * Represents a large text field that contains HTML and Markdown content.
 * Markdown gets processed automatically to HTML in templates
 */
class MarkdownText extends HTMLText {

	public static $casting = array(
		'MarkdownAsHTML'		=>	'MarkdownText',
		'MarkdownExtraAsHTML' 	=>	'MarkdownText',
	);

	public function forTemplate() {
		return $this->MarkdownAsHTML();
	}

	public function MarkdownAsHTML() {
		$parser = new MarkdownParser($this->value);
		return $parser->parse();
	}

	public function MarkdownExtraAsHTML() {
		$parser = new MarkdownParser($this->value);
		return $parser->parseExtra();
	}

	public function scaffoldFormField($title = null, $params = null) {
		return new MarkdownTextareaField($this->name, $title);
	}
}