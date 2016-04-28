<?php
/**
 * Tests for the markdowntextareafield module: parser, form field, etc
 *
 * @category silverstripe
 * @package  markdowntextareafield
 * @author   Robbie Averill <robbie@averill.co.nz>
 */
class MarkdownTest extends SapphireTest
{
    /**
     * Integration-esque tests ensuring that markdown is correctly parsed to HTML
     *
     * @dataProvider markdownProvider
     *
     * @param string $markdown
     * @param string $expected
     */
    public function testParseMarkdown($markdown, $expected)
    {
        $parser = new MarkdownParser($markdown);
        $result = $parser->parse($parser);
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
}
