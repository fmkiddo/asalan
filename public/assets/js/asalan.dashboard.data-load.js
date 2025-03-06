(function ($) {
	'use strict';
	$(function () {
		var	body		= $("body"),
			bodyDT		= body.find ("[data-table=\"true\"]:visible:not(.modal [data-table=\"true\"])"),
			ajaxLoads	= body.find ("[data-load-ajax]:visible:not(.modal [data-load-ajax])");
		if (bodyDT.length > 0) $.loadDataTable (bodyDT);
		$.loadAjax (ajaxLoads);
	});
})(jQuery);