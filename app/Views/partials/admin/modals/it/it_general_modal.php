<!-- Modal: Add Skills -->
<div class="modal modal-xlg fade" id="skill-modal" role="dialog">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
        <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
         style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a>
      </div>
            <div class="modal-body form">
                <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;">
                <span class="underline-text">Skill Sets</span></span>
                <form action="#" id="insertItSkillsForm" method="POST">
                <div class="form-group">
                    <div class="select2-primary">
                    <select class="select2 custom-form" name="it_skills[]" multiple="multiple" data-placeholder="Select Skills" data-dropdown-css-class="select2-primary" style="width: 100%;">
                    <option value="">---Select---</option>
                        <?php 
                        if(!empty($skill_list)): foreach($skill_list as $list):?>
                        <option value="<?=$list['skill_setid']?>"><?= $list['skill_name']?></option>
                        <?php endforeach; else:?>
                            <option value="">No skill sets</option>
                        <?php endif;?>
                    </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
            <a type="button" class="custom-btn border bg-default text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
                <button type="submit" id="insertItSkillsBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal: Add Skills -->

<!-- Modal: Introduction -->
<div class="modal modal-xlg fade" id="introduction-modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">

                <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
                <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
                style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a>
            </div>
            <div class="modal-body form">
                <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;">
                <span class="underline-text">Introduction </span></span>
                <form action="#" method="POST" id="updateIntroductionForm">
                <div class="form-group">
                    <div class="col-md-12">
                        <textarea name="user_profile_introduction" id="" cols="30" rows="8" class="custom-form" placeholder="** No introduction posted yet! **"><?=$introduction?></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <a type="button" class="custom-btn border text-decoration-none text-danger" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Cancel</a>
                <button type="submit" id="updateIntroductionBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal: Introduction -->

<!--  File Modal-->
<div class="modal fade" id="uploadCV" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">

        <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
        <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
         style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a>
      </div>
      <div class="modal-body" style="margin-top: -10px !important;">
        <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Upload CV/Portfolio</span></span>
        <form action="<?= base_url()?>it/upload-resume" method="post" enctype="multipart/form-data">
            <input type="file" name="file" class="custom-form" required>
            <p class="text-sm text-danger font-italic">Please be inform that we also verify your Uploaded CV for you to proceed. Make sure you uploaded the correct one.</p>
      </div>
      <div class="modal-footer border-0">
      <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
      <button type="submit" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--  File Modal End-->


<!-- Modal: ADD FILE -->
<div class="modal modal-xlg fade" id="file-modal" role="dialog">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">

        <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
        <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
         style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a>
      </div>
      <div class="modal-body form">
      <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;">
      <span class="underline-text">Upload Files </span></span>
                <?php if (session('msg')) : ?>
                    <div class="alert alert-success mt-3">
                        <?= session('msg') ?>
                    </div>
                <?php endif ?>
                <form action="#" method="POST" enctype="multipart/form-data" id="form_add_file" clas="form-horizontal">
                    <div class="form-group group-file-upload">
                        <div class="row custom-input-margintop-5">
                            <div class="col-md-12">
                                <input type="file" name="files[]" multiple="" class="custom-form">
                            </div>
                        </div>
                    </div>
                    <a style="cursor:pointer" id="btnRowAddFileUpload"><i class="bi bi-plus-circle"></i> Add More</a>
                <div class="modal-footer border-0">
                    <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Cancel</a>
                    <button type="submit" id="btnSaveFile" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal: Add FILE -->

<!-- Modal: Add Education -->
<div class="modal modal-xlg fade" id="education-modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
                <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
                style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a>
            </div>
                <div class="modal-body form">
                    <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Educational Background</span></span>
                    <form action="#" method="POST" id="insertEducationForm" class="form-horizontal">
                    <!-- EDUCATION -->
                    <div class="form-group group-education">
                        <div class="row custom-input-margintop-5 education-form-container">
                            <div class="col-md-8">
                                <input type="text" name="user_profile_edu_school[]" class="custom-form" placeholder="School/University">
                            </div>

                            <div class="col-md-4">
                                <input type="text" name="user_profile_edu_school_yr[]" class="custom-form custom-margintop-2" placeholder="Year attended">
                            </div>
                        </div>
                    </div>
                    <a style="cursor:pointer" id="btnRowAddEducation"><i class="bi bi-plus-circle"></i> Add More</a>
                </div>
                <div class="modal-footer border-0">
                    <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Cancel</a>
                    <button type="submit" id="insertEducationBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
                    </form>
                </div>        
            </div>
        </div>
    </div>
