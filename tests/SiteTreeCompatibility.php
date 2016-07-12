<?php
/**
 * The tests use SiteTree - in the case where a CMS is not present, this is a simple replacement
 *
 * @category SilverStripe
 * @package  markdowntextareafield
 * @author   Robbie Averill <robbie@averill.co.nz>
 */
if (!class_exists('SiteTree', false)) {
    class SiteTree extends DataObject implements TestOnly
    {
        private static $db = array(
            'Title'      => 'Varchar',
            'URLSegment' => 'Varchar'
        );
    }
}
