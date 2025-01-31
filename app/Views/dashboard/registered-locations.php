					{commons} {dash_locations_texts}
					<div class="card">
						<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between border-bottom border-grayl pb-2 mb-2">
									<h3 class="card-title">{title0}</h3>
									<div class="card-control">
										<a role="button" href="#modalLocationForm" data-bs-toggle="modal">
											<i class="mdi mdi-plus"></i>
										</a>
										<a role="button" href="#tableLocations" data-bs-reload="table" title="{btn_reload}">
											<i class="mdi mdi-reload"></i>
										</a>
									</div>
								</div>
								<table id="tableLocations" role="button" class="table table-hover table-striped table-centered" data-table="true">
									<thead>
										<tr>
											<th>#</th>
											<th>{th_location0}</th>
											<th>{th_location1}</th>
											<th>{th_location2}</th>
											<th>{th_location3}</th>
											<th>{th_location4}</th>
											<th>{th_location5}</th>
											<th>{th_location6}</th>
											<th>{th_location7}</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<div class="modal fade" id="modalLocationForm" role="dialog" tabindex="-1">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
    										<div class="modal-header">
												<h3 class="modal-title">{mdl_title_location0}</h3>
												<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    										</div>
    										<form method="post">
												<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
												<input type="hidden" name="request-type" value="locations|new" />
												<input type="hidden" name="atom" value="" />
        										<div class="modal-body">
        											<div class="form-group">
        												<label for="input-newcode">{text_label0}:</label>
        												<input type="text" class="form-control" name="input-newcode" data-readonlyonedit="true" data-loadtarget="code" required />
        											</div>
        											<div class="form-group">
        												<label for="input-newname">{text_label1}:</label>
        												<input type="text" class="form-control" name="input-newname" data-loadtarget="name" required />
        											</div>
        											<div class="form-group">
        												<label for="input-newaddr">{text_label2}:</label>
        												<textarea class="form-control" name="input-newaddr" rows="3" data-loadtarget="address" required></textarea>
        											</div>
        											<div class="form-group">
        												<label for="input-newphone">{text_label3}:</label>
        												<input type="tel" class="form-control" name="input-newphone" data-loadtarget="phone" required />
        											</div>
        											<div class="form-group">
        												<label for="input-newcontact">{text_label4}:</label>
        												<input type="text" class="form-control" name="input-newcontact" data-loadtarget="contact-person" required />
        											</div>
        											<div class="form-group">
        												<label for="input-newemail">{text_label5}:</label>
        												<input type="email" class="form-control" name="input-newemail" data-loadtarget="email" />
        											</div>
        											<div class="form-group">
        												<label for="input-newnotes">{text_label6}:</label>
        												<textarea class="form-control" name="input-newnotes" rows="3" data-loadtarget="notes"></textarea>
        											</div>
        										</div>
        										<div class="modal-footer">
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
									<div class="modal-dialog modal-xl">
										<div class="modal-content">
											<div class="modal-header">
												<h3 class="modal-title">{mdl_title_location1}</h3>
												<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
											</div>
											<div class="modal-body">
												<h5>{title1}</h5>
												<hr class="separator" />
												<table id="tableLocationDetails" class="table table-hover table-striped" data-details="true">
													<tbody>
														<tr>
															<td width="15%">{text_label0}</td>
															<td width="1%">:</td>
															<td data-loadtarget="code"></td>
															<td width="15%">{text_label4}</td>
															<td width="1%">:</td>
															<td data-loadtarget="contact-person"></td>
														</tr>
														<tr>
															<td>{text_label1}</td>
															<td>:</td>
															<td data-loadtarget="name"></td>
															<td>{text_label3}</td>
															<td>:</td>
															<td data-loadtarget="phone"></td>
														</tr>
														<tr>
															<td>{text_label2}</td>
															<td>:</td>
															<td data-loadtarget="address"></td>
															<td>{text_label5}</td>
															<td>:</td>
															<td data-loadtarget="email"></td>
														</tr>
													</tbody>
												</table>
												<div class="my-2 py-2 border border-gray-light small">
													<div class="pl-3">{text_label6}</div>
													<div class="pl-3 location-note" data-loadtarget="notes">
													</div>
												</div>
												<hr class="separator" />
												<div id="locationDetailTabPane">
													<ul class="nav nav-tabs nav-justified">
														<li class="nav-item">
															<a class="nav-link active" data-bs-toggle="tab" href="#location-sublocations">
																{btn_sublocations}
															</a>
														</li>
														<li class="nav-item">
															<a class="nav-link" data-bs-toggle="tab" href="#location-assets">
																{btn_assets}
															</a>
														</li>
													</ul>
													<div class="tab-content">
														<div class="tab-pane fade show active" id="location-sublocations">
															<div id="faded-sublocations" class="faded">
    															<div id="sublocationDataTable">
        															<div class="control-section">
        																<h5>{title2}</h5>
        																<div>
                                    										<a role="button" data-action="fade" data-fade-target="#faded-sublocations" href="#sublocationForm">
                                    											<i class="mdi mdi-plus"></i>
                                    										</a>
                                    										<a role="button" href="#sublocationTable" data-bs-reload="table" title="{btn_reload}">
                                    											<i class="mdi mdi-reload"></i>
                                    										</a>
        																</div>
        															</div>
																	<hr class="separator" />
    																<table id="sublocationTable" class="table table-hover table-striped table-centered" data-table="true" data-sub="sublocations" data-sub-target="">
    																	<thead>
    																		<tr>
    																			<th>#</th>
    																			<th>{th_sublocation0}</th>
    																			<th>{th_sublocation1}</th>
    																			<th>{th_sublocation2}</th>
    																		</tr>
    																	</thead>
    																	<tbody>
    																	</tbody>
    																</table>
    															</div>
    															<div id="sublocationForm">
    																<h5>{mdl_title_location2}</h5>
    																<hr class="separator" />
    																<form method="post">
                        												<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
                        												<input type="hidden" name="request-type" value="sublocation|new" />
                        												<input type="hidden" name="atom" value="" />
                        												<div class="form-group">
                        													<label for="input-newloccode">{text_label7}:</label>
                        													<input type="text" class="form-control" name="input-newloccode" data-loadtarget="code" data-reset="false" required readonly />
                        												</div>
                        												<div class="form-group">
                        													<label for="input-newcode">{text_label8}:</label>
                        													<input type="text" class="form-control" name="input-newcode" data-readonlyonedit="true" data-loadtarget="sblcode" required />
                        												</div>
                        												<div class="form-group">
                        													<label for="input-newname">{text_label9}:</label>
                        													<input type="text" class="form-control" name="input-newname" data-loadtarget="sblname" required />
                        												</div>
                        												<div class="d-block text-end">
        																	<button type="submit" class="btn btn-primary">
        																		<i class="mdi mdi-content-save"></i>
        																	</button>
        																	<button type="button" class="btn btn-primary" data-action="fade" data-cancel-form="true" data-fade-target="#faded-sublocations" data-faded-target="#sublocationDataTable">
        																		<i class="mdi mdi-close"></i>
        																	</button>
        																</div>
    																</form>
    															</div>
															</div>
														</div>
														<div class="tab-pane fade" id="location-assets">
															<div class="control-section">
																<h5>{title3}</h5>
                            									<div>
                            										<a role="button" href="#fixedAssetsTable" data-bs-reload="table" title="{btn_reload}">
                            											<i class="mdi mdi-reload"></i>
                            										</a>
                            									</div>
															</div>
															<hr class="separator" />
															<table id="fixedAssetsTable" class="table table-hover table-striped table-centered" data-table="true" data-sub="location-assets" data-sub-target="">
																<thead>
																	<tr>
																		<th>#</th>
																		<th>{th_locasset0}</th>
																		<th>{th_locasset1}</th>
																		<th>{th_locasset2}</th>
																		<th>{th_locasset3}</th>
																		<th>{th_locasset4}</th>
																	</tr>
																</thead>
																<tbody>
																</tbody>
															</table>
														</div>
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
								</div>
    						</div>
    					</div>
    				</div>{/dash_locations_texts} {/commons}