</div>
<!-- End Modal: Add Education -->

<!-- Modal: Add Work Experience -->
<div class="modal modal-xlg fade" id="experience-modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header border-0">

            <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
            <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
            style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a>
        </div>
        <div class="modal-body form">
            <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;">
            <span class="underline-text">Work Experiences</span></span>
                    <form action="#" id="insertWorkExpForm" class="form-horizontal">
                    <!-- Work Experience -->
                    <div class="form-group group-work-experience">
                        <div class="row custom-input-margintop-5 mb-1">
                            <div class="col-md-6 col-sm-6">
                                <input type="text" name="user_profile_xp_company[]" class="custom-form" placeholder="Company name">
                            </div>

                            <div class="col-md-3 col-sm-3">
                            <input type="text" name="user_profile_xp_role[]" class="custom-form custom-margintop-2" placeholder="Job role">
                            </div>

                            <div class="col-md-3 col-sm-2">
                            <input type="text" name="user_profile_xp_year[]" class="custom-form custom-margintop-2" placeholder="Year">
                            </div>
                        </div>
                    </div>
                    <a class="mt-2" style="cursor:pointer; color:#192F64!important" id="btnRowAddWorkExperience"><i class="bi bi-plus-circle"></i> Add More</a>
                
            </div>
            <div class="modal-footer border-0">
                    <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Cancel</a>
                    <button type="submit" id="insertWorkExpBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
                    </form>
                </div>        
            </div>
        </div>
    </div>
</div>
<!-- End Modal: Add Experience -->

<!-- Modal: EDIT -->
<div class="modal fade" id="profile-modal" role="dialog">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header border-0">

        <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
        <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
         style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a>
      </div>
      <div class="modal-body form">
        <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;">
        <span class="underline-text">Basic Info</span></span>
                <form action="#" method="POST" id="updateiTProfileForm">
                    <!-- Job Title -->
                    <div class="form-group mb-4">
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label class="control-label">Name</label>
                                <input type="text" name="user_name" class="custom-form" value="<?= $name?>">
                            </div>

                            <div class="col-md-4 mt-3">
                                <label class="control-label">Title</label>
                                <input type="text" name="user_position" class="custom-form" value="<?= $position?>">
                            </div>

                            <div class="col-md-2 mt-3">
                                <label>Rate Dollar/Hr</label>
                                <input type="text" name="user_rate" class="custom-form" value="<?= $rate?>">
                            </div>
                        </div>
                        
                        <!-- Contact Number & Email Address -->
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label class="control-label col-md-12">Contact Number</label>
                                <input type="text" name="user_contact" id="user_profile_email" class="custom-form" value="<?=$contactnumber?>">
                            </div>

                            <div class="col-md-6 mt-3 custom-margintop-15">
                                <label class="control-label col-md-12">Email Address</label>
                                <input type="text" name="user_email" id="user_profile_email" class="custom-form" value="<?=$email?>">
                            </div>
                        </div>

                        <!-- Introduction -->
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label mt-3">Introduction</label>
                                <textarea name="user_introduction" class="custom-form" id="user_profile_introduction" rows="8" placeholder="State your Introduction"><?= $introduction?></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;">
                    <span class="underline-text">Skills</span></span>
                    <!-- Educational Background -->
                    <div class="custom-container" id="itSkillsModal">
                    </div>
                    <hr>
                    <span class="d-flex justify-content-center mb-4 mt-3" style="font-weight: bold; font-size: 20px;">
                    <span class="underline-text">Files Uploaded</span></span>
                    <!-- File Upload -->
                        <div id="itFilesUploadedModal">
                        </div>  
                    <hr>
                    <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;">
                    <span class="underline-text">Educational Background</span></span>
                    <!-- Educational Background -->
                    <div class="custom-container" id="itEducationModal"> 
                    </div>
                    <hr>
                    <span class="d-flex justify-content-center mb-4 mt-5" style="font-weight: bold; font-size: 20px;">
                    <span class="underline-text">Work Experience/(s)</span></span>
                    <!-- Work Experience -->
                    <div class="form-group mb-3">
                        <div class="col-md-12">
                            <div class="custom-container" id="itExperienceModal">
                            </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer border-0">
                <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Cancel</a>
                <button type="submit" id="updateiTProfileBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal: EDIT -->