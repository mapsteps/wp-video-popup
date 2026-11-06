(function ($) {

	// Overlay color picker (Coloris).
	// "mixed" saves hex for solid colors and rgba() for transparent ones, same as the previous picker.
	if (window.Coloris && document.querySelector('.wp-video-popup-color-picker')) {
		var adminI18n = window.wpVideoPopupAdmin || {};
		var activeColorField = null;

		window.Coloris($.extend({
			el: '.wp-video-popup-color-picker',
			theme: 'default',
			themeMode: 'light',
			format: 'mixed',
			alpha: true,
			clearButton: true
		}, adminI18n.colorPicker || {}));

		// Remember which field the picker belongs to.
		$(document).on('focus click', '.wp-video-popup-color-picker', function () {
			activeColorField = this;
			addDefaultButton();
		});

		// "Default" button: fills in the field's default color (data-default-color).
		// Added on first use, Coloris only builds its picker once the page has loaded.
		function addDefaultButton() {
			var picker = document.getElementById('clr-picker');

			if (!picker || picker.querySelector('.wpvp-color-default')) return;

			var defaultButton = document.createElement('button');
			defaultButton.type = 'button';
			// Not "clr-default": Coloris uses that class for its default theme on the picker itself.
			defaultButton.className = 'wpvp-color-default';
			defaultButton.textContent = adminI18n.defaultColor || 'Default';

			defaultButton.addEventListener('click', function () {
				var defaultColor = activeColorField && activeColorField.getAttribute('data-default-color');
				var colorValue = document.getElementById('clr-color-value');

				if (!defaultColor || !colorValue) return;

				// Let Coloris handle it as if the value was typed, so the picker & field stay in sync.
				colorValue.value = defaultColor;
				colorValue.dispatchEvent(new Event('change', { bubbles: true }));

				// Close the picker, same as the clear button does.
				window.Coloris.close();
			});

			picker.insertBefore(defaultButton, picker.querySelector('.clr-clear'));
		}
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

	// The video service, shown as a badge in the video field (if the page has one).
	var serviceBadge = document.getElementById('wpvp-builder-service');

	function detectService(url) {
		if (/(youtube\.com|youtu\.be|youtube-nocookie\.com)\//i.test(url)) return { key: 'youtube', label: 'YouTube' };
		if (/vimeo\.com\//i.test(url)) return { key: 'vimeo', label: 'Vimeo' };
		if (/rumble\.com\//i.test(url)) return { key: 'rumble', label: 'Rumble' };
		if (acceptsFiles && videoFiles.test(url)) return { key: 'file', label: serviceBadge ? serviceBadge.getAttribute('data-file-label') : 'Video file' };
		return null;
	}

	function updateServiceBadge() {
		if (!serviceBadge) return;

		var service = detectService(fields.video.value.trim());

		serviceBadge.hidden = !service;
		serviceBadge.textContent = service ? service.label : '';
		serviceBadge.setAttribute('data-service', service ? service.key : '');
	}

	function span(className, text) {
		var el = document.createElement('span');
		el.className = className;
		el.textContent = text;
		return el;
	}

	// Writes the shortcode with syntax highlighting. Its text stays the plain shortcode (that's what gets copied).
	function renderShortcode(attributes) {
		output.textContent = '';
		output.appendChild(span('wpvp-token-tag', '[wp-video-popup'));

		attributes.forEach(function (attribute) {
			output.appendChild(document.createTextNode(' '));
			output.appendChild(span('wpvp-token-attr', attribute[0]));
			output.appendChild(span('wpvp-token-punct', '="'));
			output.appendChild(span('wpvp-token-value', attribute[1]));
			output.appendChild(span('wpvp-token-punct', '"'));
		});

		output.appendChild(span('wpvp-token-tag', ']'));
	}

	function buildShortcode() {
		var video = clean(fields.video.value) || fields.video.placeholder;
		var text = clean(value('text'));
		var start = parseInt(value('start'), 10);
		var id = cleanId(value('id'));
		var gallery = cleanGallery(value('gallery'));
		var attributes = [['video', video]];

		if (id) attributes.push(['id', id]);
		if (gallery) attributes.push(['gallery', gallery]);
		if (checked('autoplay')) attributes.push(['autoplay', '1']);
		if (checked('mute')) attributes.push(['mute', '1']);
		if (start > 0) attributes.push(['start', String(start)]);
		if (checked('portrait')) attributes.push(['portrait', '1']);
		if (text) attributes.push(['text', text]);

		renderShortcode(attributes);
		updateServiceBadge();

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
		// Only swap the label, so an icon in the button stays.
		var labelEl = button.querySelector('.wpvp-copy-label') || button;
		var label = labelEl.textContent;
		var timer;

		button.addEventListener('click', function () {
			var target = document.getElementById(button.getAttribute('data-copy-target'));

			copy(target.textContent).then(function () {
				clearTimeout(timer);
				button.classList.add('is-copied');
				labelEl.textContent = button.getAttribute('data-copied') || 'Copied!';
				copyStatus.textContent = button.getAttribute('data-copied') || 'Copied!';

				timer = setTimeout(function () {
					button.classList.remove('is-copied');
					labelEl.textContent = label;
					copyStatus.textContent = '';
				}, 1500);
			});
		});
	});

})(jQuery);
