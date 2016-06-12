<?php
/**
 * The markdown controller renders autocomplete results in JSON
 *
 * @category silverstripe
 * @package  markdowntextareafield
 * @author   Robbie Averill <robbie@averill.co.nz>
 */
class MarkdownController extends Controller
{
    /**
     * {@inheritDoc}
     * @var array
     */
    private static $allowed_actions = array('internallinks');

    /**
     * Given a search term, find a few relevant Page results and return as JSON
     *
     * @param  SS_HTTPRequest $request
     * @return string                  JSON
     */
    public function internallinks(SS_HTTPRequest $request)
    {
        $term = Convert::raw2sql($this->getRequest()->getVar('term'));

        /** @var DataList $pages */
        $pages = DataObject::get('SiteTree', "\"Title\" LIKE '%$term%'")->limit(10);

        $output = array();
        foreach ($pages as $page) {
            $output[] = array(
                'id'          => $page->ID,
                'url_segment' => $page->URLSegment,
                'title'       => $page->Title
            );
        }

        $this->response->addHeader('Content-Type', 'application/json');
        return Convert::array2json($output);
    }
}
