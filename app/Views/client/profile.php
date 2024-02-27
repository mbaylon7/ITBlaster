<?= $this->extend('/templates/admin') ?>

<?= $this->section('content') ?>
    <section class="content-header mb-2">
      <div class="container-fluid mt-3">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#clientEditProfileModal" class="btn btn-info">Edit Profile</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Basic Info Section -->
          <div class="col-md-3">
            <div class="card">
              <div class="card-body box-profile">
                <div class="text-center">
                  <span class="mt-5">
                    <li class="nav-item dropdown" style="list-style: none;">
                        <?php if(!empty($avatar)):?>
                            <img class="img-fluid rounded mb-2" src="/uploads/files/<?= $name?>/<?= $avatar?>" style="width:128px; height: 128px;" alt="User profile picture">
                        <?php else:?>
                            <img class="img-fluid rounded mb-2" src="<?= base_url()?>dist/img/default.png" style="width:128px; height: 128px;" alt="User profile picture">
                        <?php endif?>
                      <a class="nav-link" data-toggle="dropdown" href="#">
                      <span style="border: 4px solid #fff; border-radius: 50%; background: #192F64; color: #fff;  position: absolute; margin-top: -2.1rem; margin-left: 2.4rem; padding: 0 5px;"><i class="bi bi-camera" style="font-size: 20px;"></i></a>
                      </span>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" tabindex="-1" href="#">
                          <form action="client/upload-profile" method="POST" enctype="multipart/form-data">
                              <input type="file" name="file" required>
                              <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                          </form>
                        </a>
                        <?php if(!empty($avatar)):?>
                            <div class="dropdown-divider"></div>
                        <a class="dropdown-item removeProfilePicture" tabindex="-1" href="#">
                            <form action="client/remove-profile" method="POST">
                                <button type="submit" class="border-0 bg-white w-100"> Remove Profile Picture</button>
                            </form>
                        </a>
                        <?php endif?>
                      </div>
                    </li>
                  </span>
                </div>
                <div class="mb-3">
                  <span class="profile-username text-center d-block" style="margin-top:-5px"><strong> <?= $name ?></strong></span>
                  <span class="text-center d-block"><i class="bi bi-briefcase"></i> <?= $position ?></span>
                  <span class="text-center d-block"><i class="bi bi-phone"></i> <?= $contact ?></span>
                  <span class="text-center d-block"><i class="bi bi-envelope-at"></i> <?= $email ?></span>
                  <span class="text-center d-block"><i class="bi bi-buildings"></i> <?= $company ?></span>
                </div>
              </div>
              <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-info mx-4" role="alert">
                  <i class="bi bi-exclamation-circle px-2"></i><?= session()->getFlashdata('error'); ?>
                </div>
              <?php endif; ?>
            </div>
            
            <!-- Additional Contacts Section -->
            <div class="d-flex justify-content-center h5 fw-bold mt-4">Additional Contacts</div>
            <div class="card">
              <div class="card-body">
                <div class="custom-container" id="allClientContacts">
                  
                </div>
              </div>
              <div class="d-flex justify-content-end mt-3"><a style="cursor: pointer; margin:0 10px 10px;" data-toggle="modal" data-target="#clientContactModal"><i class="bi operational-btn bi-plus-circle text-info h5"></i></a></div>
            </div>
            
            <!-- Contact Section -->
            <div class="d-flex justify-content-center h5 p-1 fw-bold mt-4">Contracts</div>
            <div class="card">
              <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-info mx-4" role="alert">
                  <i class="bi bi-exclamation-circle px-2"></i><?= session()->getFlashdata('error'); ?>
                </div>
              <?php endif; ?>
              <div class="card-body" id="allClientFiles">
              
              </div>
              <div class="d-flex justify-content-end mt-3"><a style="cursor: pointer; margin:0 10px 10px;" data-toggle="modal" data-target="#clientFileModal"><i class="bi operational-btn bi-plus-circle text-info h5"></i></a></div>
            </div>
          </div>
          <div class="col-md-9">
            <!-- Product and Services Section -->
            <div class="row margin-row">
              <div class="col-md-6">
                <div class="d-flex justify-content-center h5 fw-bold">Products and Services</div>
                <div class="card">
                  <div class="card-body">
                    <div class="custom-container" id="allClientProducts">

                    </div>
                  </div>
                  <div class="d-flex justify-content-end mt-3"><a style="cursor: pointer; margin: 10px" data-toggle="modal" data-target="#clientProductServicesModal"><i class="bi operational-btn bi-plus-circle text-info h5"></i></a></div>
                </div>

                <!-- Project Section -->
                <div class="d-flex justify-content-center h5 fw-bold mt-4">Projects</div>
                <div class="card">
                  <div class="card-body">
                    <div class="custom-container">
                    <?php if(!empty($c_projects)): foreach($c_projects as $data):
                        if($data['project_label'] == 'Not Started'){
                          $label = '<span class="badge border" style="padding: 8px 10px">'.$data['project_label'].'</span>';
                        }elseif($data['project_label'] == 'In Progress'){
                            $label = '<span class="badge border-success badge-info" style="padding: 8px 10px">'.$data['project_label'].'</span>';
                        }elseif($data['project_label'] == 'On Hold'){
                            $label = '<span class="badge border border-warning badge-warning" style="padding: 8px 10px">'.$data['project_label'].'</span>';
                        }elseif($data['project_label'] == 'Cancelled'){
                            $label = '<span class="badge border border-danger badge-danger" style="padding: 8px 10px">'.$data['project_label'].'</span>';
                        }elseif($data['project_label'] == 'Completed'){
                          $label = '<span class="badge border border-light badge-success" style="padding: 8px 10px">'.$data['project_label'].'</span>';
                        }elseif($data['project_label'] != 'Not Started' && $data['project_label'] != 'In Progress' && $project['project_label'] != 'On Hold' && $project['project_label'] != 'Cancelled' && $project['project_label'] != 'Completed'){
                          $label = '<span class="badge border border-light badge-secondary" style="padding: 8px 10px">Archived</span>';
                        }
                        $count_ticket = 0;
                        if(!empty($all_ticket)){
                          foreach ($all_ticket as $ticket){
                            if($data['projectid'] == $ticket['projectid']){
                              $count_ticket++;
                              }
                          }
                        }
                      ?>
                      <div class="custom-content rounded">
                        <i class="bi bi-lightbulb text-secondary" style="font-size: 20px;"></i> <span><a target="_blank" href="/project/view-project/project=<?= $data['project_code']; ?>" data-toggle="tooltip" title="View Project"><?= $data['project_name']; ?></a> &nbsp; |&nbsp;  <a target="_blank" href="/project/view-project/project=<?= $data['project_code']; ?>" data-toggle="tooltip" title="View Tickets"><?= $count_ticket; ?> tickets</a> </span> <?= $label?>
                      </div>
                      <?php endforeach; else: ?>
                        <div class="text-center text-secondary">
                          <span><i>No Project yet!</i></span>
                        </div>
                      <?php endif;?>
                    </div>
                  </div>
                  <div class="d-flex justify-content-end mt-3"><a style="cursor: pointer; margin:0 10px 10px;" data-toggle="modal" data-target="#education-modal"><i class="bi operational-btn bi-plus-circle text-info h5"></i></a></div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="d-flex justify-content-center h5 fw-bold">Company Introduction</div>
                <div class="card">
                  <div class="card-body">
                    <div class="text-justify">
                      <i class="text-muted">
                        <?php if(!empty($introduction)):?>
                            <q><?= $introduction ?></q>
                        <?php else: echo '<span class="d-flex justify-content-center">No Introduction Posted Yet!</span>'; endif;?>
                      </i>
                    </div>
                  </div>
                  <div class="d-flex justify-content-end mt-3"><a style="cursor: pointer; margin:0 10px 10px;" data-toggle="modal" data-target="#clientIntroductionModal"><i class="bi operational-btn bi-pencil-square text-info h5"></i></a></div>
                </div>
                
                <!-- Tickets Contacts Section -->
                <div class="d-flex justify-content-center h5 fw-bold mt-4">Tickets</div>
                <div class="card">
                  <div class="card-body">
                    <div class="custom-container">
                      <div class="custom-content rounded">
                        <i class="bi bi-ticket text-secondary" style="font-size: 20px;"></i> <span>Ticket: #112837 &nbsp; |&nbsp; <a href="#" data-toggle="tooltip" title="View Task Ticket">Create header</a></span> <span class="badge badge-warning" style="padding: 8px 10px">On Hold</span>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-end mt-3"><a style="cursor: pointer; margin:0 10px 10px;" data-toggle="modal" data-target="#experience-modal"><i class="bi operational-btn bi-plus-circle text-info h5"></i></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="<?= base_url()?>plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url()?>js/client.js"></script>
    <?= $this->include('/partials/admin/modals/client/client_general_modal') ?>
<?= $this->endsection() ?>