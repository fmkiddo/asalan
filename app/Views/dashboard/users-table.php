					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card">
									<div class="card-body">
										<div class="border-bottom border-grayl mb-3 py-2">
											<div class="d-flex align-items-center justify-content-between">
    											<h3 class="card-title mb-0">{users_title}</h3>
												<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormUser" title="{btn_add}">
													<i class="mdi mdi-plus-circle"></i>
													<span>{btn_add}</span>
												</button>
    										</div>
										</div>
										<table class="table table-hover table-striped table-centered" data-table="true">
											<thead>
												<tr>
													<th><i class="mdi mdi-checkbox-marked"</th>
													<th>{th_username}</th>
													<th>{th_usergroup}</th>
													<th>{th_email}</th>
													<th>{th_created}</th>
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
					<div id="modalFormUser" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="modalFormControl" aria-modal="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">{mdl_title_userform}</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<form method="post">
									<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
									<div class="modal-body">
										<div class="form-group">
											<label for="input-uname">{label_username}:</label>
											<input type="text" class="form-control" name="input-uname" required />
										</div>
										<div class="row">
											<div class="col-sm-6">
        										<div class="form-group">
        											<label for="input-email">{label_email}:</label>
        											<input type="email" class="form-control" name="input-email" required />
        										</div>
											</div>
											<div class="col-sm-6">
        										<div class="form-group">
        											<label for="input-cemail">{label_cemail}:</label>
        											<input type="email" class="form-control" name="input-cemail" required />
        										</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
        										<div class="form-group">
        											<label for="input-pswd">{label_password}:</label>
        											<input type="password" class="form-control" name="input-pswd" required />
        										</div>
											</div>
											<div class="col-sm-6">
        										<div class="form-group">
        											<label for="input-cpswd">{label_cpassword}:</label>
        											<input type="password" class="form-control" name="input-cpswd" required />
        										</div>
											</div>
										</div>
										<div class="form-group">
											<label for="input-grouptype">{label_accesstype}</label>
											<select class="form-control" name="input-grouptype" required>
												<option disabled selected>----- {opt_disabled_acl} -----</option>
											</select>
										</div>
									</div>
									<div class="modal-footer text-end">
										<button type="submit" class="btn btn-primary" title="{btn_save}">
											<i class="mdi mdi-close"></i>
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
