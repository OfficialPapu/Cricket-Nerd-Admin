<?php
session_start();
ob_start();
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';
$squadsQuery = $conn->query("SELECT `ID`, `Match ID`, `Team`, `Player Name`,
`Type` FROM `squads`"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Batting</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
  <!-- Main Container -->
  <div class="container mx-auto px-6 py-10 mt-20">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">
      Manage Batting
    </h1>

    <!-- Form Section -->
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg mx-auto">
      <form id="squadForm" class="space-y-6">
        <div>
          <label for="team" class="block text-lg font-medium text-gray-700">Select Squad</label>
          <select name="squad" id="team"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected class="text-gray-500">
              Choose a team
            </option>
            <?php
        if ($squadsQuery && $squadsQuery->num_rows > 0) { while ($row =
              $squadsQuery->fetch_assoc()) { echo '
              <option
                value="' . htmlspecialchars($row['ID']) . '"
                class="text-black"
              >
                ' . htmlspecialchars($row['Player Name']) . '
              </option>
              '; } } ?>
          </select>
        </div>

        <div>
          <label for="runs" class="block text-lg font-medium text-gray-700">Runs</label>
          <input type="number" name="Runs" id="runs"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required />
        </div>

        <div>
          <label for="balls" class="block text-lg font-medium text-gray-700">Balls</label>
          <input type="number" name="Balls" id="balls"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required />
        </div>

        <div>
          <label for="fours" class="block text-lg font-medium text-gray-700">Fours</label>
          <input type="number" name="Fours" id="fours"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required />
        </div>

        <div>
          <label for="sixes" class="block text-lg font-medium text-gray-700">Sixes</label>
          <input type="number" name="Sixes" id="sixes"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required />
        </div>

        <div>
          <label for="strike-rate" class="block text-lg font-medium text-gray-700">Strike Rate</label>
          <input type="text" name="StrikeRate" id="strike-rate"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required />
        </div>
       <div>
     <label for="role" class="block text-lg font-medium text-gray-700">Select Status</label>
                    <select name="status" id="role" class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="Out">Out</option>
                        <option value="Not Out">Not Out</option>
        </select>
    </div>
        <!-- Submit Button -->
        <div class="flex items-center justify-center">
          <button type="submit"
            class="w-full bg-blue-600 text-white text-lg font-semibold py-3 px-6 rounded-lg focus:outline-none hover:bg-blue-700 transition duration-200">
            Add Batting
          </button>
        </div>

        <!-- Message Output -->
        <p id="message" class="mt-4 text-center text-lg"></p>
      </form>
    </div>
  </div>

  <!-- Script for Dynamic Country Selection and Form Submission -->
  <script src="Assets/JS/Batting.js"></script>
</body>

</html>