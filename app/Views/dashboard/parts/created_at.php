										<div class="created-at">
											<div class="left" role="button" title="{time_created}">{tc_humanized}</div>
											<div class="right dropend">
												<a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" href="#" aria-expanded="false">
													<span>{more}</span>
												</a>
												<ul class="dropdown-menu function-menu" style="overflow: auto;">
													<li>
														<a class="dropdown-item" role="button" data-target="{uuid}" data-action="open-editdialog" data-action-target="#{modal_target}">
															<i class="mdi mdi-content-save-edit"></i> <span>{btn_update}</span>
														</a> 
													</li>{if $showDetail}
													<li>
														<a class="dropdown-item" data-action="open-dialog" data-action-target="#modalDetail" role="button" data-target="{uuid}">
															<i class="mdi mdi-file-eye"></i> <span>{btn_details}</span>
														</a>
													</li>{endif}{if $showDelete}
													<li>
														<a class="dropdown-item" role="button" href="#">
															<i class="mdi mdi-file-eye"></i> <span>{btn_delete}</span>
														</a>
													</li>{endif}
												</ul>
											</div>
										</div>
