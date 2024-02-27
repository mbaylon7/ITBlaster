<?= $this->extend('/templates/admin') ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<style>
    .buttons-html5, .buttons-print, .buttons-collection {
        color: #B2B5BD !important;
        background: transparent;
        border-bottom: 1px solid transparent !important;
        border:none;
        border-radius: 0px;
        transition: 0.2s ease-in-out ;
    }

    .buttons-html5:hover, .buttons-print:hover, .buttons-collection:hover {
        background: transparent; 
        border-bottom: 1px solid transparent !important;
        color:  #192F64 !important;
    }

    .form-control-sm {
        border-radius: 2px;
    }
    .hiddenRow {
        padding: 0 !important;
    }
    .default {
      background: #f8f9fa;
      color: #6c757d!important;
      border: none;
    }
    .default:hover {
      background: #f8f9fa;
    }
    .red {
      background: #d9534f!important;
      color: #fff!important;
      padding: 0 17px;
      border: none;
    }
    .red:hover {
      background: #d9534f!important;
      color: #fff!important;
      padding: 0 17px;
      border: none;
    }
    .green {
      background: #5cb85c!important;
      color: #fff!important;
      padding: 0 17px;
      border: none;
    }
    .green:hover {
      background: #5cb85c!important;
      color: #fff!important;
      padding: 0 17px;
      border: none;
    }
    .dt-buttons {
      gap: 1rem;
      padding: 10px 0;
      justify-content: end;
    }
