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
})(jQuery);