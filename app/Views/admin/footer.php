</div>
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
							<div class="text-dark order-2 order-md-1">
							</div>
							<ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
								<div class="text-dark order-2 order-md-1">
									<span class="text-muted fw-bold me-1"><span id="yeardateITB"></span>©</span>
									<a href="https://itblaster.net/" target="_blank" class="text-gray-800 text-hover-primary">ITBlaster</a>
								</div>
								<script>
								const d = new Date();
								let year = d.getFullYear();
								document.getElementById("yeardateITB").innerHTML = year;
								</script>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>var hostUrl = "<?= base_url()?>assets/";</script>
		<script src="<?= base_url()?>assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url()?>assets/js/scripts.bundle.js"></script>
		<!-- <script src="<?= base_url()?>assets/js/custom/apps/projects/project/project.js"></script> -->
		<script src="<?= base_url()?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<script src="<?= base_url()?>assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<script src="<?= base_url()?>assets/js/custom/apps/ecommerce/sales/listing.js"></script>
		<script src="<?= base_url()?>assets/js/widgets.bundle.js"></script>
		<script src="<?= base_url()?>assets/js/custom/widgets.js"></script>
		<script src="<?= base_url()?>assets/js/custom/apps/chat/chat.js"></script>
		<script src="<?= base_url()?>assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="<?= base_url()?>assets/js/custom/utilities/modals/create-app.js"></script>
		<script src="<?= base_url()?>assets/js/custom/utilities/modals/users-search.js"></script>
		<script src="<?= base_url()?>assets/js/custom/utilities/modals/new-address.js"></script>
		<script src="<?= base_url()?>assets/js/custom/apps/projects/list/list.js"></script>
		<script src="<?= base_url()?>assets/js/custom/apps/chat/chat.js"></script>
		<script src="<?= base_url()?>assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="<?= base_url()?>assets/js/custom/utilities/modals/create-app.js"></script>
		<script src="<?= base_url()?>assets/js/custom/utilities/modals/users-search.js"></script>
	</body>
</html>