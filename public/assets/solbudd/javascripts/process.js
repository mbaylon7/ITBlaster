$(function () {
    "use strict";

    var url = "process/controller_functions.php";

    $('#ajax-contact').on('submit', function (e) {
        e.preventDefault()
        const formData = new FormData(this);
        formData.append('send_message', 'send_message');
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (response)
            {
                $('#ajax-contact')[0].reset();
                var parsedResponse = JSON.parse(response);
                Swal.fire({
                    icon: parsedResponse.success ? "success" : "info",
                    confirmButtonColor: "#025add",
                    confirmButtonText: "Okay, got it!",
                    text: parsedResponse.message,
                    showConfirmButton: true,
                });
            }
        });
    })

    $('#subscribe').on('submit', function(e) {
        e.preventDefault()
        const formData = new FormData(this)
        formData.append('add_subscriber', 'add_subscriber');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                $('#subscribe')[0].reset();
                var parsedResponse = JSON.parse(response);
                Swal.fire({
                    icon: parsedResponse.success ? "success" : "info",
                    confirmButtonColor: "#025add",
                    confirmButtonText: "Okay, got it!",
                    text: parsedResponse.message,
                    showConfirmButton: true,
                });
            }
        })
    })
})