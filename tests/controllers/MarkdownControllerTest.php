<?php
/**
 * Tests for the markdown controller
 *
 * @coversDefaultClass MarkdownController
 *
 * @category silverstripe
 * @package  markdowntextareafield
 * @author   Robbie Averill <robbie@averill.co.nz>
 */
require_once dirname(__FILE__) . '/../SiteTreeCompatibility.php';

class MarkdownControllerTest extends FunctionalTest
{
    /**
     * {@inheritDoc}
     * @var string
     */
    protected static $fixture_file = 'markdowntextareafield/tests/fixtures/pages.yml';

    /**
     * {@inheritDoc}
     * @var bool
     */
    protected static $use_draft_site = true;

    /**
     * Test that a JSON match of data is returned when using the autocomplete endpoint for internal links
     *
     * @covers ::internallinks
     */
    public function testInternalLinks()
    {
        /** @var SS_HTTPResponse $response */
        $response = $this->get('/admin/markdown/internallinks?term=cool');

        $expected = Convert::raw2json(
            array(
                array('id' => 123, 'url_segment' => 'my-first-page', 'title' => 'My cool Page'),
                array('id' => 234, 'url_segment' => 'my-second-page', 'title' => 'Another cool Page')
            )
        );

        $this->assertSame($expected, $response->getBody());
    }
}
