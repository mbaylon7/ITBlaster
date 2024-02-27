$(document).ready(function() {
    function toolTips(){
        $('[data-toggle="tooltip"]').tooltip()
    }
    
    getPercentage()
    function getPercentage(){
        $.ajax({
            url: '/it/completion-indicator',
            type: 'GET',
            success: function(res){
                $('#percentage').html(res);
                $('#percentage2').html(res);
                toolTips()
            }
        })
    }
    // EDIT PROFILE (ALL INFO)
    $('#updateiTProfileForm').on('submit', function(e){
        e.preventDefault();
        $('#updateiTProfileBtn').attr('disabled', true)
        const updateItProfile = new FormData(this)
        $.ajax({
            url: '/it/update-profile',
            type: 'POST',
            data: updateItProfile,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res){
                window.location.reload()
            }
        })
    })

    $('#updateIntroductionForm').on('submit', function(e){
        e.preventDefault();
        $('#updateIntroductionBtn').attr('disabled', true)
        const updateIntroduction = new FormData(this)
        $.ajax({
            url: '/it/update-it-introduction',
            type: 'POST',
            data: updateIntroduction,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res){
                window.location.reload()
            }
        })
    })

    // SKILLS
    $('#insertItSkillsForm').on('submit', function(e){
        e.preventDefault()
        $('#insertItSkillsBtn').attr('disabled', true)
        const addSkills = new FormData(this)
        $.ajax({
            url: '/it/add-skills',
            type: 'POST',
            data:  addSkills,
            cache:false,
            processData: false,
            contentType: false,
            success:function(res){
                allItSkills()
                getPercentage()
                $('#skill-modal').modal('hide')
                $('#insertItSkillsForm')[0].reset()
                $('#insertItSkillsBtn').attr('disabled', false)
                $('.select2').select2()
                $(".select2").select2("val", "");
            }
        });
    })

    $(document).on('click', '.removeSkillsListed', function(e){
        e.preventDefault()
        let id = $(this).attr('id');
        var status = $(this).data('id');

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
                    url: '/it/remove-skills',
                    type: 'POST',
                    data: {id: id, status:status},
                    dataType: 'json',
                    success: function(res){
                        allItSkills()
                        getPercentage()
                    }
                })
            }
        })
    })

    allItSkills()
    function allItSkills(){
        $.ajax({
            url: '/it/skills',
            type: 'GET',
            success: function(res){
                $('#itSkills').html(res);
                $('#itSkillsModal').html(res);
                toolTips()
            }
        })
    }

    // FILE UPLOAD
    $('#btnRowAddFileUpload').on('click', function() {
        let row = '<div class="row custom-input-margintop-5 mb-2 mt-2">' +
                    '<div class="col-md-12">' +
                        '<input type="file" name="files[]" multiple="" class="custom-form">' +
                    '</div>' +
                  '</div>';

        $('.group-file-upload').append(row);
    });

    $('#btnSaveFile').click(function(e){
        e.preventDefault();

        let formData = new FormData(document.getElementById("form_add_file"));

        $.ajax({
            type: "POST",
            url: `/file/upload`,
            data: formData,
            success: function(data) {
                $('#file-modal').modal('hide');
                allItFiles()
                getPercentage()
                toolTips()
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $(document).on('click', '.removeFileUploadedListed', function(e){
        e.preventDefault()
        let id = $(this).attr('id');
        var status = $(this).data('id');

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
                    url: '/it/remove-files',
                    type: 'POST',
                    data: {id: id, status:status},
                    success: function(res){
                        allItFiles()
                        getPercentage()
                    }
                })
            }
        })
    })

    allItFiles()
    function allItFiles(){
        $.ajax({
            url: '/it/files',
            type: 'GET',
            success: function(res){
                $('#itFilesUploaded').html(res);
                $('#itFilesUploadedModal').html(res);
                toolTips()
            }
        })
    }

    // EDUCATION
    $('#btnRowAddEducation').on('click', function() {
        let row = '<div class="row custom-input-margintop-5 education-form-container mb-2 mt-2">' +
                        '<div class="col-md-8">' +
                            '<input type="text" name="user_profile_edu_school[]" value="" class="custom-form" placeholder="School/University">' +
                        '</div>' +
                        '<div class="col-md-4">' +
                            '<input type="text" name="user_profile_edu_school_yr[]" value="" class="custom-form custom-margintop-2" placeholder="Year attended">' +
                        '</div>' +
                  '</div>';

        $('.group-education').append(row);
    });

    $('#insertEducationForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url : '/it/educationalbackground',
            data:$(this).serialize(),
            success: function(data) {
                $('#education-modal').modal('hide');
                allItEducation()
                getPercentage()
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    });

    $(document).on('click', '.removeEducationListed', function(e){
        e.preventDefault()
        let id = $(this).attr('id');
        var status = $(this).data('id');

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
                    url: '/it/remove-educations',
                    type: 'POST',
                    data: {id: id, status:status},
                    success: function(res){
                        allItEducation()
                        getPercentage()
                    }
                })
            }
        })
    })

    allItEducation()
    function allItEducation(){
        $.ajax({
            url: '/it/educations',
            type: 'GET',
            success: function(res){
                $('#itEducation').html(res);
                $('#itEducationModal').html(res);
                toolTips()
            }
        })
    }

    // EXPERIENCE
    $('#btnRowAddWorkExperience').on('click', function() {
        let row = '<div class="row custom-input-margintop-5 education-form-container mt-2 mb-2">' +
                        '<div class="col-md-6 col-sm-6">' +
                            '<input type="text" name="user_profile_xp_company[]" value="" class="custom-form" placeholder="Company name">' +
                        '</div>' +
                        '<div class="col-md-3 col-sm-3">' +
                            '<input type="text" name="user_profile_xp_role[]" value="" class="custom-form custom-margintop-2" placeholder="Job role">' +
                        '</div>' +
                        '<div class="col-md-3 col-sm-2">' +
                            '<input type="text" name="user_profile_xp_year[]" value="" class="custom-form custom-margintop-2" placeholder="Year">' +
                        '</div>' +
                  '</div>';

        $('.group-work-experience').append(row);
    });

    $('#insertWorkExpForm').on('submit', function(e){
        e.preventDefault();
        const addExperience = new FormData(this) 
        $.ajax({
            type: "POST",
            url : '/it/workexperience',
            data: addExperience,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                allItWorkExperience();
                getPercentage()
                $('#experience-modal').modal('hide')
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
    });

    $(document).on('click', '.removeWorkExperienceListed', function(e){
        e.preventDefault()
        let id = $(this).attr('id');
        var status = $(this).data('id');
        
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
                    url: '/it/remove-works',
                    type: 'POST',
                    data: {id: id, status:status},
                    success: function(res){
                        allItWorkExperience()
                        getPercentage()
                    }
                })
            }
        })
    })

    allItWorkExperience()
    function allItWorkExperience(){
        $.ajax({
            url: '/it/experiences',
            type: 'GET',
            success: function(res){
                $('#itExperience').html(res);
                $('#itExperienceModal').html(res);
                toolTips()
            }
        })
    }

});
