(function ($) {
	'use strict';
	
	$(function () {
		var body = $("body");
		var contentWrapper = $(".content-wrapper");
		var scroller = $(".container-scroller");
		var footer = $(".footer");
		var sidebar = $(".sidebar");
		var locale = $.getLocale ();
		var ajaxUrl = $.siteURL ($.getLocale () + "/data-pool");
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
		function loadDataTable (dataTables) {
			var init = false,
				delay = 200;
			dataTables.each (function () {
				var currTable = $(this),
					tableId = currTable.prop ("id"),
					options	= {
						retrieve: true,
						ajax: {
							url: $.siteURL ($.getLocale () + '/data-pool'),
							type: 'POST',
							data: function ($d) {
								var alv = $.getAlv ();
								if (currTable.is ("[data-sub]")) {
									alv = currTable.attr ("data-sub");
									$d.subdata = currTable.attr ("data-sub-target");
								}
								
								$d.fetch = alv;
							},
							complete: function () {
								body.find ("button[data-bs-reload=\"table\"][data-bs-target=\"#" + tableId + "\"]")
									.prop ("disabled", false);
							}
						},
					};
				init = $(this).delayedDataTableInit (options, delay);
				delay += 400;
			});
			return init;
		}
		var dataTables	= $(document).find ('[data-table="true"]:not("[data-sub]")');
		if (dataTables.length) loadDataTable (dataTables);
		
		$("input:checkbox[data-single=\"true\"]").on ("click", function () {
			$("input:checkbox[data-single=\"true\"]").not (this).prop ("checked", false);
		});
		$("[data-bs-reload=\"table\"]").on ("click", function (event) {
			event.preventDefault ();
			var target	= "",
				execute	= true;
			if ($(event.currentTarget).is ("a")) target = $(this).attr ('href');
			else if ($(event.currentTarget).is ("button")) target = $(this).attr ("data-bs-target");
			else execute = false;
			
			if (execute) {
				var theDt = $("table" + target + "[data-table=\"true\"]").DataTable ();
				$(this).prop ('disabled', true);
				theDt.ajax.reload ();
			}
			return execute;
		});
		
		$("[data-bs-reload=\"list\"]").on ("click", function (event) {
			event.preventDefault ();
			var target	= "",
				execute	= true;
			if ($(event.currentTarget).is ("a")) target = $(this).attr ("href");
			else if ($(event.currentTarget).is ("button")) target = $(this).attr ("data-bs-target");
			else execute = false;
			
			if (execute) {
				var theList = $("ul" + target),
					fetchRefresh = theList.attr ("data-fetch"),
					loadTarget = $(event.currentTarget).attr ("data-loadtarget"),
					ajaxParam = {
						fetch: fetchRefresh
					};
				$.ajax ({
					url: ajaxUrl,
					method: 'post',
					data: $.param (ajaxParam)
				}).done (function (result) {
					theList.children ().not (":first").remove ();
					if (!result.length) theList.children (0).removeClass ("d-none");
					else {
						theList.children (0).addClass ("d-none");
						$.each (result.data[fetchRefresh], function (k, v) {
							var li	= $("<li/>", {
									class: "border-bottom my-2",
									role: "button",
								}),
								div	= $("<div/>", {
									class: "d-flex align-items-center justify-content-between"
								}),
								de	= $("<div/>", {
									class: "d-flex align-items-center justify-content-between"
								});
							$("<span/>", {
								class: "me-2",
								text: v.type
							}).appendTo (de);
							$("<a></a>", {
								text: "edit",
								href: loadTarget,
								"data-uuid": v.uuid,
								"data-name": v.name,
								"data-type": v.type,
								role: "button",
								"data-bs-toggle": "modal"
							}).appendTo (de);
							$("<span/>", {
								class: "text-start fw-bold",
								text: v.name
							}).appendTo (div);
							de.appendTo (div);
							div.appendTo (li);
							li.appendTo (theList);
						});
					}
				});
			}
			return execute;
		});
		
		setTimeout (function () {
			$("[data-clickonload=\"true\"]").each (function () {
				$(this).click ();
			});
		}, 1000);
		
		$("input#allAccess").on ("change", function () {
			var partialAccess	= $("#partialAccess"),
				props			= {
					disabled: false,
					checked: false
				};
			if ($(this).is (":checked")) {
				props.disabled	= true;
				props.checked	= true;
			}
			partialAccess.find (":checkbox").each (function () {
				$(this).prop (props);
			});
		});
		
		function loadDataToForm (eventOwner) {
			var evParent = $(eventOwner.relatedTarget).closest ("tr");
			evParent.find ("[data-loadsource]").each (function () {
				var target	= $(this).attr ("data-loadsource"),
					content	= $(this).text (),
					ltarget	= $(":input[data-loadtarget=\"" + target + "\"]");
				if (ltarget.is ("select")) 
					ltarget.children ().each (function () {
						if ($(this).val () === content) $(this).attr ("selected", true);
					});
				else if (ltarget.is (":checkbox") || ltarget.is (":radio")) ltarget.prop ('checked', $.parseJSON (content));	
				else ltarget.val (content);
			});
		}
		function loadDataToDetails (rowSource, detailsTarget) {
			var dataRow = rowSource.find (":first-child").find ("[data-row]").attr ("data-row");
			rowSource.find ("[data-loadsource]").each (function () {
				var source 	= $(this).attr ("data-loadsource"),
					text	= $(this).text (),
					el		= detailsTarget.find ("[data-loadtarget=\"" + source + "\"]");
				el.each (function () {
					if ($(this).is (':input')) $(this).val (text);
					else $(this).text (text);
				});
			});
			detailsTarget.find ("[data-sub-target]").attr ("data-sub-target", dataRow);
		}
		body.on ("click", "#openModalDetails", function (event) {
			var currTarget = $(event.currentTarget),
				rowSource = currTarget.closest ("tr"),
				modalTarget = $($(event.target).attr ("data-bs-target"));
			loadDataToDetails (rowSource, modalTarget);
		});
		body.on ("click", "#openModalEdit", function (event) {
			if (!$(event.currentTarget).is ("[data-target]")) return false;
			var modalForm	= body.find (".modal form"),
				reqType		= modalForm.find ("[name=\"request-type\"]");
			var tVal	= reqType.val ().split ("|");
			if (tVal[0] !== "profile") {
				modalForm.find ("[name=\"atom\"]").val ($(this).attr ("data-target"));
				tVal[1]		= "edit";
				reqType.val (tVal.join ("|"));
				modalForm.find ("[data-readonlyonedit]").prop ("readonly", true);
				modalForm.find ("[data-notrequiredonedit]").prop ("required", false);
			}
		});
		body.on ("click", "[data-clone]", function (event) {
			event.preventDefault ();
			var fgParent = $(event.currentTarget).closest (".form-group"),
				cloned = fgParent.clone ();
			cloned.find (":input").val ("");
			cloned.appendTo (fgParent.parent ());
		});
		body.on ("click", "[data-remove]", function (event) {
			event.preventDefault ();
			var fgParent = $(event.currentTarget).closest (".form-group"),
				plist = fgParent.closest ("#plistValues");
			if (plist.children ().length === 1) fgParent.find (":input").val ("");
			else fgParent.remove ();
		});
		body.on ("click", "[data-action=\"fade\"]", function (event) {
			event.preventDefault ();
			var eventOwner = $(this),
				fadeTarget = eventOwner.attr ("data-fade-target"),
				fadedContent = $(fadeTarget),
				fadedTarget = $(eventOwner.is ("a") ? "#" + eventOwner.prop ("href").split ("#")[1] : eventOwner.attr ("data-faded-target")),
				reqType = fadedContent.find ("[name=\"request-type\"]"),
				reqTypeV = reqType.val (),
				tReqTypeV = reqTypeV.split ("|");
			fadedContent.children ().not (fadedTarget).fadeOut (function () {
				if (eventOwner.closest ("form").length > 0) {
					eventOwner.closest ("form").resetForm ();
					tReqTypeV[1] = "new";
				}
				if (eventOwner.is ("[data-fade-type]")) {
					var tr = eventOwner.parents ("tr"),
						modalDetail = eventOwner.closest ("#modalDetail"),
						dataRow = tr.find ("[data-row]").attr ("data-row");
					fadedContent.find ("[name=\"atom\"]").val (dataRow);
					fadedContent.find ("[data-readonlyonedit=\"true\"]").attr ("readonly", true);
					tReqTypeV[1] = "edit";
					tr.find ("[data-loadsource]").each (function () {
						var source = $(this).attr ("data-loadsource"),
							content = $(this).text ();
						modalDetail.find ("[data-loadtarget=\"" + source + "\"]").val (content);
					});
				}
				reqType.val (tReqTypeV.join ("|"));
				fadedTarget.fadeIn ();
			});
		});
		body.on ("change", "[name=\"input-proptype\"]", function (event) {
			if ($(event.currentTarget).val () === "plist") {
				body.find ("#plistValues").slideDown ();
			} else {
				body.find ("#plistValues").slideUp ();
			}
		});
		body.on ("click", "tr", function (event) {
			var tr = $(event.currentTarget),
				table = tr.closest ("table"),
				tableID = table.attr ("id");
				
			switch (tableID) {
				default:
					break;
				case "tableLocations":
					var target = $(event.target);
					if (!target.is ("td")) target = target.closest ("td");
					if (!(target.is (tr.children ().last ()))) tr.find ("#openModalDetails")[0].click ();
					break;
				case "tableAssets":
					var target = $(event.target);
					if (!target.is ("td")) target = target.closest ("td");
					target.parent ().find ("#openModalDetails")[0].click ();
					break;
			}
		});
		body.on ("change", "[data-toggle=\"slided\"]", function (event) {
			var el		= $(event.currentTarget),
				parent	= el.closest (".slided"),
				target	= $(el.val ());
			if (el.is ("select")) {
				var visibleItem	= parent.find (".slide-item:visible");
				if (!visibleItem.length) target.slideDown ();
				else {
					visibleItem.slideUp (function () {
						target.slideDown ();
					});
				}
			}
		});
		body.on ("change", "[data-load-subajax]", function (event) {
			var loaderEl = $(event.target),
				type = loaderEl.attr ("data-load-subajax"),
				loadTarget = $(loaderEl.attr ("data-subajax-target")),
				ajaxData = {
					fetch: type,
					subdata: loaderEl.val (),
				};
				
			$.ajax ({
				url: ajaxUrl,
				method: "post",
				data: $.param (ajaxData)
			}).done (function (subresult) {
				if (loadTarget.is ("select")) {
					loadTarget.resetSelect ();
					if (subresult.length) {
						$.each (subresult.data[type], function (k, v) {
							var props = {};
							switch (type) {
								default:
									props = {};
									break;
								case "sublocations":
									props = {
										value: v.uuid,
										text: v.name
									};
									break;
							};
							loadTarget.createOptions (props);
						});
					}
				} else {
					loadTarget.children ().remove ();
					$.each (subresult.data[type], function (k, v) {
						loadTarget.createFormGroup (v);
					});
				}
			}).fail (function () {
				
			});
		});
		$(".datepicker").each (function () {
			$(this).datepicker ({
				enableOnReadonly: true,
				todayHighlight: true,
				language: locale,
			});
		});
		$(".modal").on ("shown.bs.modal", function (event) {

			if ($(this).is ("#modalDetail")) {
				var dt	= $(this).find ("[data-table=\"true\"]");
				dt.each (function () {
					$(this).clone ().removeAttr ("data-table").attr ("data-tableclone", "true")
							.addClass ("d-hidden").appendTo ($(this).parent ());
					if ($(this).is (":visible")) loadDataTable ($(this));
				});
				
				$("#modalDetail .nav-link").on ("click", function (event) {
					var el = $(event.currentTarget),
						target = el.is ("a") ? "#" + el.attr ("href").split ("#")[1] : el.attr ("data-bs-target"),
						targetEL = $(target),
						cdt = targetEL.find ("[data-table=\"true\"]");
					if (cdt.is (":visible")) {
						var isDT = $.fn.DataTable.isDataTable (cdt);
						if (!isDT) loadDataTable (cdt);
						else cdt.DataTable ().ajax.reload ();
					}
				});
			}
			
			var modalForm	= $(event.currentTarget).find ("form");
			if (!modalForm.length) return false;
			var theModal	= $(event.currentTarget),
				ajaxRun		= theModal.is ("[data-ajax-run]");
			if (!ajaxRun) loadDataToForm (event);
			else {
				var ajaxTarget	= theModal.attr ("data-ajax-target"),
					ajaxData	= {
						fetch: ajaxTarget
					};
				$.ajax ({
					url: ajaxUrl,
					method: "post",
					data: $.param (ajaxData),
				}).done (function (result) {
					if (result.length > 0) {
						$.each (result.data, function (target, data) {
							var el = $("[data-ajax-load=\"" + target + "\"]");
							if (el.is ("select")) {
								el.find ("option:not(:first-child)").remove ();
								$.each (data, function (k, v) {
									var prop = {
										text: v.name,
										value: v.uuid
									};
									el.createOptions (prop);
								});
							}
							
							if (el.is ("div")) {
								el.find (":not(:first-child)").remove ();
								var type = el.attr ("data-ajax-type");
								switch (type) {
									default: // as checkbox
										$.each (data, function (k, v) {
											el.createAttributeOption ({
												name: v.name,
												value: v.uuid,
												title: v.type
											});
										});
										break;
								}
							}
						});
					}
				}).fail (function () {
				}).always (function () {
					loadDataToForm (event);
				});
			}
			
			if ($(this).is ("#modalAssetForm")) {
				var delay = 0;
				$(this).find ("[data-load-ajax]").each (function () {
					var el = $(this),
						type = el.attr ("data-load-ajax"),
						ajaxData = {
							fetch: type,
						};

					setTimeout (function () {
						$.ajax ({
							url: ajaxUrl,
							method: "post",
							data: $.param (ajaxData),
						}).done (function (result) {
							if (result.length) {
								$.each (result.data[type], function (k, v) {
									var props = {};
									switch (type) {
										default:
											props = {};
											break;
										case "locations":
											props = {
												value: v.uuid,
												text: v.name + " (" + v.code + ")",
											};
											break;
										case "config":
											props	= {
												value: v.uuid,
												text: v.name,
												title: v.dscript,
											};
											break;
									}
									el.createOptions (props);
								});
							}
						}).fail (function () {
							
						});
					}, delay);
					delay += 500;
				});
			}
		});
		$(".modal").on ("hidden.bs.modal", function (event) {
			if ($(this).is ("#modalDetail")) {
				$(this).find ("[data-readonlyonedit=\"true\"]").prop ("readonly", false);
				var dt = $(this).find ("[data-table=\"true\"]"),
					cdt = $(this).find ("[data-tableclone=\"true\"]");
				dt.DataTable ().clear ().destroy ();
				dt.remove ();
				cdt.removeClass ("d-hidden").removeAttr ("data-tableclone").attr ("data-table", "true");
				$(this).find (".nav-link").removeClass ("active");
				$(this).find (".tab-pane").removeClass ("active show");
				$(this).find (".nav .nav-item:first-child .nav-link").addClass ("active");
				$(this).find (".tab-content .tab-pane:first-child").addClass ("active show");
			}
			var modalForm	= $(event.target).find ("form");
			if (!modalForm.length) return false;
			var reqType		= modalForm.find ("[name=\"request-type\"]");
			if (reqType.length > 0) {
				var tVal		= reqType.val ().split ("|"),
					plist		= modalForm.find ("#plistValues");
				if (tVal[0] !== "profile") {
					tVal[1]			= "new";
					reqType.val (tVal.join ("|"));
					modalForm.resetForm ();
				}
			
				if (plist.length) plist.children ().not (":first-child").remove ();
			}
			
			$(event.target).find ("[data-sub-target]").attr ("data-sub-target", "");
			$(event.target).find ("[data-details=\"true\"]").find ("[data-loadtarget]").text ("");
		});
	});
})(jQuery);