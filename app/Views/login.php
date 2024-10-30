	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
				<div class="row flex-grow">
					<div class="col-lg-6 login-half-bg d-flex flex-row">
					</div>
					<div class="col-lg-6 d-flex align-items-center justify-content-center">
						<div class="auth-form-transparent text-left p-3">
							<div class="d-flex align-items-center justify-content-between">
    							<div class="brand-logo">
    								<img src="{baseURL}{brand_url}" alt="logo" />
    							</div>
    							<div class="dropdown">
    								<a role="button" class="dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
    									<span id="langText" class="lang-flag">
											<img src="https://flagicons.lipis.dev/flags/4x3/{lang}.svg" alt="lang">
    									</span>
									</a>
									<ul class="dropdown-menu">
										<li>
    										<a class="dropdown-item lang-flag" href="{baseURL}id" data-bs-toggle="language">
    											<img src="https://flagicons.lipis.dev/flags/4x3/id.svg" alt="id"> <span>Bahasa</span>
    										</a>
										</li>
										<li>
											<a class="dropdown-item lang-flag" href="{baseURL}en" data-bs-toggle="language">
    											<img src="https://flagicons.lipis.dev/flags/4x3/gb.svg" alt="en"> <span>Inggris</span>
											</a>
										</li>
										<li>
											<a class="dropdown-item lang-flag" href="{baseURL}fr" data-bs-toggle="language">
    											<img src="https://flagicons.lipis.dev/flags/4x3/fr.svg" alt="en"> <span>Perancis</span>
											</a>
										</li>
									</ul>
    							</div>
							</div>
							<h4>Hai dan selamat datang!</h4>
							<h6 class="font-weight-light">{messageOfTheDay}</h6>
							<form class="pt-3" method="post">
								<input type="hidden" name="{csrf_name}" value="{csrf_data}" />
								<div class="form-group">
									<label for="input-username">Username:</label>
									<div class="input-group">
										<div class="input-group-prepend bg-transparent">
											<span class="input-group-text bg-transparent border-right-0">
												<i class="mdi mdi-account-outline text-primary"></i>
											</span>
										</div>
										<input id="username" type="text" class="form-control form-control-lg border-left-0" name="input-username" required />
									</div>
								</div>
								<div class="form-group">
									<label for="input-password">Kata Sandi:</label>
									<div class="input-group">
										<div class="input-group-prepend bg-transparent">
											<span class="input-group-text bg-transparent border-right-0">
												<i class="mdi mdi-lock-outline text-primary"></i>
											</span>
										</div>
										<input id="password" type="password" class="form-control form-control-lg border-left-0" name="input-password" required>
									</div>
								</div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Biarkan saya tetap masuk
                                            <i class="input-helper"></i>
                                        </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Lupa kata sandi?</a>
                                </div>
                                <div class="my-3">
                                	<button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium">
                                		LOGIN
                            		</button>
                                </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>