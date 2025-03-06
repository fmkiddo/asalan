(function ($) {
	'use strict';
	var ajaxUrl = $.siteURL ($.getLocale () + "/data-pool");
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
		if ($(this).is ("[data-load-ajax]")) $.loadAjax ($(this));
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
	$.fn.editRequestType	= function () {
		var	reqType	= $(this).find ("[name=\"request-type\"]");
		if (reqType.length == 0) return false;
		else {
			var	rqVal	= reqType.val (),
				rqSplit	= rqVal.split ("|");
			if (rqSplit[1] === "new") {
				rqSplit[1] = "edit";
				reqType.val (rqSplit.join ("|"));
			}
		}
	}
	$.loadDataToForm = function (eventOwner, edit) {
		edit = edit || false;
		if ($(eventOwner.target).closest ("[data-table=\"true\"]").length > 0) {
			var	el				= $(eventOwner.target),
				evParent 		= el.closest ("tr");
			if (edit) {
				var	dataKey			= evParent.find ("[data-row]").attr ("data-row"),
					evTarget		= $(eventOwner.currentTarget),
					actionTarget	= $(evTarget.attr ("data-action-target"));
				actionTarget.find ("[name=\"atom\"]").val (dataKey);
				actionTarget.find ("[data-readonlyonedit=\"true\"]").prop ("readonly", true);
			}
			evParent.find ("[data-loadsource]").each (function () {
				var target	= $(this).attr ("data-loadsource"),
					content	= $(this).text (),
					ltarget	= $(":input[data-loadtarget=\"" + target + "\"]");
				if (ltarget.is ("select")) 
					ltarget.children ().each (function () {
						if ($(this).val () === content) $(this).attr ("selected", true);
					});
				else if (ltarget.is (":checkbox") || ltarget.is (":radio")) ltarget.prop ('checked', $.parseJSON (content));	
				else ltarget.val (content);
			});
		}
	}
	$.loadDataToDetails	= function (rowSource, detailsTarget) {
		var dataRow = rowSource.find (":first-child").find ("[data-row]").attr ("data-row");
		rowSource.find ("[data-loadsource]").each (function () {
			var source 	= $(this).attr ("data-loadsource"),
				text	= $(this).text (),
				el		= detailsTarget.find ("[data-loadtarget=\"" + source + "\"]");
			el.each (function () {
				if ($(this).is (':input')) $(this).val (text);
				else $(this).text (text);
			});
		});
		detailsTarget.find ("[data-sub-target]").attr ("data-sub-target", dataRow);
	}
	$.loadDataTable	= function (dataTables) {
		var init = false,
			delay = 200;
		dataTables.each (function () {
			var currTable = $(this),
				tableId = currTable.prop ("id"),
				options	= {
					retrieve: true,
					ajax: {
						url: $.siteURL ($.getLocale () + '/data-pool'),
						type: 'POST',
						data: function ($d) {
							var alv = $.getAlv ();
							if (currTable.is ("[data-sub]")) {
								alv = currTable.attr ("data-sub");
								$d.subdata = currTable.attr ("data-sub-target");
								if (currTable.is ("[data-sub-filter]")) {
									$d.subfilter	= currTable.attr ("data-sub-filter");
									$d.filterType	= currTable.attr ("data-sub-type");
								}
							}
							
							$d.fetch = alv;
						},
						complete: function () {
							$("[data-action=\"reload-table\"][data-action-target=\"#" + tableId + "\"]," + 
								"[data-action=\"reload-table\"][href=\"#" + tableId + "\"]").prop ("disabled", false);
						}
					},
				};
			init = $(this).delayedDataTableInit (options, delay);
			delay += 400;
		});
		return init;
	}
	$.fn.loadAjaxOptions	= function (ajaxData, type) {
		var el = $(this);
		setTimeout (function () {
			$.ajax ({
				url: ajaxUrl,
				method: "post",
				data: $.param (ajaxData),
			}).done (function (result) {
				if (result.length) {
					if (el.is ("select")) {
						el.val ('');
						el.children (":not(:first-child)").remove ();
						$.each (result.data[type], function (k, v) {
							var props = {};
							switch (type) {
								default:
									props = {};
									break;
								case "user-locations":
								case "locations":
									props = {
										value: v.uuid,
										text: v.name + " (" + v.code + ")",
									};
									break;
								case "config":
									props	= {
										value: v.uuid,
										text: v.name,
										title: v.dscript,
									};
									break;
							}
							el.createOptions (props);
						});
					}
					
					if (el.is ("ul")) {
						el.children ().remove ();
					}
				}
			}).fail (function () {
				
			});
		}, 500);
	};
	$.loadAjax	= function (els) {
		if (els.length > 0) {
			var	delay	= 0;
			els.each (function () {
				var	el			= $(this),
					fetch		= $(this).attr ("data-load-ajax"),
					dataAjax	= {
						fetch: fetch,
					};
				setTimeout (function () {
					el.loadAjaxOptions (dataAjax, fetch);
				}, delay);
				delay	+= 600;
			});
		};
	};
	$.fn.loadImages	= function (targetEl, isCarousel) {
		if (!$(this).is ("input:file")) return false;
		isCarousel = isCarousel || true;
		var	el		= $(this)[0],
			files	= el.files;
		if (!(files && files[0])) return false;
		if (isCarousel) {
			var	indicators	= targetEl.find (".carousel-indicators"),
				inner		= targetEl.find (".carousel-inner");
				
			$.each (files, function (k, file) {
				var	imageReader	= new FileReader (),
					item		= $("<div/>", {
						class: "carousel-item",
					});

				imageReader.onload	= function (e) {
					var	content	= e.target.result;
					item.css ("background-image", "url(" + content + ")");
				};
				if (k == 0) item.addClass ("active");
				item.appendTo (inner);
				if (indicators.length > 0) {
					var pointer	= $("<li/>", {
						"data-target": "#" + targetEl.prop ("id"),
						"data-slide-to": k,
					});
					if (k == 0) pointer.addClass ("active");
					pointer.appendTo (indicators);
				}
				
				imageReader.readAsDataURL (file);
			});
			targetEl.carousel ();
		} else {
			
		}
	}
})(jQuery);