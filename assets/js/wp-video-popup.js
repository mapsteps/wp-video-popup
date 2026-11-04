(function ($) {
	// Free version only supports 1 video per page/ post.
	var popup;
	var closeButton;
	var lastTrigger;
	var opened = false;
	var speed = 200;

	function init() {
		popup = document.querySelector('.wp-video-popup-wrapper');
		if (!popup) return;
		closeButton = popup.querySelector('.wp-video-popup-close');
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

		triggers.forEach(function (trigger) {
			// Make non-interactive triggers (e.g. a div or image) usable with the keyboard.
			var isNative = trigger.matches('a[href], button, input, [tabindex]');

			if (!isNative) {
				trigger.setAttribute('role', 'button');
				trigger.setAttribute('tabindex', '0');

				trigger.addEventListener('keydown', function (e) {
					if (e.key !== 'Enter' && e.key !== ' ') return;
					e.preventDefault();
					openPopup(trigger);
				});
			}

			trigger.addEventListener('click', function (e) {
				e.preventDefault();
				openPopup(trigger);
			});
		});
	}

	function setupCloseActions() {
		// Close on click.
		popup.addEventListener('click', function (e) {
			if (e.target === this || e.target.classList.contains('wp-video-popup-close')) closePopup();
		});

		document.addEventListener('keydown', function (e) {
			if (!isOpen()) return;

			// Close on escape.
			if (e.key === 'Escape' || e.key === 'Esc') {
				closePopup();
				return;
			}

			// Keep focus inside the popup (close button & video).
			if (e.key === 'Tab') trapFocus(e);
		});

		// Tabbing out of the video iframe can't be caught by keydown, so pull focus back.
		document.addEventListener('focusin', function (e) {
			if (isOpen() && !popup.contains(e.target)) closeButton.focus();
		});
	}

	function trapFocus(e) {
		var video = popup.querySelector('.wp-video-popup-video');
		var focusable = [closeButton, video];
		var first = focusable[0];
		var last = focusable[focusable.length - 1];

		if (e.shiftKey && document.activeElement === first) {
			e.preventDefault();
			last.focus();
		} else if (!e.shiftKey && document.activeElement === last) {
			e.preventDefault();
			first.focus();
		} else if (!popup.contains(document.activeElement)) {
			e.preventDefault();
			first.focus();
		}
	}

	function isOpen() {
		return opened;
	}

	function setupVideoHeight() {
		window.addEventListener('resize', function () {
			var video = document.querySelector('.wp-video-popup-video.is-resizable');
			if (video) $(video).height($(video).width() * 0.5625);
		});
	}

	function openPopup(trigger) {
		var video = popup.querySelector('.wp-video-popup-video');

		lastTrigger = trigger || document.activeElement;
		opened = true;

		document.body.insertBefore(popup, document.body.firstChild);

		$(popup).css({ display: 'flex' }).stop().animate({
			opacity: 1
		}, speed);

		$(video).stop().fadeIn(speed);

		var videoUrl = video.getAttribute('data-wp-video-popup-url');
		if (videoUrl) {
			video.setAttribute('src', videoUrl);
		}

		window.dispatchEvent(new Event('resize'));

		closeButton.focus();
	}

	function closePopup() {
		var video = popup.querySelector('.wp-video-popup-video');

		opened = false;

		$(popup).stop().animate({
			opacity: 0
		}, speed, function () {
			$(popup).css({ display: 'none' });
		});

		$(video).stop().fadeOut(speed, function () {
			video.setAttribute('src', '');
		});

		// Return focus to the element that opened the popup.
		if (lastTrigger && typeof lastTrigger.focus === 'function') lastTrigger.focus();
	}

	$(document).ready(function () {
		init();
	});
})(jQuery);
