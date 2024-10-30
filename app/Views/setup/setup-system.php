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
							<h6 class="font-weight-light">Now you can specify an URL for your system</h4>
							<hr />
							<form method="post" enctype="application/x-www-form-urlencoded">
								<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
								<input type="hidden" name="serverdata" value="{sdata0}" />
								<input type="hidden" name="extras" value="{sdata1}" />
								<div class="form-group">
									<label for="input-newurl">System URL:</label>
									<input type="text" class="form-control form-control-lg" name="input-newurl" required />
								</div>
								<div class="form-group">
									<label for="input-newadmin">Administrator Username:</label>
									<input type="text" class="form-control form-control-lg" name="input-newadmin" required />
								</div>
								<div class="form-group">
									<label for="input-newapswd">Administrator Password:</label>
									<input type="password" class="form-control form-control-lg" name="input-newapswd" required />
								</div>
								<div class="form-group">
									<label for="input-newcpswd">Re-Type Password:</label>
									<input type="password" class="form-control form-control-lg" name="input-newcpswd" required />
								</div>
								<div class="form-check form-check-flat form-check-primary">
									<label for="input-useindexphp" class="form-check-label">
										<input type="checkbox" name="input-useindexphp" value="yes" /> Use index.php? <i class="input-helper"></i>
									</label>
								</div>
								<div class="form-check form-check-flat form-check-primary">
									<label for="input-isdevelopment" class="form-check-label">
										<input type="checkbox" name="input-isdevelopment" value="yes" checked /> Is Development Environment? <i class="input-helper"></i>
									</label>
								</div>
								<hr />
								<div class="text-danger">{response}</div>
								<div class="mt-3">
									<button type="submit" class="btn btn-block btn-primary font-weight-medium auth-form-btn">
										SAVE CONFIGURATION<i class="mdi mdi-lock-open-variant"></i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
