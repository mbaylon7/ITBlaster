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
        
        #add-file-modal{
          z-index: 9999!important;
        }
        .custom-card {
          height: 60px;
          width: 100%;
          background: #fff;
          border: 1px solid #D9D9D9;
          border-radius: 2px;
        }
        .custom-card-body {
          padding: 5px;
          color: #192F64;
        }
        .custom-card-body a {
          color: #192F64 !important;
        }
        .bi {
          cursor: pointer;
        }
        .bs-canvas-overlay {
   		    opacity: 0;
          z-index: -1;
        }
        
        .bs-canvas-overlay.show {
            opacity: 0.58;
            transition: opacity .15s linear;
            z-index: 100;
        }
        
        .bs-canvas-overlay, .bs-canvas {
          transition: all .4s ease-out;
          -webkit-transition: all .4s ease-out;
          -moz-transition: all .4s ease-out;
          -ms-transition: all .4s ease-out;
        }
        
        .bs-canvas {
          top: 0;
          z-index: 100;
          overflow-x: hidden;
          overflow-y: auto;
          width: 700px;		
        }
        
        .bs-canvas-left {
          left: 0;
          margin-left: -700px;
        }
        
        .bs-canvas-right {
          right: 0;
          margin-right: -700px;
        }
        .box {
          padding: 20px;
          border: 1.5px dashed #CACDD9;
        }
        .box-body{
          
        }
    </style>
    <script src="<?= base_url()?>plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url()?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url()?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url()?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url()?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url()?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script>

   // Define a function to generate the tab navigation
   function checkboxSelect() {
        $('#select-all').click(function(event) {   
          if(this.checked) {
                $('.checkbox').each(function() {
                    this.checked = true;
                    $('#update_button_hide').removeClass('d-none');
                });
            } else {
                $('.checkbox').each(function() {
                    this.checked = false;     
                    $('#update_button_hide').addClass('d-none');
                });
          }
        });

        $('input.checkbox').click(function() {
                var anyCheckboxChecked = $('input.checkbox:checked').length > 0;
                if (anyCheckboxChecked) {
                    $('#update_button_hide').removeClass('d-none');
                } else {
                    $('#update_button_hide').addClass('d-none');
                }
            });
      }
      function showOffcanvas() {
          var bsOverlay = $('.bs-canvas-overlay');
      $('.offCanvas').on('click', function(){
          let ticketid = $(this).attr('id')
          var ctrl = $(this), 
          elm = ctrl.is('a') ? ctrl.data('target') : ctrl.attr('href');
          $(elm).addClass('mr-0');
          $(elm + ' .bs-canvas-close').attr('aria-expanded', "true");
          $('[data-target="' + elm + '"], a[href="' + elm + '"]').attr('aria-expanded', "true");
          if(bsOverlay.length)
          bsOverlay.addClass('show').addClass('bg-dark');
          $('#ticketTitle').html(ticketid);
          $('#universalTicketId').val(ticketid);
          $('#getSubTickets').html('<table class="table table-bordered">\
          <thead>\
            <tr>\
              <th></th>\
              <th>Ticket #</th>\
              <th>Description</th>\
              <th>Duedate</th>\
              <th>Status</th>\
              <th>Created</th>\
            </tr>\
          </thead>\
          <tbody>\
            <tr>\
              <td class="text-center" colspan="6"><i class="bi bi-exclamation-circle text-warning"></i> &nbsp; No data</td>\
            </tr>\
        </table>');
        $('#ticketHistory').html('<table class="table table-bordered">\
          <thead>\
            <tr>\
            <th></th>\
            <th>Personel</th>\
            <th>Action</th>\
            <th>Timestamp</th>\
            </tr>\
          </thead>\
          <tbody>\
            <tr>\
              <td class="text-center" colspan="4"><i class="bi bi-exclamation-circle text-warning"></i> &nbsp; No data</td>\
            </tr>\
        </table>');
          $.ajax({
              url: '/ticket/get-sub-tickets/'+ticketid,
              method: 'GET',
              data: {id:ticketid},
              success: function(res) {
                  $('#getSubTickets').html(res.output);
                  $('#ticketHistory').html(res.activity);
              }
          })
          return false;
      });
      
      $('.bs-canvas-close, .bs-canvas-overlay').on('click', function(){
          var elm;
          if($(this).hasClass('bs-canvas-close')) {
          elm = $(this).closest('.bs-canvas');
          $('[data-target="' + elm + '"], a[href="' + elm + '"]').attr('aria-expanded', "false");
          } else {
          elm = $('.bs-canvas')
          $('[data-toggle="canvas"]').attr('aria-expanded', "false");	
          }
          elm.removeClass('mr-0');
          $('.bs-canvas-close', elm).attr('aria-expanded', "false");
          if(bsOverlay.length)
          bsOverlay.removeClass('show').removeClass('bg-dark');
          return false;
      });
      // End off canvas
      }
      function initializeDataTable(status, tabId, res) {
        $(`#tabResultDetail${status}`).html(res.result);
        var dataTable = $(`#${tabId} table`).DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "info": true,
            "paging": true,
            "dom": '<"top"f>rt<"bottom"><"row dt-margin"<"col-md-6"i><"col-md-6"p><"col-md-12"B>><"clear">',
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        });
        dataTable.buttons().container().appendTo(`#${tabId} .col-md-6:eq(0)`);
        showOffcanvas();
      }

      function showProjectTickets() {
        $(document).on('click', '.tabStatus', function(){
          var status = $(this).attr('data-status');
          let projectid = $('#universalProjectid').val();

          $.ajax({
            url: '/project/ticket-tab-details='+status,
            method: 'GET',
            data: {status: status, projectid: projectid},
            success: function(res) {
              if (status == 'Not Started') {
                  initializeDataTable('NS', 'tabResultDetailNS', res);
              } else if (status == 'In Progress') {
                  initializeDataTable('IP', 'tabResultDetailIP', res);
              } else if (status == 'On Hold') {
                  initializeDataTable('OH', 'tabResultDetailOH', res);  
              } else if (status == 'Completed') {
                  initializeDataTable('CMP', 'tabResultDetailCMP', res);
              } else if (status == 'Cancelled') {
                  initializeDataTable('CND', 'tabResultDetailCND', res);
              } else if (status == 'Archived') {
                  initializeDataTable('ARC', 'tabResultDetailARC', res);
              } else if (status == 'For Approval') {
                  initializeDataTable('FAL', 'tabResultDetailFAL', res);
                  checkboxSelect();
              }
            }
          });
        });
      }

    </script>
    <section class="content-header">
      <?php 
        use App\Models\ClientProfile;
        use App\Models\ITProfile;

        $it = new ITProfile;
        $userit = $it->where('userId', session('id'))->first();
        $user_type = session('usertype');

        $is_permitted = ($user_type == 1 && $userit['employment_status'] == 1) ? 'd-none' : '';
        $is_client = ($user_type == 2) ? 'd-none' : '';

      ?>
        <!-- Off Canvas Content -->
      <div id="canvasContent"></div>
        <div class="container-fluid">
          <div class="row mb-2" id="projectHeader">
          </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content" style="height: 100vh">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card d-none" id="projectCardHeader">
                <div class="card-body">
                  <!-- Action Buttons -->
                  <div id="actionBtns"></div>
                  <div class="row mt-3">
                    <div class="col-md-5">
                        <!-- Project Details -->
                        <div class="d-flex flex-column bd-highlight mb-3" id="projectContentSection"></div>
                        <!-- Skills -->
                        <div class="custom-container" id="skillsContainer"></div>
                    </div>
                    <!-- Chart -->
                    <div class="col-md-5 w-100">
                        <div id="chart"></div>
                    </div>
                    <!-- Files and active project tickets count -->
                    <div class="col-md-2 d-flex flex-column bd-highlight justify-content-center align-items-center mb-3" id="filesTicketContent"></div>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12">
            <div id="tabTickets"></div>
            <div class="card d-none" id="ticketTabContent"> 
                <div class="card-body">
                  <div class="tab-content" id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <!-- <table id="dataTableFull1" class="table">
                        <thead>
                            <th>No 1</th>
                            <th>No 2</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>2</td>
                          </tr>
                        </tbody>
                      </table> -->
                      <div id="tabResultDetailAll"></div>  
                    </div>

                    <div class="tab-pane fade" id="NotStarted" role="tabpanel" aria-labelledby="new-tab">
                       <div id="tabResultDetailNS"></div>
                    </div>

                    <div class="tab-pane fade" id="InProgress" role="tabpanel" aria-labelledby="inprogress-tab">
                    <div id="tabResultDetailIP"></div>
                    </div>

                    <div class="tab-pane fade" id="OnHold" role="tabpanel" aria-labelledby="on-hold-tab">
                    <div id="tabResultDetailOH"></div>
                    </div>

                    <div class="tab-pane fade" id="Cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                    <div id="tabResultDetailCND"></div>
                    </div>

                    <div class="tab-pane fade" id="Completed" role="tabpanel" aria-labelledby="completed-tab">
                    <div id="tabResultDetailCMP"></div>
                    </div>

                    <div class="tab-pane fade" id="Archived" role="tabpanel" aria-labelledby="archived-tab">
                      <div id="tabResultDetailARC"></div>
                    </div>
                    
                    <!-- For Approval -->
                    <div class="tab-pane fade" id="ForApproval" role="tabpanel" aria-labelledby="forapproval-tab">
                      <form action="/ticket/batch-approve-tickets" method="POST">
                        <div id="tabResultDetailFAL"></div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
