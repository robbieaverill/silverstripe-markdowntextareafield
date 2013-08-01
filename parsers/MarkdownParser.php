<?php
/**
 * Glue between Silverstripe TextParser interface and Michelf's markdown parser.
 */
class MarkdownParser extends TextParser {
	
	function parse() {
		return Michelf\Markdown::defaultTransform($this->content);
	}

	function parseExtra() {
		return Michelf\MarkdownExtra::defaultTransform($this->content);
	}
}