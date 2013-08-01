<?php

// Make sure modules folder name is correct
$dir = basename(dirname(__FILE__));

if($dir != "markdowntextareafield") {
	user_error('Markdown: Directory name must be "markdowntextareafield" (currently "'.$dir.'")',E_USER_ERROR);
}

Requirements::css('markdowntextareafield/templates/css/styles.css');

Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
Requirements::javascript(THIRDPARTY_DIR. '/jquery-entwine/dist/jquery.entwine-dist.js');
Requirements::javascript('markdowntextareafield/templates/javascript/script.js');

//Requirements::javascript('markdown/templates/javascript/textinputs_jquery.js');