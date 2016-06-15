var modal = (function(){
    var
        method = {},
        $overlay,
        $modal,
        $content,
        $close,
        $url,
        $modalInstance,
        $settings;

    // Append the HTML
    $overlay = jQuery('<div id="overlay"></div>');
    $modal = jQuery('<div id="modal"></div>');
    $content = jQuery('<div id="content"></div>');
    $close = jQuery('<a id="close" href="#">close</a>');

    $modal.hide();
    $overlay.hide();
    $modal.append($content, $close);

    jQuery(document).ready(function(){
        jQuery('body').append($overlay, $modal);
    });
    // Center the modal in the viewport
    method.center = function () {
        var top, left;

        top = Math.max(jQuery(window).height() - $modal.outerHeight(), 0) / 2;
        left = Math.max(jQuery(window).width() - $modal.outerWidth(), 0) / 2;

        $modal.css({
            top:top + jQuery(window).scrollTop(),
            left:left + jQuery(window).scrollLeft()
        });
    };

    // Open the modal
    method.open = function (settings) {
        $content.empty().append(settings.content);
        $settings = settings;
        $modalInstance =
        $modal.css({
            width: settings.width || 'auto',
            height: settings.height || 'auto'
        });

        method.center();

        jQuery(window).bind('resize.modal', method.center);

        $modal.show();
        $overlay.show();
        $settings.load();
        if (typeof $settings.callback === 'function') {
            jQuery($settings.callbackTrigger).click(function () {
                $settings.callback(
                    $settings.editor,
                    jQuery($settings.callbackData).map( function(index, element) {
                        return element.value;
                    }),
                    $settings.modalInstance);
            });
        }
    };

    // Close the modal
    method.close = function () {
        $modal.hide();
        $overlay.hide();
        $content.empty();
        jQuery(window).unbind('resize.modal');
    };

    return method;
}());