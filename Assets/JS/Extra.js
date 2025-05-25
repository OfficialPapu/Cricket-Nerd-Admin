$(document).ready(function () {
    // When a match is selected
    $("#match").on("change", function () {
        var selectedOption = $(this).find(":selected");
        var countryA = selectedOption.data("country-a");
        var countryB = selectedOption.data("country-b");

        // Populate the country dropdown
        $("#country").html('<option value="" disabled selected class="text-gray-500">Select a country</option>');
        $("#country").append('<option value="' + countryA + '" class="text-black">' + countryA + '</option>');
        $("#country").append('<option value="' + countryB + '" class="text-black">' + countryB + '</option>');
    });

    // 🔥 NEW: When a country is selected
    $("#country").on("change", function () {
        const matchID = $("#match").val();
        const country = $(this).val();

        if (matchID && country) {
            $.ajax({
                url: 'Assets/PHP/Configuration/FetchingExtrasData.php',
                type: "POST",
                dataType: 'json',
                data: {
                    match: matchID,
                    country: country
                },
                success: function (response) {
        if (response.status === 'success' && response.data.length > 0) {
          const data = response.data[0];

          $('#inning').val(data['Inning'] || 0);
          $('#byes').val(data['Byes'] || 0);
          $('#leg-byes').val(data['Leg Byes'] || 0);
          $('#wides').val(data['Wides'] || 0);
          $('#no-balls').val(data['No Balls'] || 0);
          $('#penalty-runs').val(data['Penalty Runs'] || 0);
          $('#total-extras').val(data['Total Extras'] || 0);
        } else {
          $('#inning, #byes, #leg-byes, #wides, #no-balls, #penalty-runs, #total-extras').val(0);
        }
                },
                error: function () {
                    console.error("Error fetching data.");
                }
            });
        }
    });

    // Submit form
    $("#squadForm").on("submit", function (e) {
        e.preventDefault();
        const formData = $(this).serialize() + "&AddExtra=true";

        $.ajax({
            url: "Assets/PHP/API/POST/Scoreboard.php",
            type: "POST",
            data: formData,
            success: function (response) {
                if (response) {
                    $("#message").text(response).addClass("text-green-500");
                    $("#squadForm")[0].reset();
                } else {
                    $("#message").text("Something went wrong").addClass("text-red-500");
                }
            },
            error: function () {
                $("#message").text("An error occurred. Please try again.").addClass("text-red-500");
            },
        });
    });
});
