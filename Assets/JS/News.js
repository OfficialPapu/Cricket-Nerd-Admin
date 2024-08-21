$(document).ready(function () {
    const urlpost = "Assets/PHP/API/POST/News.php";
    $('#newsForm').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: urlpost,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response === "Success") {
                    $('#newsForm')[0].reset();
                    butterup.toast({
                        message: 'News successfully uploaded',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else if (response == "Image not selected") {
                    butterup.toast({
                        message: 'Image not selected',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                } else {
                    butterup.toast({
                        message: 'Failed to upload news',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            },
        });
    });
});
