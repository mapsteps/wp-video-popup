/**
 * NodeList.forEach polyfill for IE
 * 
 * @see https://developer.mozilla.org/en-US/docs/Web/API/NodeList/forEach
 */
if (window.NodeList && !NodeList.prototype.forEach) {
	NodeList.prototype.forEach = Array.prototype.forEach;
}

/**
 * Custom Event polyfill for >= IE9
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/API/CustomEvent/CustomEvent#Polyfill
 */
(function () {
	if (typeof window.CustomEvent === "function") return false;

	function CustomEvent(event, params) {
		params = params || { bubbles: false, cancelable: false, detail: null };
		var evt = document.createEvent('CustomEvent');
		evt.initCustomEvent(event, params.bubbles, params.cancelable, params.detail);
		return evt;
	}

	window.CustomEvent = CustomEvent;
})();

(function ($) {
	// Free version only support 1 video per page/ post.
	var popup = document.querySelector('.wp-video-popup-wrapper');
	var speed = 200;

	function init() {
		if (!popup) return;
		setupOpenActions();
		setupVideoHeight();
		setupCloseActions();
	}

	function setupOpenActions() {
		// Setup trigger for single popup.
		setupOpenTriggers('.wp-video-popup');

		// Setup trigger for single popup (backward compatibility support).
		setupOpenTriggers('.ryv-popup');
	}

	function setupOpenTriggers(triggerSelector) {
		var triggers = document.querySelectorAll(triggerSelector);
		if (!triggers) return;

		triggers.forEach(function (trigger) {
			trigger.addEventListener('click', function (e) {
				e.preventDefault();
				openPopup();
			});
		});
	}

	function setupCloseActions() {
		// Close on click.
		popup.addEventListener('click', function (e) {
			if (e.target == this || e.target.classList.contains('wp-video-popup-close')) closePopup();
		});

		// Close on escape.
		document.addEventListener('keyup', function (e) {
			if (e.key !== 'Escape' && e.key !== 'Esc' && e.keyCode !== 27) return;
			if ($(popup).is(':visible')) closePopup();
		});
	}

	function setupVideoHeight() {
		window.addEventListener('resize', function () {
			var video = document.querySelector('.wp-video-popup-video.is-resizable');
			if (video) $(video).height($(video).width() * 0.5625);
		});
	}

	function openPopup() {
		var video = popup.querySelector('.wp-video-popup-video');

		document.body.insertBefore(popup, document.body.firstChild);

		$(popup).css({ display: 'flex' }).stop().animate({
			opacity: 1
		}, speed);

		$(video).stop().fadeIn(speed);
		video.src = video.dataset.wpVideoPopupUrl;

		window.dispatchEvent(new Event('resize'));
	}

	function closePopup() {
		var video = popup.querySelector('.wp-video-popup-video');

		$(popup).stop().animate({
			opacity: 0
		}, speed, function () {
			$(popup).css({ display: 'none' });
		});

		$(video).stop().fadeOut(speed, function () {
			video.src = '';
		});
	}

	init();
})(jQuery);