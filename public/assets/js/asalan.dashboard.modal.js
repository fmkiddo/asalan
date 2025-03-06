(function ($) {
	'use strict';
	$(function () {
		var ajaxUrl = $.siteURL ($.getLocale () + "/data-pool");
		$(".modal").on ("shown.bs.modal", function (event) {
			var	modalOwner	= $(this),
				dt			= modalOwner.find ("[data-table=\"true\"]"),
				modalForm	= modalOwner.find ("form"),
				ajaxRun		= modalOwner.is ("[data-ajax-run]");
				
			$(this).on ("keyup", function (keyevent) {
				keyevent.preventDefault ();
				if (keyevent.key === "Escape") $(this).modal ("hide");
			});
				
			if (dt.length > 0) {
				dt.each (function () {
					$(this).clone ().removeAttr ("data-table").attr ("data-tableclone", "true")
							.addClass ("d-hidden").appendTo ($(this).parent ());
					if ($(this).is (":visible")) $.loadDataTable ($(this));
				})
			}
			
			$(this).find (".nav-link[data-bs-toggle=\"tab\"],.nav-link[data-bs-toggle=\"pill\"]").on ("click", function (event) {
				var	navLink			= $(event.currentTarget),
					actionTarget	= $((navLink.is ("[data-action-target]") ? navLink.attr ("data-action-target") : navLink.attr ("href")));
				if (actionTarget.length) {
					var	DT		= actionTarget.find ("[data-table=\"true\"]:visible");
					if (DT.length) $.loadDataTable (DT);
				}
			});
			
			if (!modalForm.length) return false;
			if (!ajaxRun) $.loadDataToForm (event);
			else {
				var ajaxTarget	= modalOwner.attr ("data-ajax-target"),
					ajaxData	= {
						fetch: ajaxTarget
					};
				$.ajax ({
					url: ajaxUrl,
					method: "post",
					data: $.param (ajaxData),
				}).done (function (result) {
					if (result.length > 0) {
						$.each (result.data, function (target, data) {
							var el = $("[data-ajax-load=\"" + target + "\"]");
							if (el.is ("select")) {
								el.find ("option:not(:first-child)").remove ();
								$.each (data, function (k, v) {
									var prop = {
										text: v.name,
										value: v.uuid
									};
									el.createOptions (prop);
								});
							}
							
							if (el.is ("div")) {
								el.find (":not(:first-child)").remove ();
								var type = el.attr ("data-ajax-type");
								switch (type) {
									default: // as checkbox
										$.each (data, function (k, v) {
											el.createAttributeOption ({
												name: v.name,
												value: v.uuid,
												title: v.type
											});
										});
										break;
								}
							}
						});
					}
				}).fail (function () {
				}).always (function () {
					$.loadDataToForm (event);
				});
			}

			if ($(this).is ("#modalAssetForm")) {
				var delay = 0;
				$(this).find ("[data-load-ajax]").each (function () {
					var el 			= $(this),
						type 		= el.attr ("data-load-ajax"),
						ajaxData = {
							fetch: type,
						};

					setTimeout (function () {
						el.loadAjaxOptions (ajaxData, type);
					}, delay);
					delay += 500;
				});
			}
		});
		$(".modal").on ("hidden.bs.modal", function (event) {
			var	dt	= $(this).find ("[data-table=\"true\"]"),
				cdt	= $(this).find ("[data-tableclone=\"true\"]");
				
			if (dt.length > 0) {
				dt.DataTable ().clear ().destroy ();
				dt.remove ();
				cdt.removeClass ("d-hidden").removeAttr ("data-tableclone").attr ("data-table", "true");
			}
			$(this).find ("form").resetForm ();
			$(this).find (".nav-link").off ("click");
			$(this).off ("keyup");
		});
	});
})(jQuery);