(function ($) {

	// Overlay color picker (Coloris).
	// "mixed" saves hex for solid colors and rgba() for transparent ones, same as the previous picker.
	if (window.Coloris && document.querySelector('.wp-video-popup-color-picker')) {
		var i18n = (window.wpVideoPopupAdmin && window.wpVideoPopupAdmin.colorPicker) || {};

		window.Coloris($.extend({
			el: '.wp-video-popup-color-picker',
			theme: 'default',
			themeMode: 'light',
			format: 'mixed',
			alpha: true,
			clearButton: true,
			swatches: ['rgba(0,0,0,0.88)', '#000000', '#ffffff']
		}, i18n));
	}

	// Getting started: shortcode builder.
	// Shared by the free & PRO version. Fields that don't exist on the page are skipped.
	var output = document.getElementById('wpvp-builder-output');
	var copyStatus = document.getElementById('wpvp-copy-status');

	if (!output) return;

	var fields = {
		video: document.getElementById('wpvp-builder-video'),
		text: document.getElementById('wpvp-builder-text'),
		start: document.getElementById('wpvp-builder-start'),
		mute: document.getElementById('wpvp-builder-mute'),
		portrait: document.getElementById('wpvp-builder-portrait'),
		id: document.getElementById('wpvp-builder-id'),
		gallery: document.getElementById('wpvp-builder-gallery'),
		autoplay: document.getElementById('wpvp-builder-autoplay')
	};
	var videoHint = document.getElementById('wpvp-builder-video-hint');
	var triggerHint = document.getElementById('wpvp-trigger-hint');
	var triggerClass = document.getElementById('wpvp-trigger-class');
	var services = /(youtube\.com|youtu\.be|youtube-nocookie\.com|vimeo\.com|rumble\.com)\//i;
	var videoFiles = /\.(mp4|m4v|webm|ogv|ogg|mov)(\?|#|$)/i;

	// Self-hosted video files are only accepted where the video field says so.
	var acceptsFiles = fields.video.hasAttribute('data-self-hosted');

	// Drop the fields that don't exist on this page.
	Object.keys(fields).forEach(function (key) {
		if (!fields[key]) delete fields[key];
	});

	function isSupported(url) {
		return services.test(url) || (acceptsFiles && videoFiles.test(url));
	}

	// Quotes & square brackets would break the shortcode.
	function clean(value) {
		return value.replace(/["\[\]]/g, '').trim();
	}

	// The ID is used as a CSS class, so only keep what's valid there.
	function cleanId(value) {
		return value.trim().replace(/\s+/g, '-').replace(/[^A-Za-z0-9_-]/g, '');
	}

	// Gallery names use underscores (same as on the front end).
	function cleanGallery(value) {
		return value.trim().replace(/[\s-]+/g, '_').replace(/[^A-Za-z0-9_]/g, '');
	}

	function value(key) {
		return fields[key] ? fields[key].value : '';
	}

	function checked(key) {
		return fields[key] ? fields[key].checked : false;
	}

	function buildShortcode() {
		var video = clean(fields.video.value) || fields.video.placeholder;
		var text = clean(value('text'));
		var start = parseInt(value('start'), 10);
		var id = cleanId(value('id'));
		var gallery = cleanGallery(value('gallery'));
		var shortcode = '[wp-video-popup video="' + video + '"';

		if (id) shortcode += ' id="' + id + '"';
		if (gallery) shortcode += ' gallery="' + gallery + '"';
		if (checked('autoplay')) shortcode += ' autoplay="1"';
		if (checked('mute')) shortcode += ' mute="1"';
		if (start > 0) shortcode += ' start="' + start + '"';
		if (checked('portrait')) shortcode += ' portrait="1"';
		if (text) shortcode += ' text="' + text + '"';

		output.textContent = shortcode + ']';

		// With an ID, the ID itself is the trigger class.
		if (fields.id && triggerClass && triggerHint) {
			triggerClass.textContent = id || 'wp-video-popup';
			triggerHint.textContent = triggerHint.getAttribute(id ? 'data-id' : 'data-default');
		}

		// Hint when the URL isn't from a supported service.
		var invalid = fields.video.value.trim() !== '' && !isSupported(fields.video.value);
		fields.video.setAttribute('aria-invalid', invalid ? 'true' : 'false');
		videoHint.classList.toggle('is-invalid', invalid);
		videoHint.textContent = videoHint.getAttribute(invalid ? 'data-invalid' : 'data-default');
	}

	Object.keys(fields).forEach(function (key) {
		fields[key].addEventListener('input', buildShortcode);
		fields[key].addEventListener('change', buildShortcode);
	});

	buildShortcode();

	// Copy buttons.
	function fallbackCopy(text) {
		var textarea = document.createElement('textarea');
		textarea.value = text;
		textarea.setAttribute('readonly', '');
		textarea.style.position = 'fixed';
		textarea.style.opacity = '0';
		document.body.appendChild(textarea);
		textarea.select();
		document.execCommand('copy');
		document.body.removeChild(textarea);
	}

	function copy(text) {
		// The Clipboard API only exists on HTTPS (and localhost).
		if (navigator.clipboard && window.isSecureContext) {
			return navigator.clipboard.writeText(text).catch(function () {
				fallbackCopy(text);
			});
		}

		fallbackCopy(text);
		return Promise.resolve();
	}

	document.querySelectorAll('.wpvp-copy').forEach(function (button) {
		var label = button.textContent;
		var timer;

		button.addEventListener('click', function () {
			var target = document.getElementById(button.getAttribute('data-copy-target'));

			copy(target.textContent).then(function () {
				clearTimeout(timer);
				button.classList.add('is-copied');
				button.textContent = button.getAttribute('data-copied') || 'Copied!';
				copyStatus.textContent = button.getAttribute('data-copied') || 'Copied!';

				timer = setTimeout(function () {
					button.classList.remove('is-copied');
					button.textContent = label;
					copyStatus.textContent = '';
				}, 1500);
			});
		});
	});

})(jQuery);
