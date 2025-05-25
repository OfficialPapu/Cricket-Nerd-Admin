      $(document).ready(function() {
 
            $("#squadForm").on("submit", function(e) {
                e.preventDefault();
                const formData = $(this).serialize() + "&AddBatting=true";

                $.ajax({
                    url: "Assets/PHP/API/POST/Scoreboard.php",
                    type: "POST",
                    data: formData,
                    success: function(response) {
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
            
            
            
    $('#team').on('change', function () {
      let selectedId = $(this).val(); 

      $.ajax({
        url: 'Assets/PHP/Configuration/FetchingBattingData.php',
        type: 'POST',
        data: { id: selectedId },
         dataType: 'json',
        success: function (response) {
      if (response.status === 'success' && response.data.length > 0) {
        const batting = response.data[0];

        // Populate the form fields
        $('#runs').val(batting.Runs || 0);
        $('#balls').val(batting.Balls || 0);
        $('#fours').val(batting.Fours || 0);
        $('#sixes').val(batting.Sixes || 0);
        $('#strike-rate').val(batting['Strike Rate'] || 0);
        $('#role').val(batting.Status || 'Out');
      } else {
        // Set default 0 or placeholder if no data
        $('#runs, #balls, #fours, #sixes, #strike-rate').val(0);
        $('#role').val('Out');
      }
        },
        error: function (xhr, status, error) {
          console.error('Error:', error);
        }
      });
    });
            
        });