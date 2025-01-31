					<div class="card">
						<div class="card">
							<div class="card-body">
								<div class="control-section">
									<h4 class="card-title">{title0}</h4>
								</div>
								<hr class="separator" />
								<ul class="nav nav-tabs nav-justified">
									<li class="nav-item">
										<a class="nav-link active" role="tab" href="#faReceiveDocuments" data-bs-toggle="tab" aria-selected="true">{tab0}</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" role="tab" href="#faReceiveDistributions" data-bs-toggle="tab" aria-selected="false">{tab1}</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="faReceiveDocuments" class="tab-pane fade show active" tabindex="-1">
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
        								<table id="tableFAReceive" class="table table-hover table-striped table-centered" data-table="true" data-page-length="50">
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
									</div>
									<div id="faReceiveDistributions" class="tab-pane fade" tabindex="-1">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="modalDocDetail" class="modal fade" role="dialog" tabindex="-1">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
								</div>
								<div class="modal-footer">
									<div class="text-end">
										<button type="button" class="btn btn-primary" data-bs-dismiss="modal">
											<span class="mdi mdi-close"></span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
