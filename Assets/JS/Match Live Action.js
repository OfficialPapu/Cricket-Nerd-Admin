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
    const countries = [countryA, countryB];
    const countryOptions = countries.map(c => `<option value="${c}" class="text-black">${c}</option>`).join("");
    $("#country-selector").html(`<option value="" disabled selected class="text-gray-500">Select a country</option>${countryOptions}`);
    $("#current-batting").html(`<option value="" disabled selected class="text-gray-500">Select batting</option>${countryOptions}`);
    $('#selected-match').text(selectedOption.text());
    $('#match-info').removeClass('hidden');
    FetchCommentary();
  });

  $('#country-selector').change(function () {
    let country = $(this).val();
    $('#selected-country').text(country);
    InsertPlayersIntoSelect();
    AppendExtrasData();
    $('#score-dashboard').removeClass('hidden');
    $('#country-b-label').text(`${country} Score`);
    UpdateScoreboard();
    FetchPlayers();
  });

  function UpdateScoreboard() {
    let MatchID = $('#match-selector').val();
    let Country = $('#country-selector').val();
    $.ajax({
      type: "GET",
      url: "Assets/PHP/API/GET/Scoreboard.php",
      data: { FetchScore: true, MatchID: MatchID, Country: Country },
      dataType: "json",
      success: function (response) {
        const data = response[0];
        if (response.length > 0) {
          $('#score').val(data['Score']);
          $('#over').val(data['Over']);
          $('#total-overs').val(data['Total Overs']);
          if (data.Status) {
            $('#match-status').val(data.Status).change();
          } else {
            $('#match-status').val("").change();
          }
          $('#current-batting').val(data.Batting).change();
          $('#toss').val(data.Toss);
          $('#match-result').val(data.Result);
        }
      }
    });
  }

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
          if (batting['Batter Striker']) {
            $('#batting-striker').val(batting['Batter Striker']).change();
          }
          if (batting['Batter Action']) {
            $('#batting-action').val(batting['Batter Action']).change();
          }
          $('#dismissal').val(batting.Dismissal || "");
        } else {
          $('#batting-runs, #batting-balls, #batting-fours, #batting-sixes, #batting-sr').val(0);
          $('#dismissal').val("");
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
          $('#bowling-noball').val(bowling['No Balls'] || 0);
          $('#bowling-wide').val(bowling['Wides'] || 0);
          if (bowling['Bowler Striker']) {
            $('#bowling-striker').val(bowling['Bowler Striker']).change();
          }
          if (bowling['Bowler Action']) {
            $('#bowling-action').val(bowling['Bowler Action']).change();
          }
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


  // Event handlers
  $(document).on('click', '.custom-checkbox', function () {
    const squadId = parseInt($(this).data('squad-id'));
    let isPlaying = $(this).hasClass('checked');
    UpdatePlayerType(squadId, isPlaying);
  });

  $(document).on('click', '.player-card', function (e) {
    if (!$(e.target).hasClass('custom-checkbox')) {
      const squadId = parseInt($(this).data('squad-id'));
      let isPlaying = $(this).hasClass('selected');
      UpdatePlayerType(squadId, isPlaying);
    }
  });

  function UpdatePlayerType(squadId, isPlaying) {
    let Type = !isPlaying ? 'Playing' : 'Bench';
    $.ajax({
      url: 'Assets/PHP/API/POST/Scoreboard.php',
      type: 'POST',
      data: { UpdatePlayerType: true, squadId: squadId, Type: Type },
      success: function (response) {
        response = response.trim();
        if (response === "Success") {
          FetchPlayers();
        } else {
          butterup.toast({
            message: 'Error updating player type',
            icon: true,
            dismissable: true,
            type: 'error',
          });
        }
      }
    });
  }

  function FetchPlayers() {
    let matchID = $('#match-selector').val();
    let country = $('#country-selector').val();
    $.ajax({
      url: 'Assets/PHP/API/GET/Scoreboard.php',
      type: "GET",
      data: {
        FetchPlayers: true,
        matchID: matchID,
        country: country
      },
      dataType: 'json',
      success: function (response) {
        if (response.length > 0) {
          RenderPlayers(response);
          updateCounts(response);
          updateSelectedTeam(response);
        } else {
          $('#players-grid').html('<div class="player-card">No players available</div>');
          $('#selected-team-section').hide();
        }
      }
    });
  }
  $('#score-form').on("submit", function (e) {
    e.preventDefault();
    if (!validateSelections()) return;
    let matchID = $('#match-selector').val();
    let country = $('#country-selector').val();
    let matchstatus = $('#match-status').val();
    const formData = new FormData(this);
    formData.append("MatchID", matchID);
    formData.append("Country", country);
    formData.append("matchstatus", matchstatus);
    formData.append("UpdateScoreBoard", true);
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
            message: 'Score successfully updated',
            icon: true,
            dismissable: true,
            type: 'success',
          });
        } else {
          butterup.toast({
            message: 'Error updating score',
            icon: true,
            dismissable: true,
            type: 'error',
          });
        }
      }
    });
  })


  $('#batting-form').on("submit", function (e) {
    e.preventDefault();
    if (!validateSelections()) return;
    if ($('#batting-player').val() == "" || $('#batting-player').val() == null) {
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
    if ($('#bowling-player').val() === "" || $('#bowling-player').val() === null) {
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

  function RenderPlayers(players) {
    const grid = $('#players-grid');
    grid.empty();
    players.forEach(player => {
      const playerCard = $(`
                    <div class="player-card bg-white border rounded-lg p-4 ${player.Type === 'Playing' ? 'selected' : ''}" data-squad-id="${player.ID}">
                        <div class="flex items-center space-x-4">
                            <div class="custom-checkbox ${player.Type === 'Playing' ? 'checked' : ''}" data-squad-id="${player.ID}"></div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 brand-blue rounded-full flex items-center justify-center text-white">
                                        <span>${player['Player Name'][0].toUpperCase()}${player['Player Name'].split(' ')[1][0].toUpperCase()}</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">${player['Player Name']}</h4>
                                        <p class="text-sm text-gray-600">${player['Role']}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                ${player.Type === 'Playing' ? '<i class="fas fa-check-circle text-green-500"></i>' : ''}
                            </div>
                        </div>
                    </div>
                `);

      grid.append(playerCard);
    });
  }
});

function updateCounts(players) {
  const selectedCount = players.filter(p => p.Type === 'Playing').length;
  if (selectedCount > 0) {
    $('#selected-team-section').show();
  } else {
    $('#selected-team-section').hide();
  }
}

function updateSelectedTeam(players) {
  const selectedPlayers = players.filter(p => p.Type === 'Playing');
  const selectedContainer = $('#selected-players');
  selectedContainer.empty();

  selectedPlayers.forEach((player, index) => {
    const playerItem = $(`
                  <div class="flex items-center p-3 bg-blue-50 rounded-lg border border-blue-200">
                      <div class="w-8 h-8 brand-blue text-white rounded-full flex items-center justify-center mr-3 text-sm font-bold">
                          ${index + 1}
                      </div>
                      <div class="flex-1">
                          <h5 class="font-semibold text-gray-800">${player['Player Name']}</h5>
                          <p class="text-xs text-gray-600">${player['Role']}</p>
                      </div>
                  </div>
              `);
    selectedContainer.append(playerItem);
  });
}

