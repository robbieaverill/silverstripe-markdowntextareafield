<?php

// Make sure modules folder name is correct
$dir = basename(dirname(__FILE__));

if ($dir != 'markdowntextareafield') {
    user_error(
        'Markdown: Directory name must be "markdowntextareafield" (currently "' . $dir . '")',
        E_USER_ERROR
    );
}

define('MARKDOWN_DIR', $dir);
Requirements::javascript(FRAMEWORK_DIR . '/thirdparty/jquery/jquery.js');
Requirements::javascript(MARKDOWN_DIR . '/thirdparty/codemirror.js');
Requirements::css(MARKDOWN_DIR . '/thirdparty/codemirror.css');

/**
 * Moved codemirror to the local repo to have more control over always changing an unstable repo from the vendor
 * https://github.com/kmddev/simplemde-markdown-editor/
 * @author: Matias Nombarasco <matias.nombarasco@kathmandu.co.nz>
 */
Requirements::javascript(MARKDOWN_DIR . '/thirdparty/simplemde.min.js');
Requirements::css(MARKDOWN_DIR . '/thirdparty/simplemde.min.css');

Requirements::javascript(MARKDOWN_DIR . '/thirdparty/modal.support.js');
LeftAndMain::require_javascript(MARKDOWN_DIR . '/js/markdowntextareafield.js');
