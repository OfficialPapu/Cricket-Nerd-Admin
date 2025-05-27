const urlget = "Assets/PHP/API/GET/Statistics.php";
const urlpost = "Update Players Action/Statistics.php";
$(document).ready(function () {
    let PlayerID = $("#uploadForm").data('playerid');
    $('#submitBtn').click(function (e) {
        e.preventDefault();
        let formData = new FormData($('#uploadForm')[0]);
        formData.append("Statistics", true);
        formData.append("PlayerID", PlayerID);
        $.ajax({
            url: urlpost,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response === "Success") {
                    $('#uploadForm')[0].reset();
                    $('#selectedPlayer').text('Select a Player');
                    $('#selectedPlayerImage').attr('src', 'https://generated.vusercontent.net/placeholder.svg');
                    butterup.toast({
                        message: 'Updated successfully.',
                        icon: true,
                        dismissable: true,
                        type: 'success',
                    });
                } else if (response === "DataMissing") {
                    butterup.toast({
                        message: 'All Field is Required!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                } else {
                    butterup.toast({
                        message: 'Something went wrong!',
                        icon: true,
                        dismissable: true,
                        type: 'error',
                    });
                }
            },
        });
    });


    $('#format').change(function () {
        const selectedFormat = $(this).val();
        if (selectedFormat) {
            $.ajax({
                url: urlget,
                type: 'GET',
                data: { UpdateFetchData: true, format: selectedFormat, PlayerID: PlayerID },
                success: function (response) {
                    response = JSON.parse(response);
                    if (response['message'] == "Success") {
                        response = response.data;
                        $('#matches').val(response[0]["Total Matches"]);
                        $('#runs').val(response[0]["Run Scored"]);
                        $('#battinginnings').val(response[0]["Batting Innings"]);
                        $('#bowlinginnings').val(response[0]["Bowlings Innings"]);
                        $('#strikeRate').val(response[0]["Strike Rate"]);
                        $('#highestScore').val(response[0]["Highest Score"]);
                        $('#halfCenturies').val(response[0]["Half Centuries"]);
                        $('#centuries').val(response[0]["Centuries"]);
                        $('#average').val(response[0]["Batting Average"]);
                        $('#economy').val(response[0]["Bowling Economy"]);
                        $('#bestbowling').val(response[0]["Best Bowlings"]);
                        $('#wickets').val(response[0]["Wickets Taken"]);
                    } else {
                        $('#matches').val("");
                        $('#runs').val("");
                        $('#battinginnings').val("");
                        $('#bowlinginnings').val("");
                        $('#strikeRate').val("");
                        $('#highestScore').val("");
                        $('#halfCenturies').val("");
                        $('#centuries').val("");
                        $('#average').val("");
                        $('#economy').val("");
                        $('#bestbowling').val("");
                        $('#wickets').val("");
                    }
                }
            });
        }
    });

});
