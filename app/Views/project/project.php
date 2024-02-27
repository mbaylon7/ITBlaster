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
</style>
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $name?>`s &nbsp;</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active">
                  <?= $name?>`s &nbsp; Project List
                  </li>
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
            <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-end">
                    <a href="#" data-toggle="modal" data-target="#add-project-modal" class="btn btn-info btn-sm"><i class="bi bi-stack"></i> Create Project</a>
                  </div>
                  <ul class="nav nav-tabs mb-4" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="all-tab" data-toggle="pill" href="#all" role="tab" aria-controls="all" aria-selected="true">All Active </a>
                    </li>
                    <li class="nav-item">
                      <?php if(!empty($notstarted)):?>
                      <a class="nav-link" id="notstarted-tab" data-toggle="pill" href="#notstarted" role="tab" aria-controls="notstarted" aria-selected="false">Not Started &nbsp; <span class="badge border"><?= $notstarted?></span></a>
                    </li>
                      <?php endif;?>
                    <li class="nav-item">
                      <?php if(!empty($progress)):?>
                      <a class="nav-link" id="inprogress-tab" data-toggle="pill" href="#inprogress" role="tab" aria-controls="inprogress" aria-selected="false">In-Progress &nbsp; <span class="badge badge-info"><?= $progress?></span></a>
                    </li>
                      <?php endif;?>
                    <li class="nav-item">
                      <?php if(!empty($onhold)):?>
                      <a class="nav-link" id="on-hold-tab" data-toggle="pill" href="#on-hold" role="tab" aria-controls="on-hold" aria-selected="false">On Hold &nbsp; <span class="badge badge-warning"><?= $onhold?></span></a>
                    </li>
                      <?php endif;?>
                    <li class="nav-item">
                      <?php if(!empty($cancelled)):?>
                      <a class="nav-link" id="cancelled-tab" data-toggle="pill" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled &nbsp; <span class="badge badge-danger"><?= $cancelled?></span></a>
                    </li>
                      <?php endif;?>
                    <li class="nav-item">
                      <?php if(!empty($completed)):?>
                      <a class="nav-link" id="completed-tab" data-toggle="pill" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed &nbsp; <span class="badge badge-success"><?= $completed?></span></a>
                    </li>
                      <?php endif;?>
                    <li class="nav-item">
                      <?php if(!empty($archived)):?>
                      <a class="nav-link" id="archived-tab" data-toggle="pill" href="#archived" role="tab" aria-controls="archived" aria-selected="false">Archive &nbsp; <span class="badge badge-danger"><?= $archived?></span></a>
                    </li>
                      <?php endif;?>
                  </ul>
                  <div class="tab-content" id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                      <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTableFull0">
                          <thead class="bg-light">
                            <tr class="text-center">
                              <th>TITLE</th>
                              <th>TAG/SKILLS</th>
                              <th width="20%">DESCRIPTION</th>
                              <th>DESIRED DUEDATE</th>
                              <th>TICKETS</th>
                              <th>DOCUMENTS</th>
                              <th>STATUS</th>
                              <th>MANAGE</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(!empty($all)): foreach ($all as $data):
                              $count_ticket = 0;
                              $count_document = 0;
                              $notcompleted = 0;
                              $completed_count = 0;
                              $total_completion = 0;
                              $count_file = 0;
                              $count_ticket = 0;

                              if($data['project_label'] == 'Not Started'){
                                $label = '<span class="badge border">'.$data['project_label'].'</span>';
                              }elseif($data['project_label'] == 'In Progress'){
                                  $label = '<span class="badge border-info badge-info">'.$data['project_label'].'</span>';
                              }elseif($data['project_label'] == 'Completed'){
                                  $label = '<span class="badge border border-success badge-success">'.$data['project_label'].'</span>';
                              }elseif($data['project_label'] == 'On Hold'){
                                  $label = '<span class="badge border border-warning badge-warning">'.$data['project_label'].'</span>';
                              }elseif($data['project_label'] == 'Cancelled'){
                                  $label = '<span class="badge border border-danger badge-danger">'.$data['project_label'].'</span>';
                              }    

                              if(!empty($all_document)){
                                foreach ($all_document as $file){
                                  if($data['projectid'] == $file['projectid']){
                                    $count_file++;
                                    }
                                }
                              }
                              if(!empty($all_ticket)){
                                foreach ($all_ticket as $ticket){
                                  if($data['projectid'] == $ticket['projectid']){
                                    if($ticket['ticket_label'] == 'Completed') {
                                      $completed_count++;
                                    }
                                    $count_ticket++;
                                    }
                                }
                                if(!empty($count_ticket) || $count_ticket != 0) {
                                  $total_completion = round($completed_count/$count_ticket*100);
                                }  
                                $color = '';
                                if($total_completion == 100) {
                                  $color = 'success';
                                } elseif($total_completion >= 60) {
                                  $color = 'info';
                                } elseif($total_completion <= 59) {
                                  $color = 'warning';
                                } 
                              }
                            ?>
                            <tr class="text-center">
                              <td><a target="_blank" id="<?=$data['project_name']?>" class="projectName<?=$data['projectid']?>" href="<?=base_url()?>project/view-project/project=<?=$data['project_code']?>"><?=$data['project_name']?></a>
                                <div class="progress mb-3">
                                  <div class="progress-bar bg-<?= $color?>" role="progressbar" aria-valuenow="<?= $total_completion?>" aria-valuemin="0"
                                      aria-valuemax="100" style="width: <?= $total_completion?>%">
                                    <span><?= $total_completion?>%</span>
                                  </div>
                                </div>
                              </td>
                              <td><?= $data['specialist_tag']?></td>
                              <td><div class="text-ellipsis"><?= $data['description']?></div></td>
                              <td><?= $data['due_date']?></td>
                              <td><?=$count_ticket?></td>
                              <td><?=$count_file?></td>
                              <td><?=$label?></td>
                              <td><a style="cursor:pointer" class="manageProjectStatus" id="<?= $data['projectid']?>" data-id="1" class="ticket-file-upload"><span data-toggle="tooltip" title="Move to Archived"><i class="bi bi-calendar2-x text-danger"></i></span></a></td>
                            </tr>
                            <?php endforeach; endif?>
                          </tbody>
                        </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="notstarted" role="tabpanel" aria-labelledby="notstarted-tab">
                      <table class="table table-hover table-bordered" id="dataTableFull0">
                      <thead class="bg-light">
                          <tr class="text-center">
                            <th>TITLE</th>
                            <th>TAG/SKILLS</th>
                            <th width="20%">DESCRIPTION</th>
                            <th>DESIRED DUEDATE</th>
                            <th>TICKETS</th>
                            <th>DOCUMENTS</th>
                            <th>STATUS</th>
                            <th>MANAGE</th>
                          </tr>
                        <tbody>
                          <?php if(!empty($p_notstarted)): foreach ($p_notstarted as $data):
                            $count_ticket = 0;
                            $count_document = 0;
                            $notcompleted = 0;
                            $completed_count = 0;
                            $total_completion = 0;
                            $count_file = 0;
                            $count_ticket = 0;
                            
                            if(!empty($all_document)){
                              foreach ($all_document as $file){
                                if($data['projectid'] == $file['projectid']){
                                  $count_file++;
                                  }
                              }
                            }
                            if(!empty($all_ticket)){
                              foreach ($all_ticket as $ticket){
                                if($data['projectid'] == $ticket['projectid']){
                                  if($ticket['ticket_label'] == 'Completed') {
                                    $completed_count++;
                                  }
                                  $count_ticket++;
                                  }
                              }
                               if(!empty($count_ticket) || $count_ticket != 0) {
                                  $total_completion = round($completed_count/$count_ticket*100);
                                }  
                              $color = '';
                              if($total_completion == 100) {
                                $color = 'success';
                              } elseif($total_completion >= 60) {
                                $color = 'info';
                              } elseif($total_completion <= 59) {
                                $color = 'warning';
                              } 
                            }
                            ?>
                          <tr class="text-center">
                            <td><a target="_blank" id="<?=$data['project_name']?>" class="projectName<?=$data['projectid']?>" href="<?=base_url()?>project/view/projectid=<?=$data['projectid']?>"><?=$data['project_name']?></a>
                              <div class="progress mb-3">
                                <div class="progress-bar bg-<?= $color?>" role="progressbar" aria-valuenow="<?= $total_completion?>" aria-valuemin="0"
                                    aria-valuemax="100" style="width: <?= $total_completion?>%">
                                  <span><?= $total_completion?>%</span>
                                </div>
                              </div>
                            </td>
                            <td><?= $data['specialist_tag']?></td>
                            <td><div class="text-ellipsis"><?= $data['description']?></div></td>
                            <td><?= $data['due_date']?></td>
                            <td><?=$count_ticket?></td>
                            <td><?=$count_file?></td>
                            <td><span class="badge border bg-light"><?= $data['project_label']?></span></td>
                            <td> <a style="cursor:pointer" class="manageProjectStatus" id="<?= $data['projectid']?>" data-id="1" class="ticket-file-upload"><span data-toggle="tooltip" title="Move to Archived"><i class="bi bi-calendar2-x text-danger"></i></span></a></td>
                          </tr>
                          <?php endforeach; endif?>
                        </tbody>
                      </table>
                    </div>

                  

                    <div class="tab-pane fade" id="inprogress" role="tabpanel" aria-labelledby="inprogress-tab">
                      <table class="table table-hover table-bordered" id="dataTableFull0">
                      <thead class="bg-light">
                          <tr class="text-center">
                            <th>TITLE</th>
                            <th>TAG/SKILLS</th>
                            <th width="20%">DESCRIPTION</th>
                            <th>DESIRED DUEDATE</th>
                            <th>TICKETS</th>
                            <th>DOCUMENTS</th>
                            <th>STATUS</th>
                            <th>MANAGE</th>
                          </tr>
                        <tbody>
                          <?php if(!empty($p_progress)): foreach ($p_progress as $data):
                            $count_ticket = 0;
                            $count_document = 0;
                            $notcompleted = 0;
                            $completed_count = 0;
                            $total_completion = 0;
                            $count_file = 0;
                            $count_ticket = 0;
                            
                            if(!empty($all_document)){
                              foreach ($all_document as $file){
                                if($data['projectid'] == $file['projectid']){
                                  $count_file++;
                                  }
                              }
                            }
                            if(!empty($all_ticket)){
                              foreach ($all_ticket as $ticket){
                                if($data['projectid'] == $ticket['projectid']){
                                  if($ticket['ticket_label'] == 'Completed') {
                                    $completed_count++;
                                  }
                                  $count_ticket++;
                                  }
                              }
                               if(!empty($count_ticket) || $count_ticket != 0) {
                                  $total_completion = round($completed_count/$count_ticket*100);
                                }  
                              $color = '';
                              if($total_completion == 100) {
                                $color = 'success';
                              } elseif($total_completion >= 60) {
                                $color = 'info';
                              } elseif($total_completion <= 59) {
                                $color = 'warning';
                              } 
                            }
                            ?>
                          <tr class="text-center">
                            <td><a target="_blank" id="<?=$data['project_name']?>" class="projectName<?=$data['projectid']?>" href="<?=base_url()?>project/view/projectid=<?=$data['projectid']?>"><?=$data['project_name']?></a>
                              <div class="progress mb-3">
                                <div class="progress-bar bg-<?= $color?>" role="progressbar" aria-valuenow="<?= $total_completion?>" aria-valuemin="0"
                                    aria-valuemax="100" style="width: <?= $total_completion?>%">
                                  <span><?= $total_completion?>%</span>
                                </div>
                              </div>
                            </td>
                            <td><?= $data['specialist_tag']?></td>
                            <td><div class="text-ellipsis"><?= $data['description']?></div></td>
                            <td><?= $data['due_date']?></td>
                            <td><?=$count_ticket?></td>
                            <td><?=$count_file?></td>
                            <td><span class="badge border bg-info"><?= $data['project_label']?></span></td>
                            <td> <a style="cursor:pointer" class="manageProjectStatus" id="<?= $data['projectid']?>" data-id="1" class="ticket-file-upload"><span data-toggle="tooltip" title="Move to Archived"><i class="bi bi-calendar2-x text-danger"></i></span></a></td>
                          </tr>
                          <?php endforeach; endif?>
                        </tbody>
                      </table>
                    </div>

                    <div class="tab-pane fade" id="on-hold" role="tabpanel" aria-labelledby="on-hold-tab">
                      <table class="table table-hover table-bordered" id="example3">
                      <thead class="bg-light">
                          <tr class="text-center">
                            <th>TITLE</th>
                            <th>TAG/SKILLS</th>
                            <th width="20%">DESCRIPTION</th>
                            <th>DESIRED DUEDATE</th>
                            <th>TICKETS</th>
                            <th>DOCUMENTS</th>
                            <th>STATUS</th>
                            <th>MANAGE</th>
                          </tr>
                        <tbody>
                          <?php if(!empty($p_hold)): foreach ($p_hold as $data):
                            $count_ticket = 0;
                            $count_document = 0;
                            $notcompleted = 0;
                            $completed_count = 0;
                            $total_completion = 0;
                            $count_file = 0;
                            $count_ticket = 0;
                            
                            if(!empty($all_document)){
                              foreach ($all_document as $file){
                                if($data['projectid'] == $file['projectid']){
                                  $count_file++;
                                  }
                              }
                            }
                            if(!empty($all_ticket)){
                              foreach ($all_ticket as $ticket){
                                if($data['projectid'] == $ticket['projectid']){
                                  if($ticket['ticket_label'] == 'Completed') {
                                    $completed_count++;
                                  }
                                  $count_ticket++;
                                  }
                              }
                               if(!empty($count_ticket) || $count_ticket != 0) {
                                  $total_completion = round($completed_count/$count_ticket*100);
                                }  
                              $color = '';
                              if($total_completion == 100) {
                                $color = 'success';
                              } elseif($total_completion >= 60) {
                                $color = 'info';
                              } elseif($total_completion <= 59) {
                                $color = 'warning';
                              } 
                            }
                            ?>
                          <tr class="text-center">
                            <td><a target="_blank" id="<?=$data['project_name']?>" class="projectName<?=$data['projectid']?>" href="<?=base_url()?>project/view/projectid=<?=$data['projectid']?>"><?=$data['project_name']?></a>
                              <div class="progress mb-3">
                                <div class="progress-bar bg-<?= $color?>" role="progressbar" aria-valuenow="<?= $total_completion?>" aria-valuemin="0"
                                    aria-valuemax="100" style="width: <?= $total_completion?>%">
                                  <span><?= $total_completion?>%</span>
                                </div>
                              </div>
                            </td>
                            <td><?= $data['specialist_tag']?></td>
                            <td><div class="text-ellipsis"><?= $data['description']?></div></td>
                            <td><?= $data['due_date']?></td>
                            <td><?=$count_ticket?></td>
                            <td><?=$count_file?></td>
                            <td><span class="badge border bg-warning"><?= $data['project_label']?></span></td>
                            <td> <a style="cursor:pointer" class="manageProjectStatus" id="<?= $data['projectid']?>" data-id="1" class="ticket-file-upload"><span data-toggle="tooltip" title="Move to Archived"><i class="bi bi-calendar2-x text-danger"></i></span></a></td>
                          </tr>
                          <?php endforeach; endif?>
                        </tbody>
                      </table>
                    </div>

                    <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                      <table class="table table-hover table-bordered" id="example4">
                      <thead class="bg-light">
                          <tr class="text-center">
                            <th>TITLE</th>
                            <th>TAG/SKILLS</th>
                            <th width="20%">DESCRIPTION</th>
                            <th>DESIRED DUEDATE</th>
                            <th>TICKETS</th>
                            <th>DOCUMENTS</th>
                            <th>STATUS</th>
                            <th>MANAGE</th>
                          </tr>
                        <tbody>
                          <?php if(!empty($p_cancelled)): foreach ($p_cancelled as $data):
                            $count_ticket = 0;
                            $count_document = 0;
                            $notcompleted = 0;
                            $completed_count = 0;
                            $total_completion = 0;
                            $count_file = 0;
                            $count_ticket = 0;
                            
                            if(!empty($all_document)){
                              foreach ($all_document as $file){
                                if($data['projectid'] == $file['projectid']){
                                  $count_file++;
                                  }
                              }
                            }
                            if(!empty($all_ticket)){
                              foreach ($all_ticket as $ticket){
                                if($data['projectid'] == $ticket['projectid']){
                                  if($ticket['ticket_label'] == 'Completed') {
                                    $completed_count++;
                                  }
                                  $count_ticket++;
                                  }
                              }
                               if(!empty($count_ticket) || $count_ticket != 0) {
                                  $total_completion = round($completed_count/$count_ticket*100);
                                }  
                              $color = '';
                              if($total_completion == 100) {
                                $color = 'success';
                              } elseif($total_completion >= 60) {
                                $color = 'info';
                              } elseif($total_completion <= 59) {
                                $color = 'warning';
                              } 
                            }
                            ?>
                          <tr class="text-center">
                            <td><a target="_blank" id="<?=$data['project_name']?>" class="projectName<?=$data['projectid']?>" href="<?=base_url()?>project/view/projectid=<?=$data['projectid']?>"><?=$data['project_name']?></a>
                              <div class="progress mb-3">
                                <div class="progress-bar bg-<?= $color?>" role="progressbar" aria-valuenow="<?= $total_completion?>" aria-valuemin="0"
                                    aria-valuemax="100" style="width: <?= $total_completion?>%">
                                  <span><?= $total_completion?>%</span>
                                </div>
                              </div>
                            </td>
                            <td><?= $data['specialist_tag']?></td>
                            <td><div class="text-ellipsis"><?= $data['description']?></div></td>
                            <td><?= $data['due_date']?></td>
                            <td><span class="badge border bg-danger"><?= $data['project_label']?></span></td>
                            <td> <a style="cursor:pointer" class="manageProjectStatus" id="<?= $data['projectid']?>" data-id="1" class="ticket-file-upload"><span data-toggle="tooltip" title="Move to Archived"><i class="bi bi-calendar2-x text-danger"></i></span></a></td>
                          </tr>
                          <?php endforeach; endif?>
                        </tbody>
                      </table>
                    </div>

                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                      <table class="table table-hover table-bordered" id="example5">
                      <thead class="bg-light">
                          <tr class="text-center">
                            <th>TITLE</th>
                            <th>TAG/SKILLS</th>
                            <th width="20%">DESCRIPTION</th>
                            <th>DESIRED DUEDATE</th>
                            <th>TICKETS</th>
                            <th>DOCUMENTS</th>
                            <th>STATUS</th>
                            <th>MANAGE</th>
                          </tr>
                        <tbody>
                          <?php if(!empty($p_completed)): foreach ($p_completed as $data):
                            $count_ticket = 0;
                            $count_document = 0;
                            $notcompleted = 0;
                            $completed_count = 0;
                            $total_completion = 0;
                            $count_file = 0;
                            $count_ticket = 0;
                            
                            if(!empty($all_document)){
                              foreach ($all_document as $file){
                                if($data['projectid'] == $file['projectid']){
                                  $count_file++;
                                  }
                              }
                            }
                            if(!empty($all_ticket)){
                              foreach ($all_ticket as $ticket){
                                if($data['projectid'] == $ticket['projectid']){
                                  if($ticket['ticket_label'] == 'Completed') {
                                    $completed_count++;
                                  }
                                  $count_ticket++;
                                  }
                              }
                               if(!empty($count_ticket) || $count_ticket != 0) {
                                  $total_completion = round($completed_count/$count_ticket*100);
                                }  
                              $color = '';
                              if($total_completion == 100) {
                                $color = 'success';
                              } elseif($total_completion >= 60) {
                                $color = 'info';
                              } elseif($total_completion <= 59) {
                                $color = 'warning';
                              } 
                            }
                            ?>
                          <tr class="text-center">
                            <td><a target="_blank" id="<?=$data['project_name']?>" class="projectName<?=$data['projectid']?>" href="<?=base_url()?>project/view/projectid=<?=$data['projectid']?>"><?=$data['project_name']?></a>
                              <div class="progress mb-3">
                                <div class="progress-bar bg-<?= $color?>" role="progressbar" aria-valuenow="<?= $total_completion?>" aria-valuemin="0"
                                    aria-valuemax="100" style="width: <?= $total_completion?>%">
                                  <span><?= $total_completion?>%</span>
                                </div>
                              </div>
                            </td>
                            <td><?= $data['specialist_tag']?></td>
                            <td><div class="text-ellipsis"><?= $data['description']?></div></td>
                            <td><?= $data['due_date']?></td>
                            <td><?=$count_ticket?></td>
                            <td><?=$count_file?></td>
                            <td><span class="badge border bg-success"><?= $data['project_label']?></span></td>
                            <td> <a style="cursor:pointer" class="manageProjectStatus" id="<?= $data['projectid']?>" data-id="1" class="ticket-file-upload"><span data-toggle="tooltip" title="Move to Archived"><i class="bi bi-calendar2-x text-danger"></i></span></a></td>
                          </tr>
                          <?php endforeach; endif?>
                        </tbody>
                      </table>
                    </div>

                    <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
                      <table class="table table-hover table-bordered" id="example3">
                      <thead class="bg-light">
                          <tr class="text-center">
                            <th>TITLE</th>
                            <th>TAG/SKILLS</th>
                            <th width="20%">DESCRIPTION</th>
                            <th>DESIRED DUEDATE</th>
                            <th>TICKETS</th>
                            <th>DOCUMENTS</th>
                            <th>MANAGE</th>
                          </tr>
                        <tbody>
                          <?php if(!empty($p_archived)): foreach ($p_archived as $data):
                            $count_ticket = 0;
                            $count_document = 0;
                            $notcompleted = 0;
                            $completed_count = 0;
                            $total_completion = 0;
                            $count_file = 0;
                            $count_ticket = 0;
                            
                            if(!empty($all_document)){
                              foreach ($all_document as $file){
                                if($data['projectid'] == $file['projectid']){
                                  $count_file++;
                                  }
                              }
                            }
                            if(!empty($all_ticket)){
                              foreach ($all_ticket as $ticket){
                                if($data['projectid'] == $ticket['projectid']){
                                  if($ticket['ticket_label'] == 'Completed') {
                                    $completed_count++;
                                  }
                                  $count_ticket++;
                                  }
                              }
                               if(!empty($count_ticket) || $count_ticket != 0) {
                                  $total_completion = round($completed_count/$count_ticket*100);
                                }  
                              $color = '';
                              if($total_completion == 100) {
                                $color = 'success';
                              } elseif($total_completion >= 60) {
                                $color = 'info';
                              } elseif($total_completion <= 59) {
                                $color = 'warning';
                              } 
                            }
                            ?>
                          <tr class="text-center">
                            <td><a target="_blank" id="<?=$data['project_name']?>" class="projectName<?=$data['projectid']?>" href="<?=base_url()?>project/view/projectid="><?=$data['project_name']?></a>
                              <div class="progress mb-3">
                                <div class="progress-bar bg-<?= $color?>" role="progressbar" aria-valuenow="<?= $total_completion?>" aria-valuemin="0"
                                    aria-valuemax="100" style="width: <?= $total_completion?>%">
                                  <span><?= $total_completion?>%</span>
                                </div>
                              </div>
                            </td>
                            <td><?= $data['specialist_tag']?></td>
                            <td><div class="text-ellipsis"><?= $data['description']?></div></td>
                            <td><?= $data['due_date']?></td>
                            <td><?=$count_ticket?></td>
                            <td><?=$count_file?></td>
                            <td><a style="cursor:pointer" class="manageProjectStatus" data-id="0" data-toggle="tooltip" title="Restore" id="<?= $data['projectid']?>" class="ticket-file-upload"> <i class="bi bi-recycle text-success" style="font-size: 16px !important;"></i></a></td>
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
                <form method="POST" id="createProjectForm" class="form-horizontal">
                <div class="form-group mb-4">
                        <div class="row">
                          <div class="col-md-5 mt-3">
                              <label class="control-label">Project Title</label>
                              <input type="hidden" name="clientid" class="custom-form" value="<?= $PK_id?>">
                              <input type="hidden" name="allot_time" id="result" class="custom-form">
                              <input type="text" name="project_title" class="custom-form">
                          </div>
                          
                          <div class="col-md-4 mt-3">
                              <label class="control-label">Project Alias</label>
                              <input type="text" name="project_alias" class="custom-form">
                          </div>

                          <div class="col-md-3 mt-3">
                              <label>Budget</label>
                              <input type="text" name="offered_rate" class="custom-form" value="">
                          </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label class="control-label col-md-12">Tag  <span data-toggle="tooltip" title="Specialist eg: Software Engineer | Web Developer | Cloud Server etc."><i class="bi bi-question-circle text-info"></i></span></label>
                                <input type="text" name="specialist" class="custom-form" value="">
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
                              <textarea name="skills" rows="3" class="custom-form"></textarea>
                          </div>
                        </div>
                        
                        <!-- Introduction -->
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label mt-3">Project description</label>
                                <textarea name="project_description" class="custom-form" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer border-0" style="margin-top: -2rem">
                <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
                <button type="submit" id="createProjectBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
                </form>
            </div>
        </div>
    </div>
  <script src="<?= base_url()?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url()?>js/project.js"></script>
  <?= $this->endsection() ?>