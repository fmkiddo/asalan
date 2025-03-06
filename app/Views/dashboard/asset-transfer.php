					{commons} {dash_assettransf_texts}
					<div class="card">
						<div class="card">
							<div class="card-body">
								<div class="control-section">
									<h4 class="card-title">{title0}</h4>
									<div class="card-control">
										<a role="button" data-action="fade" data-fade-target="#fadeTransferRequest" href="#fatransfer-form">
											<span class="mdi mdi-plus"></span>
										</a>
										<a role="button" href="#tableFATransfer" data-action="reload-table" title="{tooltip0}">
											<span class="mdi mdi-refresh"></span>
										</a>
									</div>
								</div>
								<hr class="separator" />
								<div id="fadeTransferRequest" class="faded">
									<div id="fatransfer-table" class="scrollable">
										<div class="row">
											<div class="col-4">
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
											<div class="col-4">
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
											<div class="col-4">
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
										</div>
										<hr class="separator" />
										<table id="tableFATransfer" class="table table-striped table-hover table-centered" role="button" data-table="true" data-page-length="50">
											<thead>
												<tr>
													<th>#</th>
													<th>{th0}</th>
													<th>{th1}</th>
													<th>{th2}</th>
													<th>{th3}</th>
													<th>{th4}</th>
													<th>{th5}</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
										<div id="modalDetail" class="modal fade" role="dialog" tabindex="-1" data-bs-keyboard="false" data-bs-background="static">
											<div class="modal-dialog modal-xl">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">{mdlTitle0}</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
													</div>
													<form method="post">
														<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
														<input type="hidden" name="request-type" value="fatransfer|edit" />
														<input type="hidden" name="atom" value="" />
    													<div class="modal-body">
    													
    													</div>
    													<div class="modal-footer">
    														<div class="text-end">
    															<button type="button" class="btn btn-primary" data-bs-dismiss="modal">
    																<span class="mdi mdi-close"></span>
    															</button>
    														</div>
    													</div>
													</form>
												</div>
											</div>
										</div>
									</div>
									<div id="fatransfer-form">
										<form method="post" data-alert="" data-alerttitle="">
											<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
											<input type="hidden" name="request-type" value="fatransfer|new" />
											<input type="hidden" name="atom" value="" />
											<hr class="separator" />
											<div class="row">
												<div class="col-md-4">
    												<div class="form-group">
    													<label for="input-fatdocnum">{label0}:</label>
    													<div class="input-group">
    														<input type="text" class="form-control" name="input-fatdocnum" value="[AUTO]" data-reset="false" />
        													<button type="button" id="fatDocSearch" class="btn btn-outline-primary" title="{tab2_popup0}">
        														<span class="mdi mdi-magnify"></span>
        													</button>
    													</div>
    												</div>
    												<div class="form-group">
    													<label for="input-fatdocdate">{label1}:</label>
    													<input type="text" class="form-control" name="input-fatdocdate" value="{now}" data-reset="false" readonly />
    												</div>
												</div>
												<div class="col-md-8">
													<div class="form-group">
    													<label for="input-fatapplicant">{label2}:</label>
    													<input type="hidden" name="input-fatapplicant" value="{supplicant}" />
    													<input type="text" class="form-control" id="transferApplicant" value="[{username}] {fullname}" title="{username}" data-reset="false" readonly />
													</div>
													<div class="form-group">
    													<label for="input-fatlocori">{label3}:</label>
    													<select id="locationSource" class="form-control" name="input-fatlocori" data-loadsource="location" data-load-ajax="user-locations" data-load-subajax="sublocations" data-subajax-target="#select_fatAsset" data-action="sub-updater" data-action-target="#table_fatAssetOpt" data-action-message="{pick_error}" data-action-text="{pick_message1}" required>
    														<option value="" disabled selected>---- {dsbopt0} ----</option>
    													</select>
													</div>
													<div class="form-group">
    													<label for="input-fatlocdest">{label4}:</label>
    													<select class="form-control" name="input-fatlocdest" data-load-ajax="locations" required>
    														<option value="" disabled selected>---- {dsbopt1} ----</option>
    													</select>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="input-fatremark">{label5}:</label>
												<input type="text" class="form-control" name="input-fatremark" />
											</div>
											<hr class="separator" />
											<div class="form-group">
												<div class="input-group">
													<input type="text" class="form-control" id="assetSearch" placeholder="{pholder0} ...">
													<button type="button" id="fatAddAsset" class="btn btn-outline-primary" title="{popup1}" data-action="asset-pick" data-action-source="#locationSource" data-action-toggle="modal" data-action-target="#modal_faTransferSelect">
														<span class="mdi mdi-plus-circle"></span>
													</button>
												</div>
											</div>
											<table id="tableAssetTransfer" class="table table-hover table-striped table-centered table-100" data-table="true" data-servertable="false" data-paging="false" data-searching="false" data-ordering="false" role="grid">
												<thead>
													<tr>
														<th>#</th>
														<th>{form_th0}</th>
														<th>{form_th1}</th>
														<th>{form_th2}</th>
														<th>{form_th3}</th>
														<th><i class="mdi mdi-close-circle"></i></th>
													</tr>
												</thead>
											</table>
											<hr class="separator" />
											<div class="text-end">
												<button type="submit" class="btn btn-primary">
													<span class="mdi mdi-content-save"></span>
												</button>
												<button type="reset" class="btn btn-primary" data-action="fade" data-fade-target="#fadeTransferRequest" data-action-target="#fatransfer-table">
													<span class="mdi mdi-close"></span>
												</button>
											</div>
										</form>
									</div>
								</div>
								<div id="modal_faTransferSelect" class="modal fade" role="dialog" tabindex="-1" data-bs-keyboard="false" data-bs-background="static">
									<div class="modal-dialog modal-xl">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">{mdlTitle1} <span data-loadtarget="location"></span></h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
											</div>
											<div class="modal-body">
												<div class="form-group">
													<select id="select_fatAsset" class="form-control" data-action="do-filter" data-action-target="#table_fatAssetOpt">
														<option value="" selected>---- {dsbopt2} ----</option>
													</select> 
												</div>
												<hr class="separator" />
												<table id="table_fatAssetOpt" class="table table-hover table-striped table-centered" role="button" data-table="true" data-sub="asset-picks" data-sub-target="" data-sub-type="sublocations" data-sub-filter="" data-ordering="false" data-action="pick-asset" data-action-target="#tableAssetTransfer">
													<thead>
														<tr>
															<th>#</th>
															<th>{mdl_th0}</th>
															<th>{mdl_th1}</th>
															<th>{mdl_th2}</th>
															<th>{mdl_th3}</th>
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
								<div id="modalDetail" class="modal fade" tabindex="-1" role="dialog" data-bs-keyboard="false" data-bs-background="static">
									<div class="modal-dialog modal-xl">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">{mdlTitle2} <span data-loadtarget="location"></span></h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
											</div>
											<div class="modal-body">
											</div>
											<div class="modal-footer">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>{/dash_assettransf_texts} {/commons}
