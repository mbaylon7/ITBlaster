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
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item active">
                  <?= $profile['name']?>`s &nbsp; Profile
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
          <div class="col-md-3">
            <div class="card">
              <div class="card-body box-profile">
                <div class="text-center">
                  <span class="mt-5">
                    <li class="nav-item dropdown" style="list-style: none;">
                    <?php if(!empty($profile['profile_avatar'])):?>
                            <img class="img-fluid rounded mb-2" src="/uploads/files/<?= $profile['name']?>/<?= $profile['profile_avatar']?>" style="width:128px; height: 128px;" alt="User profile picture">
                        <?php else:?>
                            <img class="img-fluid rounded mb-2" src="<?= base_url()?>dist/img/default.png" style="width:128px; height: 128px;" alt="User profile picture">
                        <?php endif?>
                    </li>
                  </span>
                </div>
                <p class="text-success d-flex justify-content-center mt-1" style="margin-top: -10px;"><strong><strong>$<?= $profile['desired_rate'] ?>/Hr</strong></strong></p>
                <div class="mb-3">
                  <?php 
                    $color = 'secondary';
                    if($profile['is_verified'] == 'Yes' && $project_count == 0) {
                      $color = 'success';
                    }elseif($profile['is_verified'] == 'Yes' && $project_count <= 5 || $profile['is_verified'] == 'Yes' && $project_count <= 9) {
                      $color = 'info';
                    }elseif($profile['is_verified'] == 'Yes' && $project_count >= 10) {
                      $color = 'warning';
                    }
                  ?>
                  <span class="profile-username text-center d-block" style="margin-top: -15px"><i class="fa-solid fa-medal text-<?= $color?>" id="flipIcon" style="font-size: 25px"></i> <strong><?=$name?></strong></span>
                  <span class="text-center d-block"><i class="bi bi-briefcase"></i> <?= $profile['user_position'] ?></span>
                <span class="text-center d-block"><i class="bi bi-phone"></i> <?= $profile['contactnumber'] ?></span>
                <span class="text-center d-block"><i class="bi bi-envelope-at"></i> <?= $profile['email'] ?></span>
                <?php if(!empty($profile['resume_file'])):?>
                    <span class="text-center d-block"><a target="_blank" href="/uploads/files/<?= $profile['name']?>/<?= $profile['resume_file']?>" data-toggle="tooltip" title="View"> <?= $profile['resume_file']?> &nbsp;</a></span>
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
                             <a href="/project/view/projectid=<?=$project['projectid']?>"><?= $project['project_name']?></a> <span class="badge badge-info border" style="padding: 8px 10px">current</span>
                        </div>
                    <?php endforeach; endif?>  
                    <?php if(!empty($projects)): foreach($projects as $project):?>
                        <div class="custom-content rounded">
                             <a href="/project/view/projectid=<?=$project['projectid']?>"><?= $project['project_name']?></a> <span class="badge badge-success border" style="padding: 8px 10px"><?= $project['project_label']?></span>
                        </div>
                    <?php endforeach; endif?>    
                   </div>
                </div>
            </div>

          </div>

          <div class="col-md-9">
            <div class="row margin-row">
              <div class="col-md-6 mt-2">
                <div class="d-flex justify-content-center h5 fw-bold">Skills</div>
                <div class="card">
                  <div class="card-body">
                    <div class="custom-container">
                        <?php if(!empty($skills)): foreach($skills as $skill):?>
                        <div class="custom-content rounded">
                            <?= $skill['skill_name']?>
                        </div>
                        <?php endforeach; endif?>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-center h5 fw-bol mt-4">Educational Background</div>
                <div class="card">
                  <div class="card-body">
                    <div class="custom-container">
                        <?php if(!empty($education)): foreach($education as $data):?>
                        <div class="custom-content d-flex justify-content-center rounded">
                            <?= $data['educational_bg_school']?> | <?= $data['educational_bg_year']?>
                        </div>
                        <?php endforeach; endif?>
                    </div>
                  </div>
                </div>
                
              </div>

              <div class="col-md-6 mt-2">
                <div class="d-flex justify-content-center h5 fw-bold">Introduction</div>
                <div class="card">
                  <div class="card-body">
                    <div class="text-justify">
                      <?php if(!empty($profile['introduction'])):?>
                      <i class="text-muted"><q>
                      <?= $profile['introduction'] ?>
                      </q>
                      <?php else:?>
                        <i class="d-flex justify-content-center text-secondary">No Introduction Posted Yet!</i>
                      <?php endif?>
                      </i>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-center h5 fw-bold mt-4">Work Experience</div>
                <div class="card">
                  <div class="card-body">
                    <div class="custom-container">
                        <?php if(!empty($experience)): foreach($experience as $data):?>
                        <div class="custom-content d-flex justify-content-center rounded">
                            <?= $data['work_xp_company']?> | <?= $data['work_xp_position']?> | <?= $data['work_xp_year']?>
                        </div>
                        <?php endforeach; endif?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<div class="modal fade" id="add-project-modal">
  <?= $this->endsection() ?>