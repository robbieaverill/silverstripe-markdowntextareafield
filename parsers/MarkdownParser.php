<?php
/**
 * Glue between Silverstripe TextParser interface and Michel F's markdown parser.
 *
 * @category silverstripe
 * @package  markdowntextareafield
 */
class MarkdownParser extends TextParser
{
    /**
     * Parse Markdown content
     * @return string
     */
    public function parse()
    {
        return Michelf\Markdown::defaultTransform($this->content);
    }

    /**
     * Parse MarkdownExtra content
     * @return string
     */
    public function parseExtra()
    {
        return Michelf\MarkdownExtra::defaultTransform($this->content);
    }
}
