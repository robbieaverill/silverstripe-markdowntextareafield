<?php
/**
 * Represents a large text field that contains HTML and Markdown content.
 * Markdown gets processed automatically to HTML in templates
 */
class MarkdownText extends Text {

	private static $escape_type = 'xml';


	public function forTemplate() {
		
		// First parse Markdown to HTML then deal with Silverstripe shortcodes
		$parser = new MarkdownParser($this->value);
		$html = $parser->parse();
		
		if ($this->processShortcodes) {
			return ShortcodeParser::get_active()->parse($html);
		}
		else {
			return $html;
		}
	}

	public function scaffoldFormField($title = null, $params = null) {
		return new MarkdownTextareaField($this->name, $title);
	}
}