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
        preg_match_all('~(#[\\w-_]+:\\d+)~', $this->content, $matches);
        if (empty($matches[1])) {
            return $this;
        }

        foreach (array_unique($matches[1]) as $internalLinkSyntax) {
            $pageId = substr($internalLinkSyntax, strrpos($internalLinkSyntax, ':') + 1);

            // Get new URL segment
            $replace = SiteTree::get()->byId($pageId);
            if (!$replace) {
                // Fallback replacement
                $replace = '#';
            } else {
                $replace = $this->getSiteTreeLink($replace);
            }

            // Perform the replacement
            $this->content = str_replace($internalLinkSyntax, $replace, $this->content);
        }
    }

    /**
     * Get the SiteTree's link and return it. Provides an extension hook to allow for custom handling.
     * @param  SiteTree $siteTree
     * @return string
     */
    public function getSiteTreeLink(SiteTree $siteTree)
    {
        $link = $siteTree->Link();
        $this->extend('parseInternalLink', $siteTree, $link);
        return $link;
    }
}
