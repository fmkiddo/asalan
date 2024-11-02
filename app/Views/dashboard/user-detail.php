					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<div class="col-md-12 col-lg-4">
										<div class="border-bottom text-center pb-4">
											<div class="thumbnail pb-3">
												<div class="pict-preview blank rounded"></div>
											</div>
											<p>{urname}</p>
										</div>
										<div class="border-bottom pt-4">
											<ul class="nav nav-tabs nav-justified" role="tablist">
												<li class="nav-item" role="presentation">
													<button type="button" class="nav-link active" id="user-details-tab" data-bs-target="#user-details" data-bs-toggle="tab" role="tab" aria-controls="home" aria-selected="true">
														<span>Pengguna</span>
													</button>
												</li>
												<li class="nav-item" role="presentation">
													<button type="button" class="nav-link" id="user-incharge-tab" data-bs-target="#user-incharge" data-bs-toggle="tab" role="tab" aria-controls="home" aria-selected="false">
														<span>Lokasi</span>
													</button>
												</li>
											</ul>
											<div class="tab-content px-0 border-0">
												<div class="tab-pane fade show active" role="tabpanel" id="user-details" aria-labelledby="user-details-tab">
													<p>Informasi Pengguna</p>
        											<table class="table table-hover table-fixed table-center-head user-details">
        												<thead>
        													<tr>
        														<th width="30%">Key</th>
        														<th width="10%">Colon</th>
        														<th width="60%">Value</th>
        													</tr>
        												</thead>
        												<tbody>
        													<tr>
        														<td>Username</td>
        														<td>:</td>
        														<td>{username}</td>
        													</tr>
        													<tr>
        														<td>Nama</td>
        														<td>:</td>
        														<td>{fullname}</td>
        													</tr>
        													<tr>
        														<td>No. Tel</td>
        														<td>:</td>
        														<td>{phone}</td>
        													</tr>
        													<tr>
        														<td>Email</td>
        														<td>:</td>
        														<td>{email}</td>
        													</tr>
        												</tbody>
        											</table>
												</div>
												<div class="tab-pane fade" role="tabpanel" id="user-incharge" aria-labelledby="user-incharge-tab">
													<p>Tanggung Jawab Lokasi</p>
												</div>
											</div>
										</div>
										<button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#profileForm">Perbarui</button>
									</div>
								</div>
							</div>
							<div class="modal fade" id="profileForm" tabindex="-1" aria-labelledby="" aria-hidden="true">
								<div class="modal-dialog modal-xl">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Perbaru Profil Pengguna</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<form method="post">
											<div class="modal-body">
												<div class="cols-to-tabs">
    												<ul class="nav nav-tabs nav-justified device-small" role="tablist">
    													<li role="presentation" class="nav-item active">
    														<a class="nav-link active" href="#profile" data-bs-toggle="tab" role="tab" aria-controls="profile" aria-selected="true">
    															<span>Profil</span>
    														</a>
    													</li>
    													<li role="presentation" class="nav-item">
    														<a class="nav-link" href="#picture" data-bs-toggle="tab" role="tab" aria-controls="picture" aria-selected="false">
    															<span>Gambar</span>
    														</a>
    													</li>
    												</ul>
    												<div class="tab-content row">
    													<div role="tabpanel" class="tab-pane fade show active col col-xs-12 col-sm-8" id="profile" aria-labelledby="profile-tab">
    														<p>Nama Pengguna:</p>
    														<div class="row">
    															<div class="col-md-4">
    																<div class="form-group">
    																	<label class="d-hidden" for="input-fname">Nama Depan:</label>
    																	<input type="text" class="form-control" name="input-fname" placeholder="Atep" required />
    																</div>
    															</div>
    															<div class="col-md-4">
    																<div class="form-group">
    																	<label class="d-hidden" for="input-mname">Nama Tengah:</label>
    																	<input type="text" class="form-control" name="input-mname" placeholder="Nurdin" />
    																</div>
    															</div>
    															<div class="col-md-4">
    																<div class="form-group">
    																	<label class="d-hidden" for="input-lname">Nama Belakang:</label>
    																	<input type="text" class="form-control" name="input-lname" placeholder="Soleh" required />
    																</div>
    															</div>
    														</div>
    														<div class="form-group">
    															<label for="input-addr1">Alamat 1:</label>
    															<textarea class="form-control" name="input-addr1" rows="3" required></textarea>
    														</div>
    														<div class="form-group">
    															<label for="input-addr1">Alamat 2:</label>
    															<textarea class="form-control" name="input-addr2" rows="3"></textarea>
    														</div>
    														<div class="row">
    															<div class="col-md-6">
    																<div class="form-group">
    																	<label for="input-phone">No. Telepon:</label>
    																	<input type="tel" class="form-control" name="input-phone" required />
    																</div>
    															</div>
    															<div class="col-md-6">
    																<div class="form-group">
    																	<label for="input-email">Email:</label>
    																	<input type="email" class="form-control" name="input-email" required />
    																</div>
    															</div>
    														</div>
    													</div>
    													<div role="tabpanel" class="tab-pane fade col col-xs-12 col-sm-4" id="picture" aria-labelledby="picture-tab">
    														<p>Foto:</p>
    														<div class="pict-preview {blank_pict}">
    														</div>
    														<div class="pick-image">
    															<input type="file" name="input-urpic" accept="image/png,image/webp,image/jpeg" />
    															<button type="button" class="btn btn-primary btn-block" id="pickImage">
    																<span>Pilih Gambar</span>
    															</button>
    														</div>
    													</div>
    												</div>
    											</div>
											</div>
											<div class="modal-footer text-end">
												<button type="submit" class="btn btn-primary">Simpan</button>
												<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>