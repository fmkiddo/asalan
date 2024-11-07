					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card">
									<div class="card-body">
										<div class="border-bottom border-grayl mb-3 py-2">
											<h3 class="card-title">{fmanager_title}</h3>
										</div>
										<ul class="nav nav-tabs nav-justified">
											<li class="nav-item">
												<a role="tab" class="nav-link active" data-bs-toggle="tab" data-bs-target="#image-list" aria-controls="image-list-tab" aria-selected="true">
													<span>{tab_images}</span>
												</a>
											</li>
											<li class="nav-item">
												<a role="tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#import-data" aria-controls="imports-data-tab" aria-selected="true">
													<span>{tab_imports}</span>
												</a>
											</li>
											<li class="nav-item">
												<a role="tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#docs-data" aria-controls="docs-data-tab" aria-selected="true">
													<span>{tab_docs}</span>
												</a>
											</li>
										</ul>
										<div class="tab-content border-0 px-0 pb-0">
											<div class="tab-pane fade show active" id="image-list" role="tabpanel" aria-labelledby="image-list-tab">
												<div class="border border-grayl border-top-0 border-left-0 border-right-0 mb-2 py-2">
													<div class="d-flex align-items-center justify-content-between">
														<h5 class="card-title mb-0">{picstable_title}</h5>
														<div>
        													<button type="button" id="btnUpload" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFileUploads" title="{btn_upload}">
        														<i class="mdi mdi-file-upload"></i>
        														<span>{btn_upload}</span>
        													</button>
        													<button type="button" id="btnDelete" class="btn btn-primary" title="{btn_remove_image}">
        														<i class="mdi mdi-file-image-remove"></i>
        														<span>{btn_remove_image}</span>
        													</button>
        												</div>
													</div>
												</div>
												<table class="table table-hover table-center-head" data-table="true" data-page-length="25">
													<thead>
														<tr>
															<th><i class="mdi mdi-checkbox-marked"></i></th>
															<th>{thd_img}</th>
															<th>{thd_imgname}</th>
															<th>{thd_imgtype}</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
												<div id="modalFileUploads" role="dialog" class="modal fade" tabindex="-1" aria-labelledby="modalFileUploads" aria-hidden="true">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title">{mdl_title_upload}</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
															</div>
															<div class="modal-body">
																<input type="file" class="form-control" accept="image/apng,image/png,image/avif,image/jpeg,image/svg,image/webp" />
																<div class=""></div>
															</div>
															<div class="modal-footer text-end">
																<button type="button" class="btn btn-primary" title="{btn_upload}">
																	<i class="mdi mdi-file-upload"></i>
																	<span>{btn_upload}</span>
																</button>
																<button type="button" class="btn btn-primary" data-bs-dismiss="modal" title="{btn_cancel}">
																	<i class="mdi mdi-close"></i>
																	<span>{btn_cancel}</span>
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="import-data" role="tabpanel" aria-labelledby="import-data-tab">
												<div class="row">
													<div class="col-md-6">
													</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="docs-data" role="tabpanel" aria-labelledby="docs-data-tab">
												<h5></h5>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
