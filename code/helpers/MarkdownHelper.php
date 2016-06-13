<?php
/**
 * Helper methods for the markdown module
 *
 * @category silverstripe
 * @package  markdowntextareafield
 * @author   Robbie Averill <robbie@averill.co.nz>
 */
class MarkdownHelper extends Object
{
    /**
     * Get the SiteTree's link and return it. Provides an extension hook to allow for custom handling.
     * @param  SiteTree $siteTree
     * @return string
     */
    public function internalMarkdownLink(SiteTree $siteTree)
    {
        $link = $siteTree->Link();
        $this->extend('updateInternalMarkdownLink', $siteTree, $link);
        return $link;
    }
}
