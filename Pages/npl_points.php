<?php
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
// $base_url = $_SERVER['DOCUMENT_ROOT'] . "/The Cricket Nerd Admin/";
include $base_url . 'Assets/Components/Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Points Table</title>
</head>
<body>
    <div class="max-w-lg mx-auto my-24 bg-white p-5 rounded-lg shadow-lg transition-transform transform">
        <form id="uploadForm" method="POST" enctype="multipart/form-data">
            <h1 class="mb-6 text-2xl text-center text-teal-800">Create Points Table</h1>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" for="videoTitle">Tournament Title</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="videoTitle" name="TournamentTitle">
            </div>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" for="videoLink">Team Name</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="videoLink" name="TeamName">
            </div>
            <button class="w-full p-3 text-lg text-white bg-gradient-to-r from-teal-800 to-teal-600 rounded-lg cursor-pointer transition-colors hover:from-teal-600 hover:to-teal-800" type="submit">Submit</button>
        </form>
    </div>
    <script src="Assets/JS/npl_points.js" type="module"></script>
</body>
</html>
