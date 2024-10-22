	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-center auth">
				<div class="row w-100">
					<div class="col-lg-4 mx-auto">
						<div class="auth-form-light text-left p-5">
							<div class="brand-logo" style="">
								<img src="{baseURL}assets/imgs/fmkiddo-logo-landscape-white.png" alt="fmkiddo-logo" class="kiddo-software"/>
							</div>
							<h4>Welcome and let's get started!</h4>
							<h6 class="font-weight-light">Let's setup your software before you continue</h4>
							<hr />
							<form method="post" enctype="application/x-www-form-urlencoded">
								<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
								<div class="form-group">
									<label for="input-licensee">Company Code:</label>
									<input type="text" class="form-control form-control-lg" name="input-licensee" required />
								</div>
								<div class="form-group">
									<label for="input-licensecode">Serial Number:</label>
									<input type="text" class="form-control form-control-lg masked" name="input-licensecode" data-inputmask="AAAAAA-AAAAAA-AAAAAA-AAAAAA-AAAAAA" required />
								</div>
								<hr />
								<div class="text-danger">{response}</div>
								<div class="mt-3">
									<button type="submit" class="btn btn-block btn-primary font-weight-medium auth-form-btn">
										ENTER LICENSE CODE<i class="mdi mdi-lock-open-variant"></i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
