$(document).ready(function () {
    $('#btn').click(function (e) {
        
        e.preventDefault();
        let Email = $('#email').val();
        let Pass = $('#Pass').val();
        $.ajax({
            type: "POST",
            url: "../PHP/API/Config/Login.php",
            data: {
                LoginAdmin: true,
                Email: Email,
                Pass: Pass,
            },
            success: function (response) {
                response=response.trim();
                console.log(response);
                if (response == 'Success') {
                    butterup.toast({
                        message: 'Login Succesful',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                    setTimeout(()=>{
                    window.location = '/';
                    },500)
                } else {
                    butterup.toast({
                        message: 'Invalid Credentials',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            }
        });
    });
});