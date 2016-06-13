<?php
/**
 * Tests for the markdowntextareafield module: parser, form field, etc
 *
 * @coversDefaultClass MarkdownParser
 *
 * @category silverstripe
 * @package  markdowntextareafield
 * @author   Robbie Averill <robbie@averill.co.nz>
 */
class MarkdownParserTest extends SapphireTest
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
     * If Fluent is installed locale codes in URLs will break the expectations
     */
    public function setUp()
    {
        parent::setUp();
        if (class_exists('Fluent')) {
            Config::inst()->update('Fluent', 'disable_default_prefix', true);
        }
    }

    /**
     * Integration-esque tests ensuring that markdown is correctly parsed to HTML
     *
     * @dataProvider markdownProvider
     * @covers ::parse
     *
     * @param string $markdown
     * @param string $expected
     */
    public function testParseMarkdown($markdown, $expected)
    {
        $parser = new MarkdownParser($markdown);
        $result = $parser->parse();
        $this->assertSame($expected, $result);
    }

    /**
     * @return array
     */
    public function markdownProvider()
    {
        $first = array(
            'This is *italic* text',
            '<p>This is <em>italic</em> text</p>' . PHP_EOL
        );

        $second = array();
        $second[] = <<<MARKDOWN
# A heading

---

* Bullet 1
* Bullet 2
* Bullet 3
MARKDOWN;

        $second[] = <<<EXPECTED
<h1>A heading</h1>

<hr />

<ul>
<li>Bullet 1</li>
<li>Bullet 2</li>
<li>Bullet 3</li>
</ul>

EXPECTED;

        return array($first, $second);
    }

    /**
     * Test that internal SilverStripe links are converted to HTML using the correct URL link for the Page
     * that is specified by an ID.
     *
     * @covers ::handleInternalLinks
     * @covers MarkdownHelper::internalMarkdownLink
     */
    public function testReplaceInternalLinks()
    {
        $markdown = <<<MD
**Markdown**. A [normal](http://google.com) link, an [internal link](#internal-link:234). _Markdown_.

A [broken link](#nowhere-ever:12346578978798) should just be a hash.

More markdown, [another internal link](#something:345).

Finito.

MD;
    
        $expected = <<<OUT
<p><strong>Markdown</strong>. A <a href="http://google.com">normal</a> link, an <a href="/my-second-page/">internal link</a>. <em>Markdown</em>.</p>

<p>A <a href="#">broken link</a> should just be a hash.</p>

<p>More markdown, <a href="/my-third-page/">another internal link</a>.</p>

<p>Finito.</p>

OUT;

        $parser = new MarkdownParser($markdown);
        $result = $parser->parse();

        $this->assertSame($expected, $result);
    }
}
