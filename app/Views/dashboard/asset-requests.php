					{commons} {dash_assetrqst_texts}
					<div class="card">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">{title0}</h5>
								<hr class="separator" />
								<div id="requestSection">
									<ul class="nav nav-tabs nav-justified">
										<li class="nav-item">
											<a class="nav-link {if !$openProcure}active{endif}" href="#requestSummary" role="tab" data-bs-toggle="tab" tabindex="-1" aria-selected="true">{tab_button0}</a>
										</li>
										<li class="nav-item">
											<a class="nav-link {if $openProcure}active{endif}" href="#requestProcure" role="tab" data-bs-toggle="tab" tabindex="-1" aria-selected="false">{tab_button1}</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#requestTransfer" role="tab" data-bs-toggle="tab" tabindex="-1" aria-selected="false">{tab_button2}</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#requestRemoval" role="tab" data-bs-toggle="tab" tabindex="-1" aria-selected="false">{tab_button3}</a>
										</li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane fade show active" id="requestSummary" role="tabpanel" tabindex="-1">
											<h5>{tab_title0}</h5>
											<hr class="separator" />
											<div class="scrollable">
												<div class="row">
													<div class="col-3">
        												<div class="card card-reset shadow-none bg-primary rounded-0 text-white">
        													<div class="card-body">
        														<h5 class="card-title text-white">{ctitle_0}</h5>
        														<p class="display-3 my-4">{dc_value0}</p>
        														<a role="button">
        															<span class="mdi mdi-refresh">{btn_reload}</span>
        														</a>
        													</div>
        												</div>
													</div>
													<div class="col-3">
        												<div class="card card-reset shadow-none bg-primary rounded-0 text-white">
        													<div class="card-body">
        														<h5 class="card-title text-white">{ctitle_1}</h5>
        														<p class="display-3 my-4">{dc_value1}</p>
        														<a role="button">
        															<span class="mdi mdi-refresh">{btn_reload}</span>
        														</a>
        													</div>
        												</div>
													</div>
													<div class="col-3">
        												<div class="card card-reset shadow-none bg-primary rounded-0 text-white">
        													<div class="card-body">
        														<h5 class="card-title text-white">{ctitle_2}</h5>
        														<p class="display-3 my-4">{dc_value2}</p>
        														<a role="button">
        															<span class="mdi mdi-refresh">{btn_reload}</span>
        														</a>
        													</div>
        												</div>
													</div>
													<div class="col-3">
        												<div class="card card-reset shadow-none bg-primary rounded-0 text-white">
        													<div class="card-body">
        														<h5 class="card-title text-white">{ctitle_3}</h5>
        														<p class="display-3 my-4">{dc_value3}</p>
        														<a role="button">
        															<span class="mdi mdi-refresh">{btn_reload}</span>
        														</a>
        													</div>
        												</div>
													</div>
												</div>
											</div>
											<hr class="separator" />
											<div class="control-section">
												<h6>{tab0_formtitle0}</h6>
												<div>
    												<a role="button" href="#tableRequestSummaries" data-action="reload-table">
    													<i class="mdi mdi-reload"></i>
    												</a>
    											</div>
											</div>
											<hr class="separator" />
											<table role="button" id="tableRequestSummaries" class="table table-hover table-striped table-centered" data-table="true">
												<thead>
													<tr>
														<th>#</th>
														<th>{t0_thead0}</th>
														<th>{t0_thead1}</th>
														<th>{t0_thead2}</th>
														<th>{t0_thead3}</th>
														<th>{t0_thead4}</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
											<div id="modalDetail" class="modal fade" tabindex="-1" role="dialog" data-bs-keyboard="false" data-bs-background="static" data-ajax="">
												<div class="modal-dialog modal-xl">
													<div class="modal-content">
														<div class="modal-header">
															<h5>{tab0_mdlTitle}</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
														</div>
														<div class="modal-body">
														</div>
														<div class="modal-footer text-end">
															<button type="button" class="btn btn-primary" data-bs-dismiss="modal">
																<i class="mdi mdi-close"></i>
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="requestProcure" role="tabpanel" tabindex="-1">
											<h5>{tab_title1}</h5>
											<hr class="separator" />
											<div class="slided">
												<select class="form-control" id="opt_fapExist" data-toggle="slided">
													<option value="" disabled selected>---- {tab1_dsbopt0} ----</option>
													<option value="#procureNew">{procure_new}</option>
													<option value="#procureExist">{procure_exist}</option>
												</select>
												<div id="procureNew" class="slide-item">
													<form method="post" enctype="multipart/form-data" autocomplete="off">
        												<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
        												<input type="hidden" name="request-type" value="faprocuren|new" />
        												<input type="hidden" name="atom" value="" />
            											<hr class="separator" />
            											<div class="control-section">
    														<h6>{tab1_formtitle0}</h6>
    														<div>
    															<button type="button" class="btn btn-link btn-sm" data-action="clone" data-action-target="#fap_formNew">
    																<span class="mdi mdi-plus-circle"></span>
    															</button>
    															<button type="button" class="btn btn-link btn-sm" data-action="clone-remove" data-action-target="#fap_formNew">
    																<span class="mdi mdi-minus-circle"></span>
    															</button>
    														</div>
            											</div>
            											<hr class="separator" />
            											<div class="row">
            												<div class="col-md-4">
                    											<div class="form-group">
                    												<label for="input-faplocopt">{tab1_label0}:</label>
                    												<select name="input-faplocopt" class="form-control" data-load-ajax="locations" required>
        																<option value="" disabled selected>---- {tab1_dsbopt1} ----</option>
                    												</select>
                    											</div>
                    										</div>
            												<div class="col-md-4">
                												<div class="form-group">
                													<label for="input-fapdocdate">{tab1_label1}:</label>
                													<input type="text" class="form-control" name="input-fapdocdate" data-reset="false" value="{now}" readonly required />
                												</div>
            												</div>
            												<div class="col-md-4">
                												<div class="form-group">
                													<label for="input-fapapplicant">{tab1_label2}:</label>
                													<input type="text" class="form-control" name="input-fapapplicant" data-reset="false" value="[{username}] {fullname}" title="{username}" readonly required />
                												</div>
            												</div>
            											</div>
            											<div class="clone-container">
                											<div id="fap_formNew" class="row">
                												<div class="col-md-8">
                													<div class="form-group">
                														<label for="input-fapname">{tab1_label3}:</label>
                														<input type="text" class="form-control" name="input-fapname[]" placeholder="PC Desktop" required />
                													</div>
                													<div class="form-group">
                														<label for="input-fapdscript">{tab1_label4}:</label>
                														<textarea class="form-control" name="input-fapdscript[]" rows="3" required></textarea>
                													</div>
                													<div class="form-group">
                														<label for="input-fapvalue">{tab1_label5}:</label>
                														<input type="number" class="form-control" name="input-fapvalue[]" placeholder="500.000" required />
                													</div>
                													<div class="form-group">
                														<label for="input-fapqty">{tab1_label6}:</label>
                														<input type="number" class="form-control" name="input-fapqty[]" placeholder="5" required />
                													</div>
                													<div class="form-group">
                														<label for="input-fapremark">{tab1_label7}:</label>
                														<input type="text" class="form-control" name="input-fapremark[]" required />
                													</div>
                												</div>
                												<div class="col-md-4">
                													<div class="form-image">
                														<label for="input-fapimage">{tab1_label8}:</label>
                														<input type="file" name="input-fapimage[0][]" id="pickMe" accept="image/png,image/jpeg" multiple required />
                														<button type="button" class="btn btn-primary btn-block" data-action="pick-image" data-action-target="#pickMe">
                															<span class="mdi mdi-upload-multiple">{tab1_text0}</span>
                														</button>
                														<button type="button" class="btn btn-primary btn-block" data-action="pick-clear" data-action-target="#pickMe">
                															<span class="mdi mdi-close">{tab1_text1}</span>
                														</button>
                														<hr class="separator" />
                														<div id="pickMeCarousel-0" class="form-image-container carousel slide">
                															<div class="carousel-inner">
                															</div>
                                                                            <button class="carousel-control-prev" type="button" data-bs-target="#pickMeCarousel-0" data-bs-slide="prev">
                                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                                <span class="visually-hidden">Previous</span>
                                                                            </button>
                                                                            <button class="carousel-control-next" type="button" data-bs-target="#pickMeCarousel-0" data-bs-slide="next">
                                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                                <span class="visually-hidden">Next</span>
                                                                            </button>
                														</div>
                													</div>
                												</div>
            													<hr class="separator" />
                											</div>
                										</div>
            											<div class="text-end">
            												<button type="submit" class="btn btn-primary">
            													<i class="mdi mdi-content-save"></i>
            												</button>
            												<button type="reset" class="btn btn-primary" data-action="clone-reset" data-action-target="#fap_formNew">
            													<i class="mdi mdi-refresh"></i>
            												</button>
            											</div>
													</form>
												</div>
												<div id="procureExist" class="slide-item">
													<form method="post" autocomplete="off">
        												<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
        												<input type="hidden" name="request-type" value="faprocurex|new" />
        												<input type="hidden" name="atom" value="" />
            											<hr class="separator" />
														<h6>{tab1_formtitle1}</h6>
            											<div class="row">
            												<div class="col-md-4">
                    											<div class="form-group">
                    												<label for="input-faplocopt">{tab1_label0}:</label>
                    												<select name="input-faplocopt" id="fapxlocopt" class="form-control" data-load-ajax="locations" data-action="sub-updater" data-action-message="{pick_error}" data-action-text="{pick_message0}" required>
        																<option value="" disabled selected>---- {tab1_dsbopt1} ----</option>
                    												</select>
                    											</div>
                    										</div>
            												<div class="col-md-4">
                												<div class="form-group">
                													<label for="input-fapdocdate">{tab1_label1}:</label>
                													<input type="text" class="form-control" name="input-fapdocdate" value="{now}" readonly required />
                												</div>
            												</div>
            												<div class="col-md-4">
                												<div class="form-group">
                													<label for="input-fapapplicant">{tab1_label2}:</label>
                													<input type="text" class="form-control" name="input-fapapplicant" value="[{username}] {fullname}" title="{username}" readonly required />
                												</div>
            												</div>
            											</div>
        												<div class="form-group">
        													<div class="input-group">
            													<input type="text" class="form-control" id="assetSearch" placeholder="{tab1_pholder0} ...">
            													<button type="button" id="fapxAddAsset" class="btn btn-outline-primary" title="{tab1_popup0}" data-action="asset-pick" data-action-source="#fapxlocopt" data-action-toggle="modal" data-action-target="#modal_fapAssetSelect">
            														<span class="mdi mdi-plus-circle"></span>
            													</button>
        													</div>
        												</div>
        												<table id="tableProcureExist" class="table table-hover table-striped table-centered table-100" data-table="true" data-servertable="false" data-paging="false" data-searching="false" data-ordering="false" data-info="false" data-tableform="true" role="grid">
        													<thead>
        														<tr>
        															<th>#</th>
        															<th>{tab1_th0}</th>
        															<th>{tab1_th1}</th>
        															<th>{tab1_th2}</th>
        															<th>{tab1_th3}</th>
        															<th>{tab1_th4}</th>
        															<th><i class="mdi mdi-close-circle"></i></th>
        														</tr>
        													</thead>
        												</table>
            											<hr class="separator" />
            											<div class="text-end">
            												<button type="submit" class="btn btn-primary">
            													<i class="mdi mdi-content-save"></i>
            												</button>
            												<button type="reset" class="btn btn-primary">
            													<i class="mdi mdi-refresh"></i>
            												</button>
            											</div>
													</form>
												</div>
											</div>
											<div id="modal_fapAssetSelect" class="modal fade" tabindex="-1" role="dialog" data-bs-keyboard="false" data-bs-background="static">
												<div class="modal-dialog modal-xl">
													<div class="modal-content">
														<div class="modal-header">
															<h5>{tab1_mdlTitle}</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
														</div>
														<div class="modal-body">
															<table id="table_faProcureOpt" role="button" class="table table-hover table-striped table-centered" data-table="true" data-sub="asset-picks" data-sub-target="" role="grid" data-action="pick-asset" data-action-target="#tableProcureExist">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>{tab1_mdl_th0}</th>
																		<th>{tab1_mdl_th1}</th>
																		<th>{tab1_mdl_th2}</th>
																	</tr>
																</thead>
															</table>
														</div>
														<div class="modal-footer text-end">
															<button type="button" class="btn btn-primary" data-bs-dismiss="modal">
																<i class="mdi mdi-close"></i>
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="requestTransfer" role="tabpanel" tabindex="-1">
											<h5>{tab_title2}</h5>
											<hr class="separator" />
											<form method="post" autocomplete="off">
												<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
												<input type="hidden" name="request-type" value="fatransfer|new" />
												<input type="hidden" name="atom" value="" />
												<hr class="separator" />
												<div class="row">
													<div class="col-md-4">
        												<div class="form-group">
        													<label for="input-fatdocnum">{tab2_label0}:</label>
        													<div class="input-group">
        														<input type="text" class="form-control" name="input-fatdocnum" />
            													<button type="button" id="fatDocSearch" class="btn btn-outline-primary" title="{tab2_popup0}">
            														<span class="mdi mdi-magnify"></span>
            													</button>
        													</div>
        												</div>
        												<div class="form-group">
        													<label for="input-fatdocdate">{tab2_label1}:</label>
        													<input type="text" class="form-control" name="input-fatdocdate" value="{now}" readonly />
        												</div>
													</div>
													<div class="col-md-8">
														<div class="form-group">
        													<label for="input-fatapplicant">{tab2_label2}:</label>
        													<input type="hidden" name="input-fatapplicant" />
        													<input type="text" class="form-control" id="transferApplicant" value="[{username}] {fullname}" title="{username}" readonly />
														</div>
														<div class="form-group">
        													<label for="input-fatlocori">{tab2_label3}:</label>
        													<select class="form-control" id="fatorilocopt" name="input-fatlocori" data-load-ajax="locations" data-load-subajax="sublocations" data-subajax-target="#select_fatAsset" data-action="sub-updater" data-action-target="#table_faTransferOpt" data-action-message="{pick_error}" data-action-text="{pick_message1}" required>
        														<option value="" disabled selected>---- {tab2_dsbopt0} ----</option>
        													</select>
														</div>
														<div class="form-group">
        													<label for="input-fatlocdest">{tab2_label4}:</label>
        													<select class="form-control" name="input-fatlocdest" data-load-ajax="user-locations" required>
        														<option value="" disabled selected>---- {tab2_dsbopt1} ----</option>
        													</select>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="input-fatremark">{tab2_label5}:</label>
													<input type="text" class="form-control" name="input-fatremark" />
												</div>
												<hr class="separator" />
												<div class="form-group">
													<div class="input-group">
    													<input type="text" class="form-control" id="assetSearch" placeholder="{tab2_pholder0} ...">
    													<button type="button" id="fatAddAsset" class="btn btn-outline-primary" title="{tab2_popup0}" data-action="asset-pick" data-action-source="#fatorilocopt" data-action-toggle="modal" data-action-target="#modal_fatAssetSelect">
    														<span class="mdi mdi-plus-circle"></span>
    													</button>
													</div>
												</div>
												<table id="tableTransferRequest" class="table table-hover table-striped table-centered table-100" data-table="true" data-servertable="false" data-paging="false" data-searching="false" data-ordering="false" data-info="false" data-tableform="true" role="grid">
													<thead>
														<tr>
															<th>#</th>
															<th>{tab2_th0}</th>
															<th>{tab2_th1}</th>
															<th>{tab2_th2}</th>
															<th>{tab2_th3}</th>
															<th><i class="mdi mdi-close-circle"></i></th>
														</tr>
													</thead>
												</table>
												<hr class="separator" />
												<div class="text-end">
													<button type="submit" class="btn btn-primary">
														<i class="mdi mdi-content-save"></i>
													</button>
													<button type="reset" class="btn btn-primary">
														<i class="mdi mdi-refresh"></i>
													</button>
												</div>
											</form>
											<div id="modal_fatAssetSelect" class="modal fade" role="dialog" tabindex="-1" data-bs-keyboard="false" data-bs-background="static">
												<div class="modal-dialog modal-xl">
													<div class="modal-content">
														<div class="modal-header">
															<h5>{tab2_mdlTitle}</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
														</div>
														<div class="modal-body">
															<div class="form-group">
																<select id="select_fatAsset" class="form-control" data-action="do-filter" data-action-target="#table_faTransferOpt">
																	<option value="" selected>---- {tab2_dsbopt2} ----</option>
																</select> 
															</div>
															<hr class="separator" />
															<table id="table_faTransferOpt" role="button" class="table table-hover table-striped table-centered" data-table="true" data-sub="asset-picks" data-sub-target="" data-sub-type="sublocations" data-sub-filter="" role="grid" data-action="pick-asset" data-action-target="#tableTransferRequest">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>{tab2_mdl_th0}</th>
																		<th>{tab2_mdl_th1}</th>
																		<th>{tab2_mdl_th2}</th>
																		<th>{tab2_mdl_th3}</th>
																	</tr>
																</thead>
															</table>
														</div>
														<div class="modal-footer text-end">
															<button type="button" class="btn btn-primary" data-bs-dismiss="modal">
																<i class="mdi mdi-close"></i>
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="requestRemoval" role="tabpanel" tabindex="-1">
											<h5>{tab_title3}</h5>
											<hr class="separator" />
											<form method="post">
												<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
												<input type="hidden" name="request-type" value="faremoval|new" />
												<input type="hidden" name="atom" value="" />
												<hr class="separator" />
    											<div class="row">
    												<div class="col-md-4">
            											<div class="form-group">
            												<label for="input-farlocopt">{tab3_label0}:</label>
            												<select name="input-farlocopt" id="farsrclocopt" class="form-control" data-load-ajax="locations" data-action="sub-updater" data-action-target="#table_faRemovalOpt" data-action-message="{pick_error}" data-action-text="{pick_message0}" required>
																<option value="" disabled selected>---- {tab3_dsbopt0} ----</option>
            												</select>
            											</div>
            										</div>
    												<div class="col-md-4">
        												<div class="form-group">
        													<label for="input-fapdocdate">{tab3_label1}:</label>
        													<input type="text" class="form-control" name="input-fapdocdate" value="{now}" readonly required />
        												</div>
    												</div>
    												<div class="col-md-4">
        												<div class="form-group">
        													<label for="input-fapapplicant">{tab3_label2}:</label>
        													<input type="text" class="form-control" name="input-fapapplicant" value="[{username}] {fullname}" title="{username}" readonly required />
        												</div>
    												</div>
    											</div>
												<div class="form-group">
													<div class="input-group">
    													<input type="text" class="form-control" id="assetSearch" placeholder="{tab3_pholder0} ...">
    													<button type="button" id="farAddAsset" class="btn btn-outline-primary" title="{tab3_popup0}" data-action="asset-pick" data-action-source="#farsrclocopt" data-action-toggle="modal" data-action-target="#modal_farAssetSelect">
    														<span class="mdi mdi-plus-circle"></span>
    													</button>
													</div>
												</div>
												<table id="tableRemovalRequest" class="table table-hover table-striped table-centered table-100" data-table="true" data-servertable="false" data-paging="false" data-searching="false" data-ordering="false" data-info="false" data-tableform="true" role="grid">
													<thead>
														<tr>
															<th>#</th>
															<th>{tab3_th0}</th>
															<th>{tab3_th1}</th>
															<th>{tab3_th2}</th>
															<th>{tab3_th3}</th>
															<th><i class="mdi mdi-close-circle"></i></th>
														</tr>
													</thead>
												</table>
												<hr class="separator" />
												<div class="text-end">
													<button type="submit" class="btn btn-primary">
														<i class="mdi mdi-content-save"></i>
													</button>
													<button type="reset" class="btn btn-primary">
														<i class="mdi mdi-refresh"></i>
													</button>
												</div>
											</form>
											<div id="modal_farAssetSelect" class="modal fade" tabindex="-1" role="dialog" data-bs-keyboard="false" data-bs-background="static">
												<div class="modal-dialog modal-xl">
													<div class="modal-content">
														<div class="modal-header">
															<h5>{tab3_mdlTitle}</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
														</div>
														<div class="modal-body">
															<table id="table_faRemovalOpt" role="button" class="table table-hover table-striped table-centered" data-table="true" data-sub="asset-picks" data-sub-target="" data-action="pick-asset" data-action-target="#tableRemovalRequest">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>{tab3_mdl_th0}</th>
																		<th>{tab3_mdl_th1}</th>
																		<th>{tab3_mdl_th2}</th>
																		<th>{tab3_mdl_th3}</th>
																	</tr>
																</thead>
															</table>
														</div>
														<div class="modal-footer text-end">
															<button type="button" class="btn btn-primary" data-bs-dismiss="modal">
																<i class="mdi mdi-close"></i>
															</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>{/dash_assetrqst_texts} {/commons}
