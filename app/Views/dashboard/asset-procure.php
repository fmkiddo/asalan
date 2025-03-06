					{commons} {dash_assetprocure_texts}
					<div class="card">
						<div class="card">
							<div class="card-body">
								<div class="control-section">
									<h4 class="card-title">{title0}</h4>
									<div class="card-control">
										<a role="button" data-redirect="flow-request" data-getredirect="procure">
											<span class="mdi mdi-plus"></span>
										</a>
										<a role="button" href="#tableFAProcurement" data-action="reload-table" title="{tooltip0}">
											<span class="mdi mdi-refresh"></span>
										</a>
									</div>
								</div>
								<hr class="separator" />
								<div class="scrollable">
									<div class="row">
										<div class="col-4">
											<div class="card card-reset shadow-none bg-primary rounded-0 text-white">
												<div class="card-body">
													<h5 class="card-title text-white">{ctitle_0}</h5>
													<p class="display-3 my-4">{dc_value0}</p>
													<a role="button">
														<span class="mdi mdi-refresh">{btn_refresh}</span>
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
														<span class="mdi mdi-refresh">{btn_refresh}</span>
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
														<span class="mdi mdi-refresh">{btn_refresh}</span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<hr class="separator" />
								<table id="tableFAProcurement" class="table table-hover table-striped table-centered" data-table="true" role="button">
									<thead>
										<tr>
											<th>#</th>
											<th>{th0}</th>
											<th>{th1}</th>
											<th>{th2}</th>
											<th>{th3}</th>
											<th>{th4}</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<div id="modalDetail" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="modalProcureDetail" data-bs-backdrop="static" data-bs-keyboard="false">
									<div class="modal-dialog modal-xl">
										<div class="modal-content">
											<div class="modal-header">
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
					</div>{/dash_assetprocure_texts} {/commons}
