(function ($) {
	'use strict';
	$(function () {
		var	body	= $("body"),
			ajaxUrl = $.siteURL ($.getLocale () + "/data-pool");
		body.on ("click", "[data-action]", function (event) {
			event.preventDefault ();
			var	el		= $(event.currentTarget),
				action	= el.attr ("data-action"),
				target	= (!el.attr ("href")) ? el.attr ("data-action-target") : el.attr ("href");
			switch (action) {
				case "open-dialog":
					var	targetEl	= $(target),
						isAble		= targetEl.attr ("data-action-privilege");
					isAble	= isAble === undefined ? "true" : isAble;
					if (isAble === "true") {
						if (targetEl.is ("#modalDetail")) {
							var	isTable	= el.closest ("[data-table=\"true\"]").length > 0;
							if (isTable) {
								var	rowSource	= el.closest ("tr");
								$.loadDataToDetails (rowSource, $(targetEl));
							}
						}
						$(targetEl).modal ("show");
					} else {
						
					}
					break;
				case "open-editdialog":
					var	targetEl	= $(target),
						isAble		= targetEl.attr ("data-action-privilege");
					isAble	= isAble === undefined ? "true" : isAble;
					if (isAble === "true") {
						$.loadDataToForm (event, true);
						targetEl.editRequestType ();
						if (targetEl.is (".modal")) targetEl.modal ("show");
						
					}
					break;
				case "reload-table":
					var targetTable	= $(target).DataTable ();
					$(this).prop ("disabled", true);
					targetTable.ajax.reload ();
					break;
				case "reload-list":
					break;
				case "fade":
					var	fadeTarget	= $(el.attr ("data-fade-target"));
					if (fadeTarget.is (".faded")) {
						var	fadedTarget	= $(target);
						
						fadeTarget.children ().not (fadedTarget).fadeOut (function () {
							fadedTarget.fadeIn (function () {
								var	ajaxLoad	= $(this).find ("[data-load-ajax]"),
									form		= $(this).find ("form"),
									dt			= $(this).find ("[data-table=\"true\"]");
									
								if (ajaxLoad.length) {
									var	delay		= 0;
									ajaxLoad.each (function () {
										var	ajaxEl		= $(this),
											type		= ajaxEl.attr ("data-load-ajax"),
											doFilter	= ajaxEl.attr ("data-load-filter"),
											ajaxData	= {
												fetch: type,
											};
										if (doFilter === 'true') ajaxData.doFilter = true;
										setTimeout (function () {
											ajaxEl.loadAjaxOptions (ajaxData, type);
										}, delay);
										delay	+= 500;
									});
								}
																	
								if (form.length) {
									var	reqType		= form.find ("[name=\"request-type\"]"),
										reqTypeVal	= reqType.val (),
										tReqTypeVal	= reqTypeVal.split ("|");
									if (el.is ("[data-edit-form]")) {
										tReqTypeVal[1]	= "edit";
										$.loadDataToForm (event, true);
									}
									reqType.val (tReqTypeVal.join ("|"));
								}
								if (dt.length) $.loadDataTable (dt);
	
								$.fn.dataTable.tables ({'visible': true, 'api': true}).columns.adjust ();
							});
						});
					}
					break;
				case "clone":
					var	targetEl	= $(target),
						cloneBox	= targetEl.closest (".clone-container");
					if (cloneBox.length > 0) {
						var	clonedTarget	= cloneBox.children (target + ":last-child").clone (),
							clonedCont		= clonedTarget.find (".form-image-container");
						clonedTarget.find (":input").val ("");
						clonedCont.find (".carousel-inner").children ().remove ();
						var	tid		= clonedCont.prop ("id"),
							splited	= tid.split ("-"),
							newId	= parseInt (splited[1]) + 1;
						splited[1]	= newId;
						var	itemId		= splited.join ("-");
						clonedCont.prop ("id", itemId);
						clonedCont.find ("[data-bs-target]").attr ("data-bs-target", "#" + itemId);
						var clonedFile	= clonedTarget.find (":input[type=\"file\"]"),
							nameCloned	= clonedFile.attr ("name"),
							imageIndex	= nameCloned.match (/\d+/g),
							asInt		= parseInt (imageIndex);
						clonedFile.attr ("name", nameCloned.replace (String (asInt), String ((asInt + 1))));
						clonedTarget.appendTo (cloneBox);
					}
					break;
				case "clone-remove":
					var	targetEl	= $(target),
						cloneBox	= targetEl.closest (".clone-container");
					if (cloneBox.children ().length > 1) cloneBox.children (":last-child").remove ();
					break;
				case "clone-reset":
					var	targetEl	= $(target),
						cloneBox	= targetEl.closest (".clone-container");
					if (cloneBox.children ().length > 1) cloneBox.children (":not(:first-child)").remove ();
					el.closest ("form").resetForm ();
					break;
				case "asset-pick":
					var	targetEl	= $(target);
					if (el.is ("[data-action-toggle]")) {
						var	toggle		= el.attr ("data-action-toggle"),
							source		= $(el.attr ("data-action-source"));
						if (!(source.val () === undefined || source.val () == "" || source.val () == null)) { 
							switch (toggle) {
								case "modal":
									targetEl.modal ("show");
									break;
							}
						} else {
							$.showAlert ({
								title: source.attr ("data-action-title"),
								text: source.attr ("data-action-text"),
								icon: "error",
							});
							source.focus ();
						}
					}
					break;
				case "pick-image":
					var	isImageForm	= el.closest (".form-image");
					if (isImageForm.length > 0) {
						var	targetEl	= isImageForm.find (target);
						targetEl.on ("change", function () {
							var	targetCont	= isImageForm.find (".form-image-container"),
								indicators	= targetCont.find (".carousel-indicators"),
								targetInner	= targetCont.find (".carousel-inner");
								
							if (targetInner.children ().length > 0) targetInner.children ().remove ();
							if (indicators.children ().length > 0) indicators.children ().remove ();
							targetEl.loadImages (targetCont, true);
						});
						targetEl.click ();
					}
					break;
				case "pick-clear":
					var	isImageForm	= el.closest (".form-image");
					if (isImageForm.length > 0) {
						var	targetEl	= $(target),
							targetCont	= isImageForm.find (".form-image-container"),
							indicators	= targetCont.find (".carousel-indicators"),
							targetInner	= targetCont.find (".carousel-inner");
						targetEl.val ("");
						if (targetInner.children ().length > 0) targetInner.children ().remove ();
						if (indicators.children ().length > 0) indicators.children ().remove ();
					}
					break;
				case 'remove-row':
					var	currRow		= el.closest ("tr"),
						tableTarget	= el.closest ("table"),
						dt			= tableTarget.DataTable ();
					dt.row (currRow).remove ();
					var	newData		= dt.rows ().data ();
					for (var i=0; i<newData.length; i++) {
						var	newContent	= $(newData[i][0]);
						newContent.find (".first-col").text (i+1);
						newData[i][0]	= newContent.prop ('outerHTML');
					}
					dt.rows ().invalidate ().draw (false);
					break;
				case 'pick-asset':
					var	clickedEl	= $(event.target),
						theTR		= clickedEl,
						dt			= $(target).DataTable ();
					if (clickedEl.closest ("th").length === 0) {
						var	data		= dt.rows ().data ().toArray (),
							rowCount	= data.length;
						
						if (!theTR.is ("tr")) theTR	= theTR.closest ("tr");
						var	rowData	= theTR.children ().eq (0).find ("[data-row]").attr ("data-row"),
							faCode	= theTR.children ().eq (1).children ().text (),
							subLoc	= theTR.children ().eq (3).children ().text (),
							addRow	= false,
							row		= -1;
						
						if (rowCount == 0) addRow = true;
						else {
							var	isExist	= false;
							for (var i=0; i<data.length; i++) {
								var	c	= data[i][1];
								if ("#tableProcureExist" === target) { 
									if (c === faCode) {
										row		= i;
										isExist	= true;
										break;
									}
								} else {
									var	s	= data[i][3];
									if (c === faCode && s === subLoc) {
										row		= i;
										isExist	= true;
										break;
									}
								}
							}
	
							if (!isExist) addRow = true;
						}
						
						if (!addRow) {
							// should be update the qty
						} else {
							var	newRow	= [];
							switch (target) {
								case "#tableProcureExist":
									var	firstCol	= $("<span/>"),
										removeBtn	= $("<button/>", {
										type: "button",
										class: "btn btn-sm btn-danger",
										"data-action": "remove-row",
									});
									$("<input/>", {
										type: "hidden",
										name: "input-fapdatarow[]",
										value: rowData
									}).appendTo (firstCol); 
									$("<span/>", {
										class: "first-col",
										text: (rowCount+1),
									}).appendTo (firstCol);
									$("<i/>", {
										class: "mdi mdi-close-circle",
									}).appendTo (removeBtn);
									var	qtyCol		= $("<input/>", {
										type: "number",
										name: "input-fapqty[]",
										class: "form-control",
										min: 1,
										value: 1,
										required: true,
									});
									newRow		= [
										firstCol.prop ("outerHTML"),
										faCode,
										theTR.children ().eq (2).children ().text (),
										$("<input/>", {
											type: "number",
											name: "input-fapvalue[]",
											class: "form-control",
											min: 1,
											required: true,
										}).prop ("outerHTML"),
										qtyCol.prop ("outerHTML"),
										$("<input/>", {
											type: "text",
											name: "input-fapremark[]",
											class: "form-control",
											required: true,
										}).prop ("outerHTML"),
										removeBtn.prop ("outerHTML"),
									];
									break;
								case "#tableTransferRequest":
								case "#tableRemovalRequest":
								case "#tableAssetTransfer":
									var	whQty		= theTR.children ().eq (4).children ().text (),
										firstCol	= $("<span/>"),
										removeBtn	= $("<button/>", {
										type: "button",
										class: "btn btn-sm btn-danger",
										"data-action": "remove-row",
									});
									$("<input/>", {
										type: "hidden",
										name: "input-famdatarow[]",
										value: rowData
									}).appendTo (firstCol); 
									$("<span/>", {
										class: "first-col",
										text: (rowCount+1),
									}).appendTo (firstCol);
									$("<i/>", {
										class: "mdi mdi-close-circle",
									}).appendTo (removeBtn);
									var	qtyCol		= $("<input/>", {
										type: "number",
										name: "input-famqty[]",
										class: "form-control",
										min: 1,
										max: whQty,
										value: 1,
										required: true,
									});
									newRow		= [
										firstCol.prop ("outerHTML"),
										faCode,
										theTR.children ().eq (2).children ().text (),
										theTR.children ().eq (3).children ().text (),
										qtyCol.prop ("outerHTML"),
										removeBtn.prop ("outerHTML"),
									];
									break;
							}
							dt.row.add (newRow).draw (false);
						}
					}
					break;
			}
		});
		body.on ("click", ".nav-link[data-bs-toggle=\"tab\"],.nav-link[data-bs-toggle=\"pill\"]", function (event) {
			var	el				= $(event.target),
				toggleTarget	= (el.is ("[data-bs-target]") ? el.attr ("data-bs-target") : el.attr ("href")),
				target			= $(toggleTarget),
				DTs				= target.find ("[data-table=\"true\"]:visible"),
				ajaxLoads		= target.find ("[data-load-ajax]:visible:not(.modal [data-load-ajax]:visible)");
			if (DTs.length > 0) $.loadDataTable (DTs);
			$.loadAjax (ajaxLoads);
		});
		body.on ("click", "[data-table=\"true\"]", function (event) {
			var	click		= $(event.target),
				table		= $(event.currentTarget);
			if (click.closest ("table").is (table)) {
				var rowSource	= click.closest ("tr"),
					colSource	= (!click.is ("td") ? click.closest ("td") : click),
					isLastChild	= rowSource.children ().last ().is (colSource),
					openDialog	= false;
				if (!isLastChild) openDialog = true;
				else 
					if (!(click.closest ("div.right").length > 0)) openDialog = true;
				
				if (openDialog) {
					var	el = rowSource.find ("[data-action=\"open-dialog\"]").attr ("data-action-target");
					$.loadDataToDetails (rowSource, $(el));
					if ($(el).is (".modal")) $(el).modal ("show");
				}
			}
		});
		body.on ("click", "[type=\"reset\"]", function (event) {
			var	el		= $(event.target),
				form	= el.closest ("form"),
				table	= form.find ("table[data-table=\"true\"]");
			if (table.length > 0) table.DataTable ().clear ().draw (false);
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
		body.on ("change", "[data-toggle]", function (event) {
			var el		= $(event.target),
				action	= el.attr ("data-toggle");
			switch (action) {
				case "slided":
					var	parent	= el.closest (".slided"),
						target	= $(el.val ());
					$.fn.loadSlidedData = function () {
						var	slideDTs	= $(this).find ("[data-table=\"true\"]"),
							ajaxLoads	= $(this).find ("[data-load-ajax]");
						if (slideDTs.length > 0) $.loadDataTable (slideDTs);
						$.loadAjax (ajaxLoads);
					};
					if (el.is ("select")) {
						var visibleItem	= parent.find (".slide-item:visible");
						if (!visibleItem.length)
							target.slideDown (function () {
								$(this).loadSlidedData ();
							});
						else {
							visibleItem.slideUp (function () {
								target.slideDown (function () {
									$(this).loadSlidedData ();
								});
							});
						}
					}
					break;
			}
		});
		body.on ("change", "[data-action]", function (event) {
			var	el		= $(event.target),
				action	= el.attr ("data-action"),
				target	= (el.is("[data-action-target]") ? el.attr ("data-action-target") : el.attr ("href"));
			if (el.is (":input")) {
				var	targetEl	= $(target);
				if (targetEl.length > 0) {
					switch (action) {
						case "sub-updater":
							if (targetEl.is ("[data-sub]") && targetEl.is ("[data-sub-target]")) targetEl.attr ("data-sub-target", el.val ());
							break;
						case "do-filter":
							var	targetFilter	= $(target);
							if (targetFilter.is ("[data-table=\"true\"]")) {
								targetFilter.attr ("data-sub-filter", el.val ());
								targetFilter.DataTable ().ajax.reload ();
							}
							break;
					}
				}
			}
		});
		body.on ("change", "[min], [max]", function (event) {
			var	el	= $(event.target),
				val	= parseInt (el.val ());
			if (el.is ("[min]")) {
				var min	= parseInt (el.attr ("min"));
				if (val < min) el.val (min);
			}
			
			if (el.is ("[max]")) {
				var	max	= parseInt (el.attr ("max"));
				if (val > max) el.val (max);
			}
		});
	});
})(jQuery);