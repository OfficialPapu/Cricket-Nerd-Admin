$(document).ready(function () {
    const urlpost = "Assets/PHP/API/POST/Videos.php";
    $('#uploadForm').submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: urlpost,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response === "Success") {
                    $('#uploadForm')[0].reset();
                    butterup.toast({
                        message: 'Video successfully uploaded',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else {
                    butterup.toast({
                        message: 'Failed to upload video',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            },
        });
    });
});