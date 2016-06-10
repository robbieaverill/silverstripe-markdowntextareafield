<?php
/**
 * Same as MarkdownText but Extra markup is enabled by default.
 *
 * @category silverstripe
 * @package  markdowntextareafield
 */
class MarkdownTextExtra extends MarkdownText
{
    /**
     * Return MarkdownExtra content as HTML for templates
     * @return string HTML
     */
    public function forTemplate()
    {
        return $this->MarkdownExtraAsHTML();
    }

    /**
     * Return an instance of the MarkdownTextareaField
     * @param  string $title
     * @param  array  $params
     * @return MarkdownTextareaField
     */
    public function scaffoldFormField($title = null, $params = null)
    {
        $field = new MarkdownTextareaField($this->name, $title);
        return $field->enableExtra();
    }
}