<!-- ADD PROJECT MODAL -->
<div class="modal fade" id="add-project-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body form" style="margin-top: -1.5rem">
                <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Create Project</span></span>
                <form method="POST" id="createProjectForm" class="form-horizontal">
                <div class="form-group mb-4">
                    <div class="row">
                        <div class="col-md-7 mt-3">
                            <label class="control-label">Project Title</label>
                            <input type="text" name="project_title" class="custom-form" required>
                        </div>
                        <div class="col-md-5 mt-3">
                            <label>Budget</label>
                            <input type="text" name="offered_rate" class="custom-form" required value="">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label class="control-label col-md-12">Started Date</label>
                            <input type="datetime-local" name="start_date" class="custom-form" required value="">
                        </div>
                        <div class="col-md-6 mt-3 custom-margintop-15">
                            <label class="control-label col-md-12">Due Date</label>
                            <input type="datetime-local" name="due_date" class="custom-form" required value="">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label mt-3">Project description</label>
                            <textarea name="project_description" class="custom-form" required rows="8"></textarea>
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
</div>

<div class="modal fade" id="history-project-modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header border-0">
            <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
        </div>
        <div class="modal-body form" style="margin-top: -1.5rem">
          <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">History Logs</span></span>
          <div class="form-group mb-4">
            <div class="row">
              <div class="col-md-12">
                <!-- <a class="d-flex justify-content-end"><i class="bi bi-printer text-success h2"></i></a> -->
                <div class="table-responsive">
                  <table id="dataTableFull" class="table table-bordered table-hover">
                    <thead>
                      <th width="5%">#</th>
                      <th width="10%">PERSONEL</th>
                      <th width="20%">ACTIVITY</th>
                      <th width="40%">REMARKS</th>
                      <th width="13%">TIMESTAMP</th>
                    </thead>
                    <tbody>
                    <?php foreach ($history ?? [] as $log): ?>
                      <tr>
                          <td><?= $log['logid'] ?></td>
                          <td><?= $log['name'] ?></td>
                          <td><?= $log['action_activity'] ?></td>
                          <td><?= $log['history_remarks'] ?></td>
                          <td><?= $log['created_at'] ?></td>
                      </tr>
                  <?php endforeach; ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="modal-footer border-0" style="margin-top: -2rem">
        <a type="button" class="custom-btn border text-decoration-none text-danger" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
      </div>
    </div>
  </div>
