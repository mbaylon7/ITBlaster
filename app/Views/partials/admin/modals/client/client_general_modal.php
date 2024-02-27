<!--  Product Services Modal-->
<div class="modal fade" id="clientProductServicesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">

        <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
        <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
         style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a>
      </div>
      <div class="modal-body" style="margin-top: -10px !important;">
        <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Products and Services</span></span>
        <form action="#" method="POST" id="clientProductServicesForm">
          <input type="text" name="product_services[]" class="custom-form">  
          <div id="newProductServiceRow"></div>
            <a class="btn" id="addNewProductServicesRow"><i class="bi bi-plus-circle-fill text-primary"></i> Add More</a>
      </div>
      <div class="modal-footer border-0">
        <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
        <button type="submit" id="clientProductServicesBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--  Product Services Modal End-->

<!--  File Modal-->
<div class="modal fade" id="clientFileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">

        <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
        <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
         style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a>
      </div>
      <div class="modal-body" style="margin-top: -10px !important;">
        <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Upload Files</span></span>
        <form action="#" method="POST" id="uploadClientFileForm">
            <input type="file" name="files[]" class="custom-form">
            <div id="newFileRow"></div>
            <a class="btn" id="addNewFileRow"><i class="bi bi-plus-circle-fill text-primary"></i> Add More</a>
      </div>
      <div class="modal-footer border-0">
      <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
      <button type="submit" id="uploadClientFileBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--  File Modal End-->


<!--  Company Introduction Modal-->
<div class="modal fade" id="clientIntroductionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">

        <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
        <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
         style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a>
      </div>
      <div class="modal-body" style="margin-top: -10px !important;">
        <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Company Introduction </span></span>
        <form action="#" method="POST" id="companyIntroductionForm">
            <textarea name="client_company_introduction" cols="30" rows="7" class="custom-form" placeholder="State Your Company Introduction"><?= $introduction?></textarea>
      </div>
      <div class="modal-footer border-0">
        <a type="button" class="custom-btn border text-decoration-none text-danger" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Cancel</a>
        <button type="submit" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--  Company Introduction Modal End-->

<!--  Content  Modal-->
<div class="modal fade" id="clientContactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">

        <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
        <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
         style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a>
      </div>
      <div class="modal-body" style="margin-top: -10px !important;">
        <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Add Contact</span></span>
        <form action="#" method="POST" id="contactForm">
        <input type="text" name="contact_name[]" class="custom-form mb-3" placeholder="Name">
        <input type="text" name="contact_no[]" class="custom-form mb-3" placeholder="Contact no.">
        <input type="text" name="contact_position[]" class="custom-form mb-3" placeholder="Position">
            <div id="newContactRow"></div>
            <a class="btn" id="addNewContactRow"><i class="bi bi-plus-circle-fill text-primary"></i> Add More</a>
      </div>
      <div class="modal-footer border-0">
        <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
        <button type="submit" id="contactBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--  Content  Modal End-->

<div class="modal fade" id="clientEditProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header border-0">

        <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
        <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
         style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a>
      </div>
      <div class="modal-body" style="margin-top: -10px !important;">
        <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Basic Info</span></span>
        <form action="#" method="POST" id="clientBasicInfoForm">
          <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label class="mb-2">Name</label>
                    <input type="hidden" name="user_id" class="custom-form mb-3" value="<?= $PK_id ?>" placeholder="Name">
                    <input type="text" name="user_name" class="custom-form mb-3" value="<?= $name ?>" placeholder="Name">
                  </div>

                  <div class="form-group">
                    <label class="mb-2">E-mail</label>
                    <input type="text" name="user_email" class="custom-form mb-3" value="<?= $email?>" placeholder="Email">
                  </div>

                  <div class="form-group">
                    <label class="mb-2">Company name</label>
                    <input type="text" name="user_company" class="custom-form mb-3" value="<?= $company?>" placeholder="Email">
                  </div>

              </div>

              <div class="col-md-6">

                  <div class="form-group">
                    <label class="mb-2">Contact number</label>
                    <input type="text" name="user_contact" class="custom-form mb-3" value="<?= $contact?>" placeholder="Contact no.">
                  </div>

                  <div class="form-group">
                    <label class="mb-2">Position</label>
                    <input type="text" name="user_position" class="custom-form mb-3" value="<?= $position?>" placeholder="Position">
                  </div>

              </div>
          </div>
          <div class="row mt-2 mb-5">
            <div class="col-md-12">
              <label class="mb-2">Company Intruduction</label>
            <textarea name="company_introduction" cols="30" rows="7" class="custom-form" placeholder="State Your product and Services"><?= $introduction?></textarea>
            </div>
          </div>
          <hr>
         <!-- PRODUCTS AND SERVICES -->
         <span class="d-flex justify-content-center mb-5 mt-5" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Products and Services</span></span>
         <div class="custom-container" id="allClientProductsModal">

        </div>

          <hr>
          <!-- FILES SECTION -->
        <span class="d-flex justify-content-center mb-5 mt-5" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Files/Contracts</span></span>
        <div class="custom-container" id="allClientFilesModal"  style="padding-left:5%;">
        </div>
        <hr>
        <!-- CONTACT SECTION -->
        <span class="d-flex justify-content-center mb-5 mt-5" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Contacts</span></span>
        <div class="custom-container" id="allClientContactsModal">
        </div>
        
      </div>
      <div class="modal-footer border-0 mt-5">
        <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Cancel</a>
        <button type="submit" id="clientBasicInfoBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
        </form>
      </div>
    </div>
  </div>
</div>