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
              <li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#profile-modal" class="btn btn-info">Edit Profile</a></li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 profile-completion-percentage mb-3">
            <div id="percentage"></div>
            <li class="nav-item dropdown" style="list-style: none;">
                  <a class="nav-link" data-toggle="dropdown" href="#">
                  <span class="text-muted text-sm" data-placement="bottom" data-toggle="tooltip" title="Click to see what is lacking in your profile to reach 100% complete" style="cursor:pointer"><i class="bi bi-question-circle text-info"></i> Progress Completion %</span>
                  </a>
                    <div class="dropdown-menu p-3" style="width: 300px !important">

                        <?php 
                        echo $c_name = (!empty($name)) ? 
                        '<span class="text-dark"><i class="bi bi-check2-circle text-success"></i></span> &nbsp; <strike>Names</strike> <br>' 
                        : 
                        '<span class="text-dark"><i class="bi bi-dash-circle text-danger"></i</span> &nbsp; Name<br>';
                        echo $c_rate = (!empty($rate)) ? 
                        '<span class="text-dark"><i class="bi bi-check2-circle text-success"></i></span> &nbsp; <strike>Rate </strike><br>' 
                        : 
                        '<span class="text-dark"><i class="bi bi-dash-circle text-danger"></i></span> &nbsp; Rate<br>';
                        echo $c_pic = (!empty($avatar)) ? 
                        '<span class="text-dark"><i class="bi bi-check2-circle text-success"></i></span> &nbsp; <strike>Avatar </strike><br>' 
                        : 
                        '<span class="text-dark"><i class="bi bi-dash-circle text-danger"></i></span> &nbsp; Avatar<br>';
                        echo $c_position = (!empty($position)) ? 
                        '<span class="text-dark"><i class="bi bi-check2-circle text-success"></i></span> &nbsp; <strike>Position </strike><br>' 
                        : 
                        '<span class="text-dark"><i class="bi bi-dash-circle text-danger"></i></span> &nbsp; Position<br>';
                        echo $c_contact = (!empty($contactnumber)) ? 
                        '<span class="text-dark"><i class="bi bi-check2-circle text-success"></i></span> &nbsp; <strike>Contact no. </strike><br>' 
                        : 
                        '<span class="text-dark"><i class="bi bi-dash-circle text-danger"></i></span> &nbsp; Contact no.<br>';
                        echo $c_email = (!empty($email)) ? 
                        '<span class="text-dark"><i class="bi bi-check2-circle text-success"></i></span> &nbsp; <strike>Email </strike><br>' 
                        : 
                        '<span class="text-dark"><i class="bi bi-dash-circle text-danger"></i></span> &nbsp; Email<br>';
                        echo $c_resume = (!empty($resume)) ? 
                        '<span class="text-dark"><i class="bi bi-check2-circle text-success"></i></span> &nbsp; <strike>Resume/Portfolio/CV </strike><br>' 
                        : 
                        '<span class="text-dark"><i class="bi bi-dash-circle text-danger"></i></span> &nbsp; Resume/Portfolio/CV<br>';
                        echo $c_introduction = (!empty($introduction)) ? 
                        '<span class="text-dark"><i class="bi bi-check2-circle text-success"></i></span> &nbsp; <strike>Introduction </strike><br>' 
                        : 
                        '<span class="text-dark"><i class="bi bi-dash-circle text-danger"></i></span> &nbsp; Introduction<br>';
                        echo $c_files = (!empty($files)) ? 
                        '<span class="text-dark"><i class="bi bi-check2-circle text-success"></i></span> &nbsp; <strike>Files </strike><br>' : 
                        '<span class="text-dark"><i class="bi bi-dash-circle text-danger"></i></span> &nbsp; Files<br>';
                        echo $c_skills = (!empty($skills)) ? 
                        '<span class="text-dark"><i class="bi bi-check2-circle text-success"></i></span> &nbsp; <strike>Skills </strike><br>' : 
                        '<span class="text-dark"><i class="bi bi-dash-circle text-danger"></i></span> &nbsp; Skills<br>';
                        echo $c_educational = (!empty($education)) ? 
                        '<span class="text-dark"><i class="bi bi-check2-circle text-success"></i></span> &nbsp; <strike>Educational Backgrounds </strike><br>' : 
                        '<span class="text-dark"><i class="bi bi-dash-circle text-danger"></i></span> &nbsp; Educational Backgrounds <br>';
                        echo $c_work = (!empty($experience)) ? 
                        '<span class="text-dark"><i class="bi bi-check2-circle text-success"></i></span> &nbsp; <strike>Work Experiences</strike> <br>' : 
                        '<span class="text-dark"><i class="bi bi-dash-circle text-danger"></i></span> &nbsp; Work Experiences  <br>';
                        ?>
                    </div>
                  </li>
          </div>
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
                          <form action="<?= base_url()?>it/upload-profile" method="post" enctype="multipart/form-data">
                            <input type="file" name="file" required>
                            <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                          </form>
                        </a>
                        <?php if(!empty($avatar)):?>
                            <div class="dropdown-divider"></div>
                        <a class="dropdown-item removeProfilePicture" tabindex="-1" href="#">
                            <form action="<?= base_url()?>it/remove-profile" method="POST">
                                <button type="submit" class="border-0 bg-white w-100"> Remove Profile Picture</button>
                            </form>
                        </a>
                        <?php endif?>
                      </div>
                    </li>
                  </span>
                </div>
                <p class="text-success d-flex justify-content-center" style="margin-top: -10px;"><strong><strong>$<?= $rate ?>/Hr</strong></strong></p>
                <div class="mb-3">
                  <?php 
                    $color = 'secondary';
                    if($is_verified == 'Yes' && $project_count == 0) {
                      $color = 'success';
                    }elseif($is_verified == 'Yes' && $project_count <= 5 || $is_verified == 'Yes' && $project_count <= 9) {
                      $color = 'info';
                    }elseif($is_verified == 'Yes' && $project_count >= 10) {
                      $color = 'warning';
                    }
                  ?>
                  <span class="profile-username text-center d-block" style="margin-top: -15px"><i class="fa-solid fa-medal text-<?= $color?>" id="flipIcon" style="font-size: 25px"></i> <strong><?=$name?></strong></span>
                  <span class="text-center d-block"><i class="bi bi-briefcase"></i> <?= $position ?></span>
                <span class="text-center d-block"><i class="bi bi-phone"></i> <?= $contactnumber ?></span>
                <span class="text-center d-block"><i class="bi bi-envelope-at"></i> <?= $email ?></span>
                <?php if(!empty($resume)):?>
                <span class="text-center d-block"><i class="bi bi-person-lines-fill"></i> &nbsp;<a target="_blank" href="/uploads/files/<?= $name?>/<?= $resume?>" data-toggle="tooltip" title="View"> <?= $resume?> &nbsp;</a>  <span data-toggle="tooltip" title="Update CV/Portfolio"><a href="#" data-toggle="modal" data-target="#uploadCV"><i class="bi bi-pencil-square text-dark"></i></a></span></span>
                <?php else:?>
                  <span class="text-center d-block"><i class="bi bi-person-lines-fill"></i> &nbsp;<a href="#"> Upload Resume/Portfolio&nbsp;</a> <a href="#" data-toggle="modal" data-target="#uploadCV"><span data-toggle="tooltip" title="Upload CV/Portfolio"><i class="bi bi-pencil-square text-dark"></i> </span></a></span>
                <?php endif?>
                </div>
              </div>
              <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-info mx-4" role="alert">
                  <i class="bi bi-exclamation-circle px-2"></i><?= session()->getFlashdata('error'); ?>
                </div>
              <?php endif; ?>
            </div>
            
            <div class="d-flex justify-content-center h5 fw-bold mt-4">Projects</div>
            <div class="card">
                <div class="card-body">
                   <div class="custom-container">
                    <?php if(empty($current) && empty($projects)):?>
                        <div class="d-flex justify-content-center text-secondary w-100">
                            <span><i>No Completed and Active Project Assigned Yet! </i></span>
                        </div>
                    <?php endif?>    
                   <?php if(!empty($current)): foreach($current as $project):?>
                        <div class="custom-content rounded">
                             <a href="/project/view-project/project=<?=$project['project_code']?>"><?= $project['project_name']?></a> <span class="badge badge-info border" style="padding: 8px 10px">current</span>
                        </div>
                    <?php endforeach; endif?>  
                    <?php if(!empty($projects)): foreach($projects as $project):?>
                        <div class="custom-content rounded">
                             <a href="/project/view-project/project=<?=$project['project_code']?>"><?= $project['project_name']?></a> <span class="badge badge-success border" style="padding: 8px 10px"><?= $project['project_label']?></span>
                        </div>
                    <?php endforeach; endif?>    
                   </div>
                </div>
            </div>

            <div class="d-flex justify-content-center h5 p-1 fw-bold mt-4">Files/Contracts <span style="margin: 1px 0 0 .5rem;" data-toggle="tooltip" title="You may upload files such as your Contracts, Resume/CV/Portfolio and related/supporting files to the project you've been working"><i class="bi bi-question-circle text-sm text-dark"></i></span></div>
            <div class="card">
              <div class="card-body" id="itFilesUploaded">
              </div>
              <div class="d-flex justify-content-end mt-3"><a style="cursor: pointer; margin:0 10px 10px;" data-toggle="modal" data-target="#file-modal"><i class="bi operational-btn bi-plus-circle text-info h5"></i></a></div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="row margin-row">
              <div class="col-md-12 profile-completion-percentage-display">
                <div id="percentage2"></div>
                  <li class="nav-item dropdown" style="list-style: none;">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                    <span class="text-muted text-sm" data-placement="bottom" data-toggle="tooltip" title="Click to see what is lacking in your profile to reach 100% complete" style="cursor:pointer"><i class="bi bi-question-circle text-info"></i> Progress Completion %</span>
                    </a>
                      <div class="dropdown-menu p-3" style="width: 300px !important">
                         <?php 
                            $checks = array(
                                'Name' => $name,
                                'Rate' => $rate,
                                'Avatar' => $avatar,
                                'Position' => $position,
                                'Contact no.' => $contactnumber,
                                'Email' => $email,
                                'Resume/Portfolio/CV' => $resume,
                                'Introduction' => $introduction,
                                'Files' => $files,
                                'Skills' => $skills,
                                'Educational Backgrounds' => $education,
                                'Work Experiences' => $experience
                            );
                            
                            foreach ($checks as $label => $value) {
                                echo '<span class="text-dark"><i class="bi ' . (!empty($value) ? 'bi-check2-circle text-success' : 'bi-dash-circle text-danger') . '"></i></span> &nbsp; ' . (!empty($value) ? '<strike>' . $label . '</strike>' : $label) . '<br>';
                            }
                        ?>
                      </div>
                  </li>
              </div>
            </div>
            <div class="row margin-row">
              <div class="col-md-6 mt-2">
                <div class="d-flex justify-content-center h5 fw-bold">Skills</div>
                <div class="card">
                  <div class="card-body">
                    <div class="custom-container" id="itSkills">
                        
                    </div>
                  </div>
                  <div class="d-flex justify-content-end mt-3"><a style="cursor: pointer; margin: 10px" data-toggle="modal" data-target="#skill-modal"><i class="bi operational-btn bi-plus-circle text-info h5"></i></a></div>
                </div>

                <div class="d-flex justify-content-center h5 fw-bol mt-4">Educational Background</div>
                <div class="card">
                  <div class="card-body">
                    <div class="custom-container" id="itEducation">
                    </div>
                  </div>
                  <div class="d-flex justify-content-end mt-3"><a style="cursor: pointer; margin: 10px;" data-toggle="modal" data-target="#education-modal"><i class="bi operational-btn bi-plus-circle text-info h5"></i></a></div>
                </div>
                
              </div>

              <div class="col-md-6 mt-2">
                <div class="d-flex justify-content-center h5 fw-bold">Introduction</div>
                <div class="card">
                  <div class="card-body">
                    <div class="text-justify">
                      <?php if(!empty($introduction)):?>
                      <i class="text-muted"><q>
                      <?= $introduction ?>
                      </q>
                      <?php else:?>
                        <i class="d-flex justify-content-center text-secondary">No Introduction Posted Yet!</i>
                      <?php endif?>
                      </i>
                    </div>
                  </div>
                  <div class="d-flex justify-content-end mt-3"><a style="cursor: pointer; margin: 10px;" data-toggle="modal" data-target="#introduction-modal"><i class="bi operational-btn bi-pencil-square text-info h5"></i></a></div>
                </div>

                <div class="d-flex justify-content-center h5 fw-bold mt-4">Work Experience</div>
                <div class="card">
                  <div class="card-body">
                    <div class="custom-container" id="itExperience">
                     
                    </div>
                  </div>
                  <div class="d-flex justify-content-end mt-3"><a style="cursor: pointer; margin: 10px;" data-toggle="modal" data-target="#experience-modal"><i class="bi operational-btn bi-plus-circle text-info h5" ></i></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?= $this->include('/partials/admin/modals/it/it_general_modal') ?>
    <script src="<?= base_url()?>plugins/jquery/jquery.min.js"></script>
     <!--src="<?= base_url()?>js/profile.js"-->
    <script src="<?= base_url()?>js/profile.js"></script>
<?= $this->endsection() ?>