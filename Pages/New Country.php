<?php
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | New Country</title>
</head>

<body>
    <div class="max-w-lg mx-auto my-24 bg-white p-5 rounded-lg shadow-lg transition-transform transform">
        <form id="playerForm" method="POST" enctype="multipart/form-data">
            <h1 class="mb-6 text-2xl text-center text-teal-800">New Country</h1>
            <div class="mb-5">
                <label class="block text-[13px] mb-[1px] font-bold text-teal-900" for="CountryName">Country Name</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="CountryName" name="CountryName" required>
            </div>
            <div class="mb-5">
                <label class="block text-[13px] mb-[1px] font-bold text-teal-900" for="CountryCode">Country Code</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="CountryCode" name="CountryCode" required>
            </div>
        
            <div class="mb-5">
                <label class="block text-[13px] mb-[1px] font-bold text-teal-900" for="Image">Country Logo</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="file" id="Image" name="Image" accept="image/*" required>
            </div>
            <button class="w-full p-3 text-lg text-white bg-gradient-to-r from-teal-800 to-teal-600 rounded-lg cursor-pointer transition-colors hover:from-teal-600 hover:to-teal-800" type="submit">Submit</button>
        </form>
    </div>

    <script src="Assets/JS/New Country.js"></script>
</body>

</html>