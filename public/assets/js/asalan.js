'use strict';

(function ($) {
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
	$.doDashboardRedirect = function ($target) {
		var $url		= window.location.href;
		if ($url.indexOf ('dashboard') >= 0) window.location.href = $.siteURL ($.getLocale () + '/dashboard?alv=' + $target);
		else {
			var $siteURL = $.siteURL ($.getLocale () + '/dashboard?alv=' + $target);
			window.location.href = $siteURL;
		}
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
	$.getAlv = function () {
		var search = window.location.search
			.replace ('?', '')
			.split ('&');
		if (!search.length) return false;
		var alv = '';
		$.each (search, function (k, v) {
			var explode = v.split ('=');
			if (explode[0] === 'alv') {
				alv = explode[1];
				return false;
			}
		});
		return alv;
	};
	$.fn.delayedDataTableInit = function (options, delay=400) {
		var dt = $(this),
			attr = dt.attr ('data-table');
		$.fn.dataTable.ext.errMode = 'throw';
		if (typeof attr === 'undefined' && attr === false) return false;
		dt.find ("thead th:first-child").attr ('data-orderable', false);
		setTimeout (function () {
			options.order		= [[1, 'asc']];
			options.responsive	= true;
			options.processing	= true;
			options.serverSide	= true;
			dt.addClass ('table-100').DataTable (options);
		}, delay);
		return true;
	};
	$.fn.createOptions = function (prop) {
		if (!$(this).is ("select")) return false;
		$("<option/>", prop).appendTo ($(this));
	};
	$.fn.resetForm	= function () {
		if (!$(this).is ("form")) return false;
		var modalForm = $(this);
		modalForm.find ("[name=\"atom\"]").val ("");
		modalForm.find ("[data-readonlyonedit]").prop ("readonly", false);
		modalForm.find ("[data-notrequiredonedit]").prop ("required", true);
		modalForm.find (":input").not ("[type=\"hidden\"]").each (function () {
			var input = $(this);
			if (input.is ("select")) {
				input.find ("option:first-child").attr ("selected", true);
				input.find ("option:not(:first-child)").remove ();
			} else if (input.is (":checkbox") || input.is (":radio")) input.prop ("checked", true);
			else input.val ("");
		});
	};
})(jQuery);