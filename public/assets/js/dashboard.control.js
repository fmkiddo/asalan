(function ($){
	'use strict';
	
	var body = $("body");
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
	body.on ("click", "[data-action=\"open-dialog\"]", function (event) {
		event.preventDefault ();
		var el		= $(event.currentTarget),
			target	= $(el.attr ("data-action-target")),
			source	= $(el.attr ("data-action-source")).val (),
			able	= el.attr ("data-action-privilege");
		if (!(source === null)) {
			target.find ("[data-sub-target]").attr ('data-sub-target', source);
			target.modal ("toggle");
		} else {
			
		}
	});
	body.on ("change", "[data-action=\"do-filter\"]", function (event) {
		var el		= $(event.currentTarget),
			target	= $(el.attr ("data-filter-target"));
		if (target.is ("[data-table=\"true\"]")) {
			target.attr ("data-sub-filter", el.val ());
			target.DataTable ().ajax.reload ();
		}
	});
	body.on ("click", "[data-pick-target]", function (event) {
		var el		= $(event.currentTarget),
			target	= $(el.attr ('data-pick-target'));
		target.click ();
	});
	body.on ("change", "#checkAll", function (event) {
		var el		= $(event.currentTarget),
			target	= $(el.attr ("data-target"));
		if (target.length) target.attr ('checked', el.prop ('checked'));
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
	body.on ("click", "table[data-target]", function (event) {
		var	el		= $(event.target),
			ct		= $(event.currentTarget),
			target	= ct.attr ("data-target");
		if (ct.is ("table")) {
			var	tdt		= $(target).DataTable (),
				sdt		= $(ct).DataTable ();
			el = (el.closest ("td").length > 0) ? el.closest ("td") : el;
			console.log (el);
		}
	});
})(jQuery);