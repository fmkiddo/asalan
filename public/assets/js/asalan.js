'use strict';

(function ($) {
	$.siteURL = function ($relativePath) {
		var $dataURL 	= $('body').attr ('data-siteurl');
		var $siteURL	= $dataURL + '/' + $relativePath;
		return $siteURL;
	};
	$.doDashboardRedirect = function ($target) {
		var $url		= window.location.href;
		var $html		= $('html');
		if ($url.indexOf ('dashboard') >= 0) window.location.href = $.siteURL ($html.attr ('lang') + '/dashboard?alv=' + $target);
	};
	$.getLocale	= function () {
		var $html = $('html');
		return $html.attr ('lang');
	};
	$.lang = function ($key) {
		const lang = {
			en: {
				signOutTitle: "Sign Out",
				signOutText: "Are you sure?",
				signOutConfirm: "Yes, i want to logout",
				signOutCancel: "No, cancel"
			},
			id: {
				signOutTitle: "Keluar",
				signOutText: "Anda yakin?",
				signOutConfirm: "Ya, saya akan logout",
				signOutCancel: "Tidak, batalkan!"
			}
		};
		var $locale = $.getLocale ();
		console.log ($locale);
		return lang[$locale][$key];
	};
})(jQuery);