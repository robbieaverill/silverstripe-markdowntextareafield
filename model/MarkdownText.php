<?php
/**
 * Represents a large text field that contains HTML and Markdown content.
 * Markdown gets processed automatically to HTML in templates
 */
class MarkdownText extends HTMLText {

	/**
	 * Define the casting for field names and types
	 * @var array
	 */
	public static $casting = array(
		'MarkdownAsHTML'		=>	'MarkdownText',
		'MarkdownExtraAsHTML' 	=>	'MarkdownText',
	);

	/**
	 * Returns Markdown content as HTML for templates
	 * @return string HTML
	 */
	public function forTemplate() {
		return $this->MarkdownAsHTML();
	}

	/**
	 * Return Markdown content as HTML
	 * @return string HTML
	 */
	public function MarkdownAsHTML() {
		$parser = new MarkdownParser($this->value);
		return $parser->parse();
	}

	/**
	 * Return MarkdownExtra content as HTML
	 * @return string HTML
	 */
	public function MarkdownExtraAsHTML() {
		$parser = new MarkdownParser($this->value);
		return $parser->parseExtra();
	}

	/**
	 * Return an instance of the MarkdownTextareaField
	 * @param  string $title
	 * @param  array  $params
	 * @return MarkdownTextareaField
	 */
	public function scaffoldFormField($title = null, $params = null) {
		return new MarkdownTextareaField($this->name, $title);
	}

}
