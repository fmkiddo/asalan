(function ($) {
	'use strict';
	$.siteURL = function ($relativePath) {
		$relativePath	= $relativePath || '';
		var $dataURL 	= $('body').attr ('data-siteurl');
		var $concat		= $dataURL.endsWith ('/');
		var $siteURL	= $dataURL + ($concat ? '' : '/') + $relativePath;
		return $siteURL;
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
	$.changeConfig = function ($name, $value) {
		var changed = false;
		var url		= window.location.href;
		var data	= {
			change: {
				type: $name,
				value: $value
			}
		};
		if (url.indexOf ('dashboard') >= 0) {
			console.log (JSON.stringify (data));
			$.ajax ({
				url: $.siteURL ($.getLocale () + '/change-config'),
				method: 'post',
				data: JSON.stringify (data),
				contentType: 'application/json',
				accept: 'application/json'
			}).done (function ($result) {
				console.log ($result);
			});
		}
		return changed;
	};
	$.showAlert = function (option) {
		option	= option || {
			title: "Default Alert",
			text: "This is default message",
			icon: "success",
		};
		Swal.fire (option);
	};
})(jQuery);