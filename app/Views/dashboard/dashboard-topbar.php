	<div class="container-scroller" data-bs-sidebar="{theme}" data-bs-topbar="{topbar}">
		<nav class="navbar col-lg-12 col-12 p-0 d-flex d-flex-row">
			<div class="navbar-brand-wrapper d-flex align-items-center justify-content-start">
				<a class="navbar-brand brand-logo-mini" href="{baseURL}">
					<img src="{baseURL}{brand_logo}" alt="Logo" />
				</a>
			</div>
			<div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
				<div class="d-flex align-items-center">
					<button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
						<span class="mdi mdi-menu"></span>
					</button>
					<div class="welcome-message d-lg-flex d-none">
						Hai, {urname}, selamat datang kembali!
					</div>
				</div>
				<ul class="navbar-nav navbar-nav-right">
					<li class="nav-item dropdown">
						<a class="nav-link count-indicator dropdown-toggle" role="button" href="#" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="mdi mdi-bell mx-0"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list">
							<h6 class="p-3 mb-0">Notifikasi</h6>
							<hr class="dropdown-divider">
							<hr class="dropdown-divider">
							<a class="dropdown-item">
								<p class="p-1 mb-0 text-center">Lihat semua notifikasi</p>
							</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link count-indicator dropdown-toggle" role="button" href="#" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="mdi mdi-email-open mx-0"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list">
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link count-indicator dropdown-toggle" role="button" href="#" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="mdi mdi-account-circle mx-0"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list">
							<h6 class="p-3 mb-0">Akun</h6>
							<hr class="dropdown-divider" />
							<a class="dropdown-item preview-item" href="#" data-redirect="profile">
								<div class="preview-thumbnail">
									<div class="preview-icon text-center rounded-circle">
										<i class="mdi mdi-account-box text-green"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<h6 class="preview-subject mb-0">Profil Anda</h6>
								</div>
							</a>
							<hr class="dropdown-divider" />
							<a class="dropdown-item preview-item" href="#" data-redirect="about">
								<div class="preview-thumbnail">
									<div class="preview-icon text-center rounded-circle">
										<i class="mdi mdi-information text-info"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<h6 class="preview-subject mb-0">Tentang</h6>
								</div>
							</a>
							<hr class="dropdown-divider" />
							<a class="dropdown-item preview-item" href="#" data-redirect="sign-out">
								<div class="preview-thumbnail">
									<div class="preview-icon text-center rounded-circle">
										<i class="mdi mdi-logout text-secondary"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<h6 class="preview-subject mb-0">Keluar</h6>
								</div>
							</a>
						</div>
					</li>
				</ul>
				<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                	<span class="mdi mdi-menu"></span>
                </button>
			</div>
		</nav>
