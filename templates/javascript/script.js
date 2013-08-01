(function($) {
	$.entwine('markdowntextareafield', function($){


		$('.field.markdowntextarea *').entwine({
			// Find textarea that belongs to this editor
			getTextarea: function() {
				return this.closest('.field.markdowntextarea').find('textarea.markdowntextarea');
			},
			getPreview: function() {
				return this.closest('.field.markdowntextarea').find('.previewarea');
			},
			parseMarkdown: function(parseurl, markdown ) {
				var self = this;
				$.post(parseurl, { markdown: markdown }, function(html) {
					self.updatePreview(html);
				});
			},
			updatePreview: function( htmldata ) {
				this.getPreview().contents().find('body').html(htmldata);
			//	this.updatePreviewHeight();
			},
			updatePreviewHeight: function() {
				this.getPreview().height(this.getPreview().contents().find('html').height()); 
			} 
		});

		$('.field.markdowntextarea button').entwine({
			onclick: function() {
				this.getTextarea().focus();
				// Use the prefix and affix to insert markdown into textarea
				if (this.attr('data-prefix') || this.attr('data-affix')) {
					this.getTextarea().surroundSelectedText(this.attr('data-prefix'), this.attr('data-affix'));
				}
			},

		});

		var timer;
		$('.field.markdowntextarea textarea').entwine({
			getParseUrl: function() {
				return this.attr('data-parseurl');
			},
			syncPreviewHeight: function() {
				this.getPreview().height(this.height());
			},
			onmatch: function() {
				this.parseMarkdown(this.getParseUrl(), this.val());
				this.syncPreviewHeight();
			},
			onchange: function() {
				this.parseMarkdown(this.getParseUrl(), this.val());
			},
			onkeyup: function() {
				var self = this;
		        clearTimeout(timer);
		        timer = setTimeout(function() {
		            self.parseMarkdown(self.getParseUrl(), self.val());
		        },750);		
			},
			onmouseup: function() {
				this.syncPreviewHeight();
			}
		});


	});
}(jQuery));