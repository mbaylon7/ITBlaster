<?= $this->extend('/templates/administrator') ?>
<?= $this->section('content') ?>
<!--begin::Content-->
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
                <div class="card ">
                    <div class="card-header card-header-stretch">
                        <h3 class="card-title"><i class="bi bi-people fs-1 text-dark fw-bold px-2"></i> Register Users</h3>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabled_view">Tabled</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#card_view">Card</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabled_view" role="tabpanel">
                                <div class="card-header card-header-stretch" style="border-bottom: 1px solid transparent;">
                                    <h3 class="card-title"></h3>
                                    <div class="card-toolbar">
                                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#tab_active">Active</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tab_inactive">Inactive</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tab_suspended">Suspended</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="tab_active" role="tabpanel">
                                        <table class="table align-middle table-row-dashed table-row-gray-300 fs-6 gy-5" id="active_user">
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_sales_table .form-check-input" value="1" />
                                                        </div>
                                                    </th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Type</th>
                                                    <th>Is Admin</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-bold text-gray-600">
                                                <?php if(!empty($active)): foreach ($active as $user): 
                                                    $type = '';
                                                    $status = '';
                                                    $is_admin = ($user['is_admin'] == 'Yes') ? 'Yes' : 'No';
                                                    if($user['usertype'] == 0) {
                                                        $type = 'Admin';
                                                    } elseif($user['usertype'] == 1) {
                                                        $type = 'IT Professional';
                                                    } else {
                                                        $type = 'Client';
                                                    } ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                <a href="#">
                                                                    <!-- <div class="symbol-label">
                                                                        <img src="<?= base_url()?><?=base_url()?>assets/media/avatars/300-12.jpg" alt="Ana Crown" class="w-100" />
                                                                    </div> -->
                                                                    <div class="symbol-label fs-3 bg-light-success text-success"><?= substr($user['name'] ,0,1)?></div>
                                                                </a>
                                                            </div>
                                                            <div class="ms-5">
                                                                <a href=".#" class="text-gray-800 text-hover-primary fs-5 fw-bolder"><?= $user['name']?></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?= $user['email']?>
                                                    </td>
                                                    <td class="">
                                                        <span class="fw-bolder">
                                                        <?= $type?>
                                                        </span>
                                                    </td>
                                                    <td class="">
                                                        <span class="fw-bolder"><?= $is_admin?></span>
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-light-info"><?= $user['status']?></div> 
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center flex-shrink-0">
                                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                <span class="svg-icon svg-icon-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
                                                                        <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                <span class="svg-icon svg-icon-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
                                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                                <span class="svg-icon svg-icon-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; endif?>
                                            </tbody>
                                        </table>
                                        </div>

                                        <div class="tab-pane fade" id="tab_inactive" role="tabpanel">
                                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="inactive_user">
                                                <thead>
                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                        <th class="w-10px pe-2">
                                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_sales_table .form-check-input" value="1" />
                                                            </div>
                                                        </th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Type</th>
                                                        <th>Is Admin</th>
                                                        <th>Status</th>
                                                        <th class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-bold text-gray-600">
                                                    <?php if(!empty($inactive)): foreach ($inactive as $user): ?>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" value="1" />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                    <a href="#">
                                                                        <!-- <div class="symbol-label">
                                                                            <img src="<?= base_url()?><?=base_url()?>assets/media/avatars/300-12.jpg" alt="Ana Crown" class="w-100" />
                                                                        </div> -->
                                                                        <div class="symbol-label fs-3 bg-light-success text-success"><?= substr($user['name'] ,0,1)?></div>
                                                                    </a>
                                                                </div>
                                                                <div class="ms-5">
                                                                    <a href=".#" class="text-gray-800 text-hover-primary fs-5 fw-bolder"><?= $user['name']?></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-kt-ecommerce-order-filter="order_id">
                                                            <?= $user['email']?>
                                                        </td>
                                                        <td class="">
                                                            <span class="fw-bolder">
                                                                <?php
                                                                $type = '';
                                                                if($user['usertype'] == 0) {
                                                                    echo $type = 'Admin';
                                                                } elseif($user['usertype'] == 1) {
                                                                    echo $type = 'IT Professional';
                                                                } else {
                                                                    echo $type = 'Client';
                                                                }
                                                                ?>
                                                            </span>
                                                        </td>
                                                        <td class="">
                                                            <span class="fw-bolder"><?= $user['is_admin']?></span>
                                                        </td>
                                                        <td class="" data-kt-ecommerce-order-filter="<?= $user['status']?>">
                                                            <div class="badge badge-light-info"><?= $user['status']?></div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center flex-shrink-0">
                                                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <span class="svg-icon svg-icon-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
                                                                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <span class="svg-icon svg-icon-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
                                                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                                    <span class="svg-icon svg-icon-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; endif?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade" id="tab_suspended" role="tabpanel">
                                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="suspended_user">
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_sales_table .form-check-input" value="1" />
                                                        </div>
                                                    </th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Type</th>
                                                    <th>Is Admin</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-bold text-gray-600">
                                                <?php if(!empty($suspended)): foreach ($suspended as $user): ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value="1" />
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                <a href="#">
                                                                    <!-- <div class="symbol-label">
                                                                        <img src="<?= base_url()?><?=base_url()?>assets/media/avatars/300-12.jpg" alt="Ana Crown" class="w-100" />
                                                                    </div> -->
                                                                    <div class="symbol-label fs-3 bg-light-success text-success"><?= substr($user['name'] ,0,1)?></div>
                                                                </a>
                                                            </div>
                                                            <div class="ms-5">
                                                                <a href=".#" class="text-gray-800 text-hover-primary fs-5 fw-bolder"><?= $user['name']?></a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td data-kt-ecommerce-order-filter="order_id">
                                                        <?= $user['email']?>
                                                    </td>
                                                    <td class="">
                                                        <span class="fw-bolder">
                                                            <?php
                                                            $type = '';
                                                            if($user['usertype'] == 0) {
                                                                echo $type = 'Admin';
                                                            } elseif($user['usertype'] == 1) {
                                                                echo $type = 'IT Professional';
                                                            } else {
                                                                echo $type = 'Client';
                                                            }
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td class="">
                                                        <span class="fw-bolder"><?= $user['is_admin']?></span>
                                                    </td>
                                                    <td class="" data-kt-ecommerce-order-filter="<?= $user['status']?>">
                                                        <div class="badge badge-light-info"><?= $user['status']?></div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center flex-shrink-0">
                                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                <span class="svg-icon svg-icon-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
                                                                        <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                <span class="svg-icon svg-icon-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
                                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                                <span class="svg-icon svg-icon-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; endif?>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="card_view" role="tabpanel">
                                <div class="row g-6 g-xl-9">
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="<?=base_url()?>demo1/dist/apps/projects/project.html" class="card shadow-sm border-hover-primary">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9 ">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="<?=base_url()?>assets/media/svg/brand-logos/plurk.svg" alt="image" class="p-3" />
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">In Progress</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Fitnes App</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">May 05, 2022</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 50% completed">
													<div class="bg-primary rounded h-4px" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Emma Smith">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-6.jpg" />
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Rudy Stone">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-1.jpg" />
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
														<span class="symbol-label bg-primary text-inverse-primary fw-bolder">S</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="<?=base_url()?>demo1/dist/apps/projects/project.html" class="card shadow-sm border-hover-primary">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="<?=base_url()?>assets/media/svg/brand-logos/disqus.svg" alt="image" class="p-3" />
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light fw-bolder me-auto px-4 py-3">Pending</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Leaf CRM</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">May 10, 2021</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$36,400.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 30% completed">
													<div class="bg-info rounded h-4px" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
														<span class="symbol-label bg-warning text-inverse-warning fw-bolder">A</span>
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Brian Cox">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-5.jpg" />
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="<?=base_url()?>demo1/dist/apps/projects/project.html" class="card shadow-sm border-hover-primary">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="<?=base_url()?>assets/media/svg/brand-logos/figma-1.svg" alt="image" class="p-3" />
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-success fw-bolder me-auto px-4 py-3">Completed</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Atica Banking</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Mar 14, 2021</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$605,100.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 100% completed">
													<div class="bg-success rounded h-4px" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Mad Macy">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-2.jpg" />
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Cris Willson">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-9.jpg" />
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Mike Garcie">
														<span class="symbol-label bg-info text-inverse-info fw-bolder">M</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="<?=base_url()?>demo1/dist/apps/projects/project.html" class="card shadow-sm border-hover-primary">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="<?=base_url()?>assets/media/svg/brand-logos/sentry-3.svg" alt="image" class="p-3" />
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light fw-bolder me-auto px-4 py-3">Pending</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Finance Dispatch</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Aug 19, 2022</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 60% completed">
													<div class="bg-info rounded h-4px" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Nich Warden">
														<span class="symbol-label bg-warning text-inverse-warning fw-bolder">N</span>
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Rob Otto">
														<span class="symbol-label bg-success text-inverse-success fw-bolder">R</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="<?=base_url()?>demo1/dist/apps/projects/project.html" class="card shadow-sm border-hover-primary">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="<?=base_url()?>assets/media/svg/brand-logos/xing-icon.svg" alt="image" class="p-3" />
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">In Progress</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">9 Degree</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Jun 24, 2022</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 40% completed">
													<div class="bg-primary rounded h-4px" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Francis Mitcham">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-20.jpg" />
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michelle Swanston">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-7.jpg" />
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
														<span class="symbol-label bg-primary text-inverse-primary fw-bolder">S</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="<?=base_url()?>demo1/dist/apps/projects/project.html" class="card shadow-sm border-hover-primary">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="<?=base_url()?>assets/media/svg/brand-logos/tvit.svg" alt="image" class="p-3" />
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">In Progress</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">GoPro App</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Jul 25, 2022</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 70% completed">
													<div class="bg-primary rounded h-4px" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-2.jpg" />
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Robin Watterman">
														<span class="symbol-label bg-success text-inverse-success fw-bolder">R</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="<?=base_url()?>demo1/dist/apps/projects/project.html" class="card shadow-sm border-hover-primary">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="<?=base_url()?>assets/media/svg/brand-logos/aven.svg" alt="image" class="p-3" />
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">In Progress</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Buldozer CRM</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">May 05, 2022</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 70% completed">
													<div class="bg-primary rounded h-4px" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-2.jpg" />
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="John Mixin">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-14.jpg" />
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Emma Smith">
														<span class="symbol-label bg-primary text-inverse-primary fw-bolder">S</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="<?=base_url()?>demo1/dist/apps/projects/project.html" class="card shadow-sm border-hover-primary">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="<?=base_url()?>assets/media/svg/brand-logos/treva.svg" alt="image" class="p-3" />
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-danger fw-bolder me-auto px-4 py-3">Overdue</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Aviasales App</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Jul 25, 2022</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 10% completed">
													<div class="bg-danger rounded h-4px" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
														<span class="symbol-label bg-warning text-inverse-warning fw-bolder">A</span>
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Brian Cox">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-5.jpg" />
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 col-xl-4">
										<!--begin::Card-->
										<a href="<?=base_url()?>demo1/dist/apps/projects/project.html" class="card shadow-sm border-hover-primary">
											<!--begin::Card header-->
											<div class="card-header border-0 pt-9">
												<!--begin::Card Title-->
												<div class="card-title m-0">
													<!--begin::Avatar-->
													<div class="symbol symbol-50px w-50px bg-light">
														<img src="<?=base_url()?>assets/media/svg/brand-logos/kanba.svg" alt="image" class="p-3" />
													</div>
													<!--end::Avatar-->
												</div>
												<!--end::Car Title-->
												<!--begin::Card toolbar-->
												<div class="card-toolbar">
													<span class="badge badge-light-success fw-bolder me-auto px-4 py-3">Completed</span>
												</div>
												<!--end::Card toolbar-->
											</div>
											<!--end:: Card header-->
											<!--begin:: Card body-->
											<div class="card-body p-9">
												<!--begin::Name-->
												<div class="fs-3 fw-bolder text-dark">Oppo CRM</div>
												<!--end::Name-->
												<!--begin::Description-->
												<p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
												<!--end::Description-->
												<!--begin::Info-->
												<div class="d-flex flex-wrap mb-5">
													<!--begin::Due-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">Mar 10, 2022</div>
														<div class="fw-bold text-gray-400">Due Date</div>
													</div>
													<!--end::Due-->
													<!--begin::Budget-->
													<div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
														<div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
														<div class="fw-bold text-gray-400">Budget</div>
													</div>
													<!--end::Budget-->
												</div>
												<!--end::Info-->
												<!--begin::Progress-->
												<div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 100% completed">
													<div class="bg-success rounded h-4px" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<!--end::Progress-->
												<!--begin::Users-->
												<div class="symbol-group symbol-hover">
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Nick Macy">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-2.jpg" />
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Sean Paul">
														<img alt="Pic" src="<?=base_url()?>assets/media/avatars/300-9.jpg" />
													</div>
													<!--begin::User-->
													<!--begin::User-->
													<div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Mike Collin">
														<span class="symbol-label bg-info text-inverse-info fw-bolder">M</span>
													</div>
													<!--begin::User-->
												</div>
												<!--end::Users-->
											</div>
											<!--end:: Card body-->
										</a>
										<!--end::Card-->
									</div>
									<!--end::Col-->
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="kt_modal_new_address" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Form-->
                <form class="form" action="#" id="kt_modal_new_address_form">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_new_address_header">
                        <!--begin::Modal title-->
                        <h2>Add New Address</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body">
                        <!--begin::Scroll-->
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header" data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Notice-->
                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                <!--begin::Icon-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                                        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Icon-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-bold">
                                        <h4 class="text-gray-900 fw-bolder">Warning</h4>
                                        <div class="fs-6 text-gray-700">Updating address may affter to your
                                        <a href="#">Tax Location</a></div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                            <!--end::Notice-->
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="required fs-5 fw-bold mb-2">First name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="first-name" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--end::Label-->
                                    <label class="required fs-5 fw-bold mb-2">Last name</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="last-name" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                    <span class="required">Country</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Your payment statements may very based on selected country"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select name="country" data-control="select2" data-dropdown-parent="#kt_modal_new_address" data-placeholder="Select a Country..." class="form-select form-select-solid">
                                    <option value="">Select a Country...</option>
                                    <option value="AF">Afghanistan</option>
                                    <option value="AX">Aland Islands</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AS">American Samoa</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AO">Angola</option>
                                    <option value="AI">Anguilla</option>
                                    <option value="AG">Antigua and Barbuda</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AM">Armenia</option>
                                    <option value="AW">Aruba</option>
                                    <option value="AU">Australia</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BS">Bahamas</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesh</option>
                                    <option value="BB">Barbados</option>
                                    <option value="BY">Belarus</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BZ">Belize</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BM">Bermuda</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BO">Bolivia, Plurinational State of</option>
                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                    <option value="BA">Bosnia and Herzegovina</option>
                                    <option value="BW">Botswana</option>
                                    <option value="BR">Brazil</option>
                                    <option value="IO">British Indian Ocean Territory</option>
                                    <option value="BN">Brunei Darussalam</option>
                                    <option value="BG">Bulgaria</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BI">Burundi</option>
                                    <option value="KH">Cambodia</option>
                                    <option value="CM">Cameroon</option>
                                    <option value="CA">Canada</option>
                                    <option value="CV">Cape Verde</option>
                                    <option value="KY">Cayman Islands</option>
                                    <option value="CF">Central African Republic</option>
                                    <option value="TD">Chad</option>
                                    <option value="CL">Chile</option>
                                    <option value="CN">China</option>
                                    <option value="CX">Christmas Island</option>
                                    <option value="CC">Cocos (Keeling) Islands</option>
                                    <option value="CO">Colombia</option>
                                    <option value="KM">Comoros</option>
                                    <option value="CK">Cook Islands</option>
                                    <option value="CR">Costa Rica</option>
                                    <option value="CI">Côte d'Ivoire</option>
                                    <option value="HR">Croatia</option>
                                    <option value="CU">Cuba</option>
                                    <option value="CW">Curaçao</option>
                                    <option value="CZ">Czech Republic</option>
                                    <option value="DK">Denmark</option>
                                    <option value="DJ">Djibouti</option>
                                    <option value="DM">Dominica</option>
                                    <option value="DO">Dominican Republic</option>
                                    <option value="EC">Ecuador</option>
                                    <option value="EG">Egypt</option>
                                    <option value="SV">El Salvador</option>
                                    <option value="GQ">Equatorial Guinea</option>
                                    <option value="ER">Eritrea</option>
                                    <option value="EE">Estonia</option>
                                    <option value="ET">Ethiopia</option>
                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FI">Finland</option>
                                    <option value="FR">France</option>
                                    <option value="PF">French Polynesia</option>
                                    <option value="GA">Gabon</option>
                                    <option value="GM">Gambia</option>
                                    <option value="GE">Georgia</option>
                                    <option value="DE">Germany</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GI">Gibraltar</option>
                                    <option value="GR">Greece</option>
                                    <option value="GL">Greenland</option>
                                    <option value="GD">Grenada</option>
                                    <option value="GU">Guam</option>
                                    <option value="GT">Guatemala</option>
                                    <option value="GG">Guernsey</option>
                                    <option value="GN">Guinea</option>
                                    <option value="GW">Guinea-Bissau</option>
                                    <option value="HT">Haiti</option>
                                    <option value="VA">Holy See (Vatican City State)</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HK">Hong Kong</option>
                                    <option value="HU">Hungary</option>
                                    <option value="IS">Iceland</option>
                                    <option value="IN">India</option>
                                    <option value="ID">Indonesia</option>
                                    <option value="IR">Iran, Islamic Republic of</option>
                                    <option value="IQ">Iraq</option>
                                    <option value="IE">Ireland</option>
                                    <option value="IM">Isle of Man</option>
                                    <option value="IL">Israel</option>
                                    <option value="IT">Italy</option>
                                    <option value="JM">Jamaica</option>
                                    <option value="JP">Japan</option>
                                    <option value="JE">Jersey</option>
                                    <option value="JO">Jordan</option>
                                    <option value="KZ">Kazakhstan</option>
                                    <option value="KE">Kenya</option>
                                    <option value="KI">Kiribati</option>
                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="KG">Kyrgyzstan</option>
                                    <option value="LA">Lao People's Democratic Republic</option>
                                    <option value="LV">Latvia</option>
                                    <option value="LB">Lebanon</option>
                                    <option value="LS">Lesotho</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LY">Libya</option>
                                    <option value="LI">Liechtenstein</option>
                                    <option value="LT">Lithuania</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="MO">Macao</option>
                                    <option value="MG">Madagascar</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MY">Malaysia</option>
                                    <option value="MV">Maldives</option>
                                    <option value="ML">Mali</option>
                                    <option value="MT">Malta</option>
                                    <option value="MH">Marshall Islands</option>
                                    <option value="MQ">Martinique</option>
                                    <option value="MR">Mauritania</option>
                                    <option value="MU">Mauritius</option>
                                    <option value="MX">Mexico</option>
                                    <option value="FM">Micronesia, Federated States of</option>
                                    <option value="MD">Moldova, Republic of</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MN">Mongolia</option>
                                    <option value="ME">Montenegro</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                    <option value="MM">Myanmar</option>
                                    <option value="NA">Namibia</option>
                                    <option value="NR">Nauru</option>
                                    <option value="NP">Nepal</option>
                                    <option value="NL">Netherlands</option>
                                    <option value="NZ">New Zealand</option>
                                    <option value="NI">Nicaragua</option>
                                    <option value="NE">Niger</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="NU">Niue</option>
                                    <option value="NF">Norfolk Island</option>
                                    <option value="MP">Northern Mariana Islands</option>
                                    <option value="NO">Norway</option>
                                    <option value="OM">Oman</option>
                                    <option value="PK">Pakistan</option>
                                    <option value="PW">Palau</option>
                                    <option value="PS">Palestinian Territory, Occupied</option>
                                    <option value="PA">Panama</option>
                                    <option value="PG">Papua New Guinea</option>
                                    <option value="PY">Paraguay</option>
                                    <option value="PE">Peru</option>
                                    <option value="PH">Philippines</option>
                                    <option value="PL">Poland</option>
                                    <option value="PT">Portugal</option>
                                    <option value="PR">Puerto Rico</option>
                                    <option value="QA">Qatar</option>
                                    <option value="RO">Romania</option>
                                    <option value="RU">Russian Federation</option>
                                    <option value="RW">Rwanda</option>
                                    <option value="BL">Saint Barthélemy</option>
                                    <option value="KN">Saint Kitts and Nevis</option>
                                    <option value="LC">Saint Lucia</option>
                                    <option value="MF">Saint Martin (French part)</option>
                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                    <option value="WS">Samoa</option>
                                    <option value="SM">San Marino</option>
                                    <option value="ST">Sao Tome and Principe</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="SN">Senegal</option>
                                    <option value="RS">Serbia</option>
                                    <option value="SC">Seychelles</option>
                                    <option value="SL">Sierra Leone</option>
                                    <option value="SG">Singapore</option>
                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                    <option value="SK">Slovakia</option>
                                    <option value="SI">Slovenia</option>
                                    <option value="SB">Solomon Islands</option>
                                    <option value="SO">Somalia</option>
                                    <option value="ZA">South Africa</option>
                                    <option value="KR">South Korea</option>
                                    <option value="SS">South Sudan</option>
                                    <option value="ES">Spain</option>
                                    <option value="LK">Sri Lanka</option>
                                    <option value="SD">Sudan</option>
                                    <option value="SR">Suriname</option>
                                    <option value="SZ">Swaziland</option>
                                    <option value="SE">Sweden</option>
                                    <option value="CH">Switzerland</option>
                                    <option value="SY">Syrian Arab Republic</option>
                                    <option value="TW">Taiwan, Province of China</option>
                                    <option value="TJ">Tajikistan</option>
                                    <option value="TZ">Tanzania, United Republic of</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TG">Togo</option>
                                    <option value="TK">Tokelau</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TT">Trinidad and Tobago</option>
                                    <option value="TN">Tunisia</option>
                                    <option value="TR">Turkey</option>
                                    <option value="TM">Turkmenistan</option>
                                    <option value="TC">Turks and Caicos Islands</option>
                                    <option value="TV">Tuvalu</option>
                                    <option value="UG">Uganda</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="AE">United Arab Emirates</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="US">United States</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="VU">Vanuatu</option>
                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                    <option value="VN">Vietnam</option>
                                    <option value="VI">Virgin Islands</option>
                                    <option value="YE">Yemen</option>
                                    <option value="ZM">Zambia</option>
                                    <option value="ZW">Zimbabwe</option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">Address Line 1</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="address1" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">Address Line 2</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="address2" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold mb-2">Town</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="city" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row g-9 mb-5">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-bold mb-2">State / Province</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="" name="state" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-bold mb-2">Post Code</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="" name="postcode" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-5">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Label-->
                                    <div class="me-5">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-bold">Use as a billing adderess?</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="fs-7 fw-bold text-muted">If you need more info, please check budget planning</div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input" name="billing" type="checkbox" value="1" checked="checked" />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <span class="form-check-label fw-bold text-muted">Yes</span>
                                        <!--end::Label-->
                                    </label>
                                    <!--end::Switch-->
                                </div>
                                <!--begin::Wrapper-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                    </div>
                    <!--end::Modal body-->
                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-light me-3">Discard</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" id="kt_modal_new_address_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
<?= $this->endsection() ?>