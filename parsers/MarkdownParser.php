<?php
/**
 * Glue between Silverstripe TextParser interface and Michelf's markdown parser.
 */
class MarkdownParser extends TextParser {
	
    /**
     * Parse Markdown content
     * @return string
     */
	function parse() {
		return Michelf\Markdown::defaultTransform($this->content);
	}

    /**
     * Parse MarkdownExtra content
     * @return string
     */
	function parseExtra() {
		return Michelf\MarkdownExtra::defaultTransform($this->content);
	}

}
