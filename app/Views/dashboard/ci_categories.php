					{commons} {dash_configitems_texts}
					<div class="card">
						<div class="card">
							<div class="card-body">
								<div class="cols-to-tabs">
									<ul class="nav nav-tabs nav-justified device-small" role="tablist">
										<li class="nav-item">
											<a class="nav-link" href="#components" data-bs-toggle="tab" role="tab" aria-controls="" aria-selected="true">
												<span>{tab_0}</span>
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link active" href="#assets-ci" data-bs-toggle="tab" role="tab" aria-controls="asset-ci-tab" aria-selected="false">
												<span>{tab_1}</span>
											</a>
										</li>
									</ul>
									<div class="tab-content border-0 row">
										<div id="components" class="tab-pane fade col col-sm-12 col-md-4" role="tabpanel" aria-labelledby="components-tab">
        									<div class="d-flex align-items-center justify-content-between border-bottom border-grayl pb-2 mb-2">
        										<h3 class="card-title mb-0">{components_title}</h3>
        										<div class="card-control">
        											<a role="button" href="#modalCompForm" data-bs-toggle="modal">
        												<i class="mdi mdi-plus"></i>
        											</a>
        											<a role="button" href="#listAttributes" data-action="reload-list" data-action-target="#listAttributes" data-clickonload="true">
        												<i class="mdi mdi-refresh" title=""></i>
    												</a>
    											</div>
        									</div>
        									<ul id="listAttributes" class="component-list" data-load-ajax="attributes">
        										<li class="empty d-none">{empty_list}</li>
        									</ul>
        									<div class="modal fade" id="modalCompForm" role="dialog" tabindex="-1">
        										<div class="modal-dialog">
        											<div class="modal-content">
        												<div class="modal-header">
        													<h3 class="modal-title">{mdl_title_ci0}</h3>
        													<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        												</div>
        												<form method="post">
        													<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
        													<input type="hidden" name="request-type" value="attr|new" />
        													<input type="hidden" name="atom" value="" />
            												<div class="modal-body">
            													<div class="form-group">
            														<label for="input-propname">{ci_label0}:</label>
            														<input type="text" class="form-control" name="input-propname" required />
            													</div>
            													<div class="form-group">
            														<label for="input-proptype">{ci_label1}:</label>
            														<select class="form-control" name="input-proptype" data-no-reset="true" required>
            															<option selected disabled>----- {ci_disabled_opt0} -----</option>
            															<option value="text">{ci_prop_type0}</option>
            															<option value="date">{ci_prop_type1}</option>
            															<option value="list">{ci_prop_type2}</option>
            															<option value="plist">{ci_prop_type3}</option>
            														</select>
            													</div>
            													<div id="plistValues" class="prelist-components">
            														<div class="form-group">
            															<div class="d-flex align-items-center justify-content-between">
            																<label>{plist_value_text}</label>
            																<div class="prelist-controls">
            																	<a href="#" role="button" data-clone="true">{btn_add}</a>
            																	<a href="#" role="button" data-remove="true">{btn_remove}</a>
            																</div>
            															</div>
            															<input type="text" class="form-control" name="input-plist[]" />
            														</div>
            													</div>
            												</div>
            												<div class="modal-footer text-end">
            													<button type="submit" class="btn btn-primary">
            														<i class="mdi mdi-content-save"></i> {btn_save}
            													</button>
        														<button type="button" class="btn btn-primary" data-bs-dismiss="modal">
        															<i class="mdi mdi-close"></i> {btn_cancel}
        														</button>
            												</div>
        												</form>
        											</div>
    											</div>
        									</div>
										</div>
										<div id="assets-ci" class="tab-pane fade show active col col-sm-12 col-md-8" role="tabpanel" aria-labelledby="assets-ci-tab">
        									<div class="d-flex align-items-center justify-content-between border-bottom border-grayl pb-2 mb-2">
        										<h3 class="card-title mb-0">{ci_title}</h3>
        										<div class="card-control">
        											<a role="button" href="#modalCIForm" data-bs-toggle="modal" title="{btn_add}">
        												<i class="mdi mdi-plus"></i>
        											</a>
        											<a role="button" href="#tableConfigItem" data-bs-reload="table" title="{btn_reload}">
        												<i class="mdi mdi-reload"></i>
        											</a>
    											</div>
        									</div>
        									<table id="tableConfigItem" class="table table-hover table-striped table-centered" data-table="true">
        										<thead>
        											<tr>
        												<th>#</th>
        												<th>{th_ci0}</th>
        												<th>{th_ci1}</th>
        												<th>{th_ci2}</th>
        												<th>{th_ci3}</th>
        												<th>{th_created}</th>
    												</tr>
        										</thead>
        										<tbody>
        										</tbody>
        									</table>
        									<div class="modal fade" id="modalCIForm" role="dialog" tabindex="-1" data-ajax-run="true" data-ajax-target="attributes">
        										<div class="modal-dialog modal-lg">
        											<div class="modal-content">
        												<div class="modal-header">
        													<h3 class="modal-title">{mdl_title_ci1}</h3>
        													<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        												</div>
        												<form method="post">
        													<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
        													<input type="hidden" name="request-type" value="config|new" />
        													<input type="hidden" name="atom" value="" />
            												<div class="modal-body">
            													<div class="row">
            														<div class="col-md-8">
                    													<div class="form-group">
                    														<label for="input-ciname">{ci_label2}:</label>
                    														<input type="text" class="form-control" name="input-ciname" data-loadtarget="code" data-readonlyonedit="true" required />
                    													</div>
                    													<div class="form-group">
                    														<label for="input-cidscript">{ci_label3}:</label>
                    														<input type="text" class="form-control" name="input-cidscript" data-loadtarget="dscript" required />
                    													</div>
                    													<div class="form-group">
                    														<label for="input-cideprem">{ci_label6}:</label>
                    														<select class="form-control" name="input-cideprem" data-loadtarget="depre-method" data-no-reset="true" required>
                    															<option value="" disabled="disabled" selected="selected">---- {ci_depre_disabled} ----</option>
                    															<option value="1">{ci_depre_opt1}</option>
                    															<option value="2">{ci_depre_opt2}</option>
                    															<option value="3">{ci_depre_opt3}</option>
                    															<option value="4">{ci_depre_opt4}</option>
                    														</select>
                    													</div>
                    													<div class="form-group">
                    														<label for="input-cisalvagev">{ci_label7} (%):</label>
                    														<input type="number" class="form-control" name="input-cisalvagev" data-loadtarget="salvage-value" value="0" placeholder="0" min="0" max="100" required />
                    													</div>
                													</div>
                													<div id="ciDataType" class="col-md-4" data-ajax-load="attributes" data-ajax-type="checkbox">
                														<label for="input-cidtype">{ci_label4}:</label>
                													</div>
            													</div>
            												</div>
            												<div class="modal-footer text-end">
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
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>{/dash_configitems_texts} {/commons}
