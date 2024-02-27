$(function() {
    $('#card_service_provider').prop('class', 'd-none');

    $('#btn_it_professionals').click(function(){
        $('#card_it_professionals').prop('class', 'd-block');
        $('#card_service_provider').prop('class', 'd-none');
    });

    $('#btn_service_provider').click(function(){
        $('#card_it_professionals').prop('class', 'd-none');
        $('#card_service_provider').prop('class', 'd-block');
    });

    /* Start: MODAL */
    $('.modal-xlg').on('hidden.bs.modal', function () {
        location.reload();
    });

    // DELETE rowWrapper class
    $('.btn_delete_row').on('click', function() {
        $('#modal_confirm_delete #idx').val($(this).data('idx'));
        $('#modal_confirm_delete #filename').val($(this).data('filename'));
        $('#modal_confirm_delete #page_id').val($(this).data('page'));
        $('#modal_confirm_delete #section_id').val($(this).data('section'));
        $('#modal_confirm_delete').modal('show');
    });

    $('#modal_confirm_delete').on('show.bs.modal', function() {
        $('.btn-ok').click(function(e) {
            e.preventDefault();

            let page = $('#page_id').val();
            let section = $('#section_id').val();
            let filename = $('#filename').val();
            let idx = $('#idx').val();

            switch(page) {
                case 'profile':
                    url = `/user/profile/delete/${section}`
                    break;
                default:
                    break;
            }

            var data = `filename=${filename}`;

            $.ajax({
                type: "POST",
                url : url,
                data: data,
                success: function(data) {
                    $('#modal_confirm_delete').modal('hide');
                    filename = filename.replace(" ","_").replace("|", "-");
                    $(`#${idx}${filename}`).remove();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Internal error: ' + jqXHR.responseText);
                }
            });
        });
    });
    /* End: MODAL */

});

// Marvin's script starts here
$(function(){
    $('#search-input').on('keyup', function(e){
        e.preventDefault();
        if($('#search-input').val() != ''){
            $('#search-icon').removeClass('bi-search').addClass('bi-x')
        }else{
            $('#search-icon').addClass('bi-search').removeClass('bi-x')
        }
    })
    if($('#search-input').val() != ''){
        $('#search-icon').removeClass('bi-search').addClass('bi-x')
    }
    $('.bi-search').click(function(){
        $('#search-input').val('')
        $('#search-icon').addClass('bi-search').removeClass('bi-x')
    })     
        
})

$(function(){
    $('#search-input').on('input', function() {
        var keyword = $(this).val().toLowerCase();
        $('#search-div').children().filter(function() {
            return $(this).text().toLowerCase().indexOf(keyword) > -1;
        }).addClass('highlight').show();
        $('#search-div').children().filter(function() {
            return $(this).text().toLowerCase().indexOf(keyword) === -1;
        }).removeClass('highlight').hide();
    });
})