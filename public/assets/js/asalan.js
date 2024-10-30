'use strict';

(function ($) {
	$.siteURL	= function ($relativePath) {
		var $dataURL 	= $('body').attr ('data-siteurl');
		var $siteURL	= $dataURL + '/' + $relativePath;
		return $siteURL;
	};
})(jQuery);