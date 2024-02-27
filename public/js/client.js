$(document).ready(function(){
    function toolTips(){
        $('[data-toggle="tooltip"]').tooltip()
    }

    allClientFile();
    function allClientFile(){
        $.ajax({
            url: '/client/files',
            method: 'get',
            success:function(res){
                $('#allClientFiles').html(res);
                $('#allClientFilesModal').html(res);
                toolTips()
            }
        })
    }

    allClientProduct();
    function allClientProduct(){
        $.ajax({
            url: '/client/products',
            method: 'get',
            success:function(res){
                $('#allClientProducts').html(res);
                $('#allClientProductsModal').html(res);
                toolTips()
            }
        })
    }

    allClientContact();
    function allClientContact(){
        $.ajax({
            url: '/client/contacts',
            method: 'get',
            success:function(res){
                $('#allClientContacts').html(res);
                $('#allClientContactsModal').html(res);
                toolTips()
            }
        })
    }

    $('#uploadClientFileForm').on('submit', function(e){
        e.preventDefault()
        const uploadClientFile = new FormData(this)
        $('#uploadClientFileBtn').attr('disabled', true)
        $.ajax({
            url: '/client/add-files',
            type: 'POST',
            cache: false,
            contentType:false,
            processData:false,
            data: uploadClientFile,
            success:function(res){
                $('#uploadClientFileBtn').attr('disabled', false)
                $('#clientFileModal').modal('hide')
                $('#uploadClientFileForm')[0].reset()
                allClientFile()
            }
        })
    })

    $('#clientProductServicesForm').on('submit', function(e){
        e.preventDefault()
        const uploadClientFile = new FormData(this)
        $('#clientProductServicesBtn').attr('disabled', true)
        $.ajax({
            url: '/client/add-products-services',
            type: 'POST',
            cache: false,
            contentType:false,
            processData:false,
            data: uploadClientFile,
            success:function(res){
                $('#clientProductServicesBtn').attr('disabled', false)
                $('#clientProductServicesModal').modal('hide')
                $('#clientProductServicesForm')[0].reset()
                allClientProduct()
            }
        })
    })

    $('#contactForm').on('submit', function(e){
        e.preventDefault()
        const uploadClientFile = new FormData(this)
        $('#contactBtn').attr('disabled', true)
        $.ajax({
            url: '/client/add-contact',
            type: 'POST',
            cache: false,
            contentType:false,
            processData:false,
            data: uploadClientFile,
            success:function(res){
                $('#contactBtn').attr('disabled', false)
                $('#clientContactModal').modal('hide')
                $('#contactForm')[0].reset()
                allClientContact()
            }
        })
    })

    $('#clientBasicInfoForm').on('submit', function(e){
        e.preventDefault()
        const updeteInfo = new FormData(this)
        $('#clientBasicInfoBtn').attr('disabled', true)
        $.ajax({
            url: '/client/update-client',
            type: 'POST',
            cache: false,
            contentType:false,
            processData:false,
            data: updeteInfo,
            success:function(res){
                $('#clientBasicInfoBtn').attr('disabled', false)
                $('#clientEditProfileModal').modal('hide')
                $('#clientBasicInfoForm')[0].reset()
                window.location.reload();
            }
        });
    })

    $('#companyIntroductionForm').on('submit', function(e){
        e.preventDefault()
        const updeteInfo = new FormData(this)
        $('#companyIntroductionBtn').attr('disabled', true)
        $.ajax({
            url: '/client/update-introduction',
            type: 'POST',
            cache: false,
            contentType:false,
            processData:false,
            data: updeteInfo,
            success:function(res){
                $('#companyIntroductionBtn').attr('disabled', false)
                $('#clientIntroductionModal').modal('hide')
                $('#companyIntroductionForm')[0].reset()
                window.location.reload();
            }
        });
    })

    $(document).on('click', '.removeClientFiles', function(e){
        let id = $(this).data('id');
        let status = $(this).attr('id');
        console.log(id);
        console.log(status);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Remove it!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/client/remove-files',
                    type: 'POST',
                    data: {id: id, status:status},
                    success: function(res){
                        allClientFile();
                    }
                })
              }
        })
    })

    $(document).on('click', '.removeClientContact', function(e){
        let id = $(this).data('id');
        let status = $(this).attr('id');
        console.log(id);
        console.log(status);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Remove it!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/client/remove-contact',
                    type: 'POST',
                    data: {id: id, status:status},
                    success: function(res){
                        allClientContact();
                    }
                })
              }
        })
    })

    $(document).on('click', '.removeClientProduct', function(e){
        let id = $(this).data('id');
        let status = $(this).attr('id');
        console.log(id);
        console.log(status);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Remove it!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/client/remove-product',
                    type: 'POST',
                    data: {id: id, status:status},
                    success: function(res){
                        allClientProduct();
                    }
                })
            }
        })
    })

     // Append new File Row Field
     $('#addNewProductServicesRow').on('click', function(){
        var html = ' <div id="inputFormRowProductServices" class="d-flex gap-2">\
        <a id="removeRowProductServices" class="mt-3" style="cursor:pointer; font-size:16px; margin-top: 25px!important; margin-right: 10px!important">\
            <i class="bi bi-x-circle-fill text-danger"></i>\
        </a>\
        <input type="text" name="product_services[]" class="custom-form mt-3">\
        </div>';
        $('#newProductServiceRow').append(html);
    })
    // Removed Appended File Row Field 
    $(document).on('click', '#removeRowProductServices', function () {
        $(this).closest('#inputFormRowProductServices').remove();
    });
    
    // Append new File Row Field
    $('#addNewFileRow').on('click', function(){
        var html = ' <div id="inputFormRowFile" class="d-flex gap-2">\
        <a id="removeRowFile" class="mt-3" style="cursor:pointer; font-size:16px; margin-top: 25px!important; margin-right: 10px!important">\
            <i class="bi bi-x-circle-fill text-danger"></i>\
        </a>\
        <input type="file" name="files[]" class="custom-form mt-3">\
        </div>';
        $('#newFileRow').append(html);
    })
    // Removed Appended File Row Field 
    $(document).on('click', '#removeRowFile', function () {
        $(this).closest('#inputFormRowFile').remove();
    });


    $('#addNewContactRow').on('click', function(){
        var html = ' <div id="inputFormRowContact">\
        <a id="removeRowContact" class="mt-3 d-flex justify-content-center text-decoration-none" style="cursor:pointer; font-size:16px; margin-top: 25px!important; margin-right: 10px!important">\
            <i class="bi bi-x-circle-fill text-danger"></i> &nbsp; Remove\
        </a>\
        <input type="text" name="contact_name[]" class="custom-form mt-3" placeholder="Name">\
        <input type="text" name="contact_no[]" class="custom-form mt-3" placeholder="Contact no.">\
        <input type="text" name="contact_position[]" class="custom-form mt-3" placeholder="Position">\
        </div>';

        $('#newContactRow').append(html);
    })
    // Removed Appended Contact Row Field 
    $(document).on('click', '#removeRowContact', function () {
        $(this).closest('#inputFormRowContact').remove()
    })

})