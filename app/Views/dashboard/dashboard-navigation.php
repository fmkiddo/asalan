    	<div class="container-fluid page-body-wrapper">
            <div class="theme-setting-wrapper">
                <div id="settings-trigger">
                	<i class="mdi mdi-cog"></i>
            	</div>{config}
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close mdi mdi-close"></i>
                    <p class="settings-heading">{lang_text}</p>
                    <ul class="lang-options">
                    	<li class="lang-item" role="button" >
                    		<span class="lang-flag">
                    			<img src="https://flagicons.lipis.dev/flags/4x3/id.svg" alt="id" /> Bahasa
                			</span>
                		</li>
                    	<li class="lang-item" role="button" >
                    		<span class="lang-flag">
                    			<img src="https://flagicons.lipis.dev/flags/4x3/gb.svg" alt="en" /> English
                			</span>
                    	</li>
                    	<li class="lang-item" role="button" >
                    		<span class="lang-flag">
                    			<img src="https://flagicons.lipis.dev/flags/4x3/fr.svg" alt="fr" /> Français
                			</span>
                    	</li>
                    </ul>
                    <p class="settings-heading">{theme_text}</p>
                    <div role="button" class="sidebar-bg-options" id="sidebar-light-theme">
                    	<div class="img-ss rounded-circle bg-light border mr-3"></div>{light_text}
                	</div>
                    <div role="button" class="sidebar-bg-options" id="sidebar-dark-theme">
                    	<div class="img-ss rounded-circle bg-dark border mr-3"></div>{dark_text}
                	</div>
                    <p class="settings-heading mt-2">{primary_text}</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles light"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles primary"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>{/config}
    		<nav id="sidebar" class="sidebar sidebar-offcanvas">
    			<ul class="nav">
    				<li class="nav-item text-light">
    					<a role="button" class="navbar-brand brand-logo-mini" data-rediret="welcome">
    						<img src="" alt="logo" />	
    					</a>
    					<a role="button" class="navbar-brand brand-logo" data-rediret="welcome">
    						<img src="" alt="logo" />
    					</a>
    				</li>{sidebar}
    				<li class="nav-title">
    					<div class="menu-heading mt-0">{tm_sidebar}</div>
					</li>
					<li class="nav-item">
						<a role="button" class="nav-link" data-redirect="welcome">
							<i class="mdi mdi-locker-multiple menu-icon"></i>
							<span class="menu-title">{tm_dashboard}</span>
						</a>
					</li>
					<li class="nav-item">
						<a role="button" class="nav-link" data-bs-toggle="collapse" data-bs-target="#assetMenu" aria-expanded="false" aria-controls="assetMenu">
							<i class="mdi mdi-database menu-icon"></i>
							<span class="menu-title">{tm_asset}</span>
							<i class="menu-arrow"></i>
						</a>
						<div id="assetMenu" class="collapse">
							<ul class="nav flex-column sub-menu">
								<li class="nav-title">
									<div class="submenu-heading mt-0">{tsm_asset_title0}</div>
								</li>
								<hr class="nav-divider" />
								<li class="nav-item">
									<a role="button" class="nav-link" data-redirect="categories">{ts_categories}</a>
								</li>
								<li class="nav-item">
									<a role="button" class="nav-link" data-redirect="master-asset">{ts_asset}</a>
								</li>
								<li class="nav-item">
									<a role="button" class="nav-link" data-redirect="reg-asset">{ts_regasset}</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-item">
						<a role="button" class="nav-link" data-redirect="locations">
							<i class="mdi mdi-map-marker-multiple menu-icon"></i>
							<span class="menu-title">{tm_location}</span>
						</a>
					</li>
					<li class="nav-item">
						<a role="button" class="nav-link" data-bs-toggle="collapse" data-bs-target="#flowMenu" aria-expanded="false" aria-controls="flowMenu">
							<i class="mdi mdi-clipboard-flow-outline menu-icon"></i>
							<span class="menu-title">{tm_asset_flow}</span>
							<i class="menu-arrow"></i>
						</a>
						<div id="flowMenu" class="collapse">
							<ul class="nav flex-column sub-menu">
								<li class="nav-title">
									<div class="submenu-heading mt-0">{tsm_flow_title0}</div>
								</li>
								<hr class="nav-divider" />
								<li class="nav-item">
									<a role="button" class="nav-link" data-redirect="">{tsm_flow_action0}</a>
								</li>
								<li class="nav-title pt-2">
									<div class="submenu-heading mt-0">{tsm_flow_title1}</div>
								</li>
								<hr class="nav-divider" />
								<li class="nav-item">
									<a role="button" class="nav-link" data-redirect="">{tsm_flow_action1}</a>
								</li>
								<li class="nav-item">
									<a role="button" class="nav-link" data-redirect="">{tsm_flow_action2}</a>
								</li>
								<li class="nav-item">
									<a role="button" class="nav-link" data-redirect="">{tsm_flow_action3}</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="nav-item">
						<a role="button" class="nav-link" data-bs-toggle="collapse" data-bs-target="#usersMenu" aria-expanded="false" aria-controls="usersMenu">
							<i class="mdi mdi-account-group menu-icon"></i>
							<span class="menu-title">{tm_users}</span>
							<i class="menu-arrow"></i>
						</a>
						<div id="usersMenu" class="collapse">
						</div>
					</li>
					<li class="nav-item">
						<a role="button" class="nav-link" data-redirect="">
							<i class=" menu-icon"></i>
							<span class="menu-title"></span>
						</a>
					</li>
					<li class="nav-item">
						<a role="button" class="nav-link" data-redirect="documentation">
							<i class="mdi mdi-book-open-page-variant menu-icon"></i>
							<span class="menu-title">{tm_manual}</span>
						</a>
					</li>{/sidebar}
    			</ul>
    		</nav>
    		<div class="main-panel">
    			<div class="content-wrapper">
