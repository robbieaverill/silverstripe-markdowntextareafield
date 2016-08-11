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
        $this->handleInternalLinks();
        return Michelf\Markdown::defaultTransform($this->content);
    }

    /**
     * Parse MarkdownExtra content
     * @return string
     */
    public function parseExtra()
    {
        $this->handleInternalLinks();
        return Michelf\MarkdownExtra::defaultTransform($this->content);
    }

    /**
     * Special function to handle internal links (custom format) in markdown before rendering it
     * @return self
     */
    protected function handleInternalLinks()
    {
        preg_match_all('~\[[^\]]*\]\((?P<link_syntax>#[\w-_]+:(?P<page_id>\d+))\)~', $this->content, $matches);
        if (empty($matches['link_syntax']) || empty($matches['page_id'])) {
            return $this;
        }

        foreach ($matches['link_syntax'] as $key => $internalLinkSyntax) {
            // Get new URL segment
            $replace = SiteTree::get()->byId($matches['page_id'][$key]);
            if (!$replace) {
                // Fallback replacement
                $replace = '#';
            } else {
                /**
                 * TextParser is not extensible at the moment - we need to use a temporary helper instead
                 * @see https://github.com/silverstripe/silverstripe-framework/pull/5686
                 */
                $helper = MarkdownHelper::create();
                $replace = $helper->internalMarkdownLink($replace);
            }

            // Perform the replacement
            $this->content = str_replace($internalLinkSyntax, $replace, $this->content);
        }
    }
}
