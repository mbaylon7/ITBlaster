<?= $this->extend('/templates/administrator') ?>
<?= $this->section('content') ?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Profile
                <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                <span class="text-muted fs-6 fw-bold px-2"> <?=$profile['name']?></span></h1>
            </div>
        </div>
    </div>
    <?php 
    //  print_r($owned_tickets); echo $owned_ticket;?>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <?php if(!empty($profile['profile_avatar'])): ?>
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="<?= base_url()?>uploads/files/<?=$profile['name']?>/<?=$profile['profile_avatar']?>" alt="image" />
                                <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                            </div>
                        </div>
                        <?php else:?> 
                            <div class="me-7 mb-4">  
                                <div class="symbol symbol-lg-160px" data-bs-toggle="tooltip" title="" data-bs-custom-class="tooltip-dark">
                                    <span class="symbol-label symbol-circle bg-warning text-inverse-warning fw-bolder" style="font-size:5em"><?= substr($profile['name'] ,0,1)?></span>
                                </div> 
                            </div> 
                        <?php endif?>    
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <span href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1"><?= $profile['name']?></span>
                                        <?php if($profile['is_verified'] != 'Yes'):?>
                                            <i data-bs-toggle="tooltip" data-bs-placement="top" title="Not Verified" data-bs-custom-class="tooltip-dark" class="bi bi-patch-check fs-1 text-secondary px-2"></i>
                                        <?php else:?> 
                                            <i data-bs-toggle="tooltip" data-bs-placement="top" title="Verified" data-bs-custom-class="tooltip-dark" class="bi bi-patch-check fs-1 text-success px-2"></i>
                                        <?php endif?>     
                                    </div>
                                    <div class="d-flex align-items-center mb-4">
                                        <a href="#" class="btn btn-sm btn-light-warning fw-bolder fs-8 py-1" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">Gold Tier</a>
                                    </div>
                                    <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <i data-bs-toggle="tooltip" data-bs-placement="top" title="Verified" data-bs-custom-class="tooltip-dark" class="bi bi-briefcase fs-3 text-gray-600 fw-bolder"></i>
                                                <span class="px-2 fs-6"><?= $profile['user_position']?></span>
                                        </a>
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <i data-bs-toggle="tooltip" data-bs-placement="top" title="Verified" data-bs-custom-class="tooltip-dark" class="bi bi-envelope fs-3 text-gray-600 fw-bolder"></i>
                                                <span class="px-2 fs-6"><?= $profile['email']?></span>
                                        </a>
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                            <i data-bs-toggle="tooltip" data-bs-placement="top" title="Verified" data-bs-custom-class="tooltip-dark" class="bi bi-telephone fs-3 text-gray-600 fw-bolder"></i>
                                                <span class="px-2 fs-6"><?= $profile['contactnumber']?></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex my-4">
                                    <!-- <a href="#" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                                        <span class="svg-icon svg-icon-3 d-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M10 18C9.7 18 9.5 17.9 9.3 17.7L2.3 10.7C1.9 10.3 1.9 9.7 2.3 9.3C2.7 8.9 3.29999 8.9 3.69999 9.3L10.7 16.3C11.1 16.7 11.1 17.3 10.7 17.7C10.5 17.9 10.3 18 10 18Z" fill="currentColor" />
                                                <path d="M10 18C9.7 18 9.5 17.9 9.3 17.7C8.9 17.3 8.9 16.7 9.3 16.3L20.3 5.3C20.7 4.9 21.3 4.9 21.7 5.3C22.1 5.7 22.1 6.30002 21.7 6.70002L10.7 17.7C10.5 17.9 10.3 18 10 18Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <span class="indicator-label">Follow</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </a> -->
                                    <a href="#" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#kt_modal_offer_a_deal">Hire Me</a>
                                    <!-- <div class="me-0">
                                        <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="bi bi-three-dots fs-3"></i>
                                        </button>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Create Invoice</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link flex-stack px-3">Create Payment
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i></a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Generate Bill</a>
                                            </div>
                                            <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
                                                <a href="#" class="menu-link px-3">
                                                    <span class="menu-title">Subscription</span>
                                                    <span class="menu-arrow"></span>
                                                </a>
                                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Plans</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Billing</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3">Statements</a>
                                                    </div>
                                                    <div class="separator my-2"></div>
                                                    <div class="menu-item px-3">
                                                        <div class="menu-content px-3">
                                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
                                                                <span class="form-check-label text-muted fs-6">Recuring</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="menu-item px-3 my-1">
                                                <a href="#" class="menu-link px-3">Settings</a>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="d-flex flex-wrap flex-stack">
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <div class="d-flex flex-wrap">
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="fs-4 fw-bolder">Profile Description</div>
                                            </div>
                                            <div class="fw-bold fs-7 text-gray-600"><?= $profile['introduction']?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                        <span class="fw-bold fs-6 text-gray-400">Profile Completion</span>
                                        <span class="fw-bolder fs-6"><?=$completion_percentage?>%</span>
                                    </div>
                                    <div class="h-5px mx-3 w-100 bg-light mb-3">
                                        <div class="bg-success rounded h-5px" role="progressbar" style="width: <?=$completion_percentage?>%;" aria-valuenow="<?=$completion_percentage?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bolder">
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="#">Overview</a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" href="#">Projects</a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" href="#l">Settings</a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" href="#">Activities</a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" href="#">Logs</a>
                        </li>
                    </ul>
                </div>
            </div>
           
   
            <div class="row gy-5 g-xl-10">
                <div class="col-xl-4">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-7">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark">Open Tickets</span>
                                <span class="text-gray-400 mt-1 fw-bold fs-7">Total of <?=$owned_ticket?> Active tickets</span>
                            </h3>
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-sm btn-light">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 415px">
                                <?php if(!empty($owned_tickets)): foreach($owned_tickets as $oticket): 
                                     if($oticket['ticket_label'] == 'Not Started'){
                                        $label = 'secondary';
                                    }elseif($oticket['ticket_label'] == 'In Progress'){
                                        $label = 'primary';
                                    }elseif($oticket['ticket_label'] == 'On Hold'){
                                        $label = 'warning';
                                    }elseif($oticket['ticket_label'] == 'Cancelled'){
                                        $label = 'danger';
                                    }elseif($oticket['ticket_label'] == 'Completed'){
                                      $label = 'success';
                                    }
                                    $color = '';
                                    $priority = '';
                                    if($oticket['ticket_priority_label'] == 'Low'){
                                      $color = 'secondary';
                                      $priority = '<span class="px-2"><i class="bi bi-flag-fill text-'.$color.'" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" title="'.$oticket['ticket_priority_label'].'"></i></span>';
                                    }if($oticket['ticket_priority_label'] == 'Moderate'){
                                      $color = 'success';
                                      $priority = '<span class="px-2"><i class="bi bi-flag-fill text-'.$color.'" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" title="'.$oticket['ticket_priority_label'].'"></i></span>';
                                    }if($oticket['ticket_priority_label'] == 'High'){
                                      $color = 'warning';
                                      $priority = '<span class="px-2"><i class="bi bi-flag-fill text-'.$color.'" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" title="'.$oticket['ticket_priority_label'].'"></i></span>';
                                    }if($oticket['ticket_priority_label'] == 'Very High'){
                                      $color = 'danger';
                                      $priority = '<span class="px-2"><i class="bi bi-flag-fill text-'.$color.'" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" title="'.$data['ticket_priority_label'].'"></i></span>';
                                    }
                                    ?>            
                                <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                    <div class="d-flex flex-stack mb-3">
                                        <div class="me-3 text-ellipsis">
                                            <img src="assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                            <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder"><?=$oticket['ticket_title']?></a>
                                        </div>
                                        <div class="m-0">
                                            <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                <span class="svg-icon svg-icon-1" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" title="Quick Actions">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                                                        <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                        <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                        <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </button>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">
                                                <div class="menu-item px-3">
                                                    <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Quick Actions</div>
                                                </div>
                                                <div class="separator mb-3 opacity-75"></div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">New Ticket</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">New Comment</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">New File</a>
                                                </div>
                                                <div class="separator mt-3 opacity-75"></div>
                                                <div class="menu-item px-3">
                                                    <div class="menu-content px-3 py-3">
                                                        <a class="btn btn-primary btn-sm px-4" href="<?=base_url()?>admin/view-project/project=<?=$oticket['project_code']?>">View Task</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-stack">
                                        <span class="text-gray-800 fw-bolder">From:
                                            <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-600 text-hover-primary fs-7 fw-bolder"><?=$oticket['project_name']?></a>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-stack mt-2">
                                        <span class="text-gray-800 fw-bolder">Client:
                                            <a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-600 text-hover-primary fs-7 fw-bolder"><?=$oticket['client']?></a>
                                        </span>
                                        <div class="d-flex">
                                        <?=$priority?><span class="badge badge-light-<?=$label?>"><?=$oticket['ticket_label']?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; else:?>
                                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed px-7 py-3 mb-6">
                                    <div class="d-flex justify-content-center align-items-center">
                                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
													<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
													<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
												</svg>
											</span>
                                        <div class="me-3 fw-bolder">
                                            No Active Tickets
                                        </div>
                                    </div>
                                </div>
                                <?php endif?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-7">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder text-dark">Project</span>
                                <span class="text-gray-400 mt-1 fw-bold fs-6">Total of <?=$count?> project handled</span>
                            </h3>
                            <div class="card-toolbar">
                                <div class="d-flex flex-stack flex-wrap gap-4">
                                    <div class="d-flex align-items-center fw-bolder">
                                        <div class="text-muted fs-7 me-2">Status</div>
                                        <select class="form-select form-select-transparent text-dark fs-7 lh-1 fw-bolder py-0 ps-3 w-auto" data-control="select2" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select an option" data-kt-table-widget-5="filter_status">
                                            <option></option>
                                            <option value="Show All" selected="selected">Show All</option>
                                            <option value="Not Started">Not Started</option>
                                            <option value="In Progress">In Progress</option>
                                            <option value="Completed">Completed</option>
                                            <option value="On Hold">On Hold</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">Name</th>
                                        <th class="text-end pe-3 min-w-150px">Date Added</th>
                                        <th class="text-end pe-3 min-w-100px">Budget</th>
                                        <th class="text-end pe-3 min-w-50px">Tickets</th>
                                        <th class="text-end pe-3 min-w-50px">Label</th>
                                        <th class="text-end pe-0 min-w-25px">Completion</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bolder text-gray-600">
                                    <?php if(!empty($project)): foreach ($project as $owned):
                                        if($owned['project_label'] == 'Not Started'){
                                            $color = 'secondary';
                                        }elseif($owned['project_label'] == 'In Progress'){
                                            $color = 'primary';
                                        }elseif($owned['project_label'] == 'Completed'){
                                            $color = 'success';
                                        }elseif($owned['project_label'] == 'On Hold'){
                                            $color = 'warning';
                                        }elseif($owned['project_label'] == 'Cancelled'){
                                            $color = 'danger';
                                        }

                                        $count_ticket = 0;
                                        $count_document = 0;
                                        $completed_count = 0;
                                        $total_completion = 0;
                                        if (!empty($tickets)){
                                            foreach ($tickets as $ticket){
                                                if ($owned['projectid'] == $ticket['projectid']){
                                                    if($ticket['ticket_label'] == 'Completed') {
                                                    $completed_count++;
                                                    }
                                                    $count_ticket++;
                                                }
                                            }
                                            if(!empty($count_ticket) || $count_ticket != 0) {
                                            $total_completion = round($completed_count/$count_ticket*100);
                                            }  
                                            $pbcolor = '';
                                            if($total_completion == 100) {
                                            $pbcolor = 'success';
                                            } elseif($total_completion >= 60) {
                                            $pbcolor = 'primary';
                                            } elseif($total_completion <= 59) {
                                            $pbcolor = 'warning';
                                            } 
                                        }
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="<?=base_url()?>admin/view-project/project=<?=$owned['project_code']?>" class="text-dark text-hover-primary"><?=$owned['project_name']?></a>
                                        </td>
                                        <td class="text-end">
                                            <?php
                                                $inputDateTime = new DateTime($owned['due_date']);
                                                $outputDate = $inputDateTime->format("d M Y");
                                                echo $outputDate;
                                            ?> 
                                        </td>
                                        <td class="text-end"><?=$owned['project_budget']?></td>
                                        <td class="text-end"><?=$count_ticket?></td>
                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-<?=$color?>"><?=$owned['project_label']?></span>
                                        </td>
                                        <td class="text-end" data-order="58">
                                            <span class="text-<?=$pbcolor?> fw-bolder"><?=$total_completion?></span>
                                        </td>
                                    </tr>
                                    <?php endforeach; endif?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endsection() ?>