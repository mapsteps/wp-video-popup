(function ($) {

	$('.wp-video-popup-color-picker').wpColorPicker();

	// Getting started: shortcode builder.
	var output = document.getElementById('wpvp-builder-output');
	var copyStatus = document.getElementById('wpvp-copy-status');

	if (!output) return;

	var fields = {
		video: document.getElementById('wpvp-builder-video'),
		text: document.getElementById('wpvp-builder-text'),
		start: document.getElementById('wpvp-builder-start'),
		mute: document.getElementById('wpvp-builder-mute'),
		portrait: document.getElementById('wpvp-builder-portrait')
	};
	var videoHint = document.getElementById('wpvp-builder-video-hint');
	var supported = /(youtube\.com|youtu\.be|youtube-nocookie\.com|vimeo\.com|rumble\.com)\//i;

	// Quotes & square brackets would break the shortcode.
	function clean(value) {
		return value.replace(/["\[\]]/g, '').trim();
	}

	function buildShortcode() {
		var video = clean(fields.video.value) || fields.video.placeholder;
		var text = clean(fields.text.value);
		var start = parseInt(fields.start.value, 10);
		var shortcode = '[wp-video-popup video="' + video + '"';

		if (fields.mute.checked) shortcode += ' mute="1"';
		if (start > 0) shortcode += ' start="' + start + '"';
		if (fields.portrait.checked) shortcode += ' portrait="1"';
		if (text) shortcode += ' text="' + text + '"';

		output.textContent = shortcode + ']';

		// Hint when the URL isn't from a supported service.
		var invalid = fields.video.value.trim() !== '' && !supported.test(fields.video.value);
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
