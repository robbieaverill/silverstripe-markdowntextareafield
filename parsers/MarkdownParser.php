<?php

class MarkdownParser extends TextParser {
	
	function parse() {
		return Michelf\Markdown::defaultTransform($this->content);
	}
}