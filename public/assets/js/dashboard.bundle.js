(function ($) {
	'use strict';
	
	$(function () {
		var body = $("body");
		var contentWrapper = $(".content-wrapper");
		var scroller = $(".container-scroller");
		var footer = $(".footer");
		var sidebar = $(".sidebar");
	
		//Add active class to nav-link based on url dynamically
		//Active class can be hard coded directly in html file also as required
	
		function addActiveClass(element) {
		    if (current === "") {
		        //for root url
		        if (element.attr("href").indexOf("index.html") !== -1) {
		            element.parents(".nav-item").last().addClass("active");
		            if (element.parents(".sub-menu").length) {
		                element.closest(".collapse").addClass("show");
		                element.addClass("active");
		            }
		        }
		    } else {
		        //for other url
		        if (element.attr("href").indexOf(current) !== -1) {
		            element.parents(".nav-item").last().addClass("active");
		            if (element.parents(".sub-menu").length) {
		                element.closest(".collapse").addClass("show");
		                element.addClass("active");
		            }
		            if (element.parents(".submenu-item").length) {
		                element.addClass("active");
		            }
		        }
		    }
		}
	
		var current = location.pathname
		    .split("/")
		    .slice(-1)[0]
		    .replace(/^\/|\/$/g, "");
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
		}
	
		$('[data-toggle="minimize"]').on("click", function () {
		    if (body.hasClass("sidebar-toggle-display") || body.hasClass("sidebar-absolute")) {
		        body.toggleClass("sidebar-hidden");
		    } else {
		        body.toggleClass("sidebar-icon-only");
		    }
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
	    var $body = $("body");

	    //sidebar backgrounds
	    $("#sidebar-light-theme").on("click", function () {
	        $body.removeClass(sidebar_classes);
	        $body.addClass("sidebar-light");
	        $(".sidebar-bg-options").removeClass("selected");
	        $(this).addClass("selected");
	    });
	    $("#sidebar-dark-theme").on("click", function () {
	        $body.removeClass(sidebar_classes);
	        $body.addClass("sidebar-dark");
	        $(".sidebar-bg-options").removeClass("selected");
	        $(this).addClass("selected");
	    });

	    //Navbar Backgrounds
	    $(".tiles.primary").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-primary");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
	    });
	    $(".tiles.success").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-success");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
	    });
	    $(".tiles.warning").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-warning");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
	    });
	    $(".tiles.danger").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-danger");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
	    });
	    $(".tiles.light").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-light");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
	    });
	    $(".tiles.info").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-info");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
	    });
	    $(".tiles.dark").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".navbar").addClass("navbar-dark");
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
	    });
	    $(".tiles.default").on("click", function () {
	        $(".navbar").removeClass(navbar_classes);
	        $(".tiles").removeClass("selected");
	        $(this).addClass("selected");
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
			            if (ev.type === "mouseenter") {
			                $menuItem.addClass("hover-open");
			            } else {
			                $menuItem.removeClass("hover-open");
			            }
			        }
			    }
			}
		});
	});
})(jQuery);