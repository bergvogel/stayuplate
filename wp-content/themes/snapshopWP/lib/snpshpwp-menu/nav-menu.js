(function($){
"use strict";
	$(document).on('click', '.media_upload_button' , function() {
		var $el = $(this);
		var upload = $el.prev().find("input"), frame;
		frame = wp.media({
			title: $el.data('choose'),
		button: {
				text: $el.data('update'),
				close: false
			}
		});
		frame.on( 'select', function() {
			var attachment = frame.state().get('selection').first();
			frame.close();

			upload.val(attachment.attributes.url);
		});
		frame.open();
	});
})(jQuery);