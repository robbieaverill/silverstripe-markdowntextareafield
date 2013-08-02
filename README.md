# Markdown capable TextareaField for Silverstripe CMS

## Features
 * Live preview
 * Extendable toolbar with common markdown functions
 * Support for both regular markdown and [extra functions](http://michelf.ca/projects/php-markdown/extra)

## Screenshot

![Alt text](/templates/images/screenshot.png?raw=true)

## Credits and Authors

 * Silverstripe CMS - <http://www.silverstripe.org/>
 * PHP Markdown - <http://michelf.ca/projects/php-markdown/>
 * Rangy Text Inputs - <http://code.google.com/p/rangy/>
 * Markdown syntax - <http://daringfireball.net/projects/markdown/>
 * Icons - <http://www.famfamfam.com/lab/icons/silk/>

## Requirements

 * SilverStripe >=3.1
 * PHP Markdown

## Installation
 
 * Use composer to install `composer require priithansen/silverstripe-markdowntextareafield:*`
 * Run /dev/build?flush=1

### Instructions

You can use MarkdownText data type for regular markdown or MarkdownTextExtra for added syntax features.

```php
class Page extends SiteTree {

    private static $db = array(
        'MarkdownContent' => 'MarkdownTextExtra',
    );

    public function getCMSFields() {
        $fields=parent::getCMSFields();

        $markdownfield = MarkdownTextareaField::create('MarkdownContent')
        $markdownfield->enableExtra(); // Enables extra syntax support for live preview.

        $fields->addFieldToTab('Root.Main', $markdownfield);        
        return $fields;
    }
}
```

### Template:

It is also possible to override markdown syntax in template

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
```

## Notes

 * Bug reports and ideas more than welcome