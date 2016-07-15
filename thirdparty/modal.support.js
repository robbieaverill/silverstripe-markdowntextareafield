(function($) {
    $.fn.modal = function() {
        var method = {},
            $overlay,
            $modal,
            $content,
            $close,
            $url,
            $modalInstance,
            $settings;

        method.init = function() {
            // Append the HTML
            this.$overlay = jQuery('<div id="overlay"></div>');
            this.$modal = jQuery('<div id="modal"></div>');
            this.$content = jQuery('<div id="content"></div>');
            this.$close = jQuery('<a id="close" href="#">x</a>');

            this.$modal.hide();
            this.$overlay.hide();
            this.$modal.append(this.$content, this.$close);

            jQuery('body').append(this.$overlay, this.$modal);
            // Center the modal in the viewport
            method.center = function () {
                var top, left;

                top = Math.max(jQuery(window).height() - this.$modal.outerHeight(), 0) / 2;
                left = Math.max(jQuery(window).width() - this.$modal.outerWidth(), 0) / 2;

                this.$modal.css({
                    top:top + jQuery(window).scrollTop(),
                    left:left + jQuery(window).scrollLeft()
                });
            };
            return this;
        };

        // Open the modal
        method.open = function (settings) {
            if(typeof this.$content == 'undefined') {
                this.init();
            }

            this.$content.empty().append(settings.content);
            $settings = settings;
            $modalInstance = this.$modal.css({
                width: settings.width || 'auto',
                height: settings.height || 'auto'
            });

            method.center();
            jQuery('#close').click(this.close);
            jQuery(window).bind('resize.modal', method.center);

            this.$modal.show();
            this.$overlay.show();
            $settings.load();
            if (typeof $settings.callback === 'function') {
                jQuery($settings.callbackTrigger).click(function () {
                    $settings.callback(
                        $settings.editor,
                        jQuery($settings.callbackData).map( function(index, element) {
                            return element.value;
                        }),
                        settings.modalInstance
                    );
                });
            }
        };

        // Close the modal
        method.close = function (event) {
            if(typeof this.$modal == 'undefined') {
                //force method
                jQuery('#modal').hide();
                jQuery('#overlay').hide();
                if (typeof event != 'undefined') {
                    event.preventDefault();
                }
                return false;
            }
            this.$modal.hide();
            this.$overlay.hide();
            this.$content.empty();
            jQuery(window).unbind('resize.modal');
            if (typeof event != 'undefined') {
                event.preventDefault();
            }

        };

        return method;
    };

}(jQuery));
