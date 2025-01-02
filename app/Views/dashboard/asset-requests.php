					{commons} {dash_assetrqst_texts}
					<div class="card">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">{title0}</h5>
								<hr class="separator" />
								<div id="requestSection">
									<ul class="nav nav-tabs nav-justified">
										<li class="nav-item">
											<a class="nav-link active" href="#requestSummary" role="tab" data-bs-toggle="tab" tabindex="-1" aria-selected="true">{tab_button0}</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#requestProcure" role="tab" data-bs-toggle="tab" tabindex="-1" aria-selected="false">{tab_button1}</a>
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
											<table id="tableRequestProcure" class="table table-hover table-striped table-centered" data-table="true">
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
        												<input type="hidden" name="request-type" value="transfer|new" />
        												<input type="hidden" name="atom" value="" />
            											<hr class="separator" />
            											<div class="control-section">
    														<h6>{tab1_formtitle0}</h6>
    														<div>
    															<button type="button" class="btn btn-link btn-sm" data-clone-form="true" data-target="#fap_formNew">
    																<span class="mdi mdi-plus-circle"></span>
    															</button>
    															<button type="button" class="btn btn-link btn-sm" data-remove-form="true">
    																<span class="mdi mdi-minus-circle"></span>
    															</button>
    														</div>
            											</div>
            											<hr class="separator" />
            											<div class="row">
            												<div class="col-md-4">
                    											<div class="form-group">
                    												<label for="input-faplocopt">{tab1_label0}:</label>
                    												<select name="input-faplocopt" class="form-control" required>
        																<option value="" disabled selected>---- {tab1_dsbopt1} ----</option>
                    												</select>
                    											</div>
                    										</div>
            												<div class="col-md-4">
                												<div class="form-group">
                													<label for="input-fapdocdate">{tab1_label1}:</label>
                													<input type="text" class="form-control" name="input-fapdocdate" readonly required />
                												</div>
            												</div>
            												<div class="col-md-4">
                												<div class="form-group">
                													<label for="input-fapapplicant">{tab1_label2}:</label>
                													<input type="text" class="form-control" name="input-fapapplicant" readonly required />
                												</div>
            												</div>
            											</div>
            											<div class="clone-container">
                											<div id="fap_formNew" class="row">
                												<div class="col-md-8">
                													<div class="form-group">
                														<label for="input-fapname">{tab1_label3}:</label>
                														<input type="text" class="form-control" name="input-fapname[]" required />
                													</div>
                													<div class="form-group">
                														<label for="input-fapdscript">{tab1_label4}:</label>
                														<textarea class="form-control" name="input-fapdscript[]" rows="3" required></textarea>
                													</div>
                													<div class="form-group">
                														<label for="input-fapqty">{tab1_label5}:</label>
                														<input type="number" class="form-control" name="input-fapqty[]" required />
                													</div>
                													<div class="form-group">
                														<label for="input-fapvalue">{tab1_label6}:</label>
                														<input type="number" class="form-control" name="input-fapvalue[]" required />
                													</div>
                													<div class="form-group">
                														<label for="input-fapremark">{tab1_label7}:</label>
                														<input type="text" class="form-control" name="input-fapremark[]" required />
                													</div>
                												</div>
                												<div class="col-md-4">
                													<div class="form-image">
                														<label for="input-fapimage">{tab1_label8}:</label>
                														<input type="file" name="input-fapimage[][]" accept="image/png,image/jpeg" multiple required />
                														<button type="button" class="btn btn-primary btn-block" data-inputclick="image">
                															<span class="mdi mdi-upload-multiple">{tab1_text0}</span>
                														</button>
                														<button type="button" class="btn btn-primary btn-block">
                															<span class="mdi mdi-close">{tab1_text1}</span>
                														</button>
                														<hr class="separator" />
                														<div class="form-image-container">
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
            												<button type="reset" class="btn btn-primary">
            													<i class="mdi mdi-refresh"></i>
            												</button>
            											</div>
													</form>
												</div>
												<div id="procureExist" class="slide-item">
													<form method="post" autocomplete="off">
        												<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
        												<input type="hidden" name="request-type" value="transfer|new" />
        												<input type="hidden" name="atom" value="" />
            											<hr class="separator" />
														<h6>{tab1_formtitle1}</h6>
            											<div class="row">
            												<div class="col-md-4">
                    											<div class="form-group">
                    												<label for="input-faplocopt">{tab1_label0}:</label>
                    												<select name="input-faplocopt" class="form-control" required>
        																<option value="" disabled selected>---- {tab1_dsbopt1} ----</option>
                    												</select>
                    											</div>
                    										</div>
            												<div class="col-md-4">
                												<div class="form-group">
                													<label for="input-fapdocdate">{tab1_label1}:</label>
                													<input type="text" class="form-control" name="input-fapdocdate" readonly required />
                												</div>
            												</div>
            												<div class="col-md-4">
                												<div class="form-group">
                													<label for="input-fapapplicant">{tab1_label2}:</label>
                													<input type="text" class="form-control" name="input-fapapplicant" readonly required />
                												</div>
            												</div>
            											</div>
        												<div class="form-group">
        													<div class="input-group">
            													<input type="text" class="form-control" id="assetSearch" placeholder="{tab2_pholder0} ...">
            													<button type="button" id="fapAddAsset" class="btn btn-outline-primary" title="{tab2_popup1}" data-bs-toggle="modal" data-bs-target="#modal_fapAssetSelect">
            														<span class="mdi mdi-plus-circle"></span>
            													</button>
        													</div>
        												</div>
        												<table id="tableTransfer" class="table table-hover table-striped table-center-head table-100" data-table="true" data-servertable="false" data-paging="false" data-searching="false" role="grid">
        													<thead>
        														<tr>
        															<th>#</th>
        															<th>{tab1_th0}</th>
        															<th>{tab1_th1}</th>
        															<th>{tab1_th2}</th>
        															<th>{tab1_th3}</th>
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
													<div id="modal_fapAssetSelect" class="modal fade" tabindex="-1" role="dialog" data-bs-keyboard="false" data-bs-background="static">
        												<div class="modal-dialog modal-xl">
        													<div class="modal-content">
        														<div class="modal-header">
        															<h5>{tab1_mdlTitle}</h5>
        															<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        														</div>
        														<div class="modal-body">
        															<table id="table_fatAssetOpt" class="table table-hover table-striped table-centered" data-table="true">
        																<thead>
        																	<tr>
        																		<th>#</th>
        																		<th>{tab1_mdl_th0}</th>
        																		<th>{tab1_mdl_th1}</th>
        																		<th>{tab1_mdl_th2}</th>
        																		<th>{tab1_mdl_th3}</th>
        																		<th>{tab1_mdl_th4}</th>
        																	</tr>
        																</thead>
        															</table>
        														</div>
        														<div class="modal-footer text-end">
        															<button type="button" id="add_fatAsset" class="btn btn-primary">
        																<i class="mdi mdi-plus-circle"></i>
        															</button>
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
										<div class="tab-pane fade" id="requestTransfer" role="tabpanel" tabindex="-1">
											<h5>{tab_title2}</h5>
											<hr class="separator" />
											<form method="post" autocomplete="off">
												<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
												<input type="hidden" name="request-type" value="transfer|new" />
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
        													<input type="text" class="form-control" name="input-fatdocdate" readonly />
        												</div>
													</div>
													<div class="col-md-8">
														<div class="form-group">
        													<label for="input-fatapplicant">{tab2_label2}:</label>
        													<input type="hidden" name="input-fatapplicant" />
        													<input type="text" class="form-control" id="transferApplicant" readonly />
														</div>
														<div class="form-group">
        													<label for="input-fatlocori">{tab2_label3}:</label>
        													<select class="form-control" name="input-fatlocori" required>
        														<option value="" disabled selected>---- {tab2_dsbopt0} ----</option>
        													</select>
														</div>
														<div class="form-group">
        													<label for="input-fatlocdest">{tab2_label4}:</label>
        													<select class="form-control" name="input-fatlocdest" required>
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
    													<button type="button" id="fatAddAsset" class="btn btn-outline-primary" title="{tab2_popup1}" data-bs-toggle="modal" data-bs-target="#modal_fatAssetSelect">
    														<span class="mdi mdi-plus-circle"></span>
    													</button>
													</div>
												</div>
												<table id="tableTransfer" class="table table-hover table-striped table-center-head table-100" data-table="true" data-servertable="false" data-paging="false" data-searching="false" role="grid">
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
																<select id="select_fatAsset" class="form-control">
																	<option value="" disabled selected>---- {tab2_dsbopt2} ----</option>
																</select> 
															</div>
															<hr class="separator" />
															<table id="table_fatAssetOpt" class="table table-hover table-striped table-centered" data-table="true">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>{tab2_mdl_th0}</th>
																		<th>{tab2_mdl_th1}</th>
																		<th>{tab2_mdl_th2}</th>
																		<th>{tab2_mdl_th3}</th>
																		<th>{tab2_mdl_th4}</th>
																	</tr>
																</thead>
															</table>
														</div>
														<div class="modal-footer text-end">
															<button type="button" id="add_fatAsset" class="btn btn-primary">
																<i class="mdi mdi-plus-circle"></i>
															</button>
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
												<input type="hidden" name="request-type" value="removal|new" />
												<input type="hidden" name="atom" value="" />
												<hr class="separator" />
    											<div class="row">
    												<div class="col-md-4">
            											<div class="form-group">
            												<label for="input-faplocopt">{tab3_label0}:</label>
            												<select name="input-faplocopt" class="form-control" required>
																<option value="" disabled selected>---- {tab1_dsbopt1} ----</option>
            												</select>
            											</div>
            										</div>
    												<div class="col-md-4">
        												<div class="form-group">
        													<label for="input-fapdocdate">{tab3_label1}:</label>
        													<input type="text" class="form-control" name="input-fapdocdate" readonly required />
        												</div>
    												</div>
    												<div class="col-md-4">
        												<div class="form-group">
        													<label for="input-fapapplicant">{tab3_label2}:</label>
        													<input type="text" class="form-control" name="input-fapapplicant" readonly required />
        												</div>
    												</div>
    											</div>
												<div class="form-group">
													<div class="input-group">
    													<input type="text" class="form-control" id="assetSearch" placeholder="{tab2_pholder0} ...">
    													<button type="button" id="farAddAsset" class="btn btn-outline-primary" title="{tab2_popup1}" data-bs-toggle="modal" data-bs-target="#modal_farAssetSelect">
    														<span class="mdi mdi-plus-circle"></span>
    													</button>
													</div>
												</div>
												<table id="tableRemoval" class="table table-hover table-striped table-center-head table-100" data-table="true" data-servertable="false" data-paging="false" data-searching="false" role="grid">
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
															<table id="table_fatAssetOpt" class="table table-hover table-striped table-centered" data-table="true">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>{tab3_mdl_th0}</th>
																		<th>{tab3_mdl_th1}</th>
																		<th>{tab3_mdl_th2}</th>
																		<th>{tab3_mdl_th3}</th>
																		<th>{tab3_mdl_th4}</th>
																	</tr>
																</thead>
															</table>
														</div>
														<div class="modal-footer text-end">
															<button type="button" id="add_fatAsset" class="btn btn-primary">
																<i class="mdi mdi-plus-circle"></i>
															</button>
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
