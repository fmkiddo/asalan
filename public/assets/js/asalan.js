'use strict';

(function ($) {
	$.siteURL	= function ($url) {
		var $dataURL 	= $('body').attr ('data-siteurl');
		var $siteURL	= $dataURL + '/' + $url;
		return $siteURL;
	};
})(jQuery);