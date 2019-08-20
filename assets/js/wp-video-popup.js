(function($) {

	var url = $('.wp-video-popup-video').attr('data-wp-video-popup-url');

	function wp_video_popup_open() {
		$('.wp-video-popup-wrapper').prependTo('body');
		$('.wp-video-popup-wrapper, .wp-video-popup-video').fadeIn(200);
		$(".wp-video-popup-video").attr("src", url);
		$(window).trigger('resize');
	}

	$('.wp-video-popup').click(function(event) {
		event.preventDefault();
		wp_video_popup_open();
	});

	// Close Function
	function wp_video_popup_close() {
		$('.wp-video-popup-wrapper, .wp-video-popup-video').fadeOut(200);
		setTimeout(function(){
			$('.wp-video-popup-video').attr('src', '');
		}, 200);
	}

	// Close on click
	$('.wp-video-popup-wrapper').click(function() {
		wp_video_popup_close();
	});

	// Close on Escape
	$(document).keyup(function(e) {
		if (e.keyCode == 27) {
			if ( $('.wp-video-popup-wrapper').is(':visible') ) {
				wp_video_popup_close();
			}
		}
	});

	// Resize
	$(window).resize(function() {
		var videoWidth = $('.wp-video-popup-video').width();
		$('.wp-video-popup-video').height(videoWidth*0.5625);
	});

	/* Backwards Compatibility */

	var oldUrl = $('.ryv-popup-video').attr('data-ryv-popup-url');

	function ryv_video_popup_open() {
		$('.ryv-popup-wrapper').prependTo('body');
		$('.ryv-popup-wrapper, .ryv-popup-video').fadeIn(200);
		$(".ryv-popup-video").attr("src", oldUrl);
		$(window).trigger('resize');
	}

	$('.ryv-popup').click(function(event) {
		event.preventDefault();
		ryv_video_popup_open();
	});


	// Close Function
	function close_ryv_popup() {
		$('.ryv-popup-wrapper, .ryv-popup-video').fadeOut(200);
		setTimeout(function(){
			$('.ryv-popup-video').attr('src', '');
		}, 200);
	}

	// Close on click
	$('.ryv-popup-wrapper').click(function() {
		close_ryv_popup();
	});

	// Close on Escape
	$(document).keyup(function(e) {
		if (e.keyCode == 27) {
			if ( $('.ryv-popup-wrapper').is(':visible') ) {
				close_ryv_popup();
			}
		}
	});

	// Resize
	$(window).resize(function() {
		var videoWidth = $('.ryv-popup-video').width();
		$('.ryv-popup-video').height(videoWidth*0.5625);
	});

})( jQuery );