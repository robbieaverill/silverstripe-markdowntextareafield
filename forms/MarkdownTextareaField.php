<?php
/**
 * Configure the input field for markdown
 *
 * @category silverstripe
 * @package  markdowntextareafield
 */
class MarkdownTextareaField extends TextareaField
{
    /**
     * Define the actions allowed on this field
     * @var array
     */
    private static $allowed_actions = array(
        'parse'
    );

    /**
     * Default on TextareaField is too small
     * @var int Visible number of text lines.
     */
    protected $rows = 15;

    /**
     * Toggle rendering markdown with extra syntax enabled.
     * @link http://michelf.ca/projects/php-markdown/extra
     * @var boolean
     */
    protected $enable_extra = false;

    /**
     * Turn on extra syntax support
     * @return MarkdownTextareaField
     */
    public function enableExtra()
    {
        $this->enable_extra = true;
        return $this;
    }

    /**
     * Parse markdown into html
     * @return string html
     */
    public function parse()
    {
        $parser = new MarkdownParser($this->request['markdown']);

        return ($this->enable_extra) ? $parser->parseExtra() : $parser->parse();
    }
}
