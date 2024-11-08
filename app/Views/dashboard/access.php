					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card">
									<div class="card-body">
										<div class="border-bottom border-grayl mb-3 py-2">
											<div class="d-flex align-items-center justify-content-between">
    											<h3 class="card-title mb-0">{acl_title}</h3>
    											<div>
    												<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormControl" title="{btn_add}">
    													<i class="mdi mdi-plus-circle"></i>
    													<span>{btn_add}</span>
    												</button>
    												<button type="button" class="btn btn-primary" data-bs-reload="table" data-bs-target="#tableAcl" title="{btn_reload}">
    													<i class="mdi mdi-reload"></i>
    													<span>{btn_reload}</span>
    												</button>
    											</div>
    										</div>
										</div>
										<table id="tableAcl" class="table table-hover table-striped table-centered" data-table="true">
											<thead>
												<tr>
													<th><i class="mdi mdi-checkbox-marked"></i></th>
													<th>{th_code}</th>
													<th>{th_name}</th>
													<th>{th_caprv}</th>
													<th>{th_crmv}</th>
													<th>{th_csend}</th>
													<th class="small">{th_created}</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="modalFormControl" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="modalFormControl" aria-modal="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">{mdl_title_controlform}</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<form method="post">
									<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
    								<div class="modal-body">
    									<div class="row">
    										<div class="col-md-6 border-right border-graylr">
    											<div class="form-group">
    												<label for="input-groupcode">{label_gcode}:</label>
    												<input type="text" class="form-control" name="input-groupcode" required />
    											</div>
    											<div class="form-group">
    												<label for="input-groupdscript">{label_gdscript}:</label>
    												<input type="text" class="form-control" name="input-groupdscript" required />
    											</div>
    											<p>{label_control}</p>
    											<div class="row">
    												<div class="col-sm-6">
    													<div class="form-check">
    														<label class="form-check-label" for="input-groupcaprv">
    															<input type="checkbox" class="form-check-input" name="input-groupcaprv" value="true">
    															{label_canapprove}
															</label>
    													</div>
    												</div>
    												<div class="col-sm-6">
    													<div class="form-check">
    														<label class="form-check-label" for="input-groupcaprv">
    															<input type="checkbox" class="form-check-input" name="input-groupcaprv" value="true">
    															{label_canremove}
															</label>
    													</div>
													</div>
    												<div class="col-sm-6">
    													<div class="form-check">
    														<label class="form-check-label" for="input-groupcaprv">
    															<input type="checkbox" class="form-check-input" name="input-groupcaprv" value="true">
    															{label_cansend}
															</label>
    													</div>
    												</div>
    											</div>
    										</div>
    										<div class="col-md-6">
    											<p>{label_access}</p>
    											<div class="row">
    												<div class="col-sm-6">
            											<div class="form-check">
            												<label for="input-groupacl0" class="form-check-label">
            													<input type="checkbox" for="input-groupacl0" value="true"/>
            													{label_access0}
            												</label>
            											</div>
            											<div class="form-check">
            												<label for="input-groupacl1" class="form-check-label">
            													<input type="checkbox" for="input-groupacl1" value="true" />
            													{label_access1}
            												</label>
        												</div>
            											<div class="form-check">
            												<label for="input-groupacl2" class="form-check-label">
            													<input type="checkbox" for="input-groupacl2" value="true" />
            													{label_access2}
            												</label>
        												</div>
            											<div class="form-check">
            												<label for="input-groupacl3" class="form-check-label">
            													<input type="checkbox" for="input-groupacl3" value="true" />
            													{label_access3}
            												</label>
        												</div>
            											<div class="form-check">
            												<label for="input-groupacl4" class="form-check-label">
            													<input type="checkbox" for="input-groupacl4" value="true"  />
            													{label_access4}
            												</label>
        												</div>
            											<div class="form-check">
            												<label for="input-groupacl5" class="form-check-label">
            													<input type="checkbox" for="input-groupacl5" value="true"  />
            													{label_access5}
            												</label>
        												</div>
            											<div class="form-check">
            												<label for="input-groupacl6" class="form-check-label">
            													<input type="checkbox" for="input-groupacl6" value="true"  />
            													{label_access6}
            												</label>
        												</div>
    												</div>
    												<div class="col-sm-6">
            											<div class="form-check">
            												<label for="input-groupacl0" class="form-check-label">
            													<input type="checkbox" for="input-groupacl7" value="true"  />
            													{label_access7}
            												</label>
        												</div>
            											<div class="form-check">
            												<label for="input-groupacl8" class="form-check-label">
            													<input type="checkbox" for="input-groupacl8" value="true"  />
            													{label_access8}
            												</label>
        												</div>
            											<div class="form-check">
            												<label for="input-groupacl9" class="form-check-label">
            													<input type="checkbox" for="input-groupacl9" value="true" />
            													{label_access9}
            												</label>
        												</div>
            											<div class="form-check">
            												<label for="input-groupacl10" class="form-check-label">
            													<input type="checkbox" for="input-groupacl10" value="true" />
            													{label_access10}
            												</label>
        												</div>
            											<div class="form-check">
            												<label for="input-groupacl11" class="form-check-label">
            													<input type="checkbox" for="input-groupacl11" value="true" />
            													{label_access11}
            												</label>
        												</div>
            											<div class="form-check">
            												<label for="input-groupacl12" class="form-check-label">
            													<input type="checkbox" for="input-groupacl12" value="true" />
            													{label_access12}
            												</label>
            											</div>
    												</div>
    											</div>
    										</div>
    									</div>
    								</div>
    								<div class="modal-footer text-end">
    									<button type="submit" class="btn btn-primary" title="{btn_save}">
    										<i class="mdi mdi-content-save"></i>
    										<span>{btn_save}</span>
    									</button>
    									<button type="button" class="btn btn-primary" data-bs-dismiss="modal" title="{btn_cancel}">
    										<i class="mdi mdi-close"></i>
    										<span>{btn_cancel}</span>
    									</button>
    								</div>
								</form>
							</div>
						</div>
					</div>
