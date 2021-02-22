(function ($) {
  $('.wp-video-popup-color-picker').wpColorPicker({}, 'disabled', true);
})(jQuery);

(function ($) {
	$(document).on('click', '.wpvp-device-button', switchDevice);

	function switchDevice(e) {
		var device = this.parentNode.dataset.device;
		var sizes = document.querySelectorAll('.wpvp-responsive-sizes .wpvp-responsive-size');
		var controls = document.querySelectorAll('.wpvp-responsive-controls .wpvp-responsive-control');

		controls.forEach(function (control) {
			if (control.dataset.device === device) {
				control.classList.add('is-active');
			} else {
				control.classList.remove('is-active');
			}
		});

		sizes.forEach(function (size) {
			if (size.dataset.sizeDevice === device) {
				size.classList.add('is-active');
			} else {
				size.classList.remove('is-active');
			}
		});
	}
})(jQuery);