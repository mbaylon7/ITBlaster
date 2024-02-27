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
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Project
                <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                <span class="text-muted fs-6 fw-bold">All Projects</span></h1>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-fluid">
            <!--begin::Stats-->
            <div class="row g-6 g-xl-9">
                <div class="col-lg-6 col-xxl-4">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <!--begin::Heading-->
                            <div class="fs-2hx fw-bolder"><?=$project_count?></div>
                            <div class="fs-4 fw-bold text-gray-400 mb-7">Current Projects</div>
                            <!--end::Heading-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-wrap">
                            <?php
                                // $current_time = time();
                                // $hex = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                                // $all_characters = $hex . $current_time;
                                // $sequence_length = 10;

                                // $generated_sequence = '';
                                // for ($i = 0; $i < $sequence_length; $i++) {
                                //     $random_index = rand(0, strlen($all_characters) - 1);
                                //     $generated_sequence .= $all_characters[$random_index];
                                // }

                                // echo "Generated sequence: " . $generated_sequence;
                            ?>

                                <!--begin::Chart-->
                                <div class="d-flex flex-center h-100px w-100px me-9 mb-5">
                                    <canvas id="kt_project_list_chart"></canvas>
                                </div>
                                <!--end::Chart-->
                                <!--begin::Labels-->
                                <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                        <div class="bullet bg-primary me-3"></div>
                                        <div class="text-gray-400">Active</div>
                                        <div class="ms-auto fw-bolder text-primary"><?=$active_project_count;?></div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                        <div class="bullet bg-success me-3"></div>
                                        <div class="text-gray-400">Completed</div>
                                        <div class="ms-auto fw-bolder text-success"><?=$completed_project_count;?></div>
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <div class="d-flex fs-6 fw-bold align-items-center">
                                        <div class="bullet bg-gray-300 me-3"></div>
                                        <div class="text-gray-400">Yet to start</div>
                                        <div class="ms-auto fw-bolder text-gray"><?=$np_project_count;?></div>
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Labels-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <div class="col-lg-6 col-xxl-4">
                    <!--begin::Budget-->
                    <div class="card h-100">
                        <div class="card-body p-9">
                            <div id="chart"></div>
                        </div>
                    </div>
                    <!--end::Budget-->
                </div>
                <div class="col-lg-6 col-xxl-4">
                    <!--begin::Clients-->
                    <div class="card h-100">
                        <div class="card-body p-9">
                            <!--begin::Heading-->
                            <div class="fs-2hx fw-bolder"><?=$client_count?></div>
                            <div class="fs-4 fw-bold text-gray-400 mb-7">Our Clients</div>
                            <!--end::Heading-->
                            <!--begin::Users group-->
                            <div class="symbol-group symbol-hover mb-9">
                                <?php if(!empty($all_client)): foreach ($all_client as $client): ?>
                                 <?php if(empty($client['profile_avatar'])):?>   
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?= $client['name']?>" data-bs-custom-class="tooltip-dark">
                                    <span class="symbol-label bg-warning text-inverse-warning fw-bolder"><?= substr($client['name'] ,0,1)?></span>
                                </div>
                                <?php else:?>   
                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?= $client['name']?>" data-bs-custom-class="tooltip-dark">
                                    <img alt="Pic" src="<?= base_url()?>uploads/files/<?=$client['name']?>/<?=$client['profile_avatar']?>" />
                                </div>
                                <?php endif?>
                                <?php endforeach; endif?>
                                <!-- <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
                                    <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bolder">+42</span>
                                </a> -->
                            </div>
                            <!--end::Users group-->
                            <!--begin::Actions-->
                            <div class="d-flex">
                                <a href="#" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users" data-bs-custom-class="tooltip-dark">All Clients</a>
                                <a href="#" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search" data-bs-custom-class="tooltip-dark">Invite New</a>
                            </div>
                            <!--end::Actions-->
                        </div>
                    </div>
                    <!--end::Clients-->
                </div>
            </div>
            <!--end::Stats-->
            <!--begin::Toolbar-->
            <div class="d-flex flex-wrap flex-stack my-5">
                <!--begin::Heading-->
                <h2 class="fs-2 fw-bold my-2">Projects
                <span class="fs-6 text-gray-400 ms-1">by Status</span></h2>
                <!--end::Heading-->
                <!--begin::Controls-->
                <div class="d-flex flex-wrap my-1">
                    <div class="m-3 px-0">
                        <a href="#" data-bs-toggle="tooltip" title="Card View" data-bs-custom-class="tooltip-dark"><i class="bi bi-grid fs-3 text-gray-700"></i></a>
                    </div>
                    <div class="m-3 px-0">
                    <a href="#" data-bs-toggle="tooltip" title="Tabled View" data-bs-custom-class="tooltip-dark"><i class="bi bi-table fs-3 text-gray-700"></i></a>
                    </div>
                    <!--begin::Select wrapper-->
                    <div class="m-0" style="padding-left: 20px">
                        <!--begin::Select-->
                        <select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-sm bg-body border-body fw-bolder w-125px">
                            <option value="Active" selected="selected">Active</option>
                            <option value="Approved">In Progress</option>
                            <option value="Declined">To Do</option>
                            <option value="In Progress">Completed</option>
                        </select>
                        <!--end::Select-->
                    </div>
                    <!--end::Select wrapper-->
                </div>
                <!--end::Controls-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Row-->
            <div class="row g-6 g-xl-9">
                <?php if(!empty($client_project)): foreach($client_project as $project): 
                    $color = '';
                    if($project['project_label'] == 'Not Started'){
                        $color = 'secondary';
                      }elseif($project['project_label'] == 'In Progress'){
                          $color = 'primary';
                      }elseif($project['project_label'] == 'Completed'){
                          $color = 'success';
                      }elseif($project['project_label'] == 'On Hold'){
                          $color = 'warning';
                      }elseif($project['project_label'] == 'Cancelled'){
                          $color = 'danger';
                    }

                    $count_ticket = 0;
                    $count_document = 0;
                    $completed_count = 0;
                    $total_completion = 0;
                    if (!empty($tickets)){
                        foreach ($tickets as $ticket){
                            if ($project['projectid'] == $ticket['projectid']){
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
                <!--begin::Col-->
                <div class="col-md-6 col-xl-4">
                    <!--begin::Card-->
                    <a href="<?=base_url()?>admin/view-project/project=<?=$project['project_code']?>" class="card border-hover-primary">
                        <!--begin::Card header-->
                        <div class="card-header border-0 pt-9">
                            <!--begin::Card Title-->
                            <div class="card-title m-0">
                                <!--begin::Avatar-->
                                <?php if(empty($project['project_image'])):?>
                                <div class="symbol symbol-50px w-50px bg-light">
                                    <img src="<?= base_url()?>uploads/files/<?=$project['name']?>/<?=$project['profile_avatar']?>" alt="image" class="p-3" />
                                </div>
                                <?php else:?>
                                <div class="symbol symbol-50px w-50px bg-light">
                                    <img src="<?=base_url()?>uploads/files/project/<?=$project['project_name']?>/<?=$project['project_image']?>" alt="image" class="p-3" />
                                </div>
                                <?php endif?>
                                <!--end::Avatar-->
                            </div>
                            <!--end::Car Title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <span class="badge badge-light-<?=$color?> fw-bolder me-auto px-4 py-3"><?= $project['project_label']?></span>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end:: Card header-->
                        <!--begin:: Card body-->
                        <div class="card-body p-9">
                            <!--begin::Name-->
                            <div class="fs-3 fw-bolder text-dark"><?= $project['project_name']?></div>
                            <!--end::Name-->
                            <!--begin::Description-->
                            <p class="text-gray-400 fs-7 mt-1 mb-7"><?= $project['description']?></p>
                            <!--end::Description-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap mb-5">
                                <!--Due Date-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                    <div class="fs-6 text-gray-800 fw-bolder"><?php
                                    $inputDateTime = new DateTime($project['due_date']);
                                    $outputDate = $inputDateTime->format("d M Y");
                                    echo $outputDate;
                                    ?></div>
                                    <div class="fw-bold text-gray-400">Due Date</div>
                                </div>
                                <!-- Tickets -->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                    <div class="fs-6 text-gray-800 fw-bolder"><?=$count_ticket?></div>
                                    <div class="fw-bold text-gray-400">Tickets</div>
                                </div>
                                <!-- Budget -->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                <?php if(empty($project['project_budget'])):?>   
                                    <div class="fs-6 text-gray-800 fw-bolder">Not Specified</div>
                                <?php else:?>   
                                    <div class="fs-6 text-gray-800 fw-bolder"><?= $project['project_budget']?></div>
                                <?php endif?>
                                    <div class="fw-bold text-gray-400">Budget</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center flex-column mt-3">
                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                    <span class="fw-bold fs-6 text-gray-400">Project Completion</span>
                                    <span class="fw-bolder fs-6"><?=$total_completion?>%</span>
                                </div>
                                <div class="h-5px mx-3 w-100 bg-light mb-3" data-bs-toggle="tooltip" title="This project <?=$total_completion?>% completed" data-bs-custom-class="tooltip-dark">
                                    <div class="bg-<?=$pbcolor?> rounded h-5px" role="progressbar" style="width: <?=$total_completion?>%;" aria-valuenow="<?=$total_completion?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end::Progress-->
                            <!--begin::Users-->
                            <div class="symbol-group symbol-hover">
                            <?php if(!empty($developer)): foreach($developer as $dev): if($project['projectid'] == $dev['projectid']):?>
                                      <?php if(!empty($dev['profile_avatar'])):?>
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?=$dev['name']?>" data-bs-custom-class="tooltip-dark">
                                        <img alt="Pic" src="<?=base_url()?>uploads/files/<?=$dev['name']?>/<?=$dev['profile_avatar']?>" />
                                    </div>
                                    <?php else:?>  
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?=$dev['name']?>" data-bs-custom-class="tooltip-dark">
                                        <span class="symbol-label bg-primary text-inverse-primary fw-bolder"><?= substr($dev['name'] ,0,1)?></span>
                                    </div>
                                <?php endif; endif; endforeach; endif?>
                            </div>
                            <!--end::Users-->
                        </div>
                        <!--end:: Card body-->
                    </a>
                    <!--end::Card-->
                </div>
                <?php endforeach; endif?>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
		<script src="<?= base_url()?>assets/js/scripts.bundle.js"></script>
    <script>
        "use strict";
        var KTProjectList={
        init:function(){
        !function(){
            var t=document.getElementById("kt_project_list_chart");if(t){
                var e=t.getContext("2d");
                new Chart(e,{
                    type:"doughnut",
                    data:{
                        datasets:[{
                            data:[<?=$active_project_count?>,<?=$completed_project_count?>,<?=$np_project_count?>],
                            backgroundColor:["#00A3FF","#50CD89","#E4E6EF"]}],
                            labels:["Active","Completed","Yet to start"]},
                            options:{
                                chart:{fontFamily:"inherit"},
                                cutout:"75%",
                                cutoutPercentage:65,
                                responsive:!0,
                                maintainAspectRatio:!1,title:{display:!1},
                                animation:{animateScale:!0,animateRotate:!0},
                                tooltips:{enabled:!0,intersect:!1,
                                    mode:"nearest",
                                    bodySpacing:5,
                                    yPadding:10,
                                    xPadding:10,
                                    caretPadding:0,
                                    displayColors:!1,
                                    backgroundColor:"#20D489",
                                    titleFontColor:"#ffffff",
                                    cornerRadius:4,
                                    footerSpacing:0,
                                    titleSpacing:0},
                                    plugins:{
                                        legend:{
                                            display:!1
                                        }
                                    }
                                }
                            })
                        }
                    }
                    ()}
                };
            KTUtil.onDOMContentLoaded((function(){KTProjectList.init()}));
            let notStarted = 0;
            let inProgress = 14;
            let onHold = 3;
            let cancelled = 0;
            let completed = 6;

            // Sample data for the chart
            const data = {
                categories: [['NOT', 'STARTED'], ['IN', 'PROGRESS'], ['ON', 'HOLD'], 'CANCELLED', 'COMPLETED'],
                series: [notStarted, inProgress, onHold, cancelled, completed]
            };

            // Custom colors for different elements
            const colors = {
                series: ['#292b2c', '#17a2b8', '#ffc107', '#dc3545', '#28a745'],
                xaxisText: ['#292b2c', '#17a2b8', '#ffc107', '#dc3545', '#28a745'],
                gridLines: '#fff'
            };

            // Options for the chart
            const options = {
                chart: {
                    type: 'bar',
                    height: 250,
                    toolbar: {
                        show: false
                    }
                },
                title: {
                    style: {
                        fontSize: '14px',
                        fontWeight: '600',
                        color: '#4FAFCB'
                    }
                },
                series: [{
                    name: 'Total of',
                    data: data.series
                }],
                xaxis: {
                    categories: data.categories,
                    labels: {
                        style: {
                            colors: colors.xaxisText
                        }
                    },
                    axisBorder: {
                        color: colors.gridLines
                    }
                },
                legend: {
                    show: false
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#000'
                        }
                    },
                    axisBorder: {
                        color: colors.gridLines
                    }
                },
                colors: colors.series,
                plotOptions: {
                    bar: {
                        columnWidth: '65%',
                        distributed: true,
                    }
                },
                grid: {
                    borderColor: colors.gridLines
                },
            };

            // Create the chart
            const chart = new ApexCharts(document.querySelector('#chart'), options);

            // Render the chart with the data
            chart.render();
    </script>
<?= $this->endsection() ?>