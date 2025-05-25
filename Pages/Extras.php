<?php
session_start();
ob_start();
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';
$AllMatchesQuery = $conn->query("SELECT `ID`, `Tournament Name`, `Country A`,
`Country B` FROM `matches` WHERE 1"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Extras</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
  <!-- Main Container -->
  <div class="container mx-auto px-6 py-10 mt-20">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">
      Manage Exras
    </h1>

    <!-- Form Section -->
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg mx-auto">
      <form id="squadForm" class="space-y-6">
        <!-- Match Selection Dropdown -->
        <?php
                if ($AllMatchesQuery && $AllMatchesQuery->num_rows > 0) { echo '
          <div>
            '; echo '<label
              for="match"
              class="block text-lg font-medium text-gray-700"
              >Select Match</label
            >'; echo '<select
              name="match"
              id="match"
              class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              '; echo '
              <option value="" disabled selected class="text-gray-500">
                Choose a match
              </option>
              '; while ($row = $AllMatchesQuery->fetch_assoc()) { echo '
              <option
                value="' . htmlspecialchars($row['ID']) . '"
                data-country-a="' . htmlspecialchars($row['Country A']) . '"
                data-country-b="' . htmlspecialchars($row['Country B']) . '"
                class="text-black"
              >
                ' . htmlspecialchars($row['Country A'] . " Vs " . $row['Country B']) . '
              </option>
              '; } echo '</select
            >'; echo '
          </div>
          '; } else { echo '
          <p class="text-red-500">No matches available</p>
          '; } ?>

        <!-- Country Selection Dropdown -->
        <div>
          <label for="country" class="block text-lg font-medium text-gray-700">Select Country</label>
          <select name="country" id="country"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="" disabled selected class="text-gray-500">
              Choose a country
            </option>
          </select>
        </div>

        <!-- Inning Input -->
        <div>
          <label for="inning" class="block text-lg font-medium text-gray-700">Inning</label>
          <input type="number" name="Inning" id="inning"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required />
        </div>

        <!-- Byes Input -->
        <div>
          <label for="byes" class="block text-lg font-medium text-gray-700">Byes</label>
          <input type="number" name="Byes" id="byes"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required />
        </div>

        <!-- Leg Byes Input -->
        <div>
          <label for="leg-byes" class="block text-lg font-medium text-gray-700">Leg Byes</label>
          <input type="number" name="LegByes" id="leg-byes"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required />
        </div>

        <!-- Wides Input -->
        <div>
          <label for="wides" class="block text-lg font-medium text-gray-700">Wides</label>
          <input type="number" name="Wides" id="wides"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required />
        </div>

        <!-- No Balls Input -->
        <div>
          <label for="no-balls" class="block text-lg font-medium text-gray-700">No Balls</label>
          <input type="number" name="NoBalls" id="no-balls"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required />
        </div>

        <!-- Penalty Runs Input -->
        <div>
          <label for="penalty-runs" class="block text-lg font-medium text-gray-700">Penalty Runs</label>
          <input type="number" name="PenaltyRuns" id="penalty-runs"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required />
        </div>

        <!-- Total Extras Input -->
        <div>
          <label for="total-extras" class="block text-lg font-medium text-gray-700">Total Extras</label>
          <input type="number" name="TotalExtras" id="total-extras"
            class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            required />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-center">
          <button type="submit"
            class="w-full bg-blue-600 text-white text-lg font-semibold py-3 px-6 rounded-lg focus:outline-none hover:bg-blue-700 transition duration-200">
            Add Extra
          </button>
        </div>

        <!-- Message Output -->
        <p id="message" class="mt-4 text-center text-lg"></p>
      </form>
    </div>
  </div>

  <!-- Script for Dynamic Country Selection and Form Submission -->
  <script src="Assets/JS/Extra.js"></script>
</body>

</html>