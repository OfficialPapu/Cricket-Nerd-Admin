<?php
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | New Player</title>
</head>

<body>
    <div class="max-w-lg mx-auto my-24 bg-white p-5 rounded-lg shadow-lg transition-transform transform">
        <form id="playerForm" method="POST" enctype="multipart/form-data">
            <h1 class="mb-6 text-2xl text-center text-teal-800">New Player</h1>
            <div class="mb-5">
                <label class="block text-[13px] mb-[1px] font-bold text-teal-900" for="PlayerName">Player Name</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="PlayerName" name="PlayerName" required>
            </div>
            <div class="mb-4">
                <label for="PlayerRole" class="block text-[13px] mb-[1px] font-semibold text-green-900">Player Role</label>
                <select id="PlayerRole" name="PlayerRole" class="w-full p-3 border border-teal-200 rounded-md bg-green-50 transition duration-300 focus:border-teal-800 outline-none" required>
                    <option value="">Select Role</option>
                    <option value="Batsman">Batsman</option>
                    <option value="Bowler">Bowler</option>
                    <option value="All-Rounder">All-Rounder</option>
                    <option value="Wicket-Keeper Batsman">Wicket-Keeper Batsman</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="PlayerType" class="block text-[13px] mb-[1px] font-semibold text-green-900">Player Type</label>
                <select id="PlayerType" name="PlayerType" class="w-full p-3 border border-teal-200 rounded-md bg-green-50 transition duration-300 focus:border-teal-800 outline-none" required>
                    <option value="">Select Type</option>
                    <option value="Right-Hand Batsman">Right-Hand Batsman</option>
                    <option value="Left-Hand Batsman">Left-Hand Batsman</option>
                    <option value="Right-Hand Bowler">Right-Hand Bowler</option>
                    <option value="Left-Hand Bowler">Left-Hand Bowler</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="BattingStyle" class="block text-[13px] mb-[1px] font-semibold text-green-900">Batting Style</label>
                <select id="BattingStyle" name="BattingStyle" class="w-full p-3 border border-teal-200 rounded-md bg-green-50 transition duration-300 focus:border-teal-800 outline-none" required>
                    <option value="">Select Style</option>
                    <option value="Left Handed">Left Handed</option>
                    <option value="Right Handed">Right Handed</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="BowlingStyle" class="block text-[13px] mb-[1px] font-semibold text-green-900">Bowling Style</label>
                <select id="BowlingStyle" name="BowlingStyle" class="w-full p-3 border border-teal-200 rounded-md bg-green-50 transition duration-300 focus:border-teal-800 outline-none" required>
                    <option value="">Select Style</option>
                    <option value="Left Handed - Fast Bowler">Left Handed - Fast Bowler</option>
                    <option value="Right Handed - Fast Bowler">Right Handed - Fast Bowler</option>
                    <option value="Left Handed - Leg Spinner">Left Handed - Leg Spinner</option>
                    <option value="Right Handed - Leg Spinner">Right Handed - Leg Spinner</option>
                    <option value="Left Handed - Off Spinner">Left Handed - Off Spinner</option>
                    <option value="Right Handed - Off Spinner">Right Handed - Off Spinner</option>
                </select>
            </div>
            <div class="mb-5">
                <label class="block text-[13px] mb-[1px] font-bold text-teal-900" for="Image">Player Photo</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="file" id="Image" name="Image" accept="image/*" required>
            </div>
            <button class="w-full p-3 text-lg text-white bg-gradient-to-r from-teal-800 to-teal-600 rounded-lg cursor-pointer transition-colors hover:from-teal-600 hover:to-teal-800" type="submit">Submit</button>
        </form>
    </div>

    <script src="Update Players JS/New Player.js"></script>
</body>

</html>