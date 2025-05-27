<?php
session_start();
ob_start();
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
include $base_url . 'Assets/PHP/API/Config/Config.php';

$AllMatchesQuery = $conn->query("SELECT `ID`, `Tournament Name`, `Country A`, `Custom Name A`, `Custom Name B`, `Country B` FROM `matches`");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Squads</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Main Container -->
    <div class="container mx-auto px-6 py-10 mt-20">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Manage Squads</h1>

        <!-- Form Section -->
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg mx-auto">
            <form id="squadForm" class="space-y-6">

                <!-- Match Selection Dropdown -->
                <?php if ($AllMatchesQuery && $AllMatchesQuery->num_rows > 0): ?>
                    <div>
                        <label for="match" class="block text-lg font-medium text-gray-700">Select Match</label>
                        <select name="match" id="match" class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="" disabled selected class="text-gray-500">Choose a match</option>
                            <?php while ($row = $AllMatchesQuery->fetch_assoc()): 
                                $countryA = !empty($row['Custom Name A']) ? $row['Custom Name A'] : $row['Country A'];
                                $countryB = !empty($row['Custom Name B']) ? $row['Custom Name B'] : $row['Country B'];
                            ?>
                                <option value="<?= htmlspecialchars($row['ID']) ?>" 
                                    data-country-a="<?= htmlspecialchars($countryA) ?>" 
                                    data-country-b="<?= htmlspecialchars($countryB) ?>" 
                                    class="text-black">
                                    <?= htmlspecialchars($countryA . " Vs " . $countryB) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                <?php else: ?>
                    <p class="text-red-500">No matches available</p>
                <?php endif; ?>

                <!-- Country Selection Dropdown -->
                <div>
                    <label for="country" class="block text-lg font-medium text-gray-700">Select Country</label>
                    <select name="country" id="country" class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="" disabled selected class="text-gray-500">Choose a country</option>
                    </select>
                </div>

                <!-- Player Name Input -->
                <div>
                    <label for="player-name" class="block text-lg font-medium text-gray-700">Player Name</label>
                    <input type="text" name="PlayerName" id="player-name" class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Role Selection Dropdown -->
                <div>
                    <label for="type" class="block text-lg font-medium text-gray-700">Select Type</label>
                    <select name="type" id="type" class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="Playing">Playing</option>
                        <option value="Bench">Bench</option>
                    </select>
                </div>
                
                <div>
                    <label for="role" class="block text-lg font-medium text-gray-700">Select Role</label>
                    <select name="role" id="role" class="block w-full p-4 mt-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="Batter">Batter</option>
                        <option value="Bowler">Bowler</option>
                        <option value="WK Batter">WK Batter</option>
                        <option value="Batting All Rounder">Batting All Rounder</option>
                        <option value="Bowling All Rounder">Bowling All Rounder</option>
                    </select>
                </div>


                <!-- Submit Button -->
                <div class="flex items-center justify-center">
                    <button type="submit" class="w-full bg-blue-600 text-white text-lg font-semibold py-3 px-6 rounded-lg focus:outline-none hover:bg-blue-700 transition duration-200">Add Squad</button>
                </div>

                <!-- Message Output -->
                <p id="message" class="mt-4 text-center text-lg"></p>
            </form>
        </div>
    </div>

    <!-- Script for Dynamic Country Selection and Form Submission -->
    <script src="Assets/JS/Squads.js"></script>

</body>

</html>
