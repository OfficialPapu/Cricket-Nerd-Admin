<?php
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Upload Matches</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <div class="max-w-lg mx-auto my-24 bg-white p-5 rounded-lg shadow-lg transition-transform transform">
        <form id="uploadForm">
            <h1 class="mb-6 text-2xl text-center text-teal-800">Upload Matches</h1>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" for="name">Tournament Name</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="name" name="TournamentName" />
            </div>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" for="name">Match Link</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="text" id="Link" name="Link" />
            </div>
            <div class="mb-5 relative">
                <label class="block mb-2 font-bold text-teal-900" for="countryA">Country A</label>
                <div class="flex items-center justify-between w-full px-4 py-2 rounded-md hover:bg-muted border cursor-pointer" id="dropdownCountryA" tabindex="0">
                    <div class="flex items-center gap-2">
                        <img id="selectedIconA" src="https://generated.vusercontent.net/placeholder.svg" alt="Selected option" width="24" height="24" class="rounded-md" />
                        <span id="selectedCountryA">Select a Flag</span>
                    </div>
                    <i class="fas" id="iconCountryA"></i>
                </div>
                <div id="dropdownMenuA" class="absolute w-full bg-background shadow-lg rounded-md border mt-2 z-10 bg-white h-[300px] overflow-auto hidden">
                    <div class="px-4 py-3 font-medium border-b">Choose an option</div>
                </div>
            </div>
            <div class="mb-5 relative">
                <label class="block mb-2 font-bold text-teal-900" for="countryB">Country B</label>
                <div class="flex items-center justify-between w-full px-4 py-2 rounded-md hover:bg-muted border cursor-pointer" id="dropdownCountryB" tabindex="0">
                    <div class="flex items-center gap-2">
                        <img id="selectedIconB" src="https://generated.vusercontent.net/placeholder.svg" alt="Selected option" width="24" height="24" class="rounded-md" />
                        <span id="selectedCountryB">Select a Flag</span>
                    </div>
                    <i class="fas" id="iconCountryB"></i>
                </div>
                <div id="dropdownMenuB" class="absolute w-full bg-background shadow-lg rounded-md border mt-2 z-10 bg-white h-[300px] overflow-auto hidden">
                    <div class="px-4 py-3 font-medium border-b">Choose an option</div>
                </div>
            </div>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" for="schedule">Schedule</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="date" id="schedule" name="Schedule" />
            </div>
            <div class="mb-5">
                <label class="block mb-2 font-bold text-teal-900" for="time">Time</label>
                <input class="w-full p-3 border border-teal-200 rounded-lg bg-green-50 focus:border-teal-800 focus:outline-none" type="time" id="time" name="Time" />
            </div>
            <button class="w-full p-3 text-lg text-white bg-gradient-to-r from-teal-800 to-teal-600 rounded-lg cursor-pointer transition-colors hover:from-teal-600 hover:to-teal-800" type="submit">Submit</button>
        </form>
    </div>

</body>
<script src="Assets/JS/Matches.js" type="module"></script>
</html>