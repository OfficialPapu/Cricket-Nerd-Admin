      $(document).ready(function() {
 
            $("#squadForm").on("submit", function(e) {
                e.preventDefault();
                const formData = $(this).serialize() + "&AddBowling=true";

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
        url: 'Assets/PHP/Configuration/FetchingBowlingData.php',
        type: 'POST',
        data: { id: selectedId },
         dataType: 'json',
        success: function (response) {
          if (response.status === 'success' && response.data.length > 0) {
          const bowling = response.data[0];
          $('#overs').val(bowling.Overs || 0);
          $('#maidens').val(bowling.Maidens || 0);
          $('#runs').val(bowling.Runs || 0);
          $('#wickets').val(bowling.Wickets || 0);
          $('#economy').val(bowling.Economy || 0);
        } else {
          // If no data exists, fill all fields with 0
          $('#overs, #maidens, #runs, #wickets, #economy').val(0);
        }
        },
        error: function (xhr, status, error) {
          console.error('Error:', error);
        }
      });
    });
            
        });
        