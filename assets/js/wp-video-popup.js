(function ($) {
	var $popups = $('.wp-video-popup-wrapper');
	var speed = 200;

	function init() {
		if (!$popups.length) return;
		setupOpenActions();
		setupVideoHeight();
		setupCloseActions();
	}

	function setupOpenActions() {
		// Setup trigger for single popup.
		$('.wp-video-popup').on('click', function (e) {
			e.preventDefault();
			openPopup($popups);
		});

		// Setup trigger for single popup (backward compatibility support).
		$('.ryv-popup').on('click', function (e) {
			e.preventDefault();
			openPopup($popups);
		});
	}

	function setupCloseActions() {
		// Close on click.
		$popups.click(function (e) {
			if (e.target == this || e.target.classList.contains('wp-video-popup-close')) closePopup($(this));
		});

		// Close on escape.
		$(document).keyup(function (e) {
			if (e.which != 27) return;
			if ($popups.is(':visible')) closePopup($popups);
		});
	}

	function setupVideoHeight() {
		$(window).on('resize', function () {
			var $video = $('.wp-video-popup-video.is-resizable');

			$video.height($video.width() * 0.5625);
		});
	}

	function openPopup($popup) {
		var $video = $popup.find('.wp-video-popup-video');

		$popup.prependTo('body');

		$popup.css({ display: 'flex' }).stop().animate({
			opacity: 1
		}, speed);

		$video.stop().fadeIn(speed);
		$video.attr("src", $video.attr('data-wp-video-popup-url'));

		$(window).trigger('resize');
	}

	function closePopup($popup) {
		var $video = $popup.find('.wp-video-popup-video');

		$popup.stop().animate({
			opacity: 0
		}, speed, function () {
			$popup.css({ display: 'none' });
		});

		$video.stop().fadeOut(speed, function () {
			$video.attr('src', '');
		});
	}

	init();
})(jQuery);