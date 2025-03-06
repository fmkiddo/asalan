(function ($) {
	'use strict';
	$(function () {
		const params = window.location.search
				.replace ("?", "")
				.split ("&");
		var	body			= $("body"),
			contentWrapper	= body.find (".content-wrapper"),
			scroller		= body.find (".container-scroller"),
			footer			= body.find (".footer"),
			sidebar			= body.find (".sidebar"),
			locale			= $.getLocale ();

		//Add active class to nav-link based on url dynamically
		//Active class can be hard coded directly in html file also as required
		$(".lang-options li").each (function () {
			if ($(this).find ("img").attr ("alt") === locale) $(this).addClass ("selected");
		});
		$(".lang-item").on ("click", function (evt) {
			var currURL = window.location.href;
			var isDashboard = currURL.indexOf ('dashboard');
			if (isDashboard) {
				var targetLocale = $(this).find ("img").attr ("alt");
				window.location.href = $.siteURL (targetLocale + "/dashboard?" + params[0]);
			}
		});
		function addActiveClass (element) {
			if (element.attr ("data-redirect") === current) {
				element.parents (".nav-item").last ().addClass ("active");
				if (element.parents (".sub-menu").length) {
					element.closest (".collapse").prev ().attr ("aria-expanded", true)
					element.closest (".collapse").addClass ("show");
					element.addClass ("active");
				}
			}
		}
		var current = "";
		$.each (params, function (k, v) {
			var param = v.split ("=");
			if (param[0] == "alv") {
				current = param[1];
				return;
			}
		});
		$(".nav li a", sidebar).each(function () {
		    var $this = $(this);
		    addActiveClass ($this);
		});

		$(".horizontal-menu .nav li a").each(function () {
		    var $this = $(this);
		    addActiveClass ($this);
		});

		//Close other submenu in sidebar on opening any

		sidebar.on("show.bs.collapse", ".collapse", function () {
		    sidebar.find(".collapse.show").collapse("hide");
		});

		//Change sidebar and content-wrapper height
		applyStyles();

		function applyStyles() {
		    //Applying perfect scrollbar
		    if (!body.hasClass("rtl")) {
		        if ($(".settings-panel .tab-content .tab-pane.scroll-wrapper").length) {
		            const settingsPanelScroll = new PerfectScrollbar (".settings-panel .tab-content .tab-pane.scroll-wrapper");
		        }
		        if ($(".chats").length) {
		            const chatsScroll = new PerfectScrollbar (".chats");
		        }
		        if (body.hasClass("sidebar-fixed")) {
		            if ($("#sidebar").length) {
		                var fixedSidebarScroll = new PerfectScrollbar ("#sidebar .nav");
		            }
		        }
		    }
			
			if (body.hasClass ("sidebar-dark")) $("div#sidebar-dark-theme").addClass ("selected");
			else  $("div#sidebar-light-theme").addClass ("selected");
			
			var navbar = body.find ("nav.navbar");
			var color = "default";
			if (navbar.hasClass ('navbar-light')) color = "light";
			if (navbar.hasClass ('navbar-dark')) color = "dark";
			if (navbar.hasClass ('navbar-success')) color = "success";
			if (navbar.hasClass ('navbar-warning')) color = "warning";
			if (navbar.hasClass ('navbar-danger')) color = "danger";
			if (navbar.hasClass ('navbar-info')) color = "info";
			if (navbar.hasClass ('navbar-primary')) color = "primary";
			body.find ("div.color-tiles .tiles." + color).addClass ("selected");
		}

		$('[data-toggle="minimize"]').on("click", function () {
		    if (body.hasClass("sidebar-toggle-display") || body.hasClass("sidebar-absolute")) {
		        body.toggleClass("sidebar-hidden");
		    } else {
		        body.toggleClass("sidebar-icon-only");
		    }
			var minimized = body.hasClass ("sidebar-icon-only");
			$.changeConfig ('minimized', minimized);
		});
		$("#urPict").on ("change", function ($evt) {
			var image	= this.files[0];
			var reader	= new FileReader ();
			reader.onloadend	= function () {
				var preview	= $($evt.target).closest (".tab-pane").find (".pict-preview");
				preview.toggleClass ("blank");
				preview.css ({
					"background": 'url("' + reader.result + '") center center / cover no-repeat',
				});
			};
			if (image) reader.readAsDataURL (image);
		});

		//checkbox and radios
		$(".form-check label,.form-radio label").append('<i class="input-helper"></i>');

		//Horizontal menu in mobile
		$('[data-toggle="horizontal-menu-toggle"]').on("click", function () {
		    $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
		});
		// Horizontal menu navigation in mobile menu on click
		var navItemClicked = $(".horizontal-menu .page-navigation >.nav-item");
		navItemClicked.on("click", function (event) {
		    if (window.matchMedia("(max-width: 991px)").matches) {
		        if (!$(this).hasClass("show-submenu")) {
		            navItemClicked.removeClass("show-submenu");
		        }
		        $(this).toggleClass("show-submenu");
		    }
		});

		$(window).scroll(function () {
		    if (window.matchMedia("(min-width: 992px)").matches) {
		        var header = $(".horizontal-menu");
		        if ($(window).scrollTop() >= 70) {
		            $(header).addClass("fixed-on-scroll");
		        } else {
		            $(header).removeClass("fixed-on-scroll");
		        }
		    }
		});
		body.on ('click', '[data-redirect]', function (event) {
			event.preventDefault ();
			var	$el			= $(event.currentTarget),
				$redirect	= $el.attr ('data-redirect');
			if ($redirect !== 'sign-out') {
				var	$payload	= $el.is ("[data-getredirect]") ? $el.attr ("data-getredirect") : "";
				$.doDashboardRedirect ($redirect, $payload);
			} else {
				Swal.fire ({
					title: $.lang ('signOutTitle'),
					text: $.lang ('signOutText'),
					icon: "warning",
					showCancelButton: true,
					confirmButtonText: $.lang ('signOutConfirm'),
					cancelButtonText: $.lang ('signOutCancel'),
				}).then (function (result) {
					if (result.isConfirmed) $.doDashboardRedirect ($redirect);
				});
			}
		});

		body.on ('mouseenter mouseleave', '.sidebar .nav-item', function ($ev) {
			var body = $("body");
			var sidebarIconOnly = body.hasClass("sidebar-icon-only");
			var sidebarFixed = body.hasClass("sidebar-fixed");
			if (!("ontouchstart" in document.documentElement)) {
			    if (sidebarIconOnly) {
			        if (sidebarFixed) {
			            if (ev.type === "mouseenter") {
			                body.removeClass("sidebar-icon-only");
			            }
			        } else {
			            var $menuItem = $(this);
			            if ($ev.type === "mouseenter") {
			                $menuItem.addClass("hover-open");
			            } else {
			                $menuItem.removeClass("hover-open");
			            }
			        }
			    }
			}
		});
		body.find (".datepicker").each (function () {
			$(this).datepicker ({
				enableOnReadonly: true,
				todayHighlight: true,
				language: locale,
			});
		});
		body.on ("focusout", "[type=\"number\"]", function () {
			var	el		= $(this),
				value	= el.val ();
			if (value === '') {
				var	def	= 0;
				if (el.is ("[min]")) def = parseInt (el.attr ("min"));
				el.val (def);
			}
		});
	});
})(jQuery);