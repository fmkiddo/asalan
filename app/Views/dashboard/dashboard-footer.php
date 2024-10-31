    			</div>
            	<footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {year} <a href="https://github.com/fmkiddo/" target="_blank">FMKiddo</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted &amp; made with <i class="mdi mdi-heart text-danger"></i></span>
                    </div>
            	</footer>
    		</div>
    	</div>
	</div>
	<div class="modal fade" id="logoutConfirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi Logout</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>Anda akan logout?</p>
				</div>
				<div class="modal-footer text-end">
					<button type="button" class="btn btn-lg btn-primary" id="doSignOut">
						<span>Ya</span>
					</button>
					<button type="button" class="btn btn-lg btn-primary" data-bs-dismiss="modal" aria-label="Close">
						<span>Batal</span>
					</button>
				</div>
			</div>
		</div>
	</div>{scripts}
	<script src="{baseURL}{url}"></script>{/scripts}
</body>
</html>
