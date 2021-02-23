(function ($) {

	$('.wp-video-popup-color-picker').wpColorPicker();

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

	$('.tab-nav-menu-item').on('click', function(event) {
		$('.tab-nav-menu-item').removeClass('active');
		$(this).addClass('active');
	});

	$('.tab-nav-menu-item.settings').on('click', function(event) {
		$('.heatbox-admin-panel').css('display', 'none');
		$('.settings-panel').css('display', 'block');
	});

	$('.tab-nav-menu-item.recommended').on('click', function(event) {
		$('.heatbox-admin-panel').css('display', 'none');
		$('.recommended-panel').css('display', 'block');
	});

	$(window).on('load', function(event) {

		var hash = window.location.hash;

		if ( ! hash ) {
			hash = '#settings';
		}

		if ( "#settings" === hash ) {
			$('.tab-nav-menu-item.settings').addClass('active');
			$('.settings-panel').css('display', 'block');
		}

		if ( "#recommended" === hash ) {
			$('.tab-nav-menu-item.recommended').addClass('active');
			$('.recommended-panel').css('display', 'block');
		}

	});

})(jQuery);