</div>

<!-- ADD TICKET -->
<div class="modal fade" id="add-ticket-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body form" style="margin-top: -1.5rem">
                <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Add Ticket</span></span>
                <form id="addTicketForm" method="POST" class="form-horizontal">
                <div class="form-group mb-4">
                    <div class="row">
                            <input type="hidden" name="projectid" value="<?= $project['projectid'];?>">
                            <input type="hidden" name="clientid" value="<?= $project['clientid'];?>">
                            <input type="hidden" name="alloted_time" id="result">
                            <input type="hidden" name="parentid" id="parentid" value="0">
                            <input type="hidden" name="childid" id="childid" value="0">
                        <?php if($usertype == 1):?>
                        <div class="col-md-8 mt-3">
                            <label class="control-label">Title</label>
                            <input type="text" name="title" class="custom-form" required>
                            <input type="hidden" name="assignto[]" value="<?= session('id')?>" class="custom-form" required>
                        </div>
                        <div class="col-md-4 mt-3">
                        <label class="control-label col-md-12">Priority</label>
                            <select class="select2 custom-form" name="priority" required data-placeholder="Select Priority" data-dropdown-css-class="select2-primary"  style="width: 100%;">
                                <option value="">Select</option>
                                <option value="Low">Low</option>
                                <option value="Moderate">Moderate</option>
                                <option value="High">High</option>
                                <option value="Very High">Very High</option>
                            </select>
                        </div>
                        <?php else:?>
                        <div class="col-md-5 mt-3">
                            <label class="control-label">Title</label>
                            <input type="text" name="title" class="custom-form" required>
                        </div>

                        <div class="col-md-4 mt-3">
                        <label class="control-label col-md-12">Label</label>
                            <select class="select2 custom-form" name="status" required data-placeholder="Select Priority" data-dropdown-css-class="select2-primary"  style="width: 100%;">
                                <option value="Not Started">Not Started</option>
                                <option value="In Progress">In Progress</option>
                                <option value="On Hold">On Hold</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>

                        <div class="col-md-3 mt-3">
                        <label class="control-label col-md-12">Priority</label>
                            <select class="select2 custom-form" name="priority" required data-placeholder="Select Priority" data-dropdown-css-class="select2-primary"  style="width: 100%;">
                                <option value="Low">Low</option>
                                <option value="Moderate">Moderate</option>
                                <option value="High">High</option>
                                <option value="Very High">Very High</option>
                            </select>
                        </div>

                        <div class="col-md-12 mt-3">
                        <label class="control-label col-md-12">Assign To</label>
                            <select class="select2 custom-form" name="assignto[]" required multiple="multiple" data-placeholder="Select Personel" data-dropdown-css-class="select2-primary"  style="width: 100%;">
                              <?php foreach($developers ?? [] as $data):?> 
                                <option value="<?=$data['id']?>"><?=$data['name']?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                       
                        <?php endif?>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label class="control-label col-md-12">Start Date</label>
                            <input type="datetime-local" id="ticket_start_date" name="startdate" class="custom-form" required>
                        </div>
                        <div class="col-md-6 mt-3 custom-margintop-15">
                        <label class="control-label col-md-12">Due Date</label>
                            <input type="datetime-local" id="ticket_due_date" name="duedate" class="custom-form" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label mt-3">Description</label>
                            <textarea name="description" class="custom-form" required rows="8"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        <div class="modal-footer border-0" style="margin-top: -2rem">
            <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
            <button type="submit" id="addTicketBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- ASSIGN PERSONEL MODAL -->
