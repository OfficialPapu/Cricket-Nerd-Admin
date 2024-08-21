$(document).ready(function () {
    $('#playerForm').submit(function (e) {
        const urlpost = "Assets/PHP/API/POST/New Country.php";
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: urlpost,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if (response === "Success") {
                    $('#playerForm')[0].reset();
                    butterup.toast({
                        message: 'Country successfully uploaded',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                }
            },
            error: function () {
                toastr.error('Something went wrong!', {
                    "closeButton": true,
                    "progressBar": true,
                    "timeOut": "2000",
                    "positionClass": "toast-top-right"
                });
            }
        });
    });
});