# Markdown capable TextareaField for Silverstripe CMS

[![Packagist](https://img.shields.io/packagist/v/robbieaverill/silverstripe-markdowntextareafield.svg)](https://packagist.org/packages/robbieaverill/silverstripe-markdowntextareafield) [![Packagist](https://img.shields.io/packagist/dt/robbieaverill/silverstripe-markdowntextareafield.svg)](https://packagist.org/packages/robbieaverill/silverstripe-markdowntextareafield) [![Code quality via Scrutinizer CI](https://scrutinizer-ci.com/g/robbieaverill/silverstripe-markdowntextareafield/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/robbieaverill/silverstripe-markdowntextareafield/)

## Features
 * Live preview (toggle)
 * Extendable toolbar with common markdown functions
 * Support for both regular markdown and [extra functions](http://michelf.ca/projects/php-markdown/extra)

## Screenshot

![Markdown editor screenshot](/templates/images/screenshot.png?raw=true)

## Credits and Authors

 * Original author - Priit Hansen (@priithansen)
 * Maintainer - Robbie Averill (@robbieaverill)
 * Silverstripe CMS - <http://www.silverstripe.org/>
 * PHP Markdown - <http://michelf.ca/projects/php-markdown/>
 * Rangy Text Inputs - <http://code.google.com/p/rangy/>
 * Markdown syntax - <http://daringfireball.net/projects/markdown/>
 * Icons - <http://www.famfamfam.com/lab/icons/silk/>

## Requirements

 * SilverStripe >= 3.1
 * [PHP Markdown](https://github.com/michelf/php-markdown)

## Installation

 * Use composer to install `composer require robbieaverill/silverstripe-markdowntextareafield:*`
 * Run `/dev/build?flush=1`

### Instructions

You can use the `MarkdownText` data type for regular markdown or `MarkdownTextExtra` for added syntax features:

```php
class Page extends SiteTree {

    private static $db = array(
        'MarkdownContent' => 'MarkdownTextExtra',
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $markdownfield = MarkdownTextareaField::create('MarkdownContent');
        $markdownfield->enableExtra(); // Enables extra syntax support for fields live preview.

        $fields->addFieldToTab('Root.Main', $markdownfield);        
        return $fields;
    }
}
```

### Template:

It is also possible to override/use markdown syntax in templates:

```html
<div class="content">
    $MarkdownContent    <!-- Depending on data type used -->
</div>

<div class="content">
    $MarkdownContent.MarkdownAsHTML    <!-- Works with both data types, regular markdown -->
</div>

<div class="content">
    $MarkdownContent.MarkdownExtraAsHTML    <!-- Works with both data types, extended syntax -->
</div>

<div class="content">
    <pre>
        // Render JSON content
        $MarkdownContent.MarkdownAsJS
        // or
        $MarkdownContent.MarkdownExtraAsJS
    </pre>
</div>
```

## Notes

 * Bug reports and ideas more than welcome.