<div class="modal fade" id="assign-personel-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body form" style="margin-top: -1.5rem">
                <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Assigned Project Manager Personel</span></span>
                <form id="assignManagerForm" method="POST" class="form-horizontal">
                <div class="form-group mb-4">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="hidden" name="projectid" value="<?= $project['projectid']?>">
                      <input type="hidden" name="project_name" value="<?= $project['project_name']?>">
                      <input type="hidden" name="column" value="pmid">
                        <label class="control-label mt-3">Personels </label>
                        <select class="select2 custom-form" name="assignto[]" multiple="multiple" required data-placeholder="Select Personel" data-dropdown-css-class="select2-primary"  style="width: 100%;">
                            <option value="">Select Personel</option>
                            <?php foreach($itpersonels ?? [] as $personel):?>
                              <?= $personel['userId']?><?= $personel['name']?><br>
                            <option value="<?= $personel['id']?>"><?= $personel['name']?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                  </div>
                </div>
            </div>
        <div class="modal-footer border-0" style="margin-top: -2rem">
            <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
            <button type="submit" id="assignManagerBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Assign</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- ASSIGN DEVELOPERS -->
<div class="modal fade" id="assign-developers-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body form" style="margin-top: -1.5rem">
              <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Assigned Developer Personel</span></span>
              <form id="assignDeveloperForm" method="POST" class="form-horizontal">
              <div class="form-group mb-4">
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" name="projectid" id="universalProjectid" value="<?= $project['projectid']?>">
                    <input type="hidden" name="clientid" value="<?= $project['clientid'];?>">
                    <input type="hidden" name="project_name" value="<?= $project['project_name']?>">
                      <label class="control-label mt-3">Personels</label>
                      <select class="select2 custom-form" name="developers[]" multiple="multiple" data-placeholder="Select Developers" data-dropdown-css-class="select2-primary" style="width: 100%;" required>
                          <option value="">Select Personel</option>
                          <?php foreach($itpersonels ?? [] as $personel):?>
                          <option value="<?= $personel['id']?>"><?= $personel['name']?></option>
                          <?php endforeach?>
                      </select>
                  </div>
                </div>
              </div>
            </div>
        <div class="modal-footer border-0" style="margin-top: -2rem">
            <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
            <button type="submit" id="assignDeveloperBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
            </form>
        </div>
    </div>
  </div>
</div>


<!-- Add File -->
<div class="modal fade" id="add-file-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body form" style="margin-top: -1.5rem">
              <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Upload File</span></span>
              <form method="POST" class="form-horizontal" id="attachTicketFile" enctype="multipart/form-data">
              <div class="form-group mb-4">
                <div class="row">
                  <div class="col-md-12">
                    <label class="control-label mt-3">File</label>
                    <input type="file" name="file" class="custom-form">
                    <input type="hidden" name="ticketid" id="ticketidval" class="custom-form" required>
                    <input type="hidden" name="projectid" value="<?= $project['projectid']?>" class="custom-form" required>
                  </div>
                </div>
              </div>
            </div>
        <div class="modal-footer border-0" style="margin-top: -2rem">
            <a type="button" class="custom-btn border text-decoration-none text-dark" data-toggle="modal" data-target="#view-ticket-modal" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
            <button type="submit" data-toggle="modal" data-target="#view-ticket-modal" id="attachTicketFileBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- VIEW APPLICANTS MODAL -->
<div class="modal fade" id="view-applicants-modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header border-0">
            <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
        </div>
        <div class="modal-body form" style="margin-top: -1.5rem">
          <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Applicants</span></span>
          <div class="form-group mb-4">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table id="dataTableFull1" class="table table-bordered table-hover">
                    <thead>
                      <th>Name</th>
                      <th>Specialty</th>
                      <th>Skill Sets</th>
                      <th class="text-center" width="18%">Action</th>
                    </thead>
                    <tbody>
                      <?php foreach($applicants ?? [] as $applicant):  if($project['projectid'] == ($applicant['projectid'] ?? null)): ?>
                        <tr>
                          <input type="hidden" class="application_id" value="<?= $applicant['applicantid'] ?>" />
                          <td><a target="_blank" data-toggle="tooltip" title="View applicant's profile" href="/project/view-profile/id=<?= $applicant['id'] ?>"><?= $applicant['name'] ?></a></td>
                          <td><?= $applicant['user_position'] ?></td>
                          <td>
                            <?php foreach($skills ?? [] as $skill): if($applicant['itid'] == ($skill['skill_itid'] ?? null)): ?>
                                <span class="badge badge-info py-2 px-2 mt-1 mb-1" style="font-size: 12px;"><?= $skill['skill_name'] ?></span>
                              <?php endif;  endforeach; ?>
                          </td>
                          <td class="text-center">
                            <a href="#" class="btn btn-danger decline_applicant applicant_status1" id="<?= $applicant['applicantid'] ?>" data-id="<?= $applicant['applicantid'] ?>">Decline</a>
                            <a href="#" class="btn btn-success accept_applicant applicant_status2" id="<?= $applicant['applicantid'] ?>" data-id="<?= $applicant['applicantid'] ?>">Accept</a>
                          </td>
                        </tr>
                      <?php endif; endforeach?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="modal-footer border-0" style="margin-top: -2rem">
        <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
      </div>
    </div>
  </div>
</div>

<!-- VIEW TICKET MODAL -->
<div class="modal fade" id="view-ticket-modal">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header border-1" style="background: #192F64">
        <div style="font-size: 18px" class="modal-title d-flex justify-content-center align-self-center text-white" id="exampleModalLabel">
          Ticket #<span id="ticketid"></span> &nbsp; &nbsp; <i class="bi bi-caret-right" style="color: #1C57E5"></i> &nbsp; &nbsp; 
          <span class="d-flex justify-content-center align-self-center" id="ticket-label"></span>
        </div>
      </div>
      <div class="modal-body">
      <form id="updateTicketForm" class="form-horizontal" method="POST">
      <label for="input" class="mb-4" style="border-bottom: 2px solid #192F64; font-size: 16px">Basic Info</label>
        <div class="row mb-3">
            <div class="col-md-6 ">
              <label for="ticket_title"> Title</label>
              <input type="hidden" id="ticketDetailsId" name="ticketid">
              <input type="text" name="title" id="ticket_title" class="custom-form" required>
            </div>

            <div class="col-md-6 ">
              <label for="due_date"> Duedate</label>
              <input type="datetime-local" name="duedate" id="due_date" class="custom-form" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6" id="ticket_label">
            </div>

            <div class="col-md-6" id="ticket_priority">
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-12">
              <label for="ticket-description"> Description</label>
              <textarea name="ticket_description" id="ticket-description" rows="4" class="custom-form"></textarea>
            </div>
          </div>
          <div class="d-flex justify-content-end">
            <button id="updateTicketDetailsBtn" class="custom-btn bg-success text-decoration-none text-white"><i class="bi bi-clipboard2-check"></i> &nbsp;Update</button type="submit">
          </div>
      </form>                  
        <!-- Comment -->
        <label for="input" class="mb-4" style="border-bottom: 2px solid #192F64; font-size: 16px">Comments</label><a data-dismiss="modal" data-toggle="modal" class="<?=$is_client?>" data-target="#add-comment-modal"><span data-toggle="tooltip" title="Add Comment"><i class="bi bi-plus-circle text-success px-2"></i></span></a>
          <div class="timeline timeline-inverse text-sm" id="ticketComments" style="max-height: 350px; overflow:auto">
          </div>
        <!-- Files -->
        <label for="input" class="mb-4" style="border-bottom: 2px solid #192F64; font-size: 16px">Files</label> <a style="cursor:pointer" data-dismiss="modal" data-toggle="modal" data-target="#add-file-modal" class="ticket-file-upload <?=$is_client?>"><span data-toggle="tooltip" title="Move to Archived"> <i class="bi bi-plus-circle text-success px-2"></i></span></a>
          <div class="row" id="ticketDocuments" style="max-height: 350px; overflow:auto">
          </div>
        </div>
      <div class="modal-footer border-1">
        <button type="submit" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</button>
      </div>
    </div>
  </div>
</div>

<!-- ADD COMMENT MODAL -->
<div class="modal fade" id="add-comment-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body form" style="margin-top: -1.5rem">
              <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Add Ticket</span></span>
              <form method="POST" id="addCommentForm" class="form-horizontal">
              <div class="form-group mb-4">
                <label class="control-label mt-3">Comment</label>
                <input type="hidden" name="projectid" value="<?=$project['projectid']?>">
                <input type="hidden" name="clientid" value="<?=$project['clientid']?>">
                <input type="hidden" name="ticketid" id="commentTicketId">
                <textarea name="comment" class="custom-form comment-content" required rows="8"></textarea>    
              </div>
            </div>
        <div class="modal-footer border-0" style="margin-top: -2rem">
            <a type="button" class="custom-btn border text-decoration-none text-dark" data-toggle="modal" data-target="#view-ticket-modal" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
            <button type="submit" data-toggle="modal" data-target="#view-ticket-modal" id="addCommentFormBtn" class="custom-btn bg-primary text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- EDIT PROJECT MODEL -->
