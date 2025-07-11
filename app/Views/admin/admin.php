<?= $this->extend('/templates/administrator') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Dashboard
                <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                <span class="text-muted fs-6 fw-bold">Analytical</span></h1>
            </div>
        </div>
    </div>
	<div class="post d-flex flex-column-fluid" id="kt_post">
		<div id="kt_content_container" class="container-xxl">
			<div class="row gy-5 g-xl-8">
				<div class="col-xl-4">
					<div class="card card-xl-stretch">
						<div class="card-header border-0 bg-danger py-5">
							<h3 class="card-title fw-bolder text-white">Projects Statistics</h3>
						</div>
						<div class="card-body p-0">
							<div class="mixed-widget-2-chart card-rounded-bottom bg-danger" data-kt-color="danger" style="height: 200px"></div>
							<div class="card-p mt-n20 position-relative">
								<div class="row g-0">
									<div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
										<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor" />
												<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor" />
												<rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor" />
												<rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor" />
											</svg>
										</span>
										<a href="#" class="text-warning fw-bold fs-6">For Approval Projects</a>
									</div>
									<div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
										<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="currentColor" />
												<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="currentColor" />
											</svg>
										</span>
										<a href="#" class="text-primary fw-bold fs-6">New Projects</a>
									</div>
								</div>
								<div class="row g-0">
									<div class="col bg-light-danger px-6 py-8 rounded-2 me-7">
										<span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor" />
												<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor" />
											</svg>
										</span>
										<a href="#" class="text-danger fw-bold fs-6 mt-2">Due Projects</a>
									</div>
									<div class="col bg-light-success px-6 py-8 rounded-2">
										<span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="currentColor" />
												<path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="currentColor" />
											</svg>
										</span>
										<a href="#" class="text-success fw-bold fs-6 mt-2">Active Reports</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-8">
					<div class="card card-xl-stretch-50 mb-5 mb-xl-8">
						<!--begin::Body-->
						<div class="card-body d-flex flex-column p-0">
							<!--begin::Stats-->
							<div class="flex-grow-1 card-p pb-0">
								<div class="d-flex flex-stack flex-wrap">
									<div class="me-2">
										<a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Generate Reports</a>
										<div class="text-muted fs-7 fw-bold">Finance and accounting reports</div>
									</div>
									<div class="fw-bolder fs-3 text-primary">$24,500</div>
								</div>
							</div>
							<!--end::Stats-->
							<!--begin::Chart-->
							<div class="mixed-widget-7-chart card-rounded-bottom" data-kt-chart-color="primary" style="height: 150px"></div>
							<!--end::Chart-->
						</div>
						<!--end::Body-->
					</div>
					<div class="card card-xl-stretch-50 mb-5 mb-xl-8">
						<div class="card-body p-0 d-flex justify-content-between flex-column overflow-hidden">
							<div class="d-flex flex-stack flex-wrap flex-grow-1 px-9 pt-9 pb-3">
								<div class="me-2">
									<span class="fw-bolder text-gray-800 d-block fs-3">Projects</span>
									<span class="text-gray-400 fw-bold">Jan 1 - Aug 1 23</span>
								</div>
								<div class="fw-bolder fs-3 text-primary">$000</div>
							</div>
							<div class="mixed-widget-10-chart" data-kt-color="primary" style="height: 175px"></div>
						</div>
					</div>
				</div>
				<!--end::Col-->
			</div>
			<!--end::Row-->
			<!--begin::Row-->
			<div class="row gy-5 g-xl-8">
				<!--begin::Col-->
				<div class="col-xl-4">
					<!--begin::List Widget 3-->
					<div class="card card-xl-stretch mb-xl-8">
						<!--begin::Header-->
						<div class="card-header border-0">
							<h3 class="card-title fw-bolder text-dark">To do list</h3>
							<div class="card-toolbar">
								<!--begin::Menu-->
								<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
									<!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
									<span class="svg-icon svg-icon-2">
										<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="5" y="5" width="5" height="5" rx="1" fill="currentColor" />
												<rect x="14" y="5" width="5" height="5" rx="1" fill="currentColor" opacity="0.3" />
												<rect x="5" y="14" width="5" height="5" rx="1" fill="currentColor" opacity="0.3" />
												<rect x="14" y="14" width="5" height="5" rx="1" fill="currentColor" opacity="0.3" />
											</g>
										</svg>
									</span>
									<!--end::Svg Icon-->
								</button>
								<!--begin::Menu 3-->
								<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
									<!--begin::Heading-->
									<div class="menu-item px-3">
										<div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
									</div>
									<!--end::Heading-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Create Invoice</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link flex-stack px-3">Create Payment
										<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i></a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3">
										<a href="#" class="menu-link px-3">Generate Bill</a>
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
										<a href="#" class="menu-link px-3">
											<span class="menu-title">Subscription</span>
											<span class="menu-arrow"></span>
										</a>
										<!--begin::Menu sub-->
										<div class="menu-sub menu-sub-dropdown w-175px py-4">
											<!--begin::Menu item-->
											<div class="menu-item px-3">
												<a href="#" class="menu-link px-3">Plans</a>
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item px-3">
												<a href="#" class="menu-link px-3">Billing</a>
											</div>
											<!--end::Menu item-->
											<!--begin::Menu item-->
											<div class="menu-item px-3">
												<a href="#" class="menu-link px-3">Statements</a>
											</div>
											<!--end::Menu item-->
											<!--begin::Menu separator-->
											<div class="separator my-2"></div>
											<!--end::Menu separator-->
											<!--begin::Menu item-->
											<div class="menu-item px-3">
												<div class="menu-content px-3">
													<!--begin::Switch-->
													<label class="form-check form-switch form-check-custom form-check-solid">
														<!--begin::Input-->
														<input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
														<!--end::Input-->
														<!--end::Label-->
														<span class="form-check-label text-muted fs-6">Recuring</span>
														<!--end::Label-->
													</label>
													<!--end::Switch-->
												</div>
											</div>
											<!--end::Menu item-->
										</div>
										<!--end::Menu sub-->
									</div>
									<!--end::Menu item-->
									<!--begin::Menu item-->
									<div class="menu-item px-3 my-1">
										<a href="#" class="menu-link px-3">Settings</a>
									</div>
									<!--end::Menu item-->
								</div>
								<!--end::Menu 3-->
								<!--end::Menu-->
							</div>
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body pt-2">
							<!--begin::Item-->
							<div class="d-flex align-items-center mb-8">
								<!--begin::Bullet-->
								<span class="bullet bullet-vertical h-40px bg-success"></span>
								<!--end::Bullet-->
								<!--begin::Checkbox-->
								<div class="form-check form-check-custom form-check-solid mx-5">
									<input class="form-check-input" type="checkbox" value="" />
								</div>
								<!--end::Checkbox-->
								<!--begin::Description-->
								<div class="flex-grow-1">
									<a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Create FireStone Logo</a>
									<span class="text-muted fw-bold d-block">Due in 2 Days</span>
								</div>
								<!--end::Description-->
								<span class="badge badge-light-success fs-8 fw-bolder">New</span>
							</div>
							<!--end:Item-->
							<!--begin::Item-->
							<div class="d-flex align-items-center mb-8">
								<!--begin::Bullet-->
								<span class="bullet bullet-vertical h-40px bg-primary"></span>
								<!--end::Bullet-->
								<!--begin::Checkbox-->
								<div class="form-check form-check-custom form-check-solid mx-5">
									<input class="form-check-input" type="checkbox" value="" />
								</div>
								<!--end::Checkbox-->
								<!--begin::Description-->
								<div class="flex-grow-1">
									<a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Stakeholder Meeting</a>
									<span class="text-muted fw-bold d-block">Due in 3 Days</span>
								</div>
								<!--end::Description-->
								<span class="badge badge-light-primary fs-8 fw-bolder">New</span>
							</div>
							<!--end:Item-->
							<!--begin::Item-->
							<div class="d-flex align-items-center mb-8">
								<!--begin::Bullet-->
								<span class="bullet bullet-vertical h-40px bg-warning"></span>
								<!--end::Bullet-->
								<!--begin::Checkbox-->
								<div class="form-check form-check-custom form-check-solid mx-5">
									<input class="form-check-input" type="checkbox" value="" />
								</div>
								<!--end::Checkbox-->
								<!--begin::Description-->
								<div class="flex-grow-1">
									<a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Scoping &amp; Estimations</a>
									<span class="text-muted fw-bold d-block">Due in 5 Days</span>
								</div>
								<!--end::Description-->
								<span class="badge badge-light-warning fs-8 fw-bolder">New</span>
							</div>
							<!--end:Item-->
							<!--begin::Item-->
							<div class="d-flex align-items-center mb-8">
								<!--begin::Bullet-->
								<span class="bullet bullet-vertical h-40px bg-primary"></span>
								<!--end::Bullet-->
								<!--begin::Checkbox-->
								<div class="form-check form-check-custom form-check-solid mx-5">
									<input class="form-check-input" type="checkbox" value="" />
								</div>
								<!--end::Checkbox-->
								<!--begin::Description-->
								<div class="flex-grow-1">
									<a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">KPI App Showcase</a>
									<span class="text-muted fw-bold d-block">Due in 2 Days</span>
								</div>
								<!--end::Description-->
								<span class="badge badge-light-primary fs-8 fw-bolder">New</span>
							</div>
							<!--end:Item-->
							<!--begin::Item-->
							<div class="d-flex align-items-center mb-8">
								<!--begin::Bullet-->
								<span class="bullet bullet-vertical h-40px bg-danger"></span>
								<!--end::Bullet-->
								<!--begin::Checkbox-->
								<div class="form-check form-check-custom form-check-solid mx-5">
									<input class="form-check-input" type="checkbox" value="" />
								</div>
								<!--end::Checkbox-->
								<!--begin::Description-->
								<div class="flex-grow-1">
									<a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Project Meeting</a>
									<span class="text-muted fw-bold d-block">Due in 12 Days</span>
								</div>
								<!--end::Description-->
								<span class="badge badge-light-danger fs-8 fw-bolder">New</span>
							</div>
							<!--end:Item-->
							<!--begin::Item-->
							<div class="d-flex align-items-center">
								<!--begin::Bullet-->
								<span class="bullet bullet-vertical h-40px bg-success"></span>
								<!--end::Bullet-->
								<!--begin::Checkbox-->
								<div class="form-check form-check-custom form-check-solid mx-5">
									<input class="form-check-input" type="checkbox" value="" />
								</div>
								<!--end::Checkbox-->
								<!--begin::Description-->
								<div class="flex-grow-1">
									<a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Customers Update</a>
									<span class="text-muted fw-bold d-block">Due in 1 week</span>
								</div>
								<!--end::Description-->
								<span class="badge badge-light-success fs-8 fw-bolder">New</span>
							</div>
							<!--end:Item-->
						</div>
						<!--end::Body-->
					</div>
					<!--end:List Widget 3-->
				</div>
				<!--end::Col-->
				<!--begin::Col-->
				<div class="col-xl-8">
					<!--begin::Tables Widget 9-->
					<div class="card card-xl-stretch mb-5 mb-xl-8">
						<!--begin::Header-->
						<div class="card-header border-0 pt-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bolder fs-3 mb-1">Active Users</span>
								<span class="text-muted mt-1 fw-bold fs-7">Over 21 members</span>
							</h3>
							<div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a user">
								<a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
								<span class="svg-icon svg-icon-3">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
										<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
									</svg>
								</span>
								<!--end::Svg Icon-->New Member</a>
							</div>
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body py-3">
							<!--begin::Table container-->
							<div class="table-responsive">
								<!--begin::Table-->
								<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
									<!--begin::Table head-->
									<thead>
										<tr class="fw-bolder text-muted">
											<th class="w-25px">
												<div class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-9-check" />
												</div>
											</th>
											<th class="min-w-200px">Authors</th>
											<th class="min-w-150px">Company</th>
											<th class="min-w-150px">Progress</th>
											<th class="min-w-100px text-end">Actions</th>
										</tr>
									</thead>
									<!--end::Table head-->
									<!--begin::Table body-->
									<tbody>
										<tr>
											<td>
												<div class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input widget-9-check" type="checkbox" value="1" />
												</div>
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="symbol symbol-45px me-5">
														<img src="assets/media/avatars/300-14.jpg" alt="" />
													</div>
													<div class="d-flex justify-content-start flex-column">
														<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Ana Simmons</a>
														<span class="text-muted fw-bold text-muted d-block fs-7">HTML, JS, ReactJS</span>
													</div>
												</div>
											</td>
											<td>
												<a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">Intertico</a>
												<span class="text-muted fw-bold text-muted d-block fs-7">Web, UI/UX Design</span>
											</td>
											<td class="text-end">
												<div class="d-flex flex-column w-100 me-2">
													<div class="d-flex flex-stack mb-2">
														<span class="text-muted me-2 fs-7 fw-bold">50%</span>
													</div>
													<div class="progress h-6px w-100">
														<div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</td>
											<td>
												<div class="d-flex justify-content-end flex-shrink-0">
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
																<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
																<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
														<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
																<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
																<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input widget-9-check" type="checkbox" value="1" />
												</div>
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="symbol symbol-45px me-5">
														<img src="assets/media/avatars/300-2.jpg" alt="" />
													</div>
													<div class="d-flex justify-content-start flex-column">
														<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Jessie Clarcson</a>
														<span class="text-muted fw-bold text-muted d-block fs-7">C#, ASP.NET, MS SQL</span>
													</div>
												</div>
											</td>
											<td>
												<a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">Agoda</a>
												<span class="text-muted fw-bold text-muted d-block fs-7">Houses &amp; Hotels</span>
											</td>
											<td class="text-end">
												<div class="d-flex flex-column w-100 me-2">
													<div class="d-flex flex-stack mb-2">
														<span class="text-muted me-2 fs-7 fw-bold">70%</span>
													</div>
													<div class="progress h-6px w-100">
														<div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</td>
											<td>
												<div class="d-flex justify-content-end flex-shrink-0">
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
																<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
																<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
														<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
																<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
																<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input widget-9-check" type="checkbox" value="1" />
												</div>
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="symbol symbol-45px me-5">
														<img src="assets/media/avatars/300-5.jpg" alt="" />
													</div>
													<div class="d-flex justify-content-start flex-column">
														<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Lebron Wayde</a>
														<span class="text-muted fw-bold text-muted d-block fs-7">PHP, Laravel, VueJS</span>
													</div>
												</div>
											</td>
											<td>
												<a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">RoadGee</a>
												<span class="text-muted fw-bold text-muted d-block fs-7">Transportation</span>
											</td>
											<td class="text-end">
												<div class="d-flex flex-column w-100 me-2">
													<div class="d-flex flex-stack mb-2">
														<span class="text-muted me-2 fs-7 fw-bold">60%</span>
													</div>
													<div class="progress h-6px w-100">
														<div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</td>
											<td>
												<div class="d-flex justify-content-end flex-shrink-0">
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
																<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
																<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
														<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
																<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
																<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input widget-9-check" type="checkbox" value="1" />
												</div>
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="symbol symbol-45px me-5">
														<img src="assets/media/avatars/300-20.jpg" alt="" />
													</div>
													<div class="d-flex justify-content-start flex-column">
														<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Natali Goodwin</a>
														<span class="text-muted fw-bold text-muted d-block fs-7">Python, PostgreSQL, ReactJS</span>
													</div>
												</div>
											</td>
											<td>
												<a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">The Hill</a>
												<span class="text-muted fw-bold text-muted d-block fs-7">Insurance</span>
											</td>
											<td class="text-end">
												<div class="d-flex flex-column w-100 me-2">
													<div class="d-flex flex-stack mb-2">
														<span class="text-muted me-2 fs-7 fw-bold">50%</span>
													</div>
													<div class="progress h-6px w-100">
														<div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</td>
											<td>
												<div class="d-flex justify-content-end flex-shrink-0">
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
																<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
																<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
														<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
																<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
																<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-check form-check-sm form-check-custom form-check-solid">
													<input class="form-check-input widget-9-check" type="checkbox" value="1" />
												</div>
											</td>
											<td>
												<div class="d-flex align-items-center">
													<div class="symbol symbol-45px me-5">
														<img src="assets/media/avatars/300-23.jpg" alt="" />
													</div>
													<div class="d-flex justify-content-start flex-column">
														<a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Kevin Leonard</a>
														<span class="text-muted fw-bold text-muted d-block fs-7">HTML, JS, ReactJS</span>
													</div>
												</div>
											</td>
											<td>
												<a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">RoadGee</a>
												<span class="text-muted fw-bold text-muted d-block fs-7">Art Director</span>
											</td>
											<td class="text-end">
												<div class="d-flex flex-column w-100 me-2">
													<div class="d-flex flex-stack mb-2">
														<span class="text-muted me-2 fs-7 fw-bold">90%</span>
													</div>
													<div class="progress h-6px w-100">
														<div class="progress-bar bg-info" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
											</td>
											<td>
												<div class="d-flex justify-content-end flex-shrink-0">
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
																<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
														<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
																<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
													<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
														<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
														<span class="svg-icon svg-icon-3">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
																<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
																<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
													</a>
												</div>
											</td>
										</tr>
									</tbody>
									<!--end::Table body-->
								</table>
								<!--end::Table-->
							</div>
							<!--end::Table container-->
						</div>
						<!--begin::Body-->
					</div>
					<!--end::Tables Widget 9-->
				</div>
				<!--end::Col-->
			</div>
			<!--end::Row-->
			<!--begin::Row-->
		</div>
		<!--end::Container-->
	</div>

<script>
	// Get the current date and time in UTC
const now = new Date();

// Calculate the time zone offset for CST (UTC-6) in minutes
const cstOffset = -5 * 60;

// Adjust the time by adding the offset
now.setMinutes(now.getMinutes() + cstOffset);

// Get the individual components (year, month, day, hours, minutes, seconds)
const cstYear = now.getUTCFullYear();
const cstMonth = now.getUTCMonth() + 1; // Months are zero-indexed, so adding 1
const cstDay = now.getUTCDate();
const cstHours = now.getUTCHours();
const cstMinutes = now.getUTCMinutes();
const cstSeconds = now.getUTCSeconds();

// Format the output to display leading zeros for single-digit values
const formattedCST = `${cstYear}-${String(cstMonth).padStart(2, '0')}-${String(cstDay).padStart(2, '0')} ${String(cstHours).padStart(2, '0')}:${String(cstMinutes).padStart(2, '0')}:${String(cstSeconds).padStart(2, '0')}`;

console.log(`Current CST date and time: ${formattedCST}`);

</script>
<?= $this->endsection() ?>