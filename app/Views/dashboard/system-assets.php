					{commons} {dash_fixedasset_texts}
					<div class="card">
						<div class="card">
							<div class="card-body">
								<div class="border-bottom border-grayl mb-3 py-2">
									<div class="d-flex align-items-center justify-content-between">
										<h3 class="card-title mb-0">{asset_title}</h3>
										<div class="card-control">
											<a role="button" data-action="open-dialog" data-action-target="#modalAssetForm">
												<i class="mdi mdi-plus"></i>
											</a>
											<a role="button" href="#tableAssets" data-action="reload-table" title="{btn_reload}">
												<i class="mdi mdi-reload"></i>
											</a>
										</div>
									</div>
								</div>
								<table id="tableAssets" class="table table-hover table-striped table-centered table-100" role="button" data-table="true">
									<thead>
										<tr>
											<th>#</th>
											<th>{th_fasset0}</th>
											<th>{th_fasset1}</th>
											<th>{th_fasset2}</th>
											<th>{th_fasset3}</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal fade" id="modalAssetForm" role="dialog" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" data-action-privilege="{canAddAsset}">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">{mdl_fasset_form_title}</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<form method="post">
									<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
									<input type="hidden" name="request-type" value="master-asset|new" />
									<input type="hidden" name="atom" value="" />
    								<div class="modal-body">
    									<div class="row">
    										<div class="col-sm-8">
    											<div class="row">
    												<div class="col-sm-6">
                										<div class="form-group">
                											<label for="input-optlocation">{fasset_label0}:</label>
                											<select id="optLocation" class="form-control" name="input-optlocation" data-loadtarget="falocation" data-load-ajax="locations" data-load-subajax="sublocations" data-subajax-target="#optSubloc" required>
                												<option value="" disabled selected>----- {fasset_dopttext0} -----</option>
                											</select>
                										</div>
    												</div>
    												<div class="col-sm-6">
                										<div class="form-group">
                											<label for="input-optsubloc">{fasset_label1}:</label>
                											<select id="optSubloc" class="form-control" name="input-optsubloc" data-loadtarget="fasubloc" required>
                												<option value="" disabled selected>----- {fasset_dopttext1} -----</option>
                											</select>
                										</div>
    												</div>
    											</div>
        										<div class="form-group">
        											<label for="input-optfacategory">{fasset_label2}:</label>
        											<select id="optConfigItem" class="form-control" name="input-optfacategory" data-loadtarget="faconfig" data-load-ajax="config" data-load-subajax="ciattributes" data-subajax-target="#fassetAttrs" required>
        												<option value="" disabled selected>----- {fasset_dopttext2} -----</option>
        											</select>
        										</div>
												<div class="form-group">
													<label for="input-newfacode">{fasset_label3}:</label>
													<input type="text" class="form-control" name="input-newfacode" data-readonlyonedit="true" required />
												</div>
												<div class="form-group">
													<label for="input-newfadscript">{fasset_label4}:</label>
													<input class="form-control" name="input-newfadscript" required />
												</div>
        										<div class="row">
        											<div class="col-sm-6">
        												<div class="form-group">
        													<label for="input-newfaacqdate">{fasset_label5}:</label>
        													<div class="input-group date datepicker">
	        													<input type="text" class="form-control" name="input-newfaacqdate" readonly required />
	        													<span class="input-group-addon input-group-append border-left">
	        														<span class="mdi mdi-calendar input-group-text"></span>
	        													</span>
        													</div>
        												</div>
        											</div>
        											<div class="col-sm-6">
        												<div class="form-group">
        													<label for="input-newfaacqcost">{fasset_label6}:</label>
        													<input class="form-control" name="input-newfaacqcost" value="0" placeholder="0" required />
        												</div>
        											</div>
        										</div>
												<div class="row">
													<div class="col-sm-6">
        												<div class="form-group">
        													<label for="input-newfaqty">{fasset_label7}:</label>
        													<input type="number" class="form-control" name="input-newfaqty" value="1" placeholder="1" required/>
        												</div>
													</div>
													<div class="col-sm-6">
        												<div class="form-group">
        													<label for="input-newfalifespane">{fasset_label8}:</label>
        													<input class="form-control" name="input-newfalifespane" value="5" placeholder="5" required />
        												</div>
													</div>
												</div>
												<div class="form-group">
													<label for="input-newfaremark">{fasset_label9}:</label>
													<textarea class="form-control" name="input-newfaremark" rows="3"></textarea>
												</div>
    										</div>
    										<div id="fassetAttrs" class="col-sm-4 border-left" style="overflow-y: auto">
    										</div>
    									</div>
    								</div>
    								<div class="modal-footer align-items-end">
    									<button type="submit" class="btn btn-primary">
    										<i class="mdi mdi-content-save"></i>
    									</button>
    									<button type="button" class="btn btn-primary" data-bs-dismiss="modal">
    										<i class="mdi mdi-close"></i>
    									</button>
    								</div>
    							</form>
							</div>
						</div>
					</div>
					<div class="modal fade" id="modalDetail" role="dialog" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
						<div class="modal-dialog modal-xxl">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">{mdl_fasset_details}</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-md-8">
        									<div class="control-section">
        										<h5>{subtitle0}</h5>
        										<div>
        											<a role="button" href="#editAssetDesc" data-action="open-editdialog" data-action-target="#editAssetDesc" data-bs-toggle="collapse" aria-expanded="false" aria-controls="editAssetDesc">
        												<span class="mdi mdi-file-edit"></span>
        											</a>
        										</div>
        									</div>
        									<table id="tableLocationDetails" class="table table-hover table-striped" data-details="true">
        										<tbody>
        											<tr>
        												<td width="30%">{fasset_label3}</td>
        												<td width="1%">:</td>
        												<td data-loadtarget="serial" data-loadsource="serial"></td>
        											</tr>
        											<tr>
        												<td>{fasset_label2}</td>
        												<td>:</td>
        												<td data-loadtarget="config" data-loadtarget="config"></td>
        											</tr>
        											<tr>
        												<td>{fasset_label4}</td>
        												<td>:</td>
        												<td data-loadtarget="dscript"></td>
        											</tr>
        											<tr>
        												<td>{fasset_label7}</td>
        												<td>:</td>
        												<td data-loadtarget="asset_total"></td>
        											</tr>
        										</tbody>
        									</table>
        									<div id="editAssetDesc" class="collapse mt-3">
        										<form method="post">
                									<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
                									<input type="hidden" name="request-type" value="master-asset|edit" />
                									<input type="hidden" name="atom" value="" />
                									<div class="row">
                										<div class="col-sm-12">
                											<div class="form-group">
                												<label>{fasset_label4}:</label>
                												<input type="text" class="form-control" data-loadtarget="dscript" required />
                											</div>
                										</div>
                									</div>
                									<hr class="separator" />
                									<div class="text-end">
                										<button type="submit" class="btn btn-sm btn-primary">
                											<span class="mdi mdi-content-save"></span>
                										</button>
                										<button type="reset" class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#editAssetDesc" aria-expanded="true" aria-controls="editAssetDesc">
                											<span class="mdi mdi-close"></span>
                										</button>
                									</div>
        										</form>
        									</div>
        									<hr class="separator" />
        									<div id="detailNav">
        										<ul class="nav nav-tabs nav-justified">
        											<li class="nav-item">
        												<a class="nav-link active" href="#fassetLocation" data-bs-toggle="tab" aria-selected="true" tabindex="-1" role="tab">
        													{fasset_tab0}
        												</a>
        											</li>
        											<li class="nav-item">
        												<a class="nav-link" href="#fassetProcureHistory" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">
        													{fasset_tab1}
        												</a>
        											</li>
        											<li class="nav-item">
        												<a class="nav-link" href="#fassetRemovalHistory" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">
        													{fasset_tab2}
        												</a>
        											</li>
        											<li class="nav-item">
        												<a class="nav-link" href="#fassetMovements" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">
        													{fasset_tab3}
        												</a>
        											</li>
        										</ul>
        										<div class="tab-content">
        											<div id="fassetLocation" class="tab-pane fade active show" role="tabpanel">
        												<div class="control-section">
        													<h5 class="modal-title">{fasset_tab_title0}</h5>
        													<div>
                        										<a role="button" href="#tableAssetAllocation" data-action="reload-table" title="{btn_reload}">
                        											<i class="mdi mdi-reload"></i>
                        										</a>
        													</div>
        												</div>
        												<hr class="separator" />
        												<table id="tableAssetAllocation" class="table table-striped table-hover table-centered w-100" data-table="true" data-sub="asset-map" data-sub-target="">
        													<thead>
        														<tr>
        															<th>#</th>
        															<th>{fadetail0_thead0}</th>
        															<th>{fadetail0_thead1}</th>
        															<th>{fadetail0_thead2}</th>
        														</tr>
        													</thead>
        													<tbody>
        													</tbody>
        												</table>
        											</div>
        											<div id="fassetProcureHistory" class="tab-pane fade" role="tabpanel">
        												<div class="control-section">
        													<h5 class="modal-title">{fasset_tab_title1}</h5>
        													<div>
                        										<a role="button" href="#tableAssetPorcureHistory" data-action="reload-table" title="{btn_reload}">
                        											<i class="mdi mdi-reload"></i>
                        										</a>
        													</div>
        												</div>
        												<hr class="separator" />
        												<table id="tableAssetPorcureHistory" class="table table-striped table-hover table-centered w-100" data-table="true" data-sub="" data-sub-target="">
        													<thead>
        														<tr>
        															<th>#</th>
        															<th>{fadetail1_thead0}</th>
        															<th>{fadetail1_thead1}</th>
        															<th>{fadetail1_thead2}</th>
        														</tr>
        													</thead>
        													<tbody>
        													</tbody>
        												</table>
        											</div>
        											<div id="fassetRemovalHistory" class="tab-pane fade" role="tabpanel">
        												<div class="control-section">
        													<h5 class="modal-title">{fasset_tab_title2}</h5>
        													<div>
                        										<a role="button" href="#tableAssetRemoveHistory" data-action="reload-table" title="{btn_reload}">
                        											<i class="mdi mdi-reload"></i>
                        										</a>
        													</div>
        												</div>
        												<hr class="separator" />
        												<table id="tableAssetRemoveHistory" class="table table-striped table-hover table-centered w-100" data-table="true" data-sub="" data-sub-target="">
        													<thead>
        													</thead>
        													<tbody>
        													</tbody>
        												</table>
        											</div>
        											<div id="fassetMovements" class="tab-pane fade" role="tabpanel">
        												<div class="control-section">
        													<h5 class="modal-title">{fasset_tab_title3}</h5>
        													<div>
                        										<a role="button" href="#tableAssetMovementHistory" data-action="reload-table" title="{btn_reload}">
                        											<i class="mdi mdi-reload"></i>
                        										</a>
        													</div>
        												</div>
        												<hr class="separator" />
        												<table id="tableAssetMovementHistory" class="table table-striped table-hover table-centered w-100" data-table="true" data-sub="" data-sub-target="">
        													<thead>
        													</thead>
        													<tbody>
        													</tbody>
        												</table>
        											</div>
        										</div>
        									</div>
										</div>
										<div class="col-md-4">
											<div class="control-section">
												<h5>{subtitle1}</h5>
											</div>
											<div role="button" id="assetPictures" class="pict-preview mb-2" data-pick-target="#assetImages">
											</div>
											<form method="post" enctype="multipart/form-data">
            									<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
            									<input type="hidden" name="request-type" value="asset-images|new" />
            									<input type="hidden" name="atom" value="" />
            									<input id="assetImages" type="file" class="d-hidden" name="asset-images" accept="image/jpeg,image/jpg,image/png,image/webp" multiple required />
            									<button type="button" class="btn btn-primary btn-block">
            										<span class="mdi mdi-upload"></span>&nbsp;<span>{btn_upload}</span>
            									</button>
            									<button type="reset" class="btn btn-primary btn-block">
            										<span class="mdi mdi-reload"></span>&nbsp;<span>{btn_reload}</span>
            									</button>
											</form>
										</div>
									</div>
								</div>
								<div class="modal-footer text-end">
									<button type="button" class="btn btn-primary" data-bs-dismiss="modal">
										<i class="mdi mdi-close"></i>
									</button>
								</div>
							</div>
						</div>
					</div>{/dash_fixedasset_texts} {/commons}
