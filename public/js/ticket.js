$(document).ready(function(){
    // Calculate Allotment time
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

    function select2() {
        $('.select2').select2({})
    }

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

    
    $('#is_clicked').on('click', function(e){
        e.preventDefault();

        $('#ApproveTicket').submit();
            // Get the selected checkboxes
        var selectedTickets = [];
        $('input[name="approval_tickets[]"]:checked').each(function() {
            selectedTickets.push($(this).val());
        });
    
        // Make the AJAX request
        $.ajax({
            url: 'ticket/batch-approve-tickets',
            method: 'POST',
            data: { approval_tickets: selectedTickets },
            success: function(response) {
            Swal.fire({
                title: 'Cheers!',
                text: 'Ticket successfully moved to archived',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500,
                padding: '4em'
            })
            },
            error: function(xhr, status, error) {
            Swal.fire({
                title: 'Opps!',
                text: 'Unable to approve ticket',
                icon: 'error',
                showConfirmButton: false,
                timer: 1500,
                padding: '4em'
            })
            }
        });
    })

    function checkAll() {
        $('input.checkbox').click(function() {
            var anyCheckboxChecked = $('input.checkbox:checked').length > 0;
            if (anyCheckboxChecked) {
              $('#update_button_hide').removeClass('d-none');
            } else {
              $('#update_button_hide').addClass('d-none');
            }
          });
    }

    $('.is_click').on('click', function(e){
        Swal.fire({
            title: 'Are you sure you want to approve all selected tickets?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            reverseButtons: true,
            confirmButtonText: 'Yes, Approve it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.post({
                    url: '/ticket/manage-ticket',
                    data: {
                        ticketid: ticketid,
                        projectid: projectid,
                        status: status,
                        action: action
                    },
                    success:function(res) {
                        Swal.fire({
                            title: 'Cheers!',
                            text: 'Ticket successfully moved to archived',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                            padding: '4em'
                        })
                        setTimeout(function(){
                            window.location.reload();
                         }, 1400);
                    }
                })
            }
        })
    })
  
    $(document).on('click', '.applyBtn', function(e){
        let id = $(this).attr('id')

        $(document).on('submit', '#applyForm'+id, function(e) {
            e.preventDefault()
            let ticketid = $('#project_id'+id).val()
            let itid = $('#itid'+id).val()
            var is_verified = $('#is_verified'+id).val()
            if(is_verified == 'No') {
                Swal.fire({
                    icon: 'info',
                    title: "You're still not verified yet!",
                    text: 'It seems your profile is not complete or not evaluated yet. If you already completed your profile kindly wait for the meantime we will still evaluate your profile details to proceed in the interview phase. Thank you!',
                  })
            } else {
                $.post({
                    url: '/ticket/apply',
                    data: $(this).serialize(),
                    success: function(res) {
                        if(res.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: res.title,
                                text: res.text,
                              })
                            $('#applyForm'+id).hide();
                            $('#applied'+id).html('<span class="text-success">Applied</span>');
                        }
                    }
                })
            }
        })
    })

    $('#createAssignProject').on('submit', function(e){
        e.preventDefault()
        $('#createAssignProjectBtn').text('Adding ...').attr('disabled', true).addClass('bg-light')
    });

    $('#updateTicketDetails').on('submit', function(e){
        e.preventDefault()
        $('#updateTicketDetailsBtn').text('Updating...').attr('disabled', true).addClass('bg-light')

        $.post({
            url: '/ticket/update-ticket',
            data: $(this).serialize(),
            success:function(res) {
                Swal.fire({
                    title: 'Cheers!',
                    text: res.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                    padding: '4em'
                })
            }
        })
    })
    
    $(document).on('click', '.addSubTask', function(){
        var ticketid = $(this).attr('id');
        $('#parentid').val(ticketid);
    })
    
    $(document).on('click', '.addGrandChildTicket', function(){
        let parentid = $(this).attr('id');
        let childid = $(this).attr('data-id');
        $('#parentid').val(parentid);
        $('#childid').val(childid);
    })

    $('.activityTab').on('click', function(e){
        e.preventDefault()
        let subTicketId = $('#universalTicketId').val();
        $.ajax({
            method: 'GET',
            url: '/ticket/get-ticket-history/'+subTicketId,
            success: function(res) {
                if(res.activity === '') {
                    $('#ticketHistory').html('<table class="table table-bordered" id="dataTableFull1">\
                    <thead>\
                    <tr>\
                        <th></th>\
                        <th>Personel</th>\
                        <th>Action</th>\
                        <th>Timestamp</th>\
                    </tr>\
                    </thead>\
                    <tbody>\
                    <td colspan="4" class="text-center"><i class="bi bi-exclamation-circle text-warning"></i> &nbsp;No History</td>\
                    </tbody>\
                        </table>');
                } else {
                    $('#ticketHistory').html(res.activity);
                }
            }
        })
    })

    function initializeDataTable(selector) {
        return $(selector).DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            language: {
                aria: {
                    sortAscending: ": activate to sort column ascending",
                    sortDescending: ": activate to sort column descending"
                },
                emptyTable: "No data available in table",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "No entries found",
                infoFiltered: "(filtered1 from _MAX_ total entries)",
                lengthMenu: "_MENU_ entries",
                search: "Search:",
                zeroRecords: "No matching records found"
            },
            buttons: [
                { extend: 'print', className: 'btn default' },
                { extend: 'pdf', className: 'btn red' },
                { extend: 'csv', className: 'btn green' }
            ],
            order: [
                [1, 'desc']
            ],
            lengthMenu: [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"]
            ],
            pageLength: 10,
            dom: "<'row'<'col-md-12 d-flex justify-content-end'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    }

    initializeDataTable('.allTicketActive');
    
    $(document).on('click', '.filterTicketOwned', function(){
        var isChecked = $(this).prop('checked');
        if(isChecked == true) {
            var devid = $(this).data('id')
            if ($.fn.DataTable.isDataTable('#dataTable_1')) {
                $('#dataTable_1').DataTable().destroy();
                $('#dataTable_1').addClass('d-none');
            }
            if ($.fn.DataTable.isDataTable('#dataTable_2')) {
                $('#dataTable_2').DataTable().destroy();
                $('#dataTable_2').addClass('d-none');
            }
            $.get({
                url: 'ticket/filter-open-tickets',
                data: {
                    devid: devid
                },
                success: function(response) {
                    $('#dataTable_1 tbody').html(response.result)
                    initializeDataTable('#dataTable_1');
                    $('#site_activities_loading, #spinner-text').addClass('d-none');
                    $('#search, #dataTable_1, #filter-side').removeClass('d-none');
                }
            })
        }
    });
    
    $('.filterTicketOwned').on('change', function() {
        $('.filterTicketOwned').not(this).prop('checked', false);
    });

    loadOpenTickets()
    function loadOpenTickets() {
        if ($.fn.DataTable.isDataTable('#dataTable_1')) {
            $('#dataTable_1').DataTable().destroy();
            $('#dataTable_1').addClass('d-none');
        }
        if ($.fn.DataTable.isDataTable('#dataTable_2')) {
            $('#dataTable_2').DataTable().destroy();
            $('#dataTable_2').addClass('d-none');
        }
        $.get({
            url: 'ticket/all-open-tickets',
            success: function(response) {
                $('#dataTable_2 tbody').html(response.result)
                $('#dataTable_2').removeClass('d-none');
                initializeDataTable('#dataTable_2');
                $('#site_activities_loading, #spinner-text').addClass('d-none');
            }
        })
    }

    loadAllProjects()
    function loadAllProjects() {
        if ($.fn.DataTable.isDataTable('#dataTable_1')) {
            $('#dataTable_1').DataTable().destroy();
            $('#dataTable_1').addClass('d-none');
        }
        if ($.fn.DataTable.isDataTable('#dataTable_2')) {
            $('#dataTable_2').DataTable().destroy();
            $('#dataTable_2').addClass('d-none');
        }
        if ($.fn.DataTable.isDataTable('#dataTable_3')) {
            $('#dataTable_3').DataTable().destroy();
            $('#dataTable_3').addClass('d-none');
        }
        $.get({
            url: 'ticket/all-projects-pm',
            success: function(response) {
                $('#dataTable_3 tbody').html(response.result)
                $('#dataTable_3').removeClass('d-none');
                initializeDataTable('#dataTable_3');
                $('#site_activities_loading, #spinner-text').addClass('d-none');
            }
        })
    }

    $(document).on('click', '.displayProject', function() {
        var isChecked = $(this).is(':checked');
        var id = $(this).val()
        if(isChecked) {
            var value = 'Yes'
        } else {
            var value = 'No'
        }
        $.ajax({
            url: '/ticket/show-hide-project/'+id,
            type: 'POST',
            data: {
                id : id,
                value : value
            } ,
            success: function(response) {
                Swal.fire({
                    title: 'Cheers!',
                    text: response.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                    padding: '4em'
                })
            }
        })
    })

    $(document).on('click', '#customCheckbox0', function(){
        var isChecked = $(this).prop('checked');
        if(isChecked == true) {
            loadOpenTickets()
        }
    })
})