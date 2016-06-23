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
     * Returns the field holder used by templates
     *
     * @param  array $properties
     * @return string            HTML to be used
     */
    public function FieldHolder($properties = array())
    {
        Requirements::javascript(MARKDOWN_DIR . '/thirdparty/codemirror.js');
        Requirements::css(MARKDOWN_DIR . '/thirdparty/codemirror.css');

        /**
         * Moved codemirror to the local repo to have more control over always changing an unstable repo from the vendor
         * https://github.com/kmddev/simplemde-markdown-editor/
         * @author: Matias Nombarasco <matias.nombarasco@kathmandu.co.nz>
         */
        Requirements::javascript(MARKDOWN_DIR . '/thirdparty/modal.support.js');
        Requirements::javascript(MARKDOWN_DIR . '/thirdparty/autocomplete.min.js');
        Requirements::javascript(MARKDOWN_DIR . '/thirdparty/simplemde.min.js');
        Requirements::css(MARKDOWN_DIR . '/thirdparty/simplemde.min.css');

        $hideIcons = Convert::raw2json(Config::inst()->get(__CLASS__, 'hideicons'));

        Requirements::customScript(
            <<<JS
                var registerMarkdownEditor = function() {
                   var simplemde = new SimpleMDE({
                        element: document.getElementById('{$this->ID()}'),
                        spellChecker: false, // temporary
                        hideIcons: {$hideIcons},
                        promptURLs: true,
                        forceSync: true
                   });
                };

                registerMarkdownEditor();

                jQuery(document).ajaxComplete(function() {
                   registerMarkdownEditor();
                });
JS
        );

        // Our modifications for SilverStripe
        Requirements::css(MARKDOWN_DIR . '/templates/css/styles.css');

        return parent::FieldHolder($properties);
    }

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
