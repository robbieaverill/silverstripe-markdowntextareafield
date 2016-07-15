function initializeMarkdownEditor() {
    jQuery.entwine('markdowntextareafield', function() {
        jQuery('.bu_markdown').each(function() {
            var simplemde = new SimpleMDE({
                element: this,
                spellChecker: false, // temporary
                hideIcons: ["heading","image","side-by-side","preview","side-by-side","preview"],
                promptURLs: true,
                forceSync: true
            });
        });
    });
}

/**
 * After document ready calls
 */
jQuery(document).ready(function() {
    initializeMarkdownEditor();
});

/**
 * After ajaxStop calls
 */
jQuery(document).ajaxStop(function(event) {
    if (event.target['activeElement'].id == 'link-autocomplete') {
       return false;
    }
    initializeMarkdownEditor();
});
