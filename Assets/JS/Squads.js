      $(document).ready(function() {
            // When a match is selected
            $("#match").on("change", function() {
                var selectedOption = $(this).find(":selected");
                var countryA = selectedOption.data("country-a");
                var countryB = selectedOption.data("country-b");

                // Populate the country dropdown
                $("#country").html('<option value="" disabled selected class="text-gray-500">Select a country</option>'); // Reset options
                $("#country").append('<option value="' + countryA + '" class="text-black">' + countryA + '</option>');
                $("#country").append('<option value="' + countryB + '" class="text-black">' + countryB + '</option>');
            });

            $("#squadForm").on("submit", function(e) {
                e.preventDefault();
               const formData = $(this).serialize() + "&AddSqads=true";

                $.ajax({
                    url: "Assets/PHP/API/POST/Scoreboard.php",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        if (response) {
                            
                            $("#message").text(response).addClass("text-green-500");
                            $("#squadForm")[0].reset();
                        } else {
                            $("#message").text(response).addClass("text-red-500");
                        }
                    },
                    error: function() {
                        $("#message").text("An error occurred. Please try again.").addClass("text-red-500");
                    },
                });
            });
        });