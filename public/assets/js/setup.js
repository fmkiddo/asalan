'use strict';
$(function () {
	$(document).ready (function () {
		$('.masked').each (function () {
			var $el		= $(this);
			var $mask	= $el.attr ('data-inputmask');
			$el.mask ($mask);
		});
	});
});