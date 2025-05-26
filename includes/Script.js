$(document).ready(function () {
  $('.tab-btn').click(function () {
    let tabId = $(this).attr('id').replace('tab-', '');
    $('.tab-btn').removeClass('tab-active').addClass('border-gray-200 text-gray-600 hover:bg-gray-50 hover:border-gray-300');
    $('.tab-content').removeClass('active');
    $(this).addClass('tab-active').removeClass('border-gray-200 text-gray-600 hover:bg-gray-50 hover:border-gray-300');
    $('#content-' + tabId).addClass('active');
  });

  $('#match-selector').change(function () {
    $('#country-selector').prop('disabled', false);
    $('#country-selector').html('<option value="">Choose a country...</option>');
    let selectedOption = $(this).find(":selected");
    let countryA = selectedOption.data("country-a");
    let countryB = selectedOption.data("country-b");
    $("#country-selector").html('<option value="" disabled selected class="text-gray-500">Select a country</option>'); // Reset options
    $("#country-selector").append('<option value="' + countryA + '" class="text-black">' + countryA + '</option>');
    $("#country-selector").append('<option value="' + countryB + '" class="text-black">' + countryB + '</option>')
    $('#selected-match').text(selectedOption.text());
    $('#match-info').removeClass('hidden');
    FetchCommentary();
  });

  $('#country-selector').change(function () {
    let country = $(this).val();
    $('#selected-country').text(country);
    InsertPlayersIntoSelect();
    AppendExtrasData();
  });


  function InsertPlayersIntoSelect() {
    let MatchID = $('#match-selector').val();
    let Country = $('#country-selector').val();
    $.ajax({
      type: "GET",
      url: "Assets/PHP/API/GET/Scoreboard.php",
      data: { PlayerData: true, MatchID: MatchID, Country: Country },
      dataType: "json",
      success: function (response) {
        const playerOptions = ['<option value="" disabled selected>Select a player</option>'];
        response.forEach(player => {
          playerOptions.push(`<option value="${player.ID}">${player['Player Name']}</option>`);
        });
        const optionsHTML = playerOptions.join('');
        $('#batting-player, #bowling-player').html(optionsHTML);
      }
    });
  }

  $('#batting-player').change(function () {
    let SquadID = $(this).val();
    $.ajax({
      url: 'Assets/PHP/Configuration/FetchingBattingData.php',
      type: 'POST',
      data: { id: SquadID },
      dataType: 'json',
      success: function (response) {
        if (response.status === 'success' && response.data.length > 0) {
          const batting = response.data[0];
          $('#batting-runs').val(batting.Runs || 0);
          $('#batting-balls').val(batting.Balls || 0);
          $('#batting-fours').val(batting.Fours || 0);
          $('#batting-sixes').val(batting.Sixes || 0);
          $('#batting-sr').val(batting['Strike Rate'] || 0);
          $('#batting-status').val(batting.Status || 'Out').change();
        } else {
          $('#batting-runs, #batting-balls, #batting-fours, #batting-sixes, #batting-sr').val(0);
        }
      }
    });
  });


  $('#bowling-player').on('change', function () {
    let SquadID = $(this).val();
    $.ajax({
      url: 'Assets/PHP/Configuration/FetchingBowlingData.php',
      type: 'POST',
      data: { id: SquadID },
      dataType: 'json',
      success: function (response) {
        if (response.status === 'success' && response.data.length > 0) {
          const bowling = response.data[0];
          $('#bowling-overs').val(bowling.Overs || 0);
          $('#bowling-maidens').val(bowling.Maidens || 0);
          $('#bowling-runs').val(bowling.Runs || 0);
          $('#bowling-wickets').val(bowling.Wickets || 0);
          $('#bowling-economy').val(bowling.Economy || 0);
        } else {
          $('#bowling-overs, #bowling-maidens, #bowling-runs, #bowling-wickets, #bowling-economy').val(0);
        }
      }
    });
  });



  function AppendExtrasData() {
    let matchID = $('#match-selector').val();
    let country = $('#country-selector').val();
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
          $('#extras-inning').val(data['Inning'] || 0);
          $('#extras-byes').val(data['Byes'] || 0);
          $('#extras-leg-byes').val(data['Leg Byes'] || 0);
          $('#extras-wides').val(data['Wides'] || 0);
          $('#extras-no-balls').val(data['No Balls'] || 0);
          $('#extras-penalty-runs').val(data['Penalty Runs'] || 0);
          $('#extras-total').val(data['Total Extras'] || 0);
        } else {
          $('#extras-inning, #extras-byes, #extras-leg-byes, #extras-wides, #extras-no-balls, #extras-penalty-runs, #extras-total').val(0);
        }
      }
    });
  }

  function FetchCommentary() {
    let matchID = $('#match-selector').val();
    $.ajax({
      url: 'Assets/PHP/API/GET/Scoreboard.php',
      type: "GET",
      data: {
        FetchCommentary: true,
        matchID: matchID
      },
      dataType: 'json',
      success: function (response) {
        if (response.length > 0) {
          const data = response;
          $('#commentary-feed').html('');
          data.forEach(function (item) {
            $('#commentary-feed').append(`
              <div class="bg-white rounded-lg p-4 border-l-4 border-blue-400">
                <p class="text-gray-800">${item.Commentary}</p>
              </div>
            `);
          });
        } else {
          $('#commentary-feed').html('<div class="bg-white rounded-lg p-4">No commentary available</div>');
        }
      }
    });
  }

  $('#batting-form').on("submit", function (e) {
    e.preventDefault();
    if (!validateSelections()) return;
    if($('#batting-player').val() == "" || $('#batting-player').val() == null) {
      butterup.toast({
        message: 'Please select a player first',
        icon: true,
        dismissable: true,
        type: 'error',
      });
      return;
    }
    const formData = new FormData(this);
    formData.append("AddBatting", true);
    $.ajax({
      url: "Assets/PHP/API/POST/Scoreboard.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        response = response.trim();
        if (response === "Success") {
          butterup.toast({
            message: 'Batting stats successfully uploaded',
            icon: true,
            dismissable: true,
            type: 'success',
          });
        } else {
          butterup.toast({
            message: 'Error uploading batting stats',
            icon: true,
            dismissable: true,
            type: 'error',
          });
        }
      }
    });
  });

  $('#bowling-form').submit(function (e) {
    e.preventDefault();
    if (!validateSelections()) return;
    if($('#bowling-player').val() === "" || $('#bowling-player').val() === null) {
      butterup.toast({
        message: 'Please select a player first',
        icon: true,
        dismissable: true,
        type: 'error',
      });
      return;
    }
    const formData = new FormData(this);
    formData.append("AddBowling", true);

    $.ajax({
      url: "Assets/PHP/API/POST/Scoreboard.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        response = response.trim();
        if (response === "Success") {
          butterup.toast({
            message: 'Bowling stats successfully uploaded',
            icon: true,
            dismissable: true,
            type: 'success',
          });
        } else {
          butterup.toast({
            message: 'Error uploading bowling stats',
            icon: true,
            dismissable: true,
            type: 'error',
          });
        }
      }
    });
  });

  $('#extras-form').submit(function (e) {
    e.preventDefault();
    if (!validateSelections()) return;
    let matchID = $('#match-selector').val();
    let country = $('#country-selector').val();
    const formData = new FormData(this);
    formData.append("AddExtra", true);
    formData.append("match", matchID);
    formData.append("country", country);

    $.ajax({
      url: "Assets/PHP/API/POST/Scoreboard.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        response = response.trim();
        if (response === "Success") {
          butterup.toast({
            message: 'Extras successfully uploaded',
            icon: true,
            dismissable: true,
            type: 'success',
          });
        } else {
          butterup.toast({
            message: 'Error uploading extras',
            icon: true,
            dismissable: true,
            type: 'error',
          });
        }
      }
    });
  });

  $('#commentary-form').submit(function (e) {
    e.preventDefault();
    if (!$('#match-selector').val()) {
      butterup.toast({
        message: 'Please select a match first',
        icon: true,
        dismissable: true,
        type: 'error',
      });
      return;
    }
    let matchID = $('#match-selector').val();
    let commentary = $('#commentary-text').val();
    if (commentary.trim() === '') {
      butterup.toast({
        message: 'Please enter commentary text',
        icon: true,
        dismissable: true,
        type: 'error',
      });
      return;
    }

    $.ajax({
      url: 'Assets/PHP/API/POST/Scoreboard.php',
      method: 'POST',
      data: {
        AddCommentary: true,
        match: matchID,
        commentary: commentary
      },
      success: function (response) {
        $('#commentary-text').val('');
        response = response.trim();
        if (response === "Success") {
          FetchCommentary();
          butterup.toast({
            message: 'Commentary added successfully!',
            icon: true,
            dismissable: true,
            type: 'success',
          });
        } else {
          butterup.toast({
            message: 'Error adding commentary',
            icon: true,
            dismissable: true,
            type: 'error',
          });
        }
      }
    });
  });

  function validateSelections() {
    if (!$('#match-selector').val()) {
      butterup.toast({
        message: 'Please select a match first',
        icon: true,
        dismissable: true,
        type: 'error',
      });
      return false;
    }
    if (!$('#country-selector').val()) {
      butterup.toast({
        message: 'Please select a country first',
        icon: true,
        dismissable: true,
        type: 'error',
      });
      return false;
    }
    return true;
  }
});