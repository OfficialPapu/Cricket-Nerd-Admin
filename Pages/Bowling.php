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
  <title>Add Bowling</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
  <!-- Main Container -->
  <div class="container mx-auto px-6 py-10 mt-20">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">
      Manage Bowling
    </h1>

    <!-- Form Section -->
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg mx-auto">
      <form id="squadForm" class="space-y-6">
        <div>
          <label for="team" class="block text-lg font-medium text-gray-700">Select Squad</label>
          <select name="squad" id="team"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected class="text-gray-500">
              Choose a player
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
    <label for="overs" class="block text-lg font-medium text-gray-700">Overs</label>
    <input type="number" name="Overs" id="overs"
        class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        required />
</div>

<div>
    <label for="maidens" class="block text-lg font-medium text-gray-700">Maidens</label>
    <input type="number" name="Maidens" id="maidens"
        class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        required />
</div>

<div>
    <label for="runs" class="block text-lg font-medium text-gray-700">Runs</label>
    <input type="number" name="Runs" id="runs"
        class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        required />
</div>

<div>
    <label for="wickets" class="block text-lg font-medium text-gray-700">Wickets</label>
    <input type="number" name="Wickets" id="wickets"
        class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        required />
</div>

<div>
    <label for="economy" class="block text-lg font-medium text-gray-700">Economy</label>
    <input type="text" name="Economy" id="economy"
        class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        required />
</div>


        <!-- Submit Button -->
        <div class="flex items-center justify-center">
          <button type="submit"
            class="w-full bg-blue-600 text-white text-lg font-semibold py-3 px-6 rounded-lg focus:outline-none hover:bg-blue-700 transition duration-200">
            Add Bowling
          </button>
        </div>

        <!-- Message Output -->
        <p id="message" class="mt-4 text-center text-lg"></p>
      </form>
    </div>
  </div>

  <!-- Script for Dynamic Country Selection and Form Submission -->
  <script src="Assets/JS/Bowling.js"></script>
</body>

</html>