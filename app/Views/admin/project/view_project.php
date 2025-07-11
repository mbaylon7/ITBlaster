<?= $this->extend('/templates/administrator') ?>
<?= $this->section('content'); 
$color = '';
if($details['project_label'] == 'Not Started'){
    $color = 'secondary';
  }elseif($details['project_label'] == 'In Progress'){
      $color = 'primary';
  }elseif($details['project_label'] == 'Completed'){
      $color = 'success';
  }elseif($details['project_label'] == 'On Hold'){
      $color = 'warning';
  }elseif($details['project_label'] == 'Cancelled'){
      $color = 'danger';
}
?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Project
                <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted">
                        <span class="text-muted">View</span>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <span class="text-muted"><?=$details['project_name']?></span>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-dark">Code: <?=$details['project_code']?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                        <!-- <?php print_r($client)?> -->
                        <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                            <?php echo $project_image = (!empty($details['project_image'])) ? 
                            '<img class="mw-50px mw-lg-75px" src="'. base_url().'uploads/files/project/'.$details['project_name'].'/'.$details['project_image'].'" alt="client profile" />' 
                            : '<img class="mw-50px mw-lg-75px" src="'. base_url().'uploads/files/'.$client['name'].'/'.$client['profile_avatar'].'" alt="client profile" />';?>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-1">
                                        <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3"><?=$details['project_name']?></a>
                                        <span class="badge badge-light-<?=$color?> me-auto"><?=$details['project_label']?></span>
                                    </div>
                                    <div class="d-flex flex-wrap mb-4 fs-7 text-gray-400"><?=$details['description']?></div>
                                    <?php if(!empty($details['allot_skills'])):?>
                                    <div class="d-flex flex-wrap fw-bold mb-2 fs-9 text-gray-400">
                                    <?php $allotSkills = $details['allot_skills'];
                                        $skillsArray = explode(',', $allotSkills);
                                       if(!empty($skillsArray)): foreach ($skillsArray as $skill):?>
                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Alloted Skill" data-bs-custom-class="tooltip-dark" class="border border-gray-300 border-dashed rounded py-1 mb-2 px-4 me-2"><?= $skill?></a>
                                        <?php endforeach; endif?>
                                    </div>
                                    <?php else: ?>
                                        No Skills Mentioned Yet
                                    <?php endif?>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-start">
                                <div class="d-flex flex-wrap">
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-4 fw-bolder"><?php
                                                $inputDateTime = new DateTime($details['due_date']);
                                                $outputDate = $inputDateTime->format("d M Y");
                                                echo $outputDate;?>
                                            </div>
                                        </div>
                                        <div class="fw-bold fs-6 text-gray-400">Due Date</div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-4 fw-bolder" data-kt-countup="true" data-kt-countup-value="<?=$project_ticket_ac?>">0</div>
                                        </div>
                                        <div class="fw-bold fs-6 text-gray-400">Open Tickets</div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="fs-4 fw-bolder" data-kt-countup="true" data-kt-countup-value="<?= preg_replace("/[^0-9]/", "", $details['project_budget']) ?>" data-kt-countup-prefix="$">0</div>
                                        </div>
                                        <div class="fw-bold fs-6 text-gray-400">Budget Spent</div>
                                    </div>
                                </div>
                                <div class="symbol-group symbol-hover mb-3">
                                    <!-- <div id="chart"></div> -->
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 w-50">
                            <div class="d-flex mb-4 justify-content-end">
                                <a href="#" class="btn btn-sm btn-bg-light btn-active-color-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">Add User</a>
                                <a href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Add Target</a>
                                <!--begin::Menu-->
                                <div class="me-0">
                                    <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="bi bi-three-dots fs-3"></i>
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
                                </div>
                                <!--end::Menu-->
                            </div>
                        </div>
                    </div>
                    <div class="separator"></div>
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary py-5 me-6 active" href="<?=base_url()?>demo1/dist/apps/projects/project.html">Overview</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link text-active-primary py-5 me-6" href="<?=base_url()?>demo1/dist/apps/projects/targets.html">Targets</a>
                        </li>
                      
                        <li class="nav-item">
                            <a class="nav-link text-active-primary py-5 me-6" href="<?=base_url()?>demo1/dist/apps/projects/budget.html">Budget</a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link text-active-primary py-5 me-6" href="<?=base_url()?>demo1/dist/apps/projects/users.html">Users</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link text-active-primary py-5 me-6" href="<?=base_url()?>demo1/dist/apps/projects/files.html">Files</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link text-active-primary py-5 me-6" href="<?=base_url()?>demo1/dist/apps/projects/activity.html">Activity</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link text-active-primary py-5 me-6" href="<?=base_url()?>demo1/dist/apps/projects/settings.html">Settings</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <!--end::Navbar-->
            <!--begin::Row-->
            <div class="row g-6 g-xl-9">
                <!--begin::Col-->
                <div class="col-lg-6">
                    <!--begin::Summary-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h3 class="fw-bolder mb-1">Tickets Summary</h3>
                                <div class="fs-6 fw-bold text-gray-400"><?=$project_ticket_dc?> Overdue Tickets</div>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-light btn-sm">View Tickets</a>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-5">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Chart-->
                                <div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
                                    <div class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
                                        <span class="fs-2qx fw-bolder"><?=$project_ticket_count?></span>
                                        <span class="fs-6 fw-bold text-gray-400">All Tickets</span>
                                    </div>
                                    <canvas id="project_overview_chart"></canvas>
                                </div>
                                <!--end::Chart-->
                                <!--begin::Labels-->
                                <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                        <div class="bullet bg-primary me-3"></div>
                                        <div class="text-gray-400">Active</div>
                                        <div class="ms-auto fw-bolder text-gray-700"><?=$project_ticket_ac?></div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                        <div class="bullet bg-success me-3"></div>
                                        <div class="text-gray-400">Completed</div>
                                        <div class="ms-auto fw-bolder text-gray-700"><?=$project_ticket_cc?></div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                        <div class="bullet bg-danger me-3"></div>
                                        <div class="text-gray-400">Overdue</div>
                                        <div class="ms-auto fw-bolder text-gray-700"><?=$project_ticket_dc?></div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center">
                                        <div class="bullet bg-gray-300 me-3"></div>
                                        <div class="text-gray-400">Yet to start</div>
                                        <div class="ms-auto fw-bolder text-gray-700"><?=$project_ticket_nc?></div>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Labels-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-bold">
                                        <div class="fs-6 text-gray-700">
                                        <a href="#" class="fw-bolder me-1">Invite New .NET Collaborators</a>to create great outstanding business to business .jsp modutr class scripts</div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Summary-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-lg-6">
                    <!--begin::Graph-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h3 class="fw-bolder mb-1">Tasks Over Time</h3>
                                <!--begin::Labels-->
                                <div class="fs-6 d-flex text-gray-400 fs-6 fw-bold">
                                    <!--begin::Label-->
                                    <div class="d-flex align-items-center me-6">
                                    <span class="menu-bullet d-flex align-items-center me-2">
                                        <span class="bullet bg-success"></span>
                                    </span>Complete</div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex align-items-center">
                                    <span class="menu-bullet d-flex align-items-center me-2">
                                        <span class="bullet bg-primary"></span>
                                    </span>Incomplete</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Labels-->
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Select-->
                                <select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-solid form-select-sm fw-bolder w-100px">
                                    <option value="1">2020 Q1</option>
                                    <option value="2">2020 Q2</option>
                                    <option value="3" selected="selected">2020 Q3</option>
                                    <option value="4">2020 Q4</option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-10 pb-0 px-5">
                            <!--begin::Chart-->
                            <div id="kt_project_overview_graph" class="card-rounded-bottom" style="height: 300px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Graph-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-lg-6">
                    <!--begin::Card-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h3 class="fw-bolder mb-1">What's on the road?</h3>
                                <div class="fs-6 text-gray-400">Total 482 participants</div>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Select-->
                                <select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-solid form-select-sm fw-bolder w-100px">
                                    <option value="1" selected="selected">Options</option>
                                    <option value="2">Option 1</option>
                                    <option value="3">Option 2</option>
                                    <option value="4">Option 3</option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-4">
                            <!--begin::Dates-->
                            <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2">
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_0">
                                        <span class="opacity-50 fs-7 fw-bold">Su</span>
                                        <span class="fs-6 fw-bolder">22</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary active" data-bs-toggle="tab" href="#kt_schedule_day_1">
                                        <span class="opacity-50 fs-7 fw-bold">Mo</span>
                                        <span class="fs-6 fw-bolder">23</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_2">
                                        <span class="opacity-50 fs-7 fw-bold">Tu</span>
                                        <span class="fs-6 fw-bolder">24</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_3">
                                        <span class="opacity-50 fs-7 fw-bold">We</span>
                                        <span class="fs-6 fw-bolder">25</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_4">
                                        <span class="opacity-50 fs-7 fw-bold">Th</span>
                                        <span class="fs-6 fw-bolder">26</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_5">
                                        <span class="opacity-50 fs-7 fw-bold">Fr</span>
                                        <span class="fs-6 fw-bolder">27</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_6">
                                        <span class="opacity-50 fs-7 fw-bold">Sa</span>
                                        <span class="fs-6 fw-bolder">28</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_7">
                                        <span class="opacity-50 fs-7 fw-bold">Su</span>
                                        <span class="fs-6 fw-bolder">29</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_8">
                                        <span class="opacity-50 fs-7 fw-bold">Mo</span>
                                        <span class="fs-6 fw-bolder">30</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_9">
                                        <span class="opacity-50 fs-7 fw-bold">Tu</span>
                                        <span class="fs-6 fw-bolder">31</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                            </ul>
                            <!--end::Dates-->
                            <!--begin::Tab Content-->
                            <div class="tab-content">
                                <!--begin::Day-->
                                <div id="kt_schedule_day_0" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">10:00 - 11:00
                                            <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Michael Walters</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">12:00 - 13:00
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Project Review &amp; Testing</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Walter White</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">10:00 - 11:00
                                            <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Sean Bean</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_1" class="tab-pane fade show active">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">16:30 - 17:30
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Kendell Trevor</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">13:00 - 14:00
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Project Review &amp; Testing</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Terry Robins</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">9:00 - 10:00
                                            <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Kendell Trevor</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_2" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">14:30 - 15:30
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Peter Marcus</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">10:00 - 11:00
                                            <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Terry Robins</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">12:00 - 13:00
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Sales Pitch Proposal</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Naomi Hayabusa</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_3" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">14:30 - 15:30
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Karina Clarke</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">9:00 - 10:00
                                            <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Karina Clarke</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">12:00 - 13:00
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Yannis Gloverson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_4" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">11:00 - 11:45
                                            <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Naomi Hayabusa</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">9:00 - 10:00
                                            <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Karina Clarke</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">9:00 - 10:00
                                            <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Terry Robins</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_5" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">12:00 - 13:00
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Sean Bean</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">11:00 - 11:45
                                            <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Peter Marcus</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">13:00 - 14:00
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Yannis Gloverson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_6" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">13:00 - 14:00
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Lunch &amp; Learn Catch Up</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Peter Marcus</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">10:00 - 11:00
                                            <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Yannis Gloverson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">12:00 - 13:00
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">David Stevenson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_7" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">10:00 - 11:00
                                            <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">David Stevenson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">16:30 - 17:30
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Terry Robins</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">12:00 - 13:00
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Mark Randall</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_8" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">13:00 - 14:00
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Project Review &amp; Testing</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Walter White</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">16:30 - 17:30
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Sales Pitch Proposal</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Naomi Hayabusa</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">16:30 - 17:30
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Yannis Gloverson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_9" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">11:00 - 11:45
                                            <span class="fs-7 text-gray-400 text-uppercase">am</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Bob Harris</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">14:30 - 15:30
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Kendell Trevor</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-8">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-bold ms-5 text-gray-600">
                                            <!--begin::Time-->
                                            <div class="fs-5">16:30 - 17:30
                                            <span class="fs-7 text-gray-400 text-uppercase">pm</span></div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bolder text-gray-800 text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="text-gray-400">Lead by
                                            <a href="#">Mark Randall</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-lg-6">
                    <!--begin::Card-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h3 class="fw-bolder mb-1">Latest Files</h3>
                                <div class="fs-6 text-gray-400">Total 382 fiels, 2,6GB space usage</div>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View All</a>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-3">
                            <!--begin::Files-->
                            <div class="d-flex flex-column mb-9">
                                <!--begin::File-->
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::Icon-->
                                    <div class="symbol symbol-30px me-5">
                                        <img alt="Icon" src="<?=base_url()?>assets/media/svg/files/pdf.svg" />
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Details-->
                                    <div class="fw-bold">
                                        <a class="fs-6 fw-bolder text-dark text-hover-primary" href="#">Project tech requirements</a>
                                        <div class="text-gray-400">2 days ago
                                        <a href="#">Karina Clark</a></div>
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Menu-->
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                        <span class="svg-icon svg-icon-3">
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
                                    <!--begin::Menu 1-->
                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62444587d084c">
                                        <!--begin::Header-->
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Menu separator-->
                                        <div class="separator border-gray-200"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Form-->
                                        <div class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Status:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_62444587d084c" data-allow-clear="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="2">In Process</option>
                                                        <option value="2">Rejected</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Member Type:</label>
                                                <!--end::Label-->
                                                <!--begin::Options-->
                                                <div class="d-flex">
                                                    <!--begin::Options-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                        <span class="form-check-label">Author</span>
                                                    </label>
                                                    <!--end::Options-->
                                                    <!--begin::Options-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                        <span class="form-check-label">Customer</span>
                                                    </label>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Notifications:</label>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                    <label class="form-check-label">Enabled</label>
                                                </div>
                                                <!--end::Switch-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                                <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Menu 1-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::File-->
                                <!--begin::File-->
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::Icon-->
                                    <div class="symbol symbol-30px me-5">
                                        <img alt="Icon" src="<?=base_url()?>assets/media/svg/files/doc.svg" />
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Details-->
                                    <div class="fw-bold">
                                        <a class="fs-6 fw-bolder text-dark text-hover-primary" href="#">Create FureStibe branding proposal</a>
                                        <div class="text-gray-400">Due in 1 day
                                        <a href="#">Marcus Blake</a></div>
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Menu-->
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                        <span class="svg-icon svg-icon-3">
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
                                    <!--begin::Menu 1-->
                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62444587d0a7d">
                                        <!--begin::Header-->
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Menu separator-->
                                        <div class="separator border-gray-200"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Form-->
                                        <div class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Status:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_62444587d0a7d" data-allow-clear="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="2">In Process</option>
                                                        <option value="2">Rejected</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Member Type:</label>
                                                <!--end::Label-->
                                                <!--begin::Options-->
                                                <div class="d-flex">
                                                    <!--begin::Options-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                        <span class="form-check-label">Author</span>
                                                    </label>
                                                    <!--end::Options-->
                                                    <!--begin::Options-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                        <span class="form-check-label">Customer</span>
                                                    </label>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Notifications:</label>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                    <label class="form-check-label">Enabled</label>
                                                </div>
                                                <!--end::Switch-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                                <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Menu 1-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::File-->
                                <!--begin::File-->
                                <div class="d-flex align-items-center mb-5">
                                    <!--begin::Icon-->
                                    <div class="symbol symbol-30px me-5">
                                        <img alt="Icon" src="<?=base_url()?>assets/media/svg/files/css.svg" />
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Details-->
                                    <div class="fw-bold">
                                        <a class="fs-6 fw-bolder text-dark text-hover-primary" href="#">Completed Project Stylings</a>
                                        <div class="text-gray-400">Due in 1 day
                                        <a href="#">Terry Barry</a></div>
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Menu-->
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                        <span class="svg-icon svg-icon-3">
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
                                    <!--begin::Menu 1-->
                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62444587d0ca2">
                                        <!--begin::Header-->
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Menu separator-->
                                        <div class="separator border-gray-200"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Form-->
                                        <div class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Status:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_62444587d0ca2" data-allow-clear="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="2">In Process</option>
                                                        <option value="2">Rejected</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Member Type:</label>
                                                <!--end::Label-->
                                                <!--begin::Options-->
                                                <div class="d-flex">
                                                    <!--begin::Options-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                        <span class="form-check-label">Author</span>
                                                    </label>
                                                    <!--end::Options-->
                                                    <!--begin::Options-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                        <span class="form-check-label">Customer</span>
                                                    </label>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Notifications:</label>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                    <label class="form-check-label">Enabled</label>
                                                </div>
                                                <!--end::Switch-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                                <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Menu 1-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::File-->
                                <!--begin::File-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Icon-->
                                    <div class="symbol symbol-30px me-5">
                                        <img alt="Icon" src="<?=base_url()?>assets/media/svg/files/ai.svg" />
                                    </div>
                                    <!--end::Icon-->
                                    <!--begin::Details-->
                                    <div class="fw-bold">
                                        <a class="fs-6 fw-bolder text-dark text-hover-primary" href="#">Create Project Wireframes</a>
                                        <div class="text-gray-400">Due in 3 days
                                        <a href="#">Roth Bloom</a></div>
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Menu-->
                                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                        <span class="svg-icon svg-icon-3">
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
                                    <!--begin::Menu 1-->
                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62444587d0ec3">
                                        <!--begin::Header-->
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Menu separator-->
                                        <div class="separator border-gray-200"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Form-->
                                        <div class="px-7 py-5">
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Status:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_62444587d0ec3" data-allow-clear="true">
                                                        <option></option>
                                                        <option value="1">Approved</option>
                                                        <option value="2">Pending</option>
                                                        <option value="2">In Process</option>
                                                        <option value="2">Rejected</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Member Type:</label>
                                                <!--end::Label-->
                                                <!--begin::Options-->
                                                <div class="d-flex">
                                                    <!--begin::Options-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                        <input class="form-check-input" type="checkbox" value="1" />
                                                        <span class="form-check-label">Author</span>
                                                    </label>
                                                    <!--end::Options-->
                                                    <!--begin::Options-->
                                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                        <span class="form-check-label">Customer</span>
                                                    </label>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-bold">Notifications:</label>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                    <label class="form-check-label">Enabled</label>
                                                </div>
                                                <!--end::Switch-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                                <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Menu 1-->
                                    <!--end::Menu-->
                                </div>
                                <!--end::File-->
                            </div>
                            <!--end::Files-->
                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6">
                                <!--begin::Icon-->
                                <!--begin::Svg Icon | path: svg/files/upload.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="67" height="67" viewBox="0 0 67 67" fill="none">
                                        <path opacity="0.25" d="M8.375 11.167C8.375 6.54161 12.1246 2.79199 16.75 2.79199H43.9893C46.2105 2.79199 48.3407 3.67436 49.9113 5.24497L56.172 11.5057C57.7426 13.0763 58.625 15.2065 58.625 17.4277V55.8337C58.625 60.459 54.8754 64.2087 50.25 64.2087H16.75C12.1246 64.2087 8.375 60.459 8.375 55.8337V11.167Z" fill="#00A3FF" />
                                        <path d="M41.875 5.28162C41.875 3.90663 42.9896 2.79199 44.3646 2.79199V2.79199C46.3455 2.79199 48.2452 3.57889 49.6459 4.97957L56.4374 11.7711C57.8381 13.1718 58.625 15.0715 58.625 17.0524V17.0524C58.625 18.4274 57.5104 19.542 56.1354 19.542H44.6667C43.1249 19.542 41.875 18.2921 41.875 16.7503V5.28162Z" fill="#00A3FF" />
                                        <path d="M32.4311 25.3368C32.1018 25.4731 31.7933 25.675 31.5257 25.9427L23.1507 34.3177C22.0605 35.4079 22.0605 37.1755 23.1507 38.2657C24.2409 39.3559 26.0085 39.3559 27.0987 38.2657L30.708 34.6563V47.4583C30.708 49.0001 31.9579 50.25 33.4997 50.25C35.0415 50.25 36.2913 49.0001 36.2913 47.4583V34.6563L39.9007 38.2657C40.9909 39.3559 42.7585 39.3559 43.8487 38.2657C44.9389 37.1755 44.9389 35.4079 43.8487 34.3177L35.4737 25.9427C34.6511 25.1201 33.443 24.9182 32.4311 25.3368Z" fill="#00A3FF" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Icon-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-bold">
                                        <h4 class="text-gray-900 fw-bolder">Quick file uploader</h4>
                                        <div class="fs-6 text-gray-700">Drag &amp; Drop or choose files from computer</div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Card body -->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-lg-6">
                    <!--begin::Card-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h3 class="fw-bolder mb-1">New Contibutors</h3>
                                <div class="fs-6 text-gray-400">From total 482 Participants</div>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View All</a>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column p-9 pt-3 mb-9">
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-5">
                                <!--begin::Avatar-->
                                <div class="me-5 position-relative">
                                    <!--begin::Image-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-6.jpg" />
                                    </div>
                                    <!--end::Image-->
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary">Emma Smith</a>
                                    <div class="text-gray-400">8 Pending &amp; 97 Completed Tasks</div>
                                </div>
                                <!--end::Details-->
                                <!--begin::Badge-->
                                <div class="badge badge-light ms-auto">5</div>
                                <!--end::Badge-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-5">
                                <!--begin::Avatar-->
                                <div class="me-5 position-relative">
                                    <!--begin::Image-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <span class="symbol-label bg-light-danger text-danger fw-bold">M</span>
                                    </div>
                                    <!--end::Image-->
                                    <!--begin::Online-->
                                    <div class="bg-success position-absolute h-8px w-8px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                    <!--end::Online-->
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary">Melody Macy</a>
                                    <div class="text-gray-400">5 Pending &amp; 84 Completed</div>
                                </div>
                                <!--end::Details-->
                                <!--begin::Badge-->
                                <div class="badge badge-light ms-auto">8</div>
                                <!--end::Badge-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-5">
                                <!--begin::Avatar-->
                                <div class="me-5 position-relative">
                                    <!--begin::Image-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-1.jpg" />
                                    </div>
                                    <!--end::Image-->
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary">Max Smith</a>
                                    <div class="text-gray-400">9 Pending &amp; 103 Completed</div>
                                </div>
                                <!--end::Details-->
                                <!--begin::Badge-->
                                <div class="badge badge-light ms-auto">9</div>
                                <!--end::Badge-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-5">
                                <!--begin::Avatar-->
                                <div class="me-5 position-relative">
                                    <!--begin::Image-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-5.jpg" />
                                    </div>
                                    <!--end::Image-->
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary">Sean Bean</a>
                                    <div class="text-gray-400">3 Pending &amp; 55 Completed</div>
                                </div>
                                <!--end::Details-->
                                <!--begin::Badge-->
                                <div class="badge badge-light ms-auto">3</div>
                                <!--end::Badge-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center">
                                <!--begin::Avatar-->
                                <div class="me-5 position-relative">
                                    <!--begin::Image-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-25.jpg" />
                                    </div>
                                    <!--end::Image-->
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary">Brian Cox</a>
                                    <div class="text-gray-400">4 Pending &amp; 115 Completed</div>
                                </div>
                                <!--end::Details-->
                                <!--begin::Badge-->
                                <div class="badge badge-light ms-auto">4</div>
                                <!--end::Badge-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-lg-6">
                    <!--begin::Tasks-->
                    <div class="card card-flush h-lg-100">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h3 class="fw-bolder mb-1">My Tasks</h3>
                                <div class="fs-6 text-gray-400">Total 25 tasks in backlog</div>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View All</a>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column mb-9 p-9 pt-3">
                            <!--begin::Item-->
                            <div class="d-flex align-items-center position-relative mb-7">
                                <!--begin::Label-->
                                <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                <!--end::Label-->
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid ms-6 me-4">
                                    <input class="form-check-input" type="checkbox" value="" />
                                </div>
                                <!--end::Checkbox-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a href="#" class="fs-6 fw-bolder text-gray-900 text-hover-primary">Create FureStibe branding logo</a>
                                    <!--begin::Info-->
                                    <div class="text-gray-400">Due in 1 day
                                    <a href="#">Karina Clark</a></div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-3">
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
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62444587d1c9e">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_62444587d1c9e" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <div class="d-flex">
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center position-relative mb-7">
                                <!--begin::Label-->
                                <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                <!--end::Label-->
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid ms-6 me-4">
                                    <input class="form-check-input" type="checkbox" value="" />
                                </div>
                                <!--end::Checkbox-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a href="#" class="fs-6 fw-bolder text-gray-900 text-hover-primary">Schedule a meeting with FireBear CTO John</a>
                                    <!--begin::Info-->
                                    <div class="text-gray-400">Due in 3 days
                                    <a href="#">Rober Doe</a></div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-3">
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
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62444587d1f11">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_62444587d1f11" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <div class="d-flex">
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center position-relative mb-7">
                                <!--begin::Label-->
                                <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                <!--end::Label-->
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid ms-6 me-4">
                                    <input class="form-check-input" type="checkbox" value="" />
                                </div>
                                <!--end::Checkbox-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a href="#" class="fs-6 fw-bolder text-gray-900 text-hover-primary">9 Degree Porject Estimation</a>
                                    <!--begin::Info-->
                                    <div class="text-gray-400">Due in 1 week
                                    <a href="#">Neil Owen</a></div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-3">
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
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62444587d2135">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_62444587d2135" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <div class="d-flex">
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center position-relative mb-7">
                                <!--begin::Label-->
                                <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                <!--end::Label-->
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid ms-6 me-4">
                                    <input class="form-check-input" type="checkbox" value="" />
                                </div>
                                <!--end::Checkbox-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a href="#" class="fs-6 fw-bolder text-gray-900 text-hover-primary">Dashgboard UI &amp; UX for Leafr CRM</a>
                                    <!--begin::Info-->
                                    <div class="text-gray-400">Due in 1 week
                                    <a href="#">Olivia Wild</a></div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-3">
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
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62444587d2357">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_62444587d2357" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <div class="d-flex">
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center position-relative">
                                <!--begin::Label-->
                                <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                <!--end::Label-->
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid ms-6 me-4">
                                    <input class="form-check-input" type="checkbox" value="" />
                                </div>
                                <!--end::Checkbox-->
                                <!--begin::Details-->
                                <div class="fw-bold">
                                    <a href="#" class="fs-6 fw-bolder text-gray-900 text-hover-primary">Mivy App R&amp;D, Meeting with clients</a>
                                    <!--begin::Info-->
                                    <div class="text-gray-400">Due in 2 weeks
                                    <a href="#">Sean Bean</a></div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-3">
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
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62444587d257c">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_62444587d257c" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <div class="d-flex">
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Tasks-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Table-->
            <div class="card card-flush mt-6 mt-xl-9">
                <!--begin::Card header-->
                <div class="card-header mt-5">
                    <!--begin::Card title-->
                    <div class="card-title flex-column">
                        <h3 class="fw-bolder mb-1">Tickets</h3>
                        <!-- <div class="fs-6 text-gray-400">Total $260,300 sepnt so far</div> -->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar my-1">
                        <!--begin::Select-->
                        <div class="me-6 my-1">
                            <select id="kt_filter_year" name="year" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                                <option value="All" selected="selected">All time</option>
                                <option value="thisyear">This year</option>
                                <option value="thismonth">This month</option>
                                <option value="lastmonth">Last month</option>
                                <option value="last90days">Last 90 days</option>
                            </select>
                        </div>
                        <!--end::Select-->
                        <!--begin::Select-->
                        <div class="me-4 my-1">
                            <select id="kt_filter_orders" name="orders" data-control="select2" data-hide-search="true" class="w-125px form-select form-select-solid form-select-sm">
                                <option value="All" selected="selected">All Orders</option>
                                <option value="Approved">Approved</option>
                                <option value="Declined">Declined</option>
                                <option value="In Progress">In Progress</option>
                                <option value="In Transit">In Transit</option>
                            </select>
                        </div>
                        <!--end::Select-->
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-3 position-absolute ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" id="kt_filter_search" class="form-control form-control-solid form-select-sm w-150px ps-9" placeholder="Search Order" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table id="kt_profile_overview_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">
                            <!--begin::Head-->
                            <thead class="fs-7 text-gray-400 text-uppercase">
                                <tr>
                                    <th class="min-w-250px">Manager</th>
                                    <th class="min-w-150px">Date</th>
                                    <th class="min-w-90px">Amount</th>
                                    <th class="min-w-90px">Status</th>
                                    <th class="min-w-50px text-end">Details</th>
                                </tr>
                            </thead>
                            <!--end::Head-->
                            <!--begin::Body-->
                            <tbody class="fs-6">
                                <tr>
                                    <td>
                                        <!--begin::User-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Wrapper-->
                                            <div class="me-5 position-relative">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-6.jpg" />
                                                </div>
                                                <!--end::Avatar-->
                                            </div>
                                            <!--end::Wrapper-->
                                            <!--begin::Info-->
                                            <div class="d-flex flex-column justify-content-center">
                                                <a href="" class="fs-6 text-gray-800 text-hover-primary">Emma Smith</a>
                                                <div class="fw-bold text-gray-400">smith@kpmg.com</div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::User-->
                                    </td>
                                    <td>Mar 10, 2022</td>
                                    <td>$527.00</td>
                                    <td>
                                        <span class="badge badge-light-danger fw-bolder px-4 py-3">Rejected</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-light btn-sm">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <!--begin::User-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Wrapper-->
                                            <div class="me-5 position-relative">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <span class="symbol-label bg-light-danger text-danger fw-bold">M</span>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Online-->
                                                <div class="bg-success position-absolute h-8px w-8px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                                <!--end::Online-->
                                            </div>
                                            <!--end::Wrapper-->
                                            <!--begin::Info-->
                                            <div class="d-flex flex-column justify-content-center">
                                                <a href="" class="fs-6 text-gray-800 text-hover-primary">Melody Macy</a>
                                                <div class="fw-bold text-gray-400">melody@altbox.com</div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::User-->
                                    </td>
                                    <td>Dec 20, 2022</td>
                                    <td>$992.00</td>
                                    <td>
                                        <span class="badge badge-light-success fw-bolder px-4 py-3">Approved</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-light btn-sm">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <!--begin::User-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Wrapper-->
                                            <div class="me-5 position-relative">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-1.jpg" />
                                                </div>
                                                <!--end::Avatar-->
                                            </div>
                                            <!--end::Wrapper-->
                                            <!--begin::Info-->
                                            <div class="d-flex flex-column justify-content-center">
                                                <a href="" class="fs-6 text-gray-800 text-hover-primary">Max Smith</a>
                                                <div class="fw-bold text-gray-400">max@kt.com</div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::User-->
                                    </td>
                                    <td>Oct 25, 2022</td>
                                    <td>$405.00</td>
                                    <td>
                                        <span class="badge badge-light-info fw-bolder px-4 py-3">In progress</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-light btn-sm">View</a>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <script src="<?= base_url()?>assets/js/scripts.bundle.js"></script>
    <script>
        "use strict";

        var KTProjectOverview = function () {
            var t = KTUtil.getCssVariableValue("--bs-primary"),
                e = KTUtil.getCssVariableValue("--bs-light-primary"),
                a = KTUtil.getCssVariableValue("--bs-success"),
                r = KTUtil.getCssVariableValue("--bs-light-success"),
                o = KTUtil.getCssVariableValue("--bs-gray-200"),
                n = KTUtil.getCssVariableValue("--bs-gray-500");

            return {
                init: function () {
                    var s, i;

                    // Chart initialization
                    (function () {
                        var t = document.getElementById("project_overview_chart");
                        if (t) {
                            var e = t.getContext("2d");
                            new Chart(e, {
                                type: "doughnut",
                                data: {
                                    datasets: [{
                                        data: [<?=$project_ticket_ac?>, <?=$project_ticket_cc?>, <?=$project_ticket_nc?>, <?=$project_ticket_dc?>],
                                        backgroundColor: ["#00A3FF", "#50CD89", "#E4E6EF", "#f1416c"]
                                    }],
                                    labels: ["Active", "Completed", "Yet to start", "Dued"]
                                },
                                options: {
                                    chart: { fontFamily: "inherit" },
                                    cutoutPercentage: 75,
                                    responsive: !0,
                                    maintainAspectRatio: !1,
                                    cutout: "75%",
                                    title: { display: !1 },
                                    animation: { animateScale: !0, animateRotate: !0 },
                                    tooltips: {
                                        enabled: !0,
                                        intersect: !1,
                                        mode: "nearest",
                                        bodySpacing: 5,
                                        yPadding: 10,
                                        xPadding: 10,
                                        caretPadding: 0,
                                        displayColors: !1,
                                        backgroundColor: "#20D489",
                                        titleFontColor: "#ffffff",
                                        cornerRadius: 4,
                                        footerSpacing: 0,
                                        titleSpacing: 0
                                    },
                                    plugins: { legend: { display: !1 } }
                                }
                            });
                        }
                    })();

                    // ApexCharts initialization
                    s = document.getElementById("kt_project_overview_graph");
                    i = parseInt(KTUtil.css(s, "height"));
                    if (s) {
                        new ApexCharts(s, {
                            series: [
                                { name: "Incomplete", data: [70, 70, 80, 80, 75, 75, 75] },
                                { name: "Complete", data: [55, 55, 60, 160, 55, 55, 60] }
                            ],
                            chart: { type: "area", height: i, toolbar: { show: !1 } },
                            plotOptions: {},
                            legend: { show: !1 },
                            dataLabels: { enabled: !1 },
                            fill: { type: "solid", opacity: 1 },
                            stroke: {
                                curve: "smooth",
                                show: !0,
                                width: 3,
                                colors: [t, a]
                            },
                            xaxis: {
                                categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug"],
                                axisBorder: { show: !1 },
                                axisTicks: { show: !1 },
                                labels: { style: { colors: n, fontSize: "12px" } },
                                crosshairs: {
                                    position: "front",
                                    stroke: { color: t, width: 1, dashArray: 3 }
                                },
                                tooltip: {
                                    enabled: !0,
                                    formatter: void 0,
                                    offsetY: 0,
                                    style: { fontSize: "12px" }
                                }
                            },
                            yaxis: { labels: { style: { colors: n, fontSize: "12px" } } },
                            states: {
                                normal: { filter: { type: "none", value: 0 } },
                                hover: { filter: { type: "none", value: 0 } },
                                active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } }
                            },
                            tooltip: {
                                style: { fontSize: "12px" },
                                y: { formatter: function (t) { return t + " tasks"; } }
                            },
                            colors: [e, r],
                            grid: {
                                borderColor: o,
                                strokeDashArray: 4,
                                yaxis: { lines: { show: !0 } }
                            },
                            markers: { colors: [e, r], strokeColor: [t, a], strokeWidth: 3 }
                        }).render();
                    }

                    // DataTable initialization
                    (function () {
                        var t = document.querySelector("#kt_profile_overview_table");
                        if (!t) return;

                        t.querySelectorAll("tbody tr").forEach((t) => {
                            const e = t.querySelectorAll("td"),
                                a = moment(e[1].innerHTML, "MMM D, YYYY").format();
                            e[1].setAttribute("data-order", a);
                        });

                        const e = $(t).DataTable({ info: !1, order: [] }),
                            a = document.getElementById("kt_filter_orders"),
                            r = document.getElementById("kt_filter_year");
                        var o, n;

                        a.addEventListener("change", function (t) {
                            e.column(3).search(t.target.value).draw();
                        });

                        r.addEventListener("change", function (t) {
                            switch (t.target.value) {
                                case "thisyear":
                                    o = moment().startOf("year").format();
                                    n = moment().endOf("year").format();
                                    e.draw();
                                    break;
                                case "thismonth":
                                    o = moment().startOf("month").format();
                                    n = moment().endOf("month").format();
                                    e.draw();
                                    break;
                                case "lastmonth":
                                    o = moment().subtract(1, "months").startOf("month").format();
                                    n = moment().subtract(1, "months").endOf("month").format();
                                    e.draw();
                                    break;
                                case "last90days":
                                    o = moment().subtract(30, "days").format();
                                    n = moment().format();
                                    e.draw();
                                    break;
                                default:
                                    o = moment().subtract(100, "years").startOf("month").format();
                                    n = moment().add(1, "months").endOf("month").format();
                                    e.draw();
                            }
                        });

                        $.fn.dataTable.ext.search.push(function (t, e, a) {
                            var r = o,
                                s = n,
                                i = parseFloat(moment(e[1]).format()) || 0;
                            return isNaN(r) && isNaN(s) || isNaN(r) && i <= s || r <= i && isNaN(s) || r <= i && i <= s;
                        });

                        document.getElementById("kt_filter_search").addEventListener("keyup", function (t) {
                            e.search(t.target.value).draw();
                        });
                    })();
                }
            };
        }();

        KTUtil.onDOMContentLoaded(function () {
            KTProjectOverview.init();
        });
    </script>
<?= $this->endsection() ?>