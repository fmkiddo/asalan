(function ($){
	'use strict';
	
	var body = $("body");
	function addAssetTransfer (dataTable, dataSources, data) {
		if (!DataTable.isDataTable (dataTable)) return false;
		dataTable.row.add ([
			$("<span/>", {
				text: $(dataSources[1]).text (),
			}).append ($("<input/>", {
				type: "hidden",
				name: "input-assetuuid[]",
				value: data,
			})).prop ("outerHTML"),
			$(dataSources[2]).text (),
			$(dataSources[3]).text (),
			$("<span/>").append ($("<input/>", {
				type: "hidden",
				"data-target": "change-qty",
				name: "input-assetqty[]",
				value: $(dataSources[4]).text (),
				min: 1,
				max: $(dataSources[4]).text (),
			})).append ($("<span/>", {
				text: $(dataSources[4]).text (),
				"data-action": "change-qty",
			})).prop ("outerHTML"),
			$("<a/>", {
				role: "button",
				class: "text-danger mdi mdi-close-circle",
				"data-action": "delete-row",
			}).prop ("outerHTML"),
		]).draw (); 
	};
	body.on ("click", "[data-clone-form=\"true\"]", function (event) {
		var el		= $(event.currentTarget),
			target	= $(el.attr ("data-target"));
		target = target.length > 1 ? target[0] : target;
		target.clone ().appendTo (target.closest (".clone-container"));
	});
	body.on ("click", "[data-remove-form=\"true\"]", function (event) {
		var target	= body.find (".clone-container");
		if (target.children ().length > 1) target.children ().last ().remove ();
		else target.closest ("form").find ("button:reset").click ();
	});
	body.on ("click", ".form-image [data-inputclick=\"image\"]", function (event) {
		$(this).closest (".form-image").find ("[type=\"file\"]").click ();
	});
	body.on ("click", ".nav-link", function (event) {
		var el		= $(event.currentTarget),
			target	= el.is ("a") ? $(el.attr ("href")) : $(el.attr ("data-bs-target"));
		target.find ("[data-table=\"true\"]").each (function () {
			$.fn.dataTable.tables ({'visible': true, 'api': true}).columns.adjust ();
		});
	});
	body.on ("change", "#checkAll", function (event) {
		var el		= $(event.currentTarget),
			target	= $(el.attr ("data-target"));
		if (target.length) target.attr ('checked', el.prop ('checked'));
	});
	body.on ("click", "[data-pick-target]", function (event) {
		var el		= $(event.currentTarget),
			target	= $(el.attr ('data-pick-target'));
		target.click ();
	});
	body.on ("click", "[data-open-form]", function (event) {
		var	el		= $(event.currentTarget),
			source	= el.closest ('td'),
			tr		= source.closest ('tr'),
			open	= el.attr ("data-open-form");
		if (open && tr !== undefined) {
			var form	= $(el.attr ("href")).find ("form"),
				rtype	= form.find ("[name=\"request-type\"]"),
				rtval	= rtype.val (),
				trtval	= rtval.split ("|");
			trtval[1] = "edit";
			rtype.val (trtval.join ("|"));
			form.find ("[name=\"atom\"]").val (el.attr ("data-target"));
			tr.find ("[data-loadsource]").each (function () {
				var fel		= $(this),
					value	= fel.text (),
					target	= fel.attr ('data-loadsource'),
					tel		= ":input[data-loadtarget=\"" + target + "\"]";
				if ($(tel).is ("[data-readonlyonedit=\"true\"]")) $(tel).attr ("readonly", true);
				if ($(tel).is ("input")) $(tel).val (value);
			});
		}
	});
	body.on ("change", "[data-action]", function (event) {
		var el		= $(event.currentTarget),
			action	= el.attr ("data-action");
		switch (action) {
			case "do-filter":
				var	target	= $(el.attr ("data-filter-target"));
				if (target.is ("[data-table=\"true\"]")) {
					target.attr ("data-sub-filter", el.val ());
					target.DataTable ().ajax.reload ();
				}
				break;
			case "reset-table":
				var target = $(el.attr ("data-reset-target"));
				if (DataTable.isDataTable (target)) {
					var	dt	= target.DataTable ();
					dt.clear ().draw ();
				}
				break;
		}
	});
	body.on ("click", "[data-action]", function (event) {
		var	el		= $(event.target),
			action	= el.attr ("data-action");
		switch (action) {
			case "delete-row":
				if (el.closest ("table").length > 0) {
					var	ctr	= el.closest ("tr"),
						tdt	= el.closest ("table").DataTable ();
					tdt.row (ctr).remove ().draw ();
				}
				break;
			case "change-qty":
				if (el.closest ("table").length > 0) {
					var	ctd			= el.closest ("td"),
						targetEl	= ctd.find ("[data-target]");
					el.toggleClass ("d-hidden");
					targetEl.prop ("type", "number");
					targetEl.focus ();
				}
				break;
			case "open-dialog":
				event.preventDefault ();
				var el		= $(event.target),
					target	= $(el.attr ("data-action-target")),
					source	= $(el.attr ("data-action-source")).val (),
					able	= el.attr ("data-action-privilege");
				if (!(source === null)) {
					target.find ("[data-sub-target]").attr ('data-sub-target', source);
					target.modal ("toggle");
				} else {
					
				}
				break;
			case "submitFATForm":
				var	el		= $(event.target),
					target	= $(el.attr ("data-target")),
					form	= el.closest ("form"),
					table	= form.find ("[data-table]");
				if (!DataTable.isDataTable (table)) return false;
				var	tdt		= table.DataTable ();
				if (tdt.rows ().count () === 0) {
					var	msg		= form.attr ("data-alert"),
						ttl		= form.attr ("data-alerttitle");
					Swal.fire ({
						title: ttl,
						text: msg,
						icon: "warning"
					});
					return false;
				} 
				target.click ();
				break;
		}
	});
	body.on ("focusout", "[data-target]", function (event) {
		var	el		= $(event.target),
			target	= el.attr ("data-target");
		if (el.is ("input")) {
			switch (target) {
				case "change-qty":
					var	sibling	= el.next (),
						value	= el.val (),
						max		= parseInt (el.prop ("max")),
						min		= parseInt (el.prop ("min"));
					if (value < min || value > max) {
						if (value < min) value = min;
						if (value > max) value = max;
					} 
					
					el.val (value);
					sibling.text (value);
					el.prop ("type", "hidden");
					sibling.toggleClass ("d-hidden");
					break;
			}
		}
	});
	body.on ("click", "[data-target]", function (event) {
		var	el		= $(event.target),
			ct		= $(event.currentTarget),
			target	= ct.attr ("data-target");
		if (ct.is ("table")) {
			var	tdt		= $(target).DataTable ();
			el = (el.closest ("td").length > 0) ? el.closest ("td") : el;
			if (el.is ('td')) {
				var	selectedRow	= el.closest ('tr'),
					dataSources	= selectedRow.find ('[data-loadsource]'),
					data		= $(dataSources[0]).attr ("data-row"),
					rowCount	= tdt.rows ().count ();
				if (data.length == 0) return false;
				if (rowCount == 0) addAssetTransfer (tdt, dataSources, data);
				else {
					var found		= false,
						rowFound	= null;
					for (var i = 0; i < rowCount; i++) {
						found	= ($(tdt.cell (i, 0).data ()).find ("input").val () === data);
						if (found) {
							rowFound	= $(tdt.row (i).node ());
							break;
						}
					}
					
					if (!found) addAssetTransfer (tdt, dataSources, data);
					else {
						var	whQty		= $(dataSources[4]).text (),
							text		= rowFound.find ("[data-action=\"change-qty\"]"),
							input		= text.prev ();
						if (parseInt (input.val ()) != whQty) {
							text.text (whQty);
							input.val (whQty);
						}
					}
				}
			}
		}
	});
})(jQuery);