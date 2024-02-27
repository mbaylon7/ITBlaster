$(document).ready(function(){
    function toolTips(){
        $('[data-toggle="tooltip"]').tooltip()
    }
    function select2() {
        $('.select2').select2({})
    }
    
    // Generate Project Details
    function generateProjectContent(projectId) {
        $.get({
            url: '/ticket/project-ticket-details/' + projectId,
            success: function (res) {
                if (res.error === false) {
                    const navItems = [
                        { status: "all", label: "All Active", badgeColor: "border", count: res.data.all, route: "all" },
                        { status: "Not Started", label: "Not Started", badgeColor: "badge-light", count: res.data.notStarted, route: "NotStarted" },
                        { status: "In Progress", label: "In-Progress", badgeColor: "badge-info", count: res.data.inProgress, route: "InProgress" },
                        { status: "On Hold", label: "On Hold", badgeColor: "badge-warning", count: res.data.hold, route: "OnHold" },
                        { status: "Cancelled", label: "Cancelled", badgeColor: "badge-danger", count: res.data.cancelled, route: "Cancelled" },
                        { status: "Completed", label: "Completed", badgeColor: "badge-success", count: res.data.completed, route: "Completed" },
                        { status: "Archived", label: "Archive", badgeColor: "badge-secondary", count: res.data.archived, route: "Archived" },
                        { status: "For Approval", label: "For Approval", badgeColor: "badge-secondary", count: res.data.forApproval, route: "ForApproval" },
                    ];
    
                    let html = '<ul class="nav nav-tabs mb-4" id="custom-content-below-tab" role="tablist">';
                    navItems.forEach(item => {
                        if (item.count > 0) {
                            html += `
                                <li class="nav-item">
                                    <a class="nav-link tabStatus" id="${item.status}-tab" onclick="showProjectTickets()" data-status="${item.status}" data-toggle="pill" href="#${item.route}" role="tab" aria-controls="${item.status}" aria-selected="false">${item.label} &nbsp; <span class="badge ${item.badgeColor}">${item.count}</span></a>
                                </li>`;
                        }
                    });
                    html += '</ul>';
    
                    let html2 = `
                        <div class="bd-highlight mb-3">
                            <span class="text-info h6"><a style="cursor:pointer">Documents</a></span>
                        </div>
                        <div class="bd-highlight mb-3" style="margin-top: -15px;">
                            <i class="bi bi-folder h1 text-gray" style="font-size: 80px;"></i>
                            <span style="display: flex; justify-content: center; margin-top: -3.6em; font-weight: bold; font-size: 18px">${res.data.files}</span>
                        </div>
                        <div class="bd-highlight mt-3">
                            <span class="text-info h6"><a style="cursor:pointer">Tickets</a></span>
                        </div>
                        <div class="bd-highlight" style="margin-top: -15px;">
                            <i class="bi bi-ticket h1 text-gray" style="font-size: 80px;"></i>
                            <span style="display: flex; justify-content: center; margin-top: -3.6em; font-weight: bold; font-size: 18px">${res.data.all}</span>
                        </div>
                    `;
                    $('#filesTicketContent').html(html2);
                    $('#tabTickets').html(html);
    
                    // Summary Graph Report
                    const data = {
                        categories: ['NOT STARTED', 'IN PROGRESS', 'ON HOLD', 'CANCELLED', 'COMPLETED'],
                        series: [res.data.notStarted, res.data.inProgress, res.data.hold, res.data.cancelled, res.data.completed]
                    };
                    const options = {
                        chart: {type: 'bar',height: 250,toolbar: {show: false}},
                        title: {text: 'Overall Ticket Status',align: 'center',style: {fontSize: '14px',fontWeight: '600',color: '#4FAFCB'}},
                        series: [{name: 'Total of',data: data.series}],
                        xaxis: {categories: data.categories,labels: {style: {colors: ['#292b2c', '#17a2b8', '#ffc107', '#dc3545', '#28a745']}},axisBorder: {color: '#fff'}},
                        legend: {show: false},
                        yaxis: {labels: {style: {colors: '#000'}},axisBorder: {color: '#fff'}},
                        colors: ['#292b2c', '#17a2b8', '#ffc107', '#dc3545', '#28a745'],
                        plotOptions: {bar: {columnWidth: '65%',distributed: true,}},
                        grid: {borderColor: '#fff'}
                    };
                    const chart = new ApexCharts(document.querySelector('#chart'), options);
                    chart.render();
    
                    // Project details including developers, project manager and skills needed
                    const project = res.data.project;
                    const developers = res.data.developers;
                    const manager = res.data.manager;
                    const owner = res.data.owner;
                    const is_permitted = res.data.is_permitted;
                    const is_client = res.data.is_client;
                    const count_applicants = res.data.applicants;
                    const assigned_pm = res.data.assigned_pm;
    
                    const labelClasses = {
                        'Not Started': 'border',
                        'In Progress': 'border-success badge-info',
                        'On Hold': 'border border-warning badge-warning',
                        'Cancelled': 'border border-danger badge-danger',
                        'Completed': 'border border-light badge-success',
                        'Archived': 'border border-light badge-secondary'
                    };
                    
                    const projectLabel = project.project_label;
                    const labelClass = labelClasses[projectLabel] || 'border border-light badge-secondary';
                    
                    const status = project.project_status_flag === 1
                        ? `<span class="badge border-danger badge-danger mt-3">Archived</span>`
                        : `<span class="badge ${labelClass} mt-3">${projectLabel}</span>`;
                        
                    head = ``
                    actionBtn = ``
                    actionBtn +=`<div class="add-project d-flex justify-content-end d-print-none">
                    <div class="btn-group" role="group" aria-label="Basic example">
                    <a style="cursor:pointer" data-toggle="modal" data-target="#add-ticket-modal" class="btn btn-info btn-sm ${is_client}"> Add Ticket</a>
                    <a type="button" class="btn ${is_permitted} btn-light border" data-toggle="modal" data-target="#assign-personel-modal"><span data-toggle="tooltip" title="Assign Project Manager"><i class="bi bi-pin-angle"></i></span></a>
                    <a type="button" class="btn ${is_permitted} btn-light border" data-toggle="modal" data-target="#assign-developers-modal"><span data-toggle="tooltip" title="Assign Developers"><i class="bi bi-code-slash"></i></span></a>
                    <a type="button" class="btn ${is_permitted} btn-light border" data-toggle="modal" data-target="#view-applicants-modal"><span data-toggle="tooltip" title="${count_applicants} Active Applicant(s) on this Project"><i class="bi bi-person-workspace"></i></span> <span class="text-warning">${count_applicants}</span></a>
                    <a type="button" class="btn ${is_permitted} btn-light border" data-toggle="modal" data-target="#edit-project-modal"><span data-toggle="tooltip" title="Edit Project"><i class="bi bi-pencil-square"></i></span></a>
                    <a type="button" class="btn btn-light border" data-toggle="modal" data-target="#history-project-modal"><span data-toggle="tooltip" title="Project History Logs"><i class="bi bi-activity"></i></span></a>
                    <a onclick="window.print()" type="button" class="btn btn-light border"><span data-toggle="tooltip" title="Print Report"><i class="bi bi-printer"></i></span></a>
                    </div>
                </div>`
                $('#actionBtns').html(actionBtn) 
                    head += `
                            <div class="col-sm-6">
                            <h1>${project.project_name}</h1>
                            
                                <span class="h4">${status}</span>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item active"><i class="bi bi-lightbulb"></i> <a href="/">${owner.name}’s</a> &nbsp; Project</li>
                                </ol>
                            </div>`
    
                    $('#projectHeader').html(head) 
                    html3 = ``;
                    html3 +=`<div class="p-2 bd-highlight"><span class="text-info">TITLE: </span> <span class="text-gray px-2"><strong>${project.project_name}</strong></span></div>
                    <div class="p-2 bd-highlight"><span class="text-info">DESCRIPTION: </span> <span class="text-gray px-2"><q><i>${project.description}</i></q></span></div>
                    <div class="p-2 bd-highlight">
                    <span class="text-info">PROJECT MANAGER: </span> 
                    <span class="text-gray px-2">`
                        if (manager && Object.keys(manager).length !== 0) {
                            const assignedPmIds = project.pmid;
                            const IdSeparator = assignedPmIds.split(',');
                            const filteredAssignees = assigned_pm.filter(assignee => IdSeparator.includes(assignee.id));
                        
                            if (filteredAssignees.length > 0) {
                                html3 += filteredAssignees.map(assignee => {
                                    return `<a target="_blank" class="px-1" data-toggle="tooltip" title="View profile" href="/project/view-profile/id=${assignee.id}"><strong>${assignee.name}</strong></a>`;
                                }).join('');
                        html3 +=`<a class="remove_assigned ${is_permitted}" data-id="2" id="${project.projectid}" data-toggle="tooltip" title="Remove"><i class="bi bi-x-circle text-danger px-1"></i></a></span></div>`
                            } else {
                                html3 += `<i class="bi bi-exclamation-circle text-warning px-1"> No Project Manager assigned yet.</i>`;
                            }
                        } else {
                            html3 += `<i class="bi bi-exclamation-circle text-warning px-1"> No Project Manager assigned yet.</i>`;
                        }
                    // Developers 
                    html3 += `<div class="p-2 bd-highlight">
                                <span class="text-info">DEVELOPER(S): </span> 
                                <span class="text-gray px-2">`
                                if(developers.length > 0) {
                                    developers.forEach(function(developer) {
                                        html3 +=`<a target="_blank" data-toggle="tooltip" title="View profile" href="/project/view-profile/id=${developer.id}"><strong>${developer.name}</strong></a><a class="remove_assigned ${is_permitted}" data-id="1" id="${developer.id}" data-text="${developer.name}" data-toggle="tooltip" title="Remove"><i class="bi bi-x-circle text-danger px-1"></i></a>`
                                    });
                                } else {
                                    html3 +=`<i class="bi bi-exclamation-circle text-warning px-1"> No Developer(s) assigned yet.</i>`
                                }
                                html3 += `</span>
                                </div>`
                                
                    // Due date            
                    html3 += `<div class="p-2 bd-highlight">
                                <span class="text-info">DESIRED DUE DATE: </span> 
                                <span class="text-gray px-2">${res.data.project_due}</span>
                            </div>` 
                    
                    // Skills
                    html3 += `<div class="p-2 bd-highlight">
                    <span class="text-info">SKILLS:</span>
                    <div class="custom-container">`
                    
                    const skillSetsString = project.allot_skills;
                    const skillSetsArray = skillSetsString.split(', ');
                    
                    $.each(skillSetsArray, function(index, skill) {
                        html3+=`<div class="custom-content rounded text-ellipsis align-item-center">
                                    <span class="text-center">${skill.trim()}</span>
                                </div>`
                    });
                    
                    html3 +=`</div>`
    
                    $('#actionBtns').html(actionBtn);
                    $('#projectHeader').html(head);
                    $('#projectContentSection').html(html3);
                }
            }
        });
    }
    

    function canvasContent() {
        canvas = `<div id="bs-canvas-right" class="bs-canvas bs-canvas-right position-fixed bg-light h-100">
            <div class="d-flex justify-content-center align-items-center border">
              <span class="h5 fw-bold mt-3 mb-3">Ticket# <span id="ticketTitle"></span></span>
              <input type="hidden" id="universalTicketId">
            </div>
            <div class="d-flex justify-content-end mt-4 px-2">
              <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-content-below-subtask-tab" data-toggle="pill" href="#custom-content-below-subtask" role="tab" aria-controls="custom-content-below-subtask" aria-selected="true">Sub Ticket</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link activityTab" id="custom-content-below-activity-tab" data-toggle="pill" href="#custom-content-below-activity" role="tab" aria-controls="custom-content-below-activity" aria-selected="false">Activities</a>
                </li>
              </ul>
            </div>
            <div class="tab-content px-4 mt-2" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active mt-5" id="custom-content-below-subtask" role="tabpanel" aria-labelledby="custom-content-below-subtask-tab">
                <div class="grid">
                  <div class="g-col-12" id="getSubTickets">
                    <!-- Sub Ticket Content -->
                  </div>
                </div>
              </div>
              <div class="tab-pane fade mt-5" id="custom-content-below-activity" role="tabpanel" aria-labelledby="custom-content-below-activity-tab">
                 <div id="ticketHistory">
                    <!-- Ticket History Content -->
                 </div>
              </div>
            </div>
          </div>`;
          $("#canvasContent").html(canvas)
    }
    // Display Content
    ProjectContent()
    function ProjectContent() {
        var projectId = $('#universalProjectid').val();
        $('#projectCardHeader').removeClass('d-none')
        generateProjectContent(projectId);// project details
        getAllProjectTicket()// All project tickets
        canvasContent()// Canvas
        toolTips()
    }

    
    $(function(){
        $('input.checkbox').on('change', function() {
            var anyCheckboxChecked = $('input.checkbox:checked').length > 0;
            $('#update_button_hide').toggleClass('d-none', !anyCheckboxChecked);
        });
    })
    
    // Calculate project allotment time (client side)
    $(function(){
        const $startDatetime = $('#project_start_date');
        const $endDatetime = $('#project_due_date');
        const $result = $('#result');

        const formatTime = (value) => {
            return value < 10 ? `0${value}` : value;
        }

        const updateResult = () => {
            const startDate = new Date($startDatetime.val());
            const endDate = new Date($endDatetime.val());

            const diffInMs = endDate.getTime() - startDate.getTime();
            const diffInMinutes = diffInMs / (1000 * 60);
            const diffInHours = diffInMs / (1000 * 60 * 60);
            const diffInDays = diffInMs / (1000 * 60 * 60 * 24);
            const diffInWeeks = diffInDays / 7;
            const diffInMonths = diffInDays / 30;

            const months = Math.floor(diffInMonths);
            const weeks = Math.floor(diffInWeeks - months * 4);
            const days = Math.floor(diffInDays - weeks * 7 - months * 30);
            const hours = Math.floor(diffInHours - days * 24 - weeks * 7 * 24 - months * 30 * 24);
            const minutes = Math.floor(diffInMinutes - hours * 60 - days * 24 * 60 - weeks * 7 * 24 * 60 - months * 30 * 24 * 60);

            let result = '';
            if (months > 0) {
            result += `${months} month${months > 1 ? 's' : ''} `;
            } if (weeks > 0) {
            result += `${weeks} week${weeks > 1 ? 's' : ''} `;
            } if (days > 0) {
            result += `${days} day${days > 1 ? 's' : ''} `;
            } if (hours > 0) {
            result += `${hours} hour${hours > 1 ? 's' : ''} `;
            } if (minutes > 0) {
            result += `${minutes} minute${minutes > 1 ? 's' : ''}`;
            }

            $result.val(result.trim() || '0 minutes');
        }

        $startDatetime.on('change', updateResult);
        $endDatetime.on('change', updateResult);
    })

    $('#createProjectForm').on('submit', function(e) {
        e.preventDefault();
        $('#createProjectBtn').prop('disabled', true);
    
        $.post('/project/add-project', $(this).serialize())
            .done(function(res) {
                    Swal.fire({
                        title: res.title,
                        text: res.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        padding: '4em'
                    });
                    ProjectContent();
                    $('#createProjectForm')[0].reset();
                    $('#add-project-modal').modal('hide');
            })
            fail(function(error) {
                console.error('Error:', error);
            });
    });

    $('#assignDeveloperForm').on('submit', function(e) {
        e.preventDefault();
        $('#assignDeveloperBtn').prop('disabled', true).text('Processing ...');
        $.post('/project/assign-developer', $(this).serialize())
            .done(function(res) {
                    Swal.fire({
                        title: res.title,
                        text: res.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        padding: '4em'
                    });
                    ProjectContent()
                    $('#assignDeveloperBtn').prop('disabled', false).text('Create');
                    $('#assignDeveloperForm')[0].reset();
                    $('#assign-developers-modal').modal('hide');
            })
    });

    $('#updateProjectForm').on('submit', function(e) {
        e.preventDefault();
        $('#updateProjectBtn').prop('disabled', true).text('Processing ...');
        $.post('/project/update-project', $(this).serialize())
            .done(function(res) {
                Swal.fire({
                    title: 'Cheers!',
                    text: res.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                    padding: '4em'
                });
                ProjectContent();
                $('#updateProjectBtn').prop('disabled', false).text('Update');
                $('#updateProjectForm')[0].reset();
                $('#edit-project-modal').modal('hide');
            })
            .fail(function(error) {
                console.error('Error:', error);
            });
    });

    $('#assignManagerForm').on('submit', function(e) {
        e.preventDefault();
        $('#assignManagerBtn').prop('disabled', true).text('Processing ...');
        $.post('/project/assign-personel', $(this).serialize())
            .done(function(res) {
                Swal.fire({
                    title: 'Cheers!',
                    text: res.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                    padding: '4em'
                });
                ProjectContent();
                $('#assignManagerBtn').prop('disabled', false).text('Assign');
                $('#assignManagerForm')[0].reset();
                $('#assign-personel-modal').modal('hide');
            })
            .fail(function(error) {
                console.error('Error:', error);
            });
    });

    $('#addCommentForm').on('submit', function(e) {
        e.preventDefault();
        $('#addCommentFormBtn').prop('disabled', true);
    
        $.post('/ticket/add-ticket-comment', $(this).serialize())
            .done(function(res) {
                Swal.fire({
                    title: res.title,
                    text: res.text,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                    padding: '4em'
                });
    
                $('#addCommentForm')[0].reset();
                $('#add-comment-modal').modal('hide');
                $('#addCommentFormBtn').prop('disabled', false);
                getTicketDetails();
            })
            .fail(function() {
                console.error('Error:', error);
            });
    });
    // show comment
    $(document).on('click', '#addCommentFormBtn', function(){
        $('#view-ticket-modal').show()
    })
    // Show modal file
    $(document).on('click', '#attachTicketFileBtn', function(){
        $('#view-ticket-modal').modal('show')
    })

    $('#attachTicketFile').on('submit', function(e) {
        e.preventDefault();
        const fileForm = new FormData(this);
        $('#attachTicketFileBtn').prop('disabled', true);
    
        $.ajax({
            url: '/ticket/attached-files-ticket',
            type: 'post',
            data: fileForm,
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(res) {
                Swal.fire({
                    title: res.title,
                    text: res.text,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                    padding: '4em'
                });
                $('#attachTicketFile')[0].reset();
                $('#add-file-modal').modal('hide');
                $('#attachTicketFileBtn').prop('disabled', false);
                getTicketDetails();
                $('#view-ticket-modal').show();
        })
        .fail(function() {
            console.error('Error:', error);
        });
    });

    getTicketDetails()
    function getTicketDetails() {
        $(document).on('click', '.view-ticket-details', function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            $('#commentTicketId').val(id);
    
            $.get('/ticket/ticket-details/' + id, function(res) {
                let ticket = res.message;
                let labelClass = getLabelClass(ticket.ticket_label);
    
                $('#ticketid').html(ticket.ticketid);
                $('#ticketidval').val(ticket.ticketid);
                $('#ticketDetailsId').val(ticket.ticketid);
                $('#ticket-description').val(ticket.ticket_task_description);
                $('#ticket_title').val(ticket.ticket_title);
                $('#due_date').val(ticket.ticket_due_date);
                $('#ticket-label').html(labelClass);
                $('#ticketComments').html(res.comment);
                $('#ticketDocuments').html(res.file);
    
                $('#ticket_priority').html(
                    `<label class="control-label col-md-12">Priority</label>
                    <select class="select2 custom-form" name="priority" required data-placeholder="Select Priority" data-dropdown-css-class="select2-primary"  style="width: 100%;">
                        <option value="${ticket.ticket_priority_label}">${ticket.ticket_priority_label}</option>
                        <option value="Low">Low</option>
                        <option value="Moderate">Moderate</option>
                        <option value="High">High</option>
                        <option value="Very High">Very High</option>
                    </select>`
                );
    
                $('#ticket_label').html(
                    `<label class="control-label col-md-12">Label</label>
                    <select class="select2 custom-form" name="label" required data-placeholder="Select Priority" data-dropdown-css-class="select2-primary"  style="width: 100%;">
                        <option value="${ticket.ticket_label}">${ticket.ticket_label}</option>
                        <option value="Not Started">Not Started</option>
                        <option value="In Progress">In Progress</option>
                        <option value="On Hold">On Hold</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Completed">Completed</option>
                    </select>`
                );
    
                select2();
            });
        });
    
        function getLabelClass(label) {
            const labelClasses = {
                'Not Started': 'badge bg-light',
                'In Progress': 'badge bg-info',
                'On Hold': 'badge bg-warning',
                'Cancelled': 'badge bg-danger',
                'Completed': 'badge bg-success'
            };
            return `<span class="${labelClasses[label]} d-flex justify-content-center align-self-center">${label}</span>`;
        }
    }
    
    // Move ticket to archivce request
    $(document).on('click', '.ticketArchive', function(){
        let ticketid = $(this).attr('id');
        let projectid = $('#globalProjectid').val();
        let status = 1;
        let action = 'Ticket#' + ticketid + ' was moved to archived';
    
        Swal.fire({
            title: 'Are you sure you want to move this ticket to archive?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            reverseButtons: true,
            confirmButtonText: 'Yes, Move it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('/ticket/manage-ticket', {
                    ticketid: ticketid,
                    projectid: projectid,
                    status: status,
                    action: action
                }).done(function(res) {
                    Swal.fire({
                        title: 'Cheers!',
                        text: 'Ticket successfully moved to archived',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        padding: '4em'
                    });
                ProjectContent()
                }).fail(function() {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Failed to move the ticket to archived',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500,
                        padding: '4em'
                    });
                });
            }
        });
    });

    // Restore ticket
    $(document).on('click', '.restoreTicket', function(){
        let ticketid = $(this).attr('id');
        let projectid = $('#globalProjectid').val();
        let status = 0;
        let action = 'Ticket#' + ticketid + ' has been restored';
    
        Swal.fire({
            title: 'Are you sure you want to restore this ticket?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            reverseButtons: true,
            confirmButtonText: 'Yes, Restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('/ticket/manage-ticket', {
                    ticketid: ticketid,
                    projectid: projectid,
                    status: status,
                    action: action
                }).done(function(res) {
                    Swal.fire({
                        title: 'Cheers!',
                        text: 'Ticket successfully restored',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        padding: '4em'
                    });
                ProjectContent()
                }).fail(function() {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Failed to restore the ticket',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500,
                        padding: '4em'
                    });
                });
            }
        });
    });

    // Manage Project Status
    $(document).on('click', '.manageProjectStatus', function() {
        const projectid = $(this).attr('id');
        const status = $(this).data('id');
        const projectName = $('.projectName' + projectid).attr('id');
        const actionStatus = status === 1 ? ' was moved to archive' : ' successfully restored';
        const title = status === 1 ? 'Are you sure you want to move this project to archive?' : 'Are you sure you want to restore this project?';
        const action = projectName + actionStatus;
    
        Swal.fire({
            title: title,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            reverseButtons: true,
            confirmButtonText: 'Yes, Move it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('/project/manage-status', {
                    projectid,
                    status,
                    action
                }).done(function(res) {
                    Swal.fire({
                        title: 'Cheers!',
                        text: action,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        padding: '4em'
                    });
                    setTimeout(function(){
                        window.location.reload();
                    }, 1400);
                });
            }
        });
    });

    // decline applicant
    $(document).on('click', '.decline_applicant', function(){
        let projectid = $(this).attr('id')
        let applicantid = $(this).data('id')
        $('.applicant_status1').removeClass('btn-danger').addClass('text-danger').text('Rejected')
        $('.applicant_status2').hide()
    })  

    // Hire Applicant
    $(document).on('click', '.accept_applicant', function() {
        const applicantid = $(this).attr('id');
        const applicationid = $(this).data('id');
        const projectid = $('#globalProjectid').val();
        const clientid = $('#globalClientid').val();
    
        $.post('/project/hire-developer', {
            applicantid,
            applicationid,
            projectid,
            clientid
        }).done(function(res) {
            const status2Elements = $('.applicant_status2');
            status2Elements.removeClass('btn-success').addClass('text-success').text('Hired');
            $('.applicant_status1').hide();
    
            Swal.fire({
                title: res.title,
                text: res.message,
                icon: 'success',
                showConfirmButton: false,
                timer: 1100,
                padding: '4em'
            });
            ProjectContent();
        });
    });

    // Remove Assigned Personel
    $(document).on('click', '.remove_assigned', function() {
        const personelid = $(this).attr('id');
        const personeltype = $(this).data('id');
        const personel = $(this).data('text');
        const projectid = $('#globalProjectid').val();
        const clientid = $('#globalClientid').val();
        const applicationid = $('.application_id').val();
        const isProjectManager = personeltype === 2;
    
        let confirmation, text;
        if (isProjectManager) {
            confirmation = 'Are you sure you want to remove these assigned Project Manager(s) from this Project? \nPlease provide remarks or reasons for this decision.';
            text = 'Project Manager(s) removed from this project';
        } else {
            confirmation = `Are you sure you want to remove ${personel} as the Developer from this Project? Please provide remarks or reasons for this decision.`;
            text = `Developer ${personel} removed from this project`;
        }
    
        Swal.fire({
            title: isProjectManager ? 'Removing Assigned Project Manager(s)' : 'Removing Developer',
            text: confirmation,
            input: 'textarea',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            reverseButtons: true,
            confirmButtonText: 'Yes, Remove it!',
            inputValidator: (value) => {
                if (!value || value.length < 20) {
                    return 'Please provide clear remarks/reasons with at least 20 characters.';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const remarks = result.value;
                $.post('/project/remove-assigned', {
                    personelid,
                    activity: text,
                    remarks,
                    clientid,
                    projectid,
                    personeltype
                }).done(function(res) {
                    Swal.fire({
                        title: 'Cheers!',
                        text: text,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1100,
                        padding: '4em'
                    });
                    ProjectContent();
                });
            }
        });
    });

    $(document).on('click', '.approvedTicket', function(e) {
        e.preventDefault();
        const id = $(this).attr('id');
        const projectid = $('#globalProjectid').val();
    
        Swal.fire({
            title: 'Are you sure you want to approve this Ticket?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            reverseButtons: true,
            confirmButtonText: 'Yes, Approve!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('/ticket/approved-ticket', {
                    id,
                    projectid
                }).done(function(res) {
                    Swal.fire({
                        title: 'Cheers!',
                        text: 'Ticket was Approved',
                        icon: 'success',
                        showConfirmButton: false,
                        confirmButtonColor: '#3085d6',
                        timer: 1100,
                        padding: '4em'
                    });
                    ProjectContent();
                });
            }
        });
    });

    function getAllProjectTicket() {
        const id = $('#universalProjectid').val();
        const tableContainer = $('#tabResultDetailAll');
        const ticketTabContent = $('#ticketTabContent');
        const dataTableButtonsContainer = $('#tabResultDetailAll .col-md-6:eq(0)');
    
        $.get(`/project/project-tickets=${id}`)
            .done((res) => {
                ticketTabContent.removeClass('d-none');
                tableContainer.html(res.result);
    
                const table = tableContainer.find('table').DataTable({
                    responsive: true,
                    lengthChange: true,
                    autoWidth: false,
                    info: true,
                    paging: true,
                    dom: '<"top"f>rt<"bottom"<"row dt-margin"<"col-md-6"i><"col-md-6"p><"col-md-12"B>>><"clear">',
                    buttons: ["copy", "csv", "excel", "pdf", "print"]
                });
    
                const dataTableButtons = new $.fn.dataTable.Buttons(table, {
                    buttons: ["copy", "csv", "excel", "pdf", "print"]
                });
    
                dataTableButtons.container().appendTo(dataTableButtonsContainer);
                showOffcanvas();
            })
            .fail((error) => {
                console.error('Error:', error);
            });
    }
    
    // Add Ticket
    $('#addTicketForm').on('submit', function(e) {
        e.preventDefault();
        var bsOverlay = $('.bs-canvas-overlay');
        var elm;
        const $addTicketBtn = $('#addTicketBtn');
        $addTicketBtn.prop('disabled', true);
    
        $.ajax({
            url: '/ticket/add-ticket',
            method: 'POST',
            data: $(this).serialize(),
            cache: false
        })
        .done(function(res) {
            Swal.fire({
                title: 'Cheers!',
                text: 'Ticket Successfully Added',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
                padding: '4em'
            });
            ProjectContent();
            $addTicketBtn.prop('disabled', false);
            $('#addTicketForm')[0].reset();
            $('#add-ticket-modal').modal('hide');
        })
        .fail(function(error) {
            console.error('Error:', error);
            Swal.fire({
                title: 'Oops!',
                text: 'Something went wrong! Please try again later.',
                icon: 'error',
                showConfirmButton: true,
                confirmButtonText: 'Okay',
                confirmButtonColor: '#007bff'
            });
            $addTicketBtn.prop('disabled', false);
        });
        setTimeout(function() {
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
        }, 1000);
    });
    
     // update ticket request
     $('#updateTicketForm').on('submit', function(e) {
        e.preventDefault();
        $('#updateTicketDetailsBtn').prop('disabled', true).text('Processing ...');
        $.post({
            url: '/ticket/update-ticket',
            data: $(this).serialize(),
            success: function(res) {
                Swal.fire({
                    title: 'Cheers!',
                    text: res.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                    padding: '4em'
                });
                ProjectContent();
                $('#updateTicketDetailsBtn').prop('disabled', false).text('Update');
                $('#updateTicketForm')[0].reset();
                $('#view-ticket-modal').modal('hide');
            }
        })
    });
    
})