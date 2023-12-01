(function ($) {
	var ajax = {};

	function init() {
		$(document).on(
			"click",
			".wp-video-popup-review-notice.is-dismissible .notice-dismiss",
			ajax.saveDismissal
		);
	}

	ajax.saveDismissal = function (e) {
		$.ajax({
			url: ajaxurl,
			type: 'post',
			data: {
				action: 'wp_video_popup_review_notice_dismissal',
				nonce: WPVideoPopupDismissal.nonces.dismissalNonce,
				dismiss: 1
			}
		}).always(function (r) {
			if (r.success) console.log(r.data);
		});
	};

	init();
})(jQuery);
