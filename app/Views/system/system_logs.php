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
                    <table class="table table-hover table-bordered" id="dataTableFull1">
                        <thead class="bg-light">
                        <tr class="text-center">
                            <th>#</th>
                            <th width="20%">PERSONEL</th>
                            <th>IP ADDRESS</th>
                            <th>ACTIVITY</th>
                            <th>DATE</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($logs)): foreach ($logs as $log): if(!empty($users)): foreach ($users as $user): if($user['id'] == $log['userid']):?>
                            <tr class="text-center">
                                <td><?= $log['logid']?></td>
                                <td><?= $user['name']?></td>
                                <td>IP::0<?= $log['logid']?></td>
                                <td><?= $log['action_activity']?></td>
                                <td><?= $log['created_at']?></td>
                            </tr>
                            <?php endif; endforeach; endif; endforeach; endif?>
                        </tbody>
                    </table>
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
                            
                        <div class="col-md-7 mt-3">
                                <label class="control-label">Project Title</label>
                                <input type="hidden" name="clientid" class="custom-form" value="<?= $PK_id?>">
                                <input type="text" name="project_title" class="custom-form">
                            </div>

                            <div class="col-md-5 mt-3">
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
                                <input type="date" name="start_date" class="custom-form" value="">
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="control-label col-md-12">Due Date</label>
                                <input type="date" name="due_date" class="custom-form" value="">
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
  <?= $this->endsection() ?>