<?php

// Make sure modules folder name is correct
$dir = basename(dirname(__FILE__));

if ($dir != 'markdowntextareafield') {
	user_error(
        'Markdown: Directory name must be "markdowntextareafield" (currently "' . $dir . '")',
        E_USER_ERROR
    );
}