</style>
<script src="<?= base_url()?>plugins/jquery/jquery.min.js"></script>
    <?php 
      use App\Models\ITProfile;
      $it = new ItProfile;
      $userid = $itid;

      $userit = $it->where('userId', session('id'))->first();
      $is_permitted = '';
      $user_type = session('usertype');

      if($user_type == 1) {
        if($userit['employment_status'] == 2) {
          $is_permitted = 'd-none';
        }
      }
    ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Board List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"><?= $name?></a></li>
              <li class="breadcrumb-item active">Project Board list</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <ul class="nav nav-tabs mb-4" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Owned</a>
              </li>
              <?php if($usertype == 2) :?>
              <li class="nav-item">
                  <a class="nav-link" id="open-tickets-tab" data-toggle="pill" href="#open-tickets" role="tab" aria-controls="open-tickets" aria-selected="false">Open Tickets</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" id="all-projects-tab" data-toggle="pill" href="#all-projects" role="tab" aria-controls="all-projects-tab" aria-selected="false">Projects</a>
              </li>
              <?php endif;?>
              <li class="nav-item">
                  <a class="nav-link" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Active</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade" id="open-tickets" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-2">
                        <h1 class="h5">Developers</h1>
                        <div class="d-flex flex-column bd-highlight mb-3">
                          <div class="p-1 bd-highlight">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input custom-control-input-success custom-control-input-outline filterTicketOwned" name="filter_dev" id="customCheckbox0" style="margin-top:5px">
                              <label for="customCheckbox0" class="custom-control-label">All</label>
                            </div>
                          </div>
                          <?php foreach($developers ?? []  as $dev ):?>
                          <div class="p-1 bd-highlight">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input custom-control-input-success custom-control-input-outline filterTicketOwned" data-id="<?=$dev['userId']?>" id="customCheckbox<?=$dev['id']?>" name="filter_dev" value="<?=$dev['id']?>" style="margin-top:5px">
                              <label for="customCheckbox<?=$dev['id']?>" class="custom-control-label"><?=$dev['name']?></label>
                            </div>
                          </div>
                          <?php endforeach?>
                        </div>
                      </div>
                      <div class="col-md-10">
                          <div id="site_activities_loading">
                              <span id="spinner-text" style="display:18px" class="">Fetching data </span> <img src="<?=base_url()?>img/loading.gif" alt="loading" /> 
                          </div>
                          <table class="table table-bordered table-hover d-none" id="dataTable_2">
                            <thead>
                                <tr role="row">
                                  <th>Project</th>
                                  <th>Ticket</th>
                                  <th>Duedate</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                          </table>
                          <table class="table table-bordered table-hover d-none" id="dataTable_1">
                            <thead>
                              <tr>
                                <th>Project</th>
                                <th>Ticket</th>
                                <th>Dev</th>
                                <th>Duedate</th>
                                <th>Status</th>
                              </tr>
                              </thead>
                              <tbody>
                              </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="all-projects" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                          <div id="site_activities_loading">
                              <span id="spinner-text" style="display:18px" class="">Fetching data </span> <img src="<?=base_url()?>img/loading.gif" alt="loading" /> 
                          </div>
                          <table class="table table-bordered table-hover" id="dataTable_3">
                            <thead>
                                <tr role="row">
                                  <th>Project</th>
                                  <th>Description</th>
                                  <th>Status</th>
                                  <th>Duedate</th>
                                  <th>Reflect</th>
                                </tr>
                              </thead>
                              <tbody>
                              </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                      <table class="allTicketActive table table-hover table-bordered" style="width: 100%!important">
                          <thead>
                          <tr>
                            <th></th>
                            <th width="30%">TITLE</th>
                            <th>TAG</th>
                            <th class="text-center">TARGET EFFORT</th>
                            <th class="text-center <?=$is_permitted?>">ACTION</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach($project ?? [] as $proj): foreach($client ?? [] as $cdata): if($proj['clientid'] == $cdata['id']):?>
                          <tr>
                          <?php if(!empty($cdata['profile_avatar'])):?>
                            <td>
                              <div class="text-center">
                                <img src="<?= base_url()?>uploads/files/<?= $cdata['name']. '/'. $cdata['profile_avatar']?>" class="rounded" alt="company image" height="40" width="40">
                              </div>
                            </td>
                          <?php else:?>
                            <td><span class="badge bg-info h5"><?= substr($cdata['company'], 0, 1) ?></span></td>
                          <?php endif?>
                            <td> 
                              <?= $proj['project_name']?> <span class="text-muted"><i>#<?= $proj['projectid']?></i></span><br>
                              <span class="text-muted"><i class="bi bi-chat-left"></i>  &nbsp; <?= $cdata['name']?> &nbsp; <span id="result<?=$proj['projectid']?>"></span></span></td>
                            <td>
                            <?php if (!empty($proj['allot_skills'])) : 
                              $allotSkills = $proj['allot_skills'];
                              $skillsArray = explode(',', $allotSkills);
                              foreach ($skillsArray ?? [] as $skill) : ?>
                                <span class="rounded px-2 py-1 mx-1 my-2 bg-info text-center"><?= $skill ?></span>
                            <?php endforeach; endif?>
                            </td>
                            <td class="text-center"><?= $proj['project_allot_time']?></td>
                            <?php $displayApplyButton = true; foreach ($applicant ?? [] as $app): if ($proj['projectid'] == $app['projectid'] && $itid == $app['itid']): $displayApplyButton = false; ?>
                                <td class="text-center <?=$is_permitted?>">
                                    <span class="text-success">Applied</span>
                                </td>
                              <?php endif; endforeach; if ($displayApplyButton): ?>
                                <td class="text-center <?=$is_permitted?>" id="applied<?= $proj['projectid']?>">
                                  <form action="#" id="applyForm<?= $proj['projectid']?>">
                                    <input type="hidden" name="projectid" id="project_id<?= $proj['projectid']?>" value="<?= $proj['projectid']?>">
                                    <input type="hidden" name="clientid" value="<?= $proj['clientid']?>">
                                    <input type="hidden" name="is_verified" id="is_verified<?= $proj['projectid']?>" value="<?= $is_verified?>">
                                    <input type="hidden" name="itid" id="itid<?= $proj['projectid']?>" value="<?=$itid?>">
                                    <button type="submit" class="btn btn-sm btn-info applyBtn is-applied<?= $proj['projectid']?>" id="<?= $proj['projectid']?>">Apply</button>
                                  </form>
                                </td>
                            <?php endif; ?>
                          </tr>
                            <script>
                              var givenDate = new Date('<?= $proj['created_at']?>');
                              var currentDate = new Date();
                              var timeDiff = currentDate - givenDate;
                              var seconds = Math.floor(timeDiff / 1000);
                              var minutes = Math.floor(seconds / 60);
                              var hours = Math.floor(minutes / 60);
                              var days = Math.floor(hours / 24);
                              var weeks = Math.floor(days / 7);
                              var months = Math.floor(days / 30);

                              var result = '';
                              if (months > 0) {
                                result += months + ' month';
                                if (months > 1) {
                                  result += 's';
                                }
                              } else if (weeks > 0) {
                                result += weeks + ' week';
                                if (weeks > 1) {
                                  result += 's';
                                }
                              } else if (days > 0) {
                                result += days + ' day';
                                if (days > 1) {
                                  result += 's';
                                }
                              } else if (hours > 0) {
                                result += hours + ' hour';
                                if (hours > 1) {
                                  result += 's';
                                }
                              } else if (minutes > 0) {
                                result += minutes + ' minute';
                                if (minutes > 1) {
                                  result += 's';
                                }
                              } else {
                                result += 'Less than a minute';
                              }
                              var resultDiv = document.getElementById('result<?=$proj['projectid']?>');
                              resultDiv.innerHTML = 'Created at ' + result + ' ago';
                            </script>
                          <?php endif; endforeach; endforeach?>
                          </tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php if($usertype == 2) :?>
                <div class="d-flex flex-row-reverse bd-highlight">
                  <div class="mb-2 bd-highlight"><a href="#" data-toggle="modal" data-target="#add-project-modal" class="btn btn-primary"><i class="bi bi-lightbulb"></i><span class="px-2">Add Project</span></a></div>
                </div>
              <?php endif;?>
              <div class="tab-pane fade show active" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
              <?php if($usertype == 2) :?>
              <div class="card" style="min-height: 60px!important">
                <div class="card-body">
                  <div class="d-flex gap-5">
                    <span class="text-success px-4" style="font-weight:800">
                    <?php 
                      if(!empty($active_project_count) || $active_project_count != 0) {
                        echo round($projectperformance = $completed_p_count/$active_project_count*100), '%';
                      } else {
                        echo '0%';
                      }
                    ?> 
                    <span class="text-muted">( PROJECT PERFORMANCE )</span></span>
                   
                   <!-- TICKET COMPLETION -->
                     <span class="text-success px-4" style="font-weight:800">
                    <?php
                      if(!empty($active_ticket_count) || $active_ticket_count != 0) {
                        echo round($taskcompletion = $completed_t_count/$active_ticket_count*100), '%';
                      } else {
                        echo '0%';
                      }
                    ?>
                    <span class="text-muted">( TASK COMPLETION )</span></span>

                    <!-- TASK ON TRACK -->
                    <span class="text-success px-4" style="font-weight:800">
                    <?php 
                      $notdue = $neardue+$ontrack;
                      $allactive = $neardue+$ontrack+$dued;
                      if(!empty($allactive) || $allactive != 0) {
                        echo $round = round($notdue/$allactive*100), '%';
                      } else {
                        echo '0%';
                      }
                    ?> <span class="text-muted">( TASK ON-TRACK )</span></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <div id="projectChart"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                      <div id="ticketChart"></div>
                    </div>
                  </div>
                </div>
              </div>
              
              <ul class="nav nav-tabs mb-4" id="custom-content-below-tab" role="tablist">
                <li class="nav-item" id="alltab">
                  <a class="nav-link active" id="all-tab" data-toggle="pill" href="#all" role="tab" aria-controls="all" aria-selected="true">All Active &nbsp; <span class="badge badge-success" id="countAll"></span></a>
                </li>
                <li class="nav-item" id="nstab">
                  <a class="nav-link" id="notstarted-tab" data-toggle="pill" href="#notstarted" role="tab" aria-controls="notstarted" aria-selected="false">Not Started &nbsp; <span class="badge border" id="countNs">0</span></a>
                </li>
                <li class="nav-item" id="iptab">
                  <a class="nav-link" id="inprogress-tab" data-toggle="pill" href="#inprogress" role="tab" aria-controls="inprogress" aria-selected="false">In-Progress &nbsp; <span class="badge badge-info" id="countIp">0</span></a>
                </li>
                <li class="nav-item" id="ohtab">
                  <a class="nav-link" id="on-hold-tab" data-toggle="pill" href="#on-hold" role="tab" aria-controls="on-hold" aria-selected="false">On Hold &nbsp; <span class="badge badge-warning" id="countOh">0</span></a>
                </li>
                <li class="nav-item" id="cltab">
                  <a class="nav-link" id="cancelled-tab" data-toggle="pill" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled &nbsp; <span class="badge badge-danger" id="countCl">0</span></a>
                </li>
                <li class="nav-item" id="cmtab">
                  <a class="nav-link" id="completed-tab" data-toggle="pill" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed &nbsp; <span class="badge badge-success" id="countCm">0</span></a>
                </li>
                <li class="nav-item" id="artab">
                  <a class="nav-link" id="archived-tab" data-toggle="pill" href="#archived" role="tab" aria-controls="archived" aria-selected="false">Archive &nbsp; <span class="badge badge-danger" id="countAr">0</span></a>
                </li>
              </ul> 
              <div class="card">
                <div class="card-body">
                  <div class="tab-content" id="custom-content-below-tabContent">
                      <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                        <table class="allTicketActive table table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>TITLE</th>
                              <th>CLIENT</th>
                              <th>TAG / SKILLS</th>
                              <th>DESCRIPTION</th>
                              <th>START DATE</th>
                              <th>DESIRED DUE DATE</th>
                              <th>DEVELOPER(S)</th>
                              <th>ACTIVE TICKETS</th>
                              <th>DOCUMENT</th>
                              <th>REMAINING TIME</th>
                              <th>LAST UPDATED</th>
                              <th>STATUS</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                              $index = 0;
                              foreach ($manage ?? [] as $own): 
                                $pmids = explode(',', $own['pmid']);
                                if(in_array($userid, $pmids)): 
                                  $index++;
                                  $labelClasses = [
                                    'Not Started' => 'badge border',
                                    'In Progress' => 'badge border-info badge-info',
                                    'Completed' => 'badge border border-success badge-success',
                                    'On Hold' => 'badge border border-warning badge-warning',
                                    'Cancelled' => 'badge border border-danger badge-danger'
                                  ];
                                $labelClass = $labelClasses[$own['project_label']] ?? '';
                                $count_ticket = $completed_count = $count_document = 0;
                                foreach ($tickets ?? [] as $ticket) {
                                    if ($own['projectid'] == $ticket['projectid']) {
                                        $count_ticket++;
                                        if ($ticket['ticket_label'] == 'Completed') {
                                            $completed_count++;
                                        }
                                    }
                                }
                                $total_completion = ($count_ticket > 0) ? round(($completed_count / $count_ticket) * 100) : 0;
                                $color = ($total_completion == 100) ? 'success' : (($total_completion >= 60) ? 'info' : 'warning');
                                foreach ($documents ?? [] as $document) {
                                    if ($own['projectid'] == $document['projectid']) {
                                        $count_document++;
                                    }
                                }
                                $label = '<span class="' . $labelClass . '">' . $own['project_label'] . '</span>';
                              ?>
                              <tr>
                                  <td><a href="/project/view-project/project=<?=$own['project_code']?>" target="_blank"><?= $own['project_name']?></a><br>
                                    <div class="progress mb-3">
                                      <div class="progress-bar bg-<?=$color?>" role="progressbar" aria-valuenow="<?=$total_completion?>" aria-valuemin="0"
                                          aria-valuemax="100" style="width: <?=$total_completion?>%">
                                        <span><?=$total_completion?>%</span>
                                      </div>
                                    </div>
                                  </td>
                                  <td><?=$own['company']?></td>
                                  <td><?=$own['specialist_tag']?></td>
                                  <td><div class="text-ellipsis"><?= $own['description']?></div></td>
                                  <td><?= (new DateTime($own['start_date']))->format("F d, Y") ?></td>
                                  <td><?= (new DateTime($own['due_date']))->format("F d, Y") ?></td>
                                  <td class="text-center">
                                    <?php foreach($developer ?? [] as $dev): if($own['projectid'] == $dev['projectid']):?>
                                      <?php if(!empty($dev['profile_avatar'])):?>
                                        <img data-toggle="tooltip" title="<?=$dev['name']?>" src="/uploads/files/<?=$dev['name']?>/<?=$dev['profile_avatar']?>" width="36" height="36" class="img-circle" style="margin-left:-10px; border: 2px solid #6c757d;">
                                      <?php else:?>  
                                        <a href="#" data-toggle="tooltip" title="<?=$dev['name']?>" class="h4 bg-light text-secondary border-dark rounded-pill px-2 font-weight-bold" style="margin-left:-10px; border: 3px solid #6c757d;">
                                        <?php 
                                            preg_match_all('/[A-Z]/', $dev['name'], $matches);
                                            $capitalLetters = implode('', $matches[0]);
                                            echo $capitalLetters;
                                          ?>
                                      </a>
                                      <?php endif; endif; endforeach?> 
                                  </td>    
                                  <td><?=$count_ticket?></td>
                                  <td><?=$count_document?></td>
                                  <td>
                                    <?php if($own['project_label'] != 'Completed'):?>
                                      <div class="countdown" data-due="<?=$own['due_date']?>"></div>
                                    <?php else:?>
                                      -
                                    <?php endif?>
                                  </td>
                                  <td><?= (new DateTime($own['last_update']))->format("F d, Y") ?></td>
                                  <td><?=$label?></td>
                              </tr>
                            <?php endif; endforeach;?>
                            <input type="hidden" value="<?=$index?>" id="allCount">
                          </tbody>
                        </table>
                      </div>
                      <div class="tab-pane fade" id="notstarted" role="tabpanel" aria-labelledby="notstarted-tab">
                        <table class="allTicketActive table table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>TITLE</th>
                              <th>CLIENT</th>
                              <th>TAG / SKILLS</th>
                              <th>DESCRIPTION</th>
                              <th>START DATE</th>
                              <th>DESIRED DUE DATE</th>
                              <th>DEVELOPER(S)</th>
                              <th>ACTIVE TICKETS</th>
                              <th>DOCUMENT</th>
                              <th>REMAINING TIME</th>
                              <th>LAST UPDATED</th>
                              <th>STATUS</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $indexns = 0;
                              foreach($notstarted ?? [] as $own):
                                $pmids = explode(',', $own['pmid']);
                                if(in_array($userid, $pmids)): 
                                $indexns++;
                              $count_ticket = $completed_count = $count_document = 0;
                              foreach ($tickets ?? [] as $ticket) {
                                  if ($own['projectid'] == $ticket['projectid']) {
                                      $count_ticket++;
                                      if ($ticket['ticket_label'] == 'Completed') {
                                          $completed_count++;
                                      }
                                  }
                              }
                              $total_completion = ($count_ticket > 0) ? round(($completed_count / $count_ticket) * 100) : 0;
                              $color = ($total_completion == 100) ? 'success' : (($total_completion >= 60) ? 'info' : 'warning');
                              foreach ($documents ?? [] as $document) {
                                  if ($own['projectid'] == $document['projectid']) {
                                      $count_document++;
                                  }
                              }
                            ?>
                              <tr>
                                  <td><a href="/project/view-project/project=<?=$own['project_code']?>" target="_blank"><?= $own['project_name']?></a><br>
                                    <div class="progress mb-3">
                                      <div class="progress-bar bg-<?=$color?>" role="progressbar" aria-valuenow="<?=$total_completion?>" aria-valuemin="0"
                                          aria-valuemax="100" style="width: <?=$total_completion?>%">
                                        <span><?=$total_completion?>%</span>
                                      </div>
                                    </div>
                                  </td>
                                  <td><?=$own['company']?></td>
                                  <td><?=$own['specialist_tag']?></td>
                                  <td><div class="text-ellipsis"><?= $own['description']?></div></td>
                                  <td><?= (new DateTime($own['start_date']))->format("F d, Y") ?></td>
                                  <td><?= (new DateTime($own['due_date']))->format("F d, Y") ?></td>
                                  <td class="text-center">
                                    <?php foreach($developer ?? [] as $dev): if($own['projectid'] == $dev['projectid']):?>
                                      <?php if(!empty($dev['profile_avatar'])):?>
                                        <img data-toggle="tooltip" title="<?=$dev['name']?>" src="/uploads/files/<?=$dev['name']?>/<?=$dev['profile_avatar']?>" width="36" height="36" class="img-circle" style="margin-left:-10px; border: 2px solid #6c757d;">
                                      <?php else:?>  
                                        <a href="#" data-toggle="tooltip" title="<?=$dev['name']?>" class="h4 bg-light text-secondary border-dark rounded-pill px-2 font-weight-bold" style="margin-left:-10px; border: 3px solid #6c757d;">
                                        <?php 
                                            preg_match_all('/[A-Z]/', $dev['name'], $matches);
                                            $capitalLetters = implode('', $matches[0]);
                                            echo $capitalLetters;
                                          ?>
                                      </a>
                                      <?php endif; endif; endforeach?> 
                                  </td>    
                                  <td><?=$count_ticket?></td>
                                  <td><?=$count_document?></td>
                                  <td>
                                    <?php if($own['project_label'] != 'Completed'):?>
                                      <div class="countdown" data-due="<?=$own['due_date']?>"></div>
                                    <?php else:?>
                                      -
                                    <?php endif?>
                                  </td>
                                  <td><?= (new DateTime($own['last_update']))->format("F d, Y") ?></td>
                                  <td><span class="badge border"> <?=$own['project_label']?></span></td>
                              </tr>
                          <?php endif; endforeach?> 
                          <input type="hidden" id="countresNs" value="<?=$indexns?>"> 
                          </tbody>
                        </table>
                      </div>

                      <div class="tab-pane fade" id="inprogress" role="tabpanel" aria-labelledby="inprogress-tab">
                        <table class="allTicketActive table table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>TITLE</th>
                              <th>CLIENT</th>
                              <th>TAG / SKILLS</th>
                              <th>DESCRIPTION</th>
                              <th>START DATE</th>
                              <th>DESIRED DUE DATE</th>
                              <th>DEVELOPER(S)</th>
                              <th>ACTIVE TICKETS</th>
                              <th>DOCUMENT</th>
                              <th>REMAINING TIME</th>
                              <th>LAST UPDATED</th>
                              <th>STATUS</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $indexip = 0;
                              foreach($inprogress ?? [] as $own):
                              $pmids = explode(',', $own['pmid']);
                              if(in_array($userid, $pmids)): 
                              $indexip++;
                              $count_ticket = $completed_count = $count_document = 0;
                                foreach ($tickets ?? [] as $ticket) {
                                    if ($own['projectid'] == $ticket['projectid']) {
                                        $count_ticket++;
                                        if ($ticket['ticket_label'] == 'Completed') {
                                            $completed_count++;
                                        }
                                    }
                                }
                                $total_completion = ($count_ticket > 0) ? round(($completed_count / $count_ticket) * 100) : 0;
                                $color = ($total_completion == 100) ? 'success' : (($total_completion >= 60) ? 'info' : 'warning');
                                foreach ($documents ?? [] as $document) {
                                    if ($own['projectid'] == $document['projectid']) {
                                        $count_document++;
                                    }
                                }
                            ?>
                              <tr>
                                  <td><a href="/project/view-project/project=<?=$own['project_code']?>" target="_blank"><?= $own['project_name']?></a><br>
                                    <div class="progress mb-3">
                                      <div class="progress-bar bg-<?=$color?>" role="progressbar" aria-valuenow="<?=$total_completion?>" aria-valuemin="0"
                                          aria-valuemax="100" style="width: <?=$total_completion?>%">
                                        <span><?=$total_completion?>%</span>
                                      </div>
                                    </div>
                                  </td>
                                  <td><?=$own['company']?></td>
                                  <td><?=$own['specialist_tag']?></td>
                                  <td><div class="text-ellipsis"><?= $own['description']?></div></td>
                                  <td><?= (new DateTime($own['start_date']))->format("F d, Y") ?></td>
                                  <td><?= (new DateTime($own['due_date']))->format("F d, Y") ?></td>
                                  <td class="text-center">
                                    <?php foreach($developer ?? [] as $dev): if($own['projectid'] == $dev['projectid']):?>
                                      <?php if(!empty($dev['profile_avatar'])):?>
                                        <img data-toggle="tooltip" title="<?=$dev['name']?>" src="/uploads/files/<?=$dev['name']?>/<?=$dev['profile_avatar']?>" width="36" height="36" class="img-circle" style="margin-left:-10px; border: 2px solid #6c757d;">
                                      <?php else:?>  
                                        <a href="#" data-toggle="tooltip" title="<?=$dev['name']?>" class="h4 bg-light text-secondary border-dark rounded-pill px-2 font-weight-bold" style="margin-left:-10px; border: 3px solid #6c757d;">
                                        <?php 
                                            preg_match_all('/[A-Z]/', $dev['name'], $matches);
                                            $capitalLetters = implode('', $matches[0]);
                                            echo $capitalLetters;
                                          ?>
                                      </a>
                                      <?php endif; endif; endforeach?> 
                                  </td>    
                                  <td><?=$count_ticket?></td>
                                  <td><?=$count_document?></td>
                                  <td>
                                    <?php if($own['project_label'] != 'Completed'):?>
                                      <div class="countdown" data-due="<?=$own['due_date']?>"></div>
                                    <?php else:?>
                                      -
                                    <?php endif?>
                                  </td>
                                  <td><?= (new DateTime($own['last_update']))->format("F d, Y") ?></td>
                                  <td><span class="badge border badge-info"><?=$own['project_label']?></span></td>
                              </tr>
                          <?php endif; endforeach?> 
                          <input type="hidden" id="countresIp" value="<?=$indexip?>"> 
                          
                          </tbody>
                        </table>
                      </div>

                      <div class="tab-pane fade" id="on-hold" role="tabpanel" aria-labelledby="on-hold-tab">
                        <table class="allTicketActive table table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>TITLE</th>
                              <th>CLIENT</th>
                              <th>TAG / SKILLS</th>
                              <th>DESCRIPTION</th>
                              <th>START DATE</th>
                              <th>DESIRED DUE DATE</th>
                              <th>DEVELOPER(S)</th>
                              <th>ACTIVE TICKETS</th>
                              <th>DOCUMENT</th>
                              <th>REMAINING TIME</th>
                              <th>LAST UPDATED</th>
                              <th>STATUS</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $indexoh = 0;
                              foreach($onhold ?? [] as $own):
                              $pmids = explode(',', $own['pmid']);
                              if(in_array($userid, $pmids)): 
                              $indexoh++;
                              $count_ticket = $completed_count = $count_document = 0;
                              foreach ($tickets ?? [] as $ticket) {
                                  if ($own['projectid'] == $ticket['projectid']) {
                                      $count_ticket++;
                                      if ($ticket['ticket_label'] == 'Completed') {
                                          $completed_count++;
                                      }
                                  }
                              }
                              $total_completion = ($count_ticket > 0) ? round(($completed_count / $count_ticket) * 100) : 0;
                              $color = ($total_completion == 100) ? 'success' : (($total_completion >= 60) ? 'info' : 'warning');
                              foreach ($documents ?? [] as $document) {
                                  if ($own['projectid'] == $document['projectid']) {
                                      $count_document++;
                                  }
                              }
                            ?>
                              <tr>
                                  <td><a href="/project/view-project/project=<?=$own['project_code']?>" target="_blank"><?= $own['project_name']?></a><br>
                                    <div class="progress mb-3">
                                      <div class="progress-bar bg-<?=$color?>" role="progressbar" aria-valuenow="<?=$total_completion?>" aria-valuemin="0"
                                          aria-valuemax="100" style="width: <?=$total_completion?>%">
                                        <span><?=$total_completion?>%</span>
                                      </div>
                                    </div>
                                  </td>
                                  <td><?=$own['company']?></td>
                                  <td><?=$own['specialist_tag']?></td>
                                  <td><div class="text-ellipsis"><?= $own['description']?></div></td>
                                  <td><?= (new DateTime($own['start_date']))->format("F d, Y") ?></td>
                                  <td><?= (new DateTime($own['due_date']))->format("F d, Y") ?></td>
                                  <td class="text-center">
                                    <?php foreach($developer ?? [] as $dev): if($own['projectid'] == $dev['projectid']):?>
                                      <?php if(!empty($dev['profile_avatar'])):?>
                                        <img data-toggle="tooltip" title="<?=$dev['name']?>" src="/uploads/files/<?=$dev['name']?>/<?=$dev['profile_avatar']?>" width="36" height="36" class="img-circle" style="margin-left:-10px; border: 2px solid #6c757d;">
                                      <?php else:?>  
                                        <a href="#" data-toggle="tooltip" title="<?=$dev['name']?>" class="h4 bg-light text-secondary border-dark rounded-pill px-2 font-weight-bold" style="margin-left:-10px; border: 3px solid #6c757d;">
                                        <?php 
                                            preg_match_all('/[A-Z]/', $dev['name'], $matches);
                                            $capitalLetters = implode('', $matches[0]);
                                            echo $capitalLetters;
                                          ?>
                                      </a>
                                      <?php endif; endif; endforeach?> 
                                  </td>    
                                  <td><?=$count_ticket?></td>
                                  <td><?=$count_document?></td>
                                  <td>
                                    <?php if($own['project_label'] != 'Completed'):?>
                                      <div class="countdown" data-due="<?=$own['due_date']?>"></div>
                                    <?php else:?>
                                      -
                                    <?php endif?>
                                  </td>
                                  <td><?= (new DateTime($own['last_update']))->format("F d, Y") ?></td>
                                  <td><span class="border badge badge-warning"><?=$own['project_label']?></span></td>
                              </tr>
                          <?php endif; endforeach?> 
                          <input type="hidden" id="countresOh" value="<?=$indexoh?>">   
                          </tbody>
                        </table>
                      </div>

                      <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                        <table class="allTicketActive table table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>TITLE</th>
                              <th>CLIENT</th>
                              <th>TAG / SKILLS</th>
                              <th>DESCRIPTION</th>
                              <th>START DATE</th>
                              <th>DESIRED DUE DATE</th>
                              <th>DEVELOPER(S)</th>
                              <th>ACTIVE TICKETS</th>
                              <th>DOCUMENT</th>
                              <th>REMAINING TIME</th>
                              <th>LAST UPDATED</th>
                              <th>STATUS</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $indexcl = 0;
                              foreach($cancelled ?? [] as $own):
                                $pmids = explode(',', $own['pmid']);
                                if(in_array($userid, $pmids)): 
                                $indexcl++;
                                $count_ticket = $completed_count = $count_document = 0;
                                foreach ($tickets ?? [] as $ticket) {
                                    if ($own['projectid'] == $ticket['projectid']) {
                                        $count_ticket++;
                                        if ($ticket['ticket_label'] == 'Completed') {
                                            $completed_count++;
                                        }
                                    }
                                }
                                $total_completion = ($count_ticket > 0) ? round(($completed_count / $count_ticket) * 100) : 0;
                                $color = ($total_completion == 100) ? 'success' : (($total_completion >= 60) ? 'info' : 'warning');
                                foreach ($documents ?? [] as $document) {
                                    if ($own['projectid'] == $document['projectid']) {
                                        $count_document++;
                                    }
                                }
                            ?>
                              <tr>
                                  <td><a href="/project/view-project/project=<?=$own['project_code']?>" target="_blank"><?= $own['project_name']?></a><br>
                                    <div class="progress mb-3">
                                      <div class="progress-bar bg-<?=$color?>" role="progressbar" aria-valuenow="<?=$total_completion?>" aria-valuemin="0"
                                          aria-valuemax="100" style="width: <?=$total_completion?>%">
                                        <span><?=$total_completion?>%</span>
                                      </div>
                                    </div>
                                  </td>
                                  <td><?=$own['company']?></td>
                                  <td><?=$own['specialist_tag']?></td>
                                  <td><div class="text-ellipsis"><?= $own['description']?></div></td>
                                  <td><?= (new DateTime($own['start_date']))->format("F d, Y") ?></td>
                                  <td><?= (new DateTime($own['due_date']))->format("F d, Y") ?></td>
                                  <td class="text-center">
                                    <?php foreach($developer ?? [] as $dev): if($own['projectid'] == $dev['projectid']):?>
                                      <?php if(!empty($dev['profile_avatar'])):?>
                                        <img data-toggle="tooltip" title="<?=$dev['name']?>" src="/uploads/files/<?=$dev['name']?>/<?=$dev['profile_avatar']?>" width="36" height="36" class="img-circle" style="margin-left:-10px; border: 2px solid #6c757d;">
                                      <?php else:?>  
                                        <a href="#" data-toggle="tooltip" title="<?=$dev['name']?>" class="h4 bg-light text-secondary border-dark rounded-pill px-2 font-weight-bold" style="margin-left:-10px; border: 3px solid #6c757d;">
                                        <?php 
                                            preg_match_all('/[A-Z]/', $dev['name'], $matches);
                                            $capitalLetters = implode('', $matches[0]);
                                            echo $capitalLetters;
                                          ?>
                                      </a>
                                      <?php endif; endif; endforeach?> 
                                  </td>    
                                  <td><?=$count_ticket?></td>
                                  <td><?=$count_document?></td>
                                  <td>
                                    <?php if($own['project_label'] != 'Completed'):?>
                                      <div class="countdown" data-due="<?=$own['due_date']?>"></div>
                                    <?php else:?>
                                      -
                                    <?php endif?>
                                  </td>
                                  <td><?= (new DateTime($own['last_update']))->format("F d, Y") ?></td>
                                  <td><span class="border badge badge-danger"><?= $own['project_label']?></span></td>
                              </tr>
                          <?php endif; endforeach?> 
                          <input type="hidden" id="countresCl" value="<?=$indexcl?>">  
                          </tbody>
                        </table>
                      </div>

                      <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <table class="allTicketActive table table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>TITLE</th>
                              <th>CLIENT</th>
                              <th>TAG / SKILLS</th>
                              <th>DESCRIPTION</th>
                              <th>START DATE</th>
                              <th>DESIRED DUE DATE</th>
                              <th>DEVELOPER(S)</th>
                              <th>ACTIVE TICKETS</th>
                              <th>DOCUMENT</th>
                              <th>REMAINING TIME</th>
                              <th>LAST UPDATED</th>
                              <th>STATUS</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                               $indexcm = 0;
                               foreach($completed ?? [] as $own):
                               $pmids = explode(',', $own['pmid']);
                               if(in_array($userid, $pmids)): 
                               $indexcm++;
                               $count_ticket = $completed_count = $count_document = 0;
                               foreach ($tickets ?? [] as $ticket) {
                                   if ($own['projectid'] == $ticket['projectid']) {
                                       $count_ticket++;
                                       if ($ticket['ticket_label'] == 'Completed') {
                                           $completed_count++;
                                       }
                                   }
                               }
                               $total_completion = ($count_ticket > 0) ? round(($completed_count / $count_ticket) * 100) : 0;
                               $color = ($total_completion == 100) ? 'success' : (($total_completion >= 60) ? 'info' : 'warning');
                               foreach ($documents ?? [] as $document) {
                                   if ($own['projectid'] == $document['projectid']) {
                                       $count_document++;
                                   }
                               }
                            ?>
                              <tr>
                                  <td><a href="/project/view-project/project=<?=$own['project_code']?>" target="_blank"><?= $own['project_name']?></a><br>
                                    <div class="progress mb-3">
                                      <div class="progress-bar bg-<?=$color?>" role="progressbar" aria-valuenow="<?=$total_completion?>" aria-valuemin="0"
                                          aria-valuemax="100" style="width: <?=$total_completion?>%">
                                        <span><?=$total_completion?>%</span>
                                      </div>
                                    </div>
                                  </td>
                                  <td><?=$own['company']?></td>
                                  <td><?=$own['specialist_tag']?></td>
                                  <td><div class="text-ellipsis"><?= $own['description']?></div></td>
                                  <td><?= (new DateTime($own['start_date']))->format("F d, Y") ?></td>
                                  <td><?= (new DateTime($own['due_date']))->format("F d, Y") ?></td>
                                  <td class="text-center">
                                    <?php foreach($developer ?? [] as $dev): if($own['projectid'] == $dev['projectid']):?>
                                      <?php if(!empty($dev['profile_avatar'])):?>
                                        <img data-toggle="tooltip" title="<?=$dev['name']?>" src="/uploads/files/<?=$dev['name']?>/<?=$dev['profile_avatar']?>" width="36" height="36" class="img-circle" style="margin-left:-10px; border: 2px solid #6c757d;">
                                      <?php else:?>  
                                        <a href="#" data-toggle="tooltip" title="<?=$dev['name']?>" class="h4 bg-light text-secondary border-dark rounded-pill px-2 font-weight-bold" style="margin-left:-10px; border: 3px solid #6c757d;">
                                        <?php 
                                            preg_match_all('/[A-Z]/', $dev['name'], $matches);
                                            $capitalLetters = implode('', $matches[0]);
                                            echo $capitalLetters;
                                          ?>
                                      </a>
                                      <?php endif; endif; endforeach?> 
                                  </td>    
                                  <td><?=$count_ticket?></td>
                                  <td><?=$count_document?></td>
                                  <td>
                                    <?php if($own['project_label'] != 'Completed'):?>
                                      <div class="countdown" data-due="<?=$own['due_date']?>"></div>
                                    <?php else:?>
                                      -
                                    <?php endif?>
                                  </td>
                                  <td><?= (new DateTime($own['last_update']))->format("F d, Y") ?></td>
                                  <td><span class="border badge badge-success"><?=$own['project_label']?></span></td>
                              </tr>
                          <?php endif; endforeach?> 
                          <input type="hidden" id="countresCm" value="<?=$indexcm?>"> 
                          </tbody>
                        </table>
                      </div>

                      <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
                        <table class="allTicketActive table table-hover table-bordered">
                          <thead>
                            <tr>
                              <th>TITLE</th>
                              <th>CLIENT</th>
                              <th>TAG / SKILLS</th>
                              <th>DESCRIPTION</th>
                              <th>START DATE</th>
                              <th>DESIRED DUE DATE</th>
                              <th>DEVELOPER(S)</th>
                              <th>ACTIVE TICKETS</th>
                              <th>DOCUMENT</th>
                              <th>REMAINING TIME</th>
                              <th>LAST UPDATED</th>
                              <th>STATUS</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                                $indexar = 0;
                                foreach($archived as $own):
                                $pmids = explode(',', $own['pmid']);
                                if(in_array($userid, $pmids)): 
                                $indexar++;
                                $count_ticket = $completed_count = $count_document = 0;
                                foreach ($tickets ?? [] as $ticket) {
                                    if ($own['projectid'] == $ticket['projectid']) {
                                        $count_ticket++;
                                        if ($ticket['ticket_label'] == 'Completed') {
                                            $completed_count++;
                                        }
                                    }
                                }
                                $total_completion = ($count_ticket > 0) ? round(($completed_count / $count_ticket) * 100) : 0;
                                $color = ($total_completion == 100) ? 'success' : (($total_completion >= 60) ? 'info' : 'warning');
                                foreach ($documents ?? [] as $document) {
                                    if ($own['projectid'] == $document['projectid']) {
                                        $count_document++;
                                    }
                                }
                            ?>
                              <tr>
                                  <td><a href="/project/view-project/project=<?=$own['project_code']?>" target="_blank"><?= $own['project_name']?></a><br>
                                    <div class="progress mb-3">
                                      <div class="progress-bar bg-<?=$color?>" role="progressbar" aria-valuenow="<?=$total_completion?>" aria-valuemin="0"
                                          aria-valuemax="100" style="width: <?=$total_completion?>%">
                                        <span><?=$total_completion?>%</span>
                                      </div>
                                    </div>
                                  </td>
                                  <td><?=$own['company']?></td>
                                  <td><?=$own['specialist_tag']?></td>
                                  <td><div class="text-ellipsis"><?= $own['description']?></div></td>
                                  <td><?= (new DateTime($own['start_date']))->format("F d, Y") ?></td>
                                  <td><?= (new DateTime($own['due_date']))->format("F d, Y") ?></td>
                                  <td class="text-center">
                                    <?php foreach($developer ?? [] as $dev): if($own['projectid'] == $dev['projectid']):?>
                                      <?php if(!empty($dev['profile_avatar'])):?>
                                        <img data-toggle="tooltip" title="<?=$dev['name']?>" src="/uploads/files/<?=$dev['name']?>/<?=$dev['profile_avatar']?>" width="36" height="36" class="img-circle" style="margin-left:-10px; border: 2px solid #6c757d;">
                                      <?php else:?>  
                                        <a href="#" data-toggle="tooltip" title="<?=$dev['name']?>" class="h4 bg-light text-secondary border-dark rounded-pill px-2 font-weight-bold" style="margin-left:-10px; border: 3px solid #6c757d;">
                                        <?php 
                                            preg_match_all('/[A-Z]/', $dev['name'], $matches);
                                            $capitalLetters = implode('', $matches[0]);
                                            echo $capitalLetters;
                                          ?>
                                      </a>
                                      <?php endif; endif; endforeach?> 
                                  </td>    
                                  <td><?=$count_ticket?></td>
                                  <td><?=$count_document?></td>
                                  <td>
                                    <?php if($own['project_label'] != 'Completed'):?>
                                      <div class="countdown" data-due="<?=$own['due_date']?>"></div>
                                    <?php else:?>
                                      -
                                    <?php endif?>
                                  </td>
                                  <td><?= (new DateTime($own['last_update']))->format("F d, Y") ?></td>
                                  <td><span class="border badge badge-danger"><?=$own['project_label']?></span></td>
                              </tr>
                          <?php endif; endforeach?> 
                          <input type="hidden" id="countresAr" value="<?=$indexar?>">   
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php else:?>
              <div class="card">
                <div class="card-body">
                  <table class="allTicketActive table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th>TITLE</th>
                        <th>CLIENT</th>
                        <th>ACTIVE TICKETS</th>
                        <th>TARGET EFFORT</th>
                        <th>REMAINING TIME</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($owned ?? [] as $own) : ?>
                        <tr data-toggle="collapse" href="#collapseExample<?= $own['projectid'] ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                          <td><a href="/project/view-project/project=<?=$own['project_code']?>"><?=$own['project_name']?></a></td>
                          <?php foreach ($client ?? [] as $cl) : if ($own['clientid'] == $cl['id']) : ?>
                              <td><?=$cl['company']?></td>
                            <?php endif; endforeach?>
                          <?php
                          $count_ticket = 0;
                          foreach ($tickets ?? [] as $ticket) {
                            if ($own['projectid'] == $ticket['projectid']) {
                              $count_ticket++;
                            }
                          }
                          ?>
                          <td><?=$count_ticket?></td>
                          <td><?=$own['project_allot_time']?></td>
                          <td>
                            <?php if ($own['project_label'] != 'Completed') : ?>
                              <div class="countdown" data-due="<?=$own['due_date']?>"></div>
                            <?php else : ?>
                              -
                            <?php endif ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
              <?php endif?>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<div class="modal fade" id="add-project-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header border-0">

    <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
    <!-- <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
    style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a> -->
    </div>
      <div class="modal-body form" style="margin-top: -1.5rem">
        <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Create Project</span></span>
        <!-- <?= base_url()?>ticket/create-assign-project -->
            <form action="<?= base_url()?>ticket/create-assign-project" method="POST" id="createAssignProjects" class="form-horizontal">
            <div class="form-group mb-4">
              <div class="row">
                <div class="col-md-6 mt-3">
                  <label class="control-label">Project Title</label>
                  <input type="hidden" name="pmid" class="custom-form" value="<?= $itid?>">
                  <input type="hidden" name="allot_time" id="result" class="custom-form">
                  <input id="projectName" type="text" name="project_name" class="custom-form">
                  </select>
                </div>

                <div class="col-md-6 mt-3">
                    <label class="control-label">Project Alias</label>
                    <input type="text" name="project_alias" class="custom-form">
                </div>

                <div class="col-md-6 mt-3">
                  <label>Budget</label>
                  <input type="text" name="budget" class="custom-form" value="">
                </div>

                <div class="col-md-6 mt-3">
                  <label>Project Label Status</label>
                  <select id="projectLabel" class="select2 custom-form" name="label" required data-placeholder="Select Status" data-dropdown-css-class="select2-primary"  style="width: 100%;">
                      <option value="Not Started">Not Started</option>
                      <option value="In Progress">In Progress</option>
                      <option value="On Hold">On Hold</option>
                      <option value="Cancelled">Cancelled</option>
                      <option value="Completed">Completed</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-7 mt-3">
                  <label class="control-label col-md-12">Client</label>
                  <select class="select2 custom-form" name="clientid" required data-placeholder="Select Priority" data-dropdown-css-class="select2-primary"  style="width: 100%;">
                    <?php foreach ($client ?? [] as $data):?>
                      <option value="<?=$data['id']?>"><?=$data['company']?></option>
                    <?php endforeach?>
                  </select>
                </div>

                <div class="col-md-5 mt-3">
                  <label class="control-label col-md-12">Developer</label>
                  <select class="select2 custom-form" name="developers[]" multiple="multiple" data-placeholder="Select Developers" data-dropdown-css-class="select2-primary" style="width: 100%;" required>
                    <?php foreach ($developers ?? [] as $dev):?>
                      <option value="<?=$dev['id']?>"><?=$dev['name']?></option>
                    <?php endforeach?>
                  </select>
                </div>
              </div>
                    
              <div class="row">
                  <div class="col-md-4 mt-3">
                    <label class="control-label col-md-12">Tag  <span data-toggle="tooltip" title="Specialist eg: Software Engineer | Web Developer | Cloud Server etc."><i class="bi bi-question-circle text-info"></i></span></label>
                    <input id="projectTag" type="text" name="tag" class="custom-form" value="">
                  </div>
                  
                  <div class="col-md-4 mt-3">
                    <label class="control-label col-md-12">Started Date</label>
                    <input type="date" name="start_date" id="project_start_date" class="custom-form" value="">
                  </div>

                  <div class="col-md-4 mt-3">
                    <label class="control-label col-md-12">Due Date</label>
                    <input type="date" name="due_date" id="project_due_date" class="custom-form" value="">
                  </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <label class="control-label mt-3">Skills needed <span data-toggle="tooltip" title="On listing Skills needed to this project you must seperate it in comma(,) eg: (skill#1, skill#2, skill#3)"><i class="bi bi-question-circle text-info"></i></span></label>
                  <textarea id="projectSkills" name="skills" rows="3" class="custom-form"></textarea>
                </div>
              </div>
                    
              <!-- Introduction -->
              <div class="row">
                <div class="col-md-12">
                  <label class="control-label mt-3">Project description</label>
                  <textarea id="projectDescription" name="description" class="custom-form" rows="8"></textarea>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <label class="control-label mt-3">Migrate Start-up Ticket? <span class="py-2" data-toggle="tooltip" title="By tick marking the checkbox it will create tickets for start up along with the creation of the project"><i class="bi bi-question-circle text-info"></i></span></label><br>
                  <input type="checkbox" name="status_type" id="statusType" value="1" class="px-3"> Yes
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer border-0" style="margin-top: -2rem">
            <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
            <button type="submit" id="createAssignProjectBtsn" class="custom-btn bg-primary text-decoration-none text-white">Proceed &nbsp; <i class="bi bi-arrow-right-circle"></i></button>
            </form>
        </div>
      </div>
    </div>
    <script>
      $('#createAssignProjectBtn').on('click', function(){
      const swalAlert = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-primary mx-2 px-5',
          cancelButton: 'btn btn-default px-5'
        },
        buttonsStyling: false
      })

      var projectName = $('#projectName').val();
      var projectLabel = $('#projectLabel').val();
      var projectTag = $('#projectTag').val();
      var projectSkills = $('#projectSkills').val();
      var projectStart = $('#project_start_date').val();
      var projectDue = $('#project_due_date').val();
      var projectDescription = $('#projectDescription').val();

      if (projectName === '' || projectLabel === '' || projectTag === '' || projectSkills === '' || projectStart === '' || projectDue === '' || projectDescription === '') {
        swalAlert.fire({
          title: 'Opps!',
          text: 'The project`s ( Name, Status, Tags, Skills, Start date, Due date and Description ) are required!',
          icon: 'warning',
          confirmButtonText: '<i class="bi bi-hand-thumbs-up"></i> Got it!',
        });
        return;
      }

      swalAlert.fire({
        title: 'Is the project module development?',
        text: 'By clicking yes, it will automatically create necessary tickets for starters!',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'YES',
        cancelButtonText: 'NO',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          var formData = $('#createAssignProjects').serialize();
          $.post({
            url: '/ticket/create-assign-project',
            data: formData,
            success: function(response) {
              swalAlert.fire(
                'Success!',
                'Your form has been submitted successfully Module.',
                'success'
              );
              setTimeout(function(){
                window.location.reload();
              }, 1400);
            },
            error: function(xhr, status, error) {
              swalAlert.fire(
                'Error!',
                'Failed to submit the form. Please try again later.',
                'error'
              );
            }
          });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          $.post({
            url: '/ticket/create-assign-project',
            data: formData,
            success: function(response) {
              swalAlert.fire(
                'Success!',
                'Your form has been submitted successfully not a Module.',
                'success'
              );
              setTimeout(function(){
                window.location.reload();
              }, 1400);
            },
            error: function(xhr, status, error) {
              swalAlert.fire(
                'Error!',
                'Failed to submit the form. Please try again later.',
                'error'
              );
            }
          });
        }
      });
    });


    </script>
    <!-- CHART -->
    <script>
      const all = parseInt($('#allCount').val(), 10) || 0;
      const countNs = parseInt($('#countresNs').val(), 10) || 0;
      const countIp = parseInt($('#countresIp').val(), 10) || 0;
      const countOh = parseInt($('#countresOh').val(), 10) || 0;
      const countCl = parseInt($('#countresCl').val(), 10) || 0;
      const countCm = parseInt($('#countresCm').val(), 10) || 0;
      const countAr = parseInt($('#countresAr').val(), 10) || 0;
      
      const all_active = countNs + countIp;
      
      console.log(all_active)
      $('#countAll').html(all_active)

      $('#countNs').html(countNs)
      $('#countIp').html(countIp)
      $('#countOh').html(countOh)
      $('#countCl').html(countCl)
      $('#countCm').html(countCm)
      $('#countAr').html(countAr)

      if(all == 0) {
        $("#alltab").prop("hidden", true);
      } else {
        $("#alltab").prop("hidden", false);
      }
      if(countNs == 0) {
        $("#nstab").prop("hidden", true);
      } else {
        $("#nstab").prop("hidden", false);
      }
      if(countIp == 0) {
        $("#iptab").prop("hidden", true);
      } else {
        $("#iptab").prop("hidden", false);
      }
      if(countOh == 0) {
        $("#ohtab").prop("hidden", true);
      } else {
        $("#ohtab").prop("hidden", false);
      }
      if(countCl == 0) {
        $("#cltab").prop("hidden", true);
      } else {
        $("#cltab").prop("hidden", false);
      }
      if(countCm == 0) {
        $("#cmtab").prop("hidden", true);
      } else {
        $("#cmtab").prop("hidden", false);
      }
      if(countAr == 0) {
        $("#artab").prop("hidden", true);
      } else {
        $("#artab").prop("hidden", false);
      }

      let notStarted = $('#countresNs').val();
      let inProgress = $('#countresIp').val();
      let onHold     = $('#countresOh').val();
      let cancelled  = $('#countresCl').val();
      let completed  = $('#countresCm').val();

      // Sample data for the chart
      const data = {
          categories: [ ['NOT', 'STARTED'], 'COMPLETED',  ['ON', 'HOLD'], 'CANCELLED', ['IN', 'PROGRESS'],  ],
          series: [notStarted, completed, onHold, cancelled, inProgress]
      };

      // Custom colors for different elements
      const colors = {
          series: ['#292b2c',  '#28a745', '#ffc107', '#dc3545', '#17a2b8'],
          xaxisText: ['#292b2c',  '#28a745', '#ffc107', '#dc3545', '#17a2b8'],
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
              text: 'Overall Project Status',
              align: 'center',
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
          }
      };

  // Create the chart
  const chart = new ApexCharts(document.querySelector('#projectChart'), options);

  // Render the chart with the data
  chart.render();


  let onTrack = <?=$ontrack?>;
  let remainingDaysDue = <?=$neardue?>;
  let overDue = <?=$dued?>;
  const data2 = {
      categories: [['ON', 'TRACK'], ['3 DAYS', 'TO DUE'], 'OVERDUE'],
      series: [onTrack, remainingDaysDue, overDue]
  };

  // Custom colors for different elements
  const colors2 = {
      series: ['#28a745', '#ffc107', '#dc3545'],
      xaxisText: ['#28a745', '#ffc107', '#dc3545'],
      gridLines: '#fff'
  };

  // Options for the chart
  const options2 = {
      chart: {
          type: 'bar',
          height: 250,
          toolbar: {
              show: false
          }
      },
      title: {
          text: 'Overall Ticket Status',
          align: 'center',
          style: {
              fontSize: '14px',
              fontWeight: '600',
              color: '#4FAFCB'
          }
      },
      series: [{
          name: 'Total of',
          data: data2.series
      }],
      xaxis: {
          categories: data2.categories,
          labels: {
              style: {
                  colors: colors2.xaxisText
              }
          },
          axisBorder: {
              color: colors2.gridLines
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
              color: colors2.gridLines
          }
      },
      colors: colors2.series,
      plotOptions: {
          bar: {
              columnWidth: '65%',
              distributed: true,
          }
      },
      grid: {
          borderColor: colors2.gridLines
      }
  };

  const chart2 = new ApexCharts(document.querySelector('#ticketChart'), options2);
  chart2.render();

      var countdownElements = document.getElementsByClassName("countdown");
      for (var i = 0; i < countdownElements.length; i++) {
          var countdownElement = countdownElements[i];
          var dueDateStr = countdownElement.getAttribute("data-due");
          
          calculateLargestUnit(countdownElement, dueDateStr);
      }
      
      function calculateLargestUnit(element, dueDateStr) {
        var currentDate = new Date();
        var dueDate = new Date(dueDateStr);
        var timeDiff = dueDate.getTime() - currentDate.getTime();
        var months = Math.floor(timeDiff / (1000 * 60 * 60 * 24 * 30));
        var weeks = Math.floor((timeDiff % (1000 * 60 * 60 * 24 * 30)) / (1000 * 60 * 60 * 24 * 7));
        var days = Math.floor((timeDiff % (1000 * 60 * 60 * 24 * 7)) / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        
        var largestUnit;
        if (timeDiff <= 0) {
            largestUnit = '<span class="text-red"><i class="bi bi-flag-fill text-red px-1"></i> Overdued!</span>';
            
          } else if (months > 0) {
              largestUnit = months + " month" + (months > 1 ? "s" : "");
          } else if (weeks > 0) {
              largestUnit = weeks + " week" + (weeks > 1 ? "s" : "");
          } else if (days > 0) {
              largestUnit = days + " day" + (days > 1 ? "s" : "");
          } else {
              largestUnit = hours + " hour" + (hours > 1 ? "s" : "");
          }
            element.innerHTML = largestUnit;
        }
    </script>
    <script src="<?= base_url()?>js/ticket.js"></script>
  <?= $this->endsection() ?>