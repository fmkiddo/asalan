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
	$.doDashboardRedirect = function ($target, $payload="") {
		var $url		= window.location.href,
			$addURL		= "/dashboard?alv=" + $target;
			
		if ($payload !== "") $addURL += "&payload=" + $payload;
		
		if ($url.indexOf ('dashboard') >= 0) window.location.href = $.siteURL ($.getLocale () + $addURL);
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
		var dt				= $(this),
			attr			= dt.attr ('data-table'),
			isServerSide	= dt.is ("[data-servertable=\"false\"]") ? false : true;
		$.fn.dataTable.ext.errMode = 'throw';
		if (typeof attr === 'undefined' && attr === false) return false;
		dt.find ("thead th:first-child").attr ('data-orderable', false);
		setTimeout (function () {
			options.order		= [[1, 'asc']];
			options.responsive	= true;
			if (isServerSide) {
				options.processing	= true;
				options.serverSide	= true;
			} else delete options['ajax'];
			dt.addClass ('table-100').DataTable (options);
		}, delay);
		return true;
	};
	$.fn.createOptions = function (prop) {
		if (!$(this).is ("select")) return false;
		$("<option/>", prop).appendTo ($(this));
	};
	$.fn.createAttributeOption = function (prop) {
		if (!($(this).is ("div"))) return false;
		var formCheck	= $("<div/>", {
			class: "form-check",
			title: prop.name + ": " + prop.title,
		}),
			checkLabel	= $("<label/>", {
				class: "form-check-label",
				text: prop.name,
			}).appendTo (formCheck);
		$("<input/>", {
			class: "form-check-input",
			type: "checkbox",
			name: "input-cidtype[]",
			id: "CIDtype",
			value: prop.value,
		}).appendTo (checkLabel);
		$("<i></i>", {
			class: "input-helper",
		}).appendTo (checkLabel);
		formCheck.appendTo ($(this));		
	};
	$.fn.resetSelect = function (noReset) {
		if (!$(this).is ("select")) return false;
		$(this).val ($(this).find ("option:first-child").val ());
		if (!noReset) $(this).find("option:not(:first-child)").remove ();
	};
	$.fn.resetForm	= function () {
		if (!$(this).is ("form")) return false;
		var modalForm = $(this);
		modalForm.find ("[name=\"atom\"]").val ("");
		modalForm.find ("[data-readonlyonedit]").prop ("readonly", false);
		modalForm.find ("[data-notrequiredonedit]").prop ("required", true);
		modalForm.find (":input").not ("[type=\"hidden\"],[data-reset=\"false\"]").each (function () {
			var input = $(this);
			if (input.is ("select")) input.resetSelect (input.is ("[data-no-reset]"));
			else if (input.is (":checkbox") || input.is (":radio")) 
				if (input.is ("[data-defstate=\"checked\"]")) input.prop ("checked", true);
				else input.prop ("checked", false);
			else 
				if (!input.is ("[placeholder]")) input.val ("");
				else {
					var defVal = input.attr ("placeholder");
					input.val (defVal);
				}
		});
	};
	$.fn.createFormGroup = function (serverData) {
		if (!$(this).is ("div")) return false;
		console.log (serverData);
		var childEl = {};
		switch (serverData.type) {
			default:
				break;
			case "text":
			case "date":
				childEl = $("<div/>", {
					class: "form-group d-hidden"
				});
				$("<label/>", {
					for: "input-newfaattrs",
					text: serverData.name + ":",
				}).appendTo (childEl);
				$("<input/>", {
					type: "hidden",
					name: "input-newfaattrsid[]",
					value: serverData.uuid
				}).appendTo (childEl);
				$("<input/>", {
					type: "text",
					class: "form-control",
					name: "input-newfaattrs[]",
					value: "",
					required: true
				}).appendTo (childEl);
				break;
			case "prepopulated-list":
				childEl = $("<div/>", {
					class: "form-group d-hidden"
				});
				$("<label/>", {
					for: "input-newfaattrs",
					text: serverData.name + ":",
				}).appendTo (childEl);
				$("<input/>", {
					type: "hidden",
					name: "input-newfaattrsid[]",
					value: serverData.uuid
				}).appendTo (childEl);
				var listInput = $("<select/>", {
					name: "input-newfaattrs[]",
					value: "",
					class: "form-control",
					required: true,
				});
				listInput.appendTo (childEl);
				$.each (serverData.values, function (k, v) {
					var prop = {
						value: v,
						text: v,
					};
					$("<option/>", prop).appendTo (listInput);
				});
				break;
		}
		childEl.appendTo ($(this));
		setTimeout (function () {
			childEl.fadeIn ();
			childEl.toggleClass ("d-hidden");
		}, 300);
	};
	$("input[min]").on ("focusout", function (event) {
		var min = parseInt ($(this).attr ("min")),
			val = $(this).val ();
			
		if (min > val) $(this).val (min);
	});
	$("input[max]").on ("focusout", function (event) {
		var max = parseInt ($(this).attr ("max")),
			val = $(this).val ();
		if (max < val) $(this).val (max);
	});
})(jQuery);