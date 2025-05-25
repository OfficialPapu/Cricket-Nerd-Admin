<?php
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
// $base_url = $_SERVER['DOCUMENT_ROOT'] . "/The Cricket Nerd Admin/"; // Ensure this is correct
include $base_url . 'Assets/Components/Navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/CSS/Quill.css">
    <title>NPL | Update</title>
</head>

<body>
    <div class="max-w-4xl mx-auto my-24 bg-white p-5 rounded-lg shadow-lg transition-transform transform">
        <form id="nplForm">
            <h1 class="mb-6 text-2xl text-center text-teal-800">Upload Player Profile for all tournament Points table</h1>
            <div class="mb-4">
                <label for="PlayerRole" class="block text-[13px] mb-[1px] font-semibold text-green-900">Player Configuration</label>
                <select id="PlayerRole" name="PlayerRole" class="w-full p-3 border border-teal-200 rounded-md bg-green-50 transition duration-300 focus:border-teal-800 outline-none" required>
                    <option value="">Upload Stats For</option>
                    <option value="Batsman">Batsman</option>
                    <option value="Bowler">Bowler</option>
                </select>
            </div>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" for="playerName">Player Name</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="playerName" name="PlayerName" required/>
            </div>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" for="playerName">Tournament Title</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="Title" placeholder="eg:NPL 2025,IPL 2025 etc" name="Title" required/>
            </div>
            <button class="w-full p-3 text-lg text-white bg-gradient-to-r from-teal-800 to-teal-600 rounded-lg cursor-pointer transition-colors hover:from-teal-600 hover:to-teal-800" type="submit">Submit</button>
        </form>
    </div>

    <script src="Assets/JS/Quill.js"></script>
    <script src="Assets/JS/npl.js"></script>
</body>

</html>
