<?php
$base_url = $_SERVER['DOCUMENT_ROOT'] . "/";
include $base_url . 'Assets/Components/Navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Admin | Insert Player Profile</title>
</head>
<body>
    <div class="max-w-[600px] mx-auto my-10 bg-white p-5 rounded-lg shadow-lg mt-[140px]">
        <form id="uploadForm" method="POST" enctype="multipart/form-data" data-playerid="<?php echo $_GET['PlayerID'];?>">
            <div class='flex justify-between items-center mb-6'>
                <h1 class="text-2xl text-center text-teal-700">Update Player Profile</h1>
                <a href="Pages/New Player.php" class='bg-[#d4edda] p-[10px] rounded-lg text-[#155724] font-bold text-[13px]'>New Player</a>
            </div>

            <div class="mb-5 relative">
                <div id="dropdownMenu" class="absolute w-full bg-background shadow-lg rounded-md border mt-2 z-10 bg-white h-[300px] overflow-auto hidden">
                    <div class="px-4 py-3 font-medium border-b">Choose an option</div>
                </div>
            </div>
            <input type="hidden" name="PlayerID" id="PlayerID">
            <div class="mb-4">
                <label for="format" class="block mb-[1px] text-[12px]">Match Format</label>
                <select id="format" name="format" class="w-full px-3 py-[0.7rem] border rounded-md outline-none bg-green-50 border-teal-200">
                    <option value="">Select Format</option>
                    <option value="t20i">T20I</option>
                    <option value="odi">ODI</option>
                    <option value="domestic">Domestic</option>
                </select>
            </div>

            <div class='flex justify-between gap-2 mb-4'>
                <div class="mb-4">
                    <label for="matches" class="block mb-[1px] text-[12px]">Total Matches</label>
                    <input type="number" id="matches" name="matches" class="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                </div>
                <div class="mb-4">
                    <label for="runs" class="block mb-[1px] text-[12px]">Runs Scored</label>
                    <input type="number" id="runs" name="runs" class="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                </div>
                
                <div class="mb-4">
                    <label for="innings" class="block mb-[1px] text-[12px]">Batting Innings</label>
                    <input type="number" id="battinginnings" name="battinginnings" class="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                </div>
                <div class="mb-4">
                    <label for="runs" class="block mb-[1px] text-[12px]">Bowling Innings</label>
                    <input type="number" id="bowlinginnings" name="bowlinginnings" class="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                </div>
                
            </div>

            <div class="mb-4">
                <label for="strikeRate" class="block mb-[1px] text-[12px]">Strike Rate</label>
                <input type="number" id="strikeRate" name="strikeRate" class="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
            </div>

            <div class='flex justify-between gap-2 mb-4'>
                <div class="mb-4">
                    <label for="highestScore" class="block mb-[1px] text-[12px]">Highest Score</label>
                    <input type="number" id="highestScore" name="highestScore" class="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                </div>
                <div class="mb-4">
                    <label for="halfCenturies" class="block mb-[1px] text-[12px]">Half Centuries</label>
                    <input type="number" id="halfCenturies" name="halfCenturies" class="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                </div>
                <div class="mb-4">
                    <label for="centuries" class="block mb-[1px] text-[12px]">Centuries</label>
                    <input type="number" id="centuries" name="centuries" class="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                </div>
            </div>

            <div class='flex justify-between gap-2 mb-6'>
                <div class="mb-4">
                    <label for="average" class="block mb-[1px] text-[12px]">Batting Average</label>
                    <input type="number" id="average" name="average" class="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                </div>
                <div class="mb-4">
                    <label for="economy" class="block mb-[1px] text-[12px]">Bowling Economy</label>
                    <input type="number" id="economy" name="economy" class="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                </div>
                <div class="mb-4">
                    <label for="economy" class="block mb-[1px] text-[12px]">Best Bowling </label>
                    <input type="text" id="bestbowling" name="bestbowling" class="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                </div>
                <div class="mb-4">
                    <label for="wickets" class="block mb-[1px] text-[12px]">Wickets Taken</label>
                    <input type="number" id="wickets" name="wickets" class="w-full px-3 py-[.50rem] border rounded-md outline-none bg-green-50 border-teal-200" />
                </div>
            </div>

            <button id="submitBtn" class="w-full px-3 py-[.50rem] border rounded-md bg-gradient-to-r from-teal-700 to-teal-900 text-white text-lg cursor-pointer hover:from-teal-900">
                Submit
            </button>
        </form>
    </div>
    
</body>
<script src="Assets/JS/Statistics.js" type="module"></script>
</html>