<div class="modal fade" id="edit-project-modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header border-0">

          <h5 class="modal-title d-flex justify-content-center" id="exampleModalLabel"></h5>
          <!-- <a type="button" class="btn-close border-0" data-dismiss="modal" aria-label="Close"
          style="color:#000; margin: -10px -5px 0 0"><i class="bi bi-x-circle text-danger" style="font-size:22px!important"></i></a> -->
      </div>
        <div class="modal-body form" style="margin-top: -1.5rem">
        <span class="d-flex justify-content-center mb-4 mt-0" style="font-weight: bold; font-size: 20px;"><span class="underline-text">Edit Project</span></span>
            <form id="updateProjectForm" method="POST" class="form-horizontal">
            <div class="form-group mb-4">
              <div class="row">
              <div class="col-md-5 mt-3">
                      <label class="control-label">Project Title</label>
                      <input type="hidden" name="projectid" id="globalProjectid" class="custom-form" value="<?= $project['projectid']?>">
                      <input type="hidden" name="clientid" id="globalClientid" class="custom-form" value="<?= $project['clientid']?>">
                      <input type="text" name="project_title" id="globalProjectName" class="custom-form" value="<?= $project['project_name']?>">
                  </div>

                  <div class="col-md-4 mt-3">
                  <label class="control-label col-md-12">Priority</label>
                      <select class="select2 custom-form" name="project_status" required data-placeholder="Select Priority" data-dropdown-css-class="select2-primary"  style="width: 100%;">
                          <option value="<?= $project['project_label']?>"><?= $project['project_label']?></option>
                          <option value="Not Started">Not Started</option>
                          <option value="In Progress">In Progress</option>
                          <option value="On Hold">On Hold</option>
                          <option value="Cancelled">Cancelled</option>
                          <option value="Completed">Completed</option>
                          <option value="Archived">Archived</option>
                      </select>
                  </div>

                  <div class="col-md-3 mt-3">
                      <label>Budget</label>
                      <input type="text" name="offered_rate" class="custom-form" value="<?= $project['project_budget']?>">
                  </div>
              </div>
              
              <div class="row">
                  <div class="col-md-6 mt-3">
                      <label class="control-label col-md-12">Tag  <span data-toggle="tooltip" title="Specialist eg: Software Engineer | Web Developer | Cloud Server etc."><i class="bi bi-question-circle text-info"></i></span></label>
                      <input type="text" name="specialist" class="custom-form" value="<?= $project['specialist_tag']?>">
                  </div>
                  
                  <div class="col-md-3 mt-3">
                      <label class="control-label col-md-12">Started Date</label>
                      <input type="date" name="start_date" class="custom-form" value="<?= $project['start_date']?>">
                  </div>

                  <div class="col-md-3 mt-3">
                      <label class="control-label col-md-12">Due Date</label>
                      <input type="date" name="due_date" class="custom-form" value="<?= $project['due_date']?>">
                  </div>
              </div>

              <div class="row">
                <div class="col-md-12 mt-3">
                  <label for="Client"></label>
                  <select class="select2 custom-form" name="clientid" required data-placeholder="Select Priority" data-dropdown-css-class="select2-primary"  style="width: 100%;">
                        <option value="<?= $owner['id']?>"><?= $owner['name']?></option>
                          <?php foreach($all_client ?? [] as $client):?>
                          <option value="<?=$client['id']?>"><?=$client['name']?></option>
                          <?php endforeach?>
                      </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                    <label class="control-label mt-3">Skills needed <span data-toggle="tooltip" title="On listing Skills needed to this project you must seperate it in comma(,) eg: (skill#1, skill#2, skill#3)"><i class="bi bi-question-circle text-info"></i></span></label>
                    <textarea name="skills" rows="3" class="custom-form"><?= $project['allot_skills']?></textarea>
                </div>
              </div>
              
              <!-- Introduction -->
              <div class="row">
                  <div class="col-md-12">
                      <label class="control-label mt-3">Project description</label>
                      <textarea name="project_description" class="custom-form" rows="8"><?= $project['description']?></textarea>
                  </div>
              </div>
          </div>
        </div>
        <div class="modal-footer border-0" style="margin-top: -2rem">
            <a type="button" class="custom-btn border text-decoration-none text-dark" data-dismiss="modal"><i class="bi bi-x-circle"></i> &nbsp;Close</a>
            <button type="submit" id="updateProjectForm" class="custom-btn bg-success text-decoration-none text-white"><i class="bi bi-check-circle"></i> &nbsp;Update</button>
            </form>
        </div>
    </div>
</div>
  <script src="<?= base_url()?>js/project.js"></script>
  <script src="<?= base_url()?>js/ticket.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script></script>
  <?= $this->endsection() ?>
  