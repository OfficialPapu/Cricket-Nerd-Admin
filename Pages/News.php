<?php
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | News</title>
</head>

<body>
    <div class="max-w-lg mx-auto my-24 bg-white p-5 rounded-lg shadow-lg transition-transform transform">
        <form id="newsForm">
            <h1 class="mb-6 text-2xl text-center text-teal-800">Upload News</h1>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" htmlFor="title">Title</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" name="Title"/>
            </div>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" htmlFor="title">Author</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" name="Author"/>
            </div>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" htmlFor="description">Description</label>
                <textarea class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" rows="5" name="Description"></textarea>
            </div>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" htmlFor="screenshots">Select Best Photo</label>
                <input class="w-full p-1 border border-teal-200 rounded-lg" type="file" id="screenshots" name="Image" accept="image/*" />
            </div>
            <button class="w-full p-3 text-lg text-white bg-gradient-to-r from-teal-800 to-teal-600 rounded-lg cursor-pointer transition-colors hover:from-teal-600 hover:to-teal-800">Submit</button>
        </form>
    </div>

</body>
<script src="Assets/JS/News.js" type="module"></script>
</html>