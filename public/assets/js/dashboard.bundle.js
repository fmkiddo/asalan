(function ($) {
	'use strict';
	
	$(function () {
		var body = $("body");
		var contentWrapper = $(".content-wrapper");
		var scroller = $(".container-scroller");
		var footer = $(".footer");
		var sidebar = $(".sidebar");
		var locale = $.getLocale ();
		const params = window.location.search
				.replace ("?", "")
				.split ("&");
	
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
		function addActiveClass(element) {
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
		    addActiveClass($this);
		});
	
		$(".horizontal-menu .nav li a").each(function () {
		    var $this = $(this);
		    addActiveClass($this);
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
		            const settingsPanelScroll = new PerfectScrollbar(".settings-panel .tab-content .tab-pane.scroll-wrapper");
		        }
		        if ($(".chats").length) {
		            const chatsScroll = new PerfectScrollbar(".chats");
		        }
		        if (body.hasClass("sidebar-fixed")) {
		            if ($("#sidebar").length) {
		                var fixedSidebarScroll = new PerfectScrollbar("#sidebar .nav");
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
		
		$('[data-toggle="offcanvas"]').on ("click", function() {
			$('.sidebar-offcanvas').toggleClass('active')
		});	
	
	    $(".nav-settings").on ("click", function () {
	        $("#right-sidebar").toggleClass("open");
	    });
	    $(".settings-close").on ("click", function () {
	        $("#right-sidebar,#theme-settings").removeClass("open");
	    });

	    $("#settings-trigger").on ("click", function () {
	        $("#theme-settings").toggleClass("open");
	    });

	    //background constants
	    var navbar_classes = "navbar-danger navbar-success navbar-warning navbar-dark navbar-light navbar-primary navbar-info navbar-pink";
	    var sidebar_classes = "sidebar-light sidebar-dark";

	    //sidebar backgrounds
	    $("#sidebar-light-theme").on("click", function () {
	        body.removeClass(sidebar_classes);
	        body.addClass("sidebar-light");
	        $(".sidebar-bg-options").removeClass("selected");
	        $(this).addClass("selected");
			$.changeConfig ('theme', 'light');
	    });
	    $("#sidebar-dark-theme").on("click", function () {
	        body.removeClass(sidebar_classes);
	        body.addClass("sidebar-dark");
	        $(".sidebar-bg-options").removeClass("selected");
	        $(this).addClass("selected");
			$.changeConfig ('theme', 'dark');
	    });

	    //Navbar Backgrounds
	    $(".tiles.primary").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-primary");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
			$.changeConfig ('topbar', 'primary');
	    });
	    $(".tiles.success").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-success");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
			$.changeConfig ('topbar', 'success');
	    });
	    $(".tiles.warning").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-warning");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
			$.changeConfig ('topbar', 'warning');
	    });
	    $(".tiles.danger").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-danger");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
			$.changeConfig ('topbar', 'danger');
	    });
	    $(".tiles.light").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-light");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
			$.changeConfig ('topbar', 'light');
	    });
	    $(".tiles.info").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-info");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
			$.changeConfig ('topbar', 'info');
	    });
	    $(".tiles.dark").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-dark");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
			$.changeConfig ('topbar', 'dark');
	    });
	    $(".tiles.default").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
			$.changeConfig ('topbar', 'default');
	    });
		$("#pickImage").on ("click", function () {
			$(this).closest ('div.pick-image').find ('[type="file"]').click ();
		});
		
		$(document).on ('click', '[data-redirect]', function ($evt) {
			$evt.preventDefault ();
			var $redirect	= $($evt.currentTarget).attr ('data-redirect');
			if ($redirect !== 'sign-out') $.doDashboardRedirect ($redirect);
			else {
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
		
		$(document).on ('mouseenter mouseleave', '.sidebar .nav-item', function ($ev) {
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
		
		var datatables	= $(document).find ('[data-table="true"]');
		if (datatables.length) {
			datatables.each (function () {
				$(this).DataTable ();
			});
		}
	});
})(jQuery);